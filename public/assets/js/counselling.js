/* Exam and counselling pages: "Your details", the counselling list filters, the explorers (cutoffs, seat matrix,
   colleges) and small bits (rules tabs, switcher, "coming soon" alerts). Pages work without it; this makes them live. */
(function () {
    'use strict';
    var root = document.querySelector('main.cz');
    if (!root) return;

    // ------------------------------------------------------------------ toast
    var toastEl = null, toastTimer = null;
    function toast(msg) {
        if (!toastEl) {
            toastEl = document.createElement('div');
            toastEl.className = 'cz-toast';
            toastEl.setAttribute('role', 'status');
            document.body.appendChild(toastEl);
        }
        toastEl.textContent = msg;
        toastEl.hidden = false;
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toastEl.hidden = true; }, 2600);
    }

    // ------------------------------------------------------------------ "Your details" (cookie read by the server)
    var COOKIE = 'ez_profile';
    function readProfile() {
        var m = document.cookie.match(/(?:^|;\s*)ez_profile=([^;]*)/);
        try { return m ? JSON.parse(decodeURIComponent(m[1])) || {} : {}; } catch (e) { return {}; }
    }
    function saveProfile(p) {
        document.cookie = COOKIE + '=' + encodeURIComponent(JSON.stringify(p)) + ';path=/;max-age=31536000;SameSite=Lax';
    }
    var reloadOnProfile = root.hasAttribute('data-cz-reload-on-profile');
    var explorer = root.getAttribute('data-cz-explorer');
    var rankTimer = null;

    function onProfileInput(el, immediate) {
        var key = el.getAttribute('data-p');
        var p = readProfile();
        var v = el.value.trim();
        if (key === 'rank') v = v && parseInt(v, 10) > 0 ? parseInt(v, 10) : null;
        if (key === 'cat') v = v ? parseInt(v, 10) : null;
        p[key] = v || null;
        saveProfile(p);
        // keep other copies of the same field in step
        root.querySelectorAll('[data-p="' + key + '"]').forEach(function (o) { if (o !== el) o.value = el.value; });
        if (explorer) return;   // the explorer form refetches by itself (the field is part of it)
        if (reloadOnProfile) {
            clearTimeout(rankTimer);
            rankTimer = setTimeout(function () { location.reload(); }, immediate ? 0 : 700);
        }
    }
    root.addEventListener('change', function (e) { if (e.target.matches('[data-p]')) onProfileInput(e.target, true); });

    // ------------------------------------------------------------------ "coming soon" (alerts)
    root.addEventListener('click', function (e) {
        var b = e.target.closest('[data-cz-soon]');
        if (b) { e.preventDefault(); toast(b.getAttribute('data-cz-soon') + ' are coming soon. Check back shortly.'); }
    });

    // ------------------------------------------------------------------ counselling switcher (keeps the filters that still make sense)
    var sw = root.querySelector('[data-cz-switch]');
    if (sw) {
        sw.addEventListener('change', function () {
            var opt = sw.options[sw.selectedIndex];
            var url = new URL(opt.getAttribute('data-url'), location.href);
            var keep = ['q', 'state', 'type', 'category', 'rank', 'sort', 'per_page', 'fee', 'within'];
            var cur = new URLSearchParams(location.search);
            keep.forEach(function (k) { if (cur.get(k)) url.searchParams.set(k, cur.get(k)); });
            location.href = url.toString();
        });
    }

    // ------------------------------------------------------------------ deposit rules tabs
    root.querySelectorAll('[data-cz-rule]').forEach(function (chip) {
        chip.addEventListener('click', function () {
            var id = chip.getAttribute('data-cz-rule');
            root.querySelectorAll('[data-cz-rule]').forEach(function (c) { c.setAttribute('aria-pressed', String(c === chip)); });
            root.querySelectorAll('[data-cz-rules]').forEach(function (tb) { tb.hidden = tb.getAttribute('data-cz-rules') !== id; });
        });
    });

    // ------------------------------------------------------------------ all counsellings: search + type/status chips
    var hubList = root.querySelector('#cz-hub-list');
    if (hubList) {
        var hub = { q: '', type: 'all', status: 'all' };
        var params = new URLSearchParams(location.search);
        hub.q = params.get('q') || '';
        hub.type = params.get('type') || 'all';
        hub.status = params.get('status') || 'all';
        var qInput = root.querySelector('[data-cz-hub="q"]');
        var groups = root.querySelectorAll('[data-cz-hub="type"], [data-cz-hub="status"]');

        function applyHub() {
            var q = hub.q.trim().toLowerCase(), shown = { mine: 0, rest: 0 };
            hubList.querySelectorAll('[data-cz-item]').forEach(function (it) {
                var ok = (hub.type === 'all' || it.getAttribute('data-level') === hub.type)
                    && (hub.status === 'all' || it.getAttribute('data-status') === hub.status)
                    && (!q || it.getAttribute('data-search').indexOf(q) !== -1);
                it.hidden = !ok;
                if (ok) shown[it.getAttribute('data-mine') === '1' ? 'mine' : 'rest']++;
            });
            ['mine', 'rest'].forEach(function (g) {
                var h = hubList.querySelector('[data-cz-group="' + g + '"]');
                if (h) { h.hidden = !shown[g]; h.querySelector('span').textContent = shown[g]; }
            });
            var empty = hubList.querySelector('[data-cz-empty]');
            if (empty) empty.hidden = (shown.mine + shown.rest) > 0;
            var url = new URL(location.href);
            ['q', 'type', 'status'].forEach(function (k) {
                if (hub[k] && hub[k] !== 'all') url.searchParams.set(k, hub[k]); else url.searchParams.delete(k);
            });
            history.replaceState(null, '', url.toString());
        }
        if (qInput) {
            qInput.value = hub.q;
            var qt = null;
            qInput.addEventListener('input', function () { clearTimeout(qt); qt = setTimeout(function () { hub.q = qInput.value; applyHub(); }, 200); });
        }
        groups.forEach(function (g) {
            var key = g.getAttribute('data-cz-hub');
            g.querySelectorAll('button').forEach(function (b) { b.setAttribute('aria-pressed', String(b.getAttribute('data-v') === hub[key])); });
            g.addEventListener('click', function (e) {
                var b = e.target.closest('button'); if (!b) return;
                hub[key] = b.getAttribute('data-v');
                g.querySelectorAll('button').forEach(function (x) { x.setAttribute('aria-pressed', String(x === b)); });
                applyHub();
            });
        });
        applyHub();
    }

    // ------------------------------------------------------------------ explorers: filters live in the URL, results are fetched
    var form = root.querySelector('[data-cz-filters]');
    var results = root.querySelector('#cz-results');
    if (form && results) {
        var wrap = form.querySelector('[data-cz-filters-wrap]');
        var mq = window.matchMedia('(min-width: 761px)');
        function syncDetails() { if (wrap) wrap.open = mq.matches || wrap.hasAttribute('data-user-open'); }
        if (wrap) wrap.addEventListener('toggle', function () { if (!mq.matches) { if (wrap.open) wrap.setAttribute('data-user-open', ''); else wrap.removeAttribute('data-user-open'); } });
        syncDetails();
        if (mq.addEventListener) mq.addEventListener('change', syncDetails);

        var pending = null, searchTimer = null;
        function queryString() {
            var fd = new FormData(form), qs = new URLSearchParams();
            fd.forEach(function (v, k) { if (v !== '' && v !== null) qs.set(k, v); });
            return qs.toString();
        }
        function setField(name, value) {
            var el = form.elements[name];
            if (!el) return;
            if (el.type === 'checkbox') el.checked = !!value; else el.value = value;
        }
        function updateCount() {
            var n = parseInt((results.querySelector('[data-cz-active]') || { getAttribute: function () { return '0'; } }).getAttribute('data-cz-active'), 10) || 0;
            var c = form.querySelector('[data-cz-fcount]');
            if (c) c.textContent = n ? '(' + n + ')' : '';
        }
        function load(push) {
            var qs = queryString();
            var url = location.pathname + (qs ? '?' + qs : '');
            if (pending) pending.abort();
            pending = new AbortController();
            results.classList.add('is-loading');
            fetch(url, { headers: { 'X-Cz-Partial': '1', 'Accept': 'text/html' }, credentials: 'same-origin', signal: pending.signal })
                .then(function (r) { if (!r.ok) throw new Error('HTTP ' + r.status); return r.text(); })
                .then(function (html) {
                    results.innerHTML = html;
                    results.classList.remove('is-loading');
                    if (push) history.pushState({ cz: 1 }, '', url); else history.replaceState({ cz: 1 }, '', url);
                    updateCount();
                })
                .catch(function (err) {
                    if (err.name === 'AbortError') return;
                    results.classList.remove('is-loading');
                    location.href = url;   // fall back to a normal page load
                });
        }
        function changed(resetPage) {
            if (resetPage) setField('page', '');
            load(true);
        }

        form.addEventListener('submit', function (e) { e.preventDefault(); changed(true); });
        form.addEventListener('input', function (e) {
            var t = e.target;
            if (t.name === 'q' || t.name === 'rank') {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function () {
                    if (t.name === 'rank') onProfileInput(t, true);
                    changed(true);
                }, 350);
            }
        });
        form.addEventListener('change', function (e) {
            var t = e.target;
            if (t.name === 'q' || t.name === 'rank') return;   // handled on input
            if (t.hasAttribute('data-cz-full')) {   // changes the page header too (round, version notice): load the whole page
                setField('page', '');
                var qs = queryString();
                location.href = location.pathname + (qs ? '?' + qs : '');
                return;
            }
            changed(t.name !== 'page');
        });
        // the sort select lives in the results (form="cz-filters"); delegated clicks for sort headers, pager, chips
        results.addEventListener('change', function (e) { if (e.target.name === 'sort') changed(true); });
        results.addEventListener('click', function (e) {
            var a;
            if ((a = e.target.closest('[data-cz-page]'))) { e.preventDefault(); setField('page', a.getAttribute('data-cz-page') === '1' ? '' : a.getAttribute('data-cz-page')); load(true); form.scrollIntoView({ block: 'start' }); return; }
            if ((a = e.target.closest('[data-cz-size]'))) { e.preventDefault(); setField('per_page', a.getAttribute('data-cz-size') === '25' ? '' : a.getAttribute('data-cz-size')); changed(true); return; }
            if ((a = e.target.closest('[data-cz-sort]'))) {
                e.preventDefault();
                var s = results.querySelector('select[name="sort"]');
                var v = a.getAttribute('data-cz-sort');
                if (s) {
                    if (!Array.prototype.some.call(s.options, function (o) { return o.value === v; })) { var o = document.createElement('option'); o.value = v; o.textContent = v; s.appendChild(o); }
                    s.value = v;
                }
                changed(true);
                return;
            }
            if ((a = e.target.closest('[data-cz-clear]'))) { e.preventDefault(); setField(a.getAttribute('data-cz-clear'), ''); changed(true); }
        });
        window.addEventListener('popstate', function () {
            var p = new URLSearchParams(location.search);
            Array.prototype.forEach.call(form.elements, function (el) {
                if (!el.name || el.name === 'sort') return;
                if (el.type === 'checkbox') el.checked = !!p.get(el.name); else el.value = p.get(el.name) || '';
            });
            load(false);
        });
        updateCount();
    }
})();
