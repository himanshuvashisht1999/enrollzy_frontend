/* Exams, Counselling & Cutoffs: filters that apply themselves, the counselling picker, syllabus tabs, the "On this
   page" highlight, alerts sign-up, and remembering the visitor's state / category / rank (ez_profile cookie, read by
   the server). Every page also works without this script: filters are plain GET forms, pages are plain links. */
(function () {
    'use strict';
    var root = document.querySelector('main.ec');
    if (!root) return;
    var $$ = function (sel, el) { return Array.prototype.slice.call((el || root).querySelectorAll(sel)); };

    var toastEl = null, toastT = null;
    function toast(msg) {
        if (!toastEl) { toastEl = document.createElement('div'); toastEl.className = 'ec-toast'; toastEl.setAttribute('role', 'status'); root.appendChild(toastEl); }
        toastEl.textContent = msg; toastEl.hidden = false; clearTimeout(toastT);
        toastT = setTimeout(function () { toastEl.hidden = true; }, 3200);
    }

    // ------------------------------------------------------------------ the visitor's details (same cookie as the counselling pages)
    function readProfile() {
        var m = document.cookie.match(/(?:^|;\s*)ez_profile=([^;]*)/);
        try { return m ? JSON.parse(decodeURIComponent(m[1])) || {} : {}; } catch (e) { return {}; }
    }
    function remember(el) {
        var key = el.getAttribute('data-ec-remember'), v = el.value.trim(), p = readProfile();
        if (key === 'rank' || key === 'cat') v = v && parseInt(v, 10) > 0 ? parseInt(v, 10) : null;
        p[key] = v || null;
        document.cookie = 'ez_profile=' + encodeURIComponent(JSON.stringify(p)) + ';path=/;max-age=31536000;SameSite=Lax';
    }

    // ------------------------------------------------------------------ filters: GET forms that submit themselves
    $$('form[data-ec-autosubmit]').forEach(function (form) {
        var t = null;
        var go = function () {
            // drop empty fields so the URL stays short (and shareable)
            $$('input, select', form).forEach(function (f) { if (f.name && f.value === '' && f.type !== 'hidden') f.disabled = true; });
            form.submit();
        };
        form.addEventListener('change', function (e) {
            var el = e.target;
            if (el.hasAttribute('data-ec-remember')) remember(el);
            if (el.tagName !== 'SELECT') return;
            // a new exam / counselling / year makes the dependent choices meaningless: leave them out
            (el.getAttribute('data-ec-reset') || '').split(',').forEach(function (n) {
                if (!n) return;
                var f = form.querySelector('[name="' + n + '"]'); if (f) f.disabled = true;
            });
            go();
        });
        $$('[data-ec-debounce]', form).forEach(function (inp) {
            inp.addEventListener('input', function () {
                if (inp.hasAttribute('data-ec-remember')) remember(inp);
                clearTimeout(t); t = setTimeout(go, inp.type === 'number' ? 900 : 600);
            });
        });
        form.addEventListener('submit', function (e) { e.preventDefault(); go(); });
    });
    // a select whose options are URLs (rows per page, college in the trend)
    $$('select[data-ec-nav]').forEach(function (s) { s.addEventListener('change', function () { location.href = s.value; }); });
    // put the cursor back in the search box after the page reloads
    $$('[data-ec-debounce]').forEach(function (inp) {
        if (inp.value && inp.type === 'search' && document.referrer.split('?')[0] === location.href.split('?')[0]) { inp.focus(); var n = inp.value.length; try { inp.setSelectionRange(n, n); } catch (e) {} }
    });

    // ------------------------------------------------------------------ in-page tabs (syllabus subjects)
    $$('[data-ec-tabs]').forEach(function (list) {
        var name = list.getAttribute('data-ec-tabs');
        list.addEventListener('click', function (e) {
            var b = e.target.closest('[data-ec-tab]'); if (!b) return;
            $$('[data-ec-tab]', list).forEach(function (x) { x.setAttribute('aria-selected', String(x === b)); });
            $$('[data-ec-pane="' + name + '"]').forEach(function (p) { p.hidden = p.getAttribute('data-ec-key') !== b.getAttribute('data-ec-tab'); });
        });
    });

    // ------------------------------------------------------------------ "On this page": highlight the section in view
    var heads = $$('.ec-ihead[id]');
    if (heads.length && 'IntersectionObserver' in window) {
        var spy = new IntersectionObserver(function (en) {
            en.forEach(function (x) {
                if (!x.isIntersecting) return;
                var id = x.target.id.slice(4);
                $$('.ec-toc a').forEach(function (a) { a.classList.toggle('on', a.getAttribute('data-ec-toc') === id); });
            });
        }, { rootMargin: '-140px 0px -70% 0px' });
        heads.forEach(function (h) { spy.observe(h); });
    }
    // quick links on the same page scroll there instead of reloading
    root.addEventListener('click', function (e) {
        var a = e.target.closest('a[data-ec-toc]'); if (!a) return;
        var el = document.getElementById('sec-' + a.getAttribute('data-ec-toc'));
        if (el) { e.preventDefault(); window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 120, behavior: 'smooth' }); history.replaceState(null, '', '#sec-' + a.getAttribute('data-ec-toc')); }
    });

    // ------------------------------------------------------------------ counselling picker
    var pick = root.querySelector('[data-ec-pickwrap]');
    if (pick) {
        var pq = pick.querySelector('[data-ec-pkq]'), type = 'all';
        var filter = function () {
            var q = (pq.value || '').trim().toLowerCase(), shown = 0;
            $$('.ec-pk', pick).forEach(function (a) {
                var ok = (type === 'all' || a.getAttribute('data-pk') === type) && (!q || a.getAttribute('data-q').indexOf(q) !== -1);
                a.hidden = !ok; if (ok) shown++;
            });
            $$('[data-ec-pkh]', pick).forEach(function (h) {
                var k = h.getAttribute('data-ec-pkh');
                h.hidden = !$$('.ec-pk[data-pk="' + k + '"]', pick).some(function (a) { return !a.hidden; });
                if (h.nextElementSibling && h.nextElementSibling.classList.contains('ec-pk-grid')) h.nextElementSibling.hidden = h.hidden;
            });
            pick.querySelector('[data-ec-pknone]').hidden = shown > 0;
        };
        root.addEventListener('click', function (e) {
            if (e.target.closest('[data-ec-picker]')) { pick.hidden = false; setTimeout(function () { pq.focus(); }, 30); return; }
            if (e.target.closest('[data-ec-pkclose]')) { pick.hidden = true; return; }
            var t = e.target.closest('[data-ec-pktype]');
            if (t) { type = t.getAttribute('data-ec-pktype'); $$('[data-ec-pktype]', pick).forEach(function (b) { b.setAttribute('aria-pressed', String(b === t)); }); filter(); }
        });
        pq.addEventListener('input', filter);
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') pick.hidden = true; });
    }

    // ------------------------------------------------------------------ alerts: follow an exam or counselling by email
    var modal = root.querySelector('[data-ec-alerts]');
    if (modal) {
        var form = modal.querySelector('form'), msg = modal.querySelector('[data-ec-alerts-msg]');
        root.addEventListener('click', function (e) {
            var a = e.target.closest('[data-ec-alerts-open]');
            if (a) {
                e.preventDefault();
                form.querySelector('[name=type]').value = a.getAttribute('data-type');
                form.querySelector('[name=slug]').value = a.getAttribute('data-slug');
                modal.querySelector('[data-ec-alerts-text]').textContent = 'We email you when ' + a.getAttribute('data-name') + ' dates change or a new ' + (a.getAttribute('data-type') === 'exam' ? 'step opens.' : 'round opens.');
                msg.hidden = true; modal.hidden = false;
                form.querySelector('[name=email]').focus();
                return;
            }
            if (e.target.closest('[data-ec-close]') || e.target === modal) modal.hidden = true;
        });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') modal.hidden = true; });
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = form.querySelector('button[type=submit]'); btn.disabled = true;
            fetch(root.getAttribute('data-alerts-url'), { method: 'POST', body: new FormData(form), headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' })
                .then(function (r) { return r.json().then(function (j) { return { ok: r.ok, j: j }; }); })
                .then(function (res) {
                    msg.hidden = false; msg.classList.toggle('err', !res.ok);
                    msg.textContent = res.j.message || (res.ok ? 'Check your email to confirm.' : 'Please check your email address.');
                    if (res.ok) form.reset();
                })
                .catch(function () { toast('Could not send right now. Please try again.'); })
                .then(function () { btn.disabled = false; });
        });
    }
})();
