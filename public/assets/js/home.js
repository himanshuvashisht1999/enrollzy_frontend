/* Homepage: rotating hero word, search suggestions, tabs (stage, deadlines, stream, skills, board), scholarship
   filters, the call-back form, and the compare box (three ways, opens the university compare page). */
(function () {
    'use strict';
    var root = document.querySelector('main.hz');
    if (!root) return;
    var $$ = function (sel, el) { return Array.prototype.slice.call((el || root).querySelectorAll(sel)); };
    var esc = function (s) { return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); };
    var getJSON = function (url) { return fetch(url, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' }).then(function (r) { return r.ok ? r.json() : {}; }).catch(function () { return {}; }); };

    var toastEl = null, toastT = null;
    function toast(msg) {
        if (!toastEl) { toastEl = document.createElement('div'); toastEl.className = 'hz-toast'; toastEl.setAttribute('role', 'status'); root.appendChild(toastEl); }
        toastEl.textContent = msg; toastEl.hidden = false; clearTimeout(toastT);
        toastT = setTimeout(function () { toastEl.hidden = true; }, 2600);
    }

    // ------------------------------------------------------------------ rotating hero word
    var rot = root.querySelector('[data-hz-rot]');
    if (rot && !(window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches)) {
        var words = [], wi = 0;
        try { words = JSON.parse(rot.getAttribute('data-words') || '[]'); } catch (e) {}
        if (words.length > 1) setInterval(function () { wi = (wi + 1) % words.length; rot.textContent = words[wi]; }, 2400);
    }

    // ------------------------------------------------------------------ tabs: [data-hz-tabs=x] buttons switch [data-hz-pane=x] panes
    $$('[data-hz-tabs]').forEach(function (list) {
        var name = list.getAttribute('data-hz-tabs');
        list.addEventListener('click', function (e) {
            var b = e.target.closest('[data-hz-tab]'); if (!b) return;
            var key = b.getAttribute('data-hz-tab');
            $$('[data-hz-tab]', list).forEach(function (x) { x.setAttribute('aria-selected', String(x === b)); });
            $$('[data-hz-pane="' + name + '"]').forEach(function (p) { p.hidden = p.getAttribute('data-hz-key') !== key; });
        });
    });

    // ------------------------------------------------------------------ search with suggestions (the site's live search)
    var form = root.querySelector('[data-hz-search]');
    if (form) {
        var q = form.querySelector('[data-hz-q]'), type = form.querySelector('[data-hz-type]'), box = form.querySelector('[data-hz-suggest]');
        var t = null, seq = 0, active = -1;
        var links = function () { return $$('a', box); };
        var mark = function (i) { var l = links(); active = (i + l.length) % l.length; l.forEach(function (a, j) { a.classList.toggle('on', j === active); }); };
        var run = function () {
            var v = q.value.trim(), my = ++seq;
            if (v.length < 2) { box.hidden = true; return; }
            getJSON(root.getAttribute('data-live-url') + '?q=' + encodeURIComponent(v) + '&type=' + encodeURIComponent(type.value)).then(function (rows) {
                if (my !== seq) return;
                rows = Array.isArray(rows) ? rows : [];
                active = -1;
                box.innerHTML = rows.map(function (r) { return '<a href="' + esc(r.url) + '"><span class="k">' + esc(r.type) + '</span>' + esc(r.title) + (r.subtitle ? '<small>' + esc(r.subtitle) + '</small>' : '') + '</a>'; }).join('')
                    + '<a href="' + esc(root.getAttribute('data-search-url') + '?q=' + encodeURIComponent(v)) + '"><span class="k">Search</span>See all results for “' + esc(v) + '”</a>';
                box.hidden = false;
            });
        };
        q.addEventListener('input', function () { clearTimeout(t); t = setTimeout(run, 220); });
        type.addEventListener('change', run);
        q.addEventListener('keydown', function (e) {
            if (box.hidden) return;
            if (e.key === 'ArrowDown') { e.preventDefault(); mark(active + 1); }
            else if (e.key === 'ArrowUp') { e.preventDefault(); mark(active - 1); }
            else if (e.key === 'Enter' && active >= 0) { e.preventDefault(); location.href = links()[active].href; }
            else if (e.key === 'Escape') box.hidden = true;
        });
        form.addEventListener('submit', function (e) { if (!q.value.trim()) { e.preventDefault(); q.focus(); } });
        document.addEventListener('click', function (e) { if (!e.target.closest('[data-hz-search]')) box.hidden = true; });
    }
    $$('[data-hz-focus-search]').forEach(function (a) { a.addEventListener('click', function () { setTimeout(function () { if (form) form.querySelector('[data-hz-q]').focus(); }, 350); }); });

    // ------------------------------------------------------------------ scholarships: level + category, first three matches
    $$('[data-hz-sch]').forEach(function (sec) {
        var lvl = sec.querySelector('[data-sch-level]'), cat = sec.querySelector('[data-sch-cat]'), none = sec.querySelector('[data-sch-none]');
        var cards = $$('.hz-scard[data-levels]', sec);
        function apply() {
            var l = lvl ? lvl.value : '', c = cat ? cat.value : '', shown = 0;
            cards.forEach(function (card) {
                var ok = (!l || card.getAttribute('data-levels').split('|').indexOf(l) !== -1) && (!c || card.getAttribute('data-cats').split('|').indexOf(c) !== -1);
                card.hidden = !ok || shown >= 3; if (ok && shown < 3) shown++;
            });
            none.hidden = shown > 0;
        }
        if (lvl) lvl.addEventListener('change', apply);
        if (cat) cat.addEventListener('change', apply);
    });

    // ------------------------------------------------------------------ call-back form
    var modal = root.querySelector('[data-hz-modal]');
    function closeModal() { if (modal) modal.hidden = true; }
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
    root.addEventListener('click', function (e) {
        var a = e.target.closest('[data-hz-enquire]');
        if (a && modal) {
            e.preventDefault();
            var kind = a.getAttribute('data-hz-enquire'), f = modal.querySelector('form');
            var title = modal.querySelector('[data-hz-modal-title]');
            title.textContent = { 'Online advisor': a.textContent.trim() || 'Talk to an online advisor', 'Admission enquiry': 'Admission enquiry' }[kind] || title.getAttribute('data-default');
            f.setAttribute('data-kind', kind);
            f.setAttribute('data-about', a.getAttribute('data-hz-about') || '');
            // pick the matching "I'm looking for" option when the admin's list has one
            var sel = f.querySelector('[name="programme"]'), want = { 'Online advisor': /online/i, 'Admission enquiry': /school/i }[kind];
            if (sel && want) { var o = Array.prototype.filter.call(sel.options, function (x) { return want.test(x.text); })[0]; if (o) sel.value = o.value; }
            f.querySelector('[data-hz-ok]').hidden = true;
            modal.hidden = false;
            f.querySelector('input[name="name"]').focus();
            return;
        }
        if (e.target.closest('[data-hz-close]') || e.target === modal) closeModal();
    });
    $$('form[data-hz-enquiry]').forEach(function (f) {
        f.addEventListener('submit', function (e) {
            e.preventDefault();
            var kind = f.getAttribute('data-kind') || 'Enquiry', about = f.getAttribute('data-about');
            f.querySelector('[data-hz-subject]').value = kind + ': homepage';
            f.querySelector('[data-hz-message]').value = [kind + ' request from the homepage.', about ? 'About: ' + about : '', f.querySelector('[name="programme"]') && f.querySelector('[name="programme"]').value ? 'Looking for: ' + f.querySelector('[name="programme"]').value : ''].filter(Boolean).join('\n');
            var btn = f.querySelector('button[type=submit]'); btn.disabled = true;
            fetch(f.action, { method: 'POST', body: new FormData(f), headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' })
                .then(function (r) { return r.json().then(function (j) { return { ok: r.ok, j: j }; }); })
                .then(function (res) {
                    var ok = f.querySelector('[data-hz-ok]'); ok.hidden = false;
                    ok.textContent = res.ok ? 'Thank you. A counsellor will call you back shortly.' : (res.j && res.j.message ? res.j.message : 'Please check your name and phone number.');
                    if (res.ok) f.reset();
                })
                .catch(function () { toast('Could not send right now. Please try again.'); })
                .then(function () { btn.disabled = false; });
        });
    });

    // ------------------------------------------------------------------ compare box
    var cmp = root.querySelector('[data-hz-compare]');
    if (cmp) initCompare(cmp);

    function initCompare(cmp) {
        var optUrl = root.getAttribute('data-options-url'), base = root.getAttribute('data-compare-url');
        var COURSES = JSON.parse(cmp.getAttribute('data-courses') || '[]'), UNIS = JSON.parse(cmp.getAttribute('data-universities') || '[]');
        var MODES = {
            course: ['One course at up to three universities. Best when you know what to study but not where.', 'University', 'same-course'],
            custom: ['Mix and match: any course at any university and campus.', 'Option', 'custom'],
            uni: ['Compare up to three courses at the same university and campus.', 'Course', 'same-uni']
        };
        var cache = {};
        var get = function (q) { if (!cache[q]) cache[q] = getJSON(optUrl + '?' + q); return cache[q]; };
        var mode = 'course', top = {}, slots;
        var blank = function () { return { uni: '', course: '', off: '', opts: {} }; };
        var reset = function () { top = { course: '', uni: '', campus: '', unis: null, campuses: null, progs: null }; slots = [blank(), blank()]; };
        reset();

        var el = function (sel) { return cmp.querySelector(sel); };
        var opt = function (list, v, ph, key, label) {
            return '<option value="">' + esc(ph) + '</option>' + (list || []).map(function (x) { var k = String(x[key]); return '<option value="' + esc(k) + '"' + (k === String(v) ? ' selected' : '') + '>' + esc(x[label]) + '</option>'; }).join('');
        };
        var done = function (s) { return !!s.off; };

        function render() {
            $$('[data-cm]', cmp).forEach(function (b) { b.setAttribute('aria-selected', String(b.getAttribute('data-cm') === mode)); });
            el('[data-cmp-desc]').textContent = MODES[mode][0];
            var topEl = el('[data-cmp-top]');
            topEl.hidden = mode === 'custom';
            topEl.innerHTML = mode === 'course'
                ? '<label>Course<select data-top="course">' + opt(COURSES, top.course, 'Select course', 'id', 'name') + '</select></label>'
                : mode === 'uni'
                ? '<label>University<select data-top="uni">' + opt(UNIS, top.uni, 'Select university', 'slug', 'name') + '</select></label><label>Campus<select data-top="campus"' + (top.campuses ? '' : ' disabled') + '>' + opt(top.campuses, top.campus, top.uni && !top.campuses ? 'Loading…' : 'Select campus', 'id', 'label') + '</select></label>'
                : '';
            var name = MODES[mode][1];
            el('[data-cmp-slots]').innerHTML = slots.map(function (s, i) {
                var f = '';
                if (mode === 'course') {
                    f += '<select data-i="' + i + '" data-k="uni" aria-label="University ' + (i + 1) + '"' + (top.unis ? '' : ' disabled') + '>' + opt(top.unis, s.uni, top.course && !top.unis ? 'Loading…' : 'Select university', 'slug', 'name') + '</select>';
                    f += '<select data-i="' + i + '" data-k="off" aria-label="Campus ' + (i + 1) + '"' + (s.opts.offs ? '' : ' disabled') + '>' + opt(s.opts.offs, s.off, 'Select campus', 'id', 'label') + '</select>';
                } else if (mode === 'custom') {
                    f += '<select data-i="' + i + '" data-k="uni" aria-label="University ' + (i + 1) + '">' + opt(UNIS, s.uni, 'Select university', 'slug', 'name') + '</select>';
                    f += '<select data-i="' + i + '" data-k="course" aria-label="Course ' + (i + 1) + '"' + (s.opts.progs ? '' : ' disabled') + '>' + opt(s.opts.progs, s.course, s.uni && !s.opts.progs ? 'Loading…' : 'Select course', 'course_id', 'label') + '</select>';
                    f += '<select data-i="' + i + '" data-k="off" aria-label="Campus ' + (i + 1) + '"' + (s.opts.offs ? '' : ' disabled') + '>' + opt(s.opts.offs, s.off, 'Select campus', 'id', 'label') + '</select>';
                } else {
                    f += '<select data-i="' + i + '" data-k="off" aria-label="Course ' + (i + 1) + '"' + (top.progs ? '' : ' disabled') + '>' + opt(top.progs, s.off, 'Select course', 'first', 'label') + '</select>';
                }
                return (i ? '<span class="hz-vs">VS</span>' : '') + '<div class="hz-slot' + (done(s) ? ' on' : '') + '"><span class="sn">' + name + ' ' + (i + 1) + '</span>' + f + (i > 1 ? '<button type="button" class="rm" data-rm="' + i + '" aria-label="Remove">×</button>' : '') + '</div>';
            }).join('') + (slots.length < 3 ? '<span class="hz-vs">VS</span><button type="button" class="hz-slot add" data-add><b>+</b>Add a third ' + name.toLowerCase() + '</button>' : '');
            var n = slots.filter(done).length;
            el('[data-cmp-hint]').textContent = mode === 'course' && !top.course ? 'Choose a course first.' : mode === 'uni' && !top.campus ? 'Choose a university and campus first.'
                : n < 2 ? 'Choose at least two ' + (mode === 'uni' ? 'courses' : mode === 'course' ? 'universities' : 'options') + '.' : n + ' selected. Ready to compare.';
            el('[data-cmp-go]').disabled = n < 2;
        }

        cmp.addEventListener('click', function (e) {
            var b = e.target.closest('[data-cm]');
            if (b && b.getAttribute('data-cm') !== mode) { mode = b.getAttribute('data-cm'); reset(); render(); return; }
            if (e.target.closest('[data-add]')) { slots.push(blank()); render(); return; }
            var r = e.target.closest('[data-rm]');
            if (r) { slots.splice(+r.getAttribute('data-rm'), 1); render(); return; }
            if (e.target.closest('[data-cmp-go]')) {
                var chosen = slots.filter(done);
                var uni = mode === 'uni' ? top.uni : chosen[0].uni;
                location.href = base + '/' + encodeURIComponent(uni) + '/compare?tab=' + MODES[mode][2] + '&ids=' + chosen.map(function (s) { return s.off; }).join(',');
            }
        });
        cmp.addEventListener('change', function (e) {
            var t = e.target, v = t.value;
            if (t.hasAttribute('data-top')) {
                var k = t.getAttribute('data-top');
                if (k === 'course') {
                    top.course = v; top.unis = null; slots = slots.map(blank); render();
                    if (v) get('unis_for=' + v).then(function (j) { if (top.course !== v) return; top.unis = j.universities || []; if (!top.unis.length) toast('No university lists this course yet.'); render(); });
                } else if (k === 'uni') {
                    top.uni = v; top.campus = ''; top.campuses = null; top.progs = null; slots = slots.map(blank); render();
                    if (v) get('uni=' + encodeURIComponent(v) + '&list=campuses').then(function (j) {
                        if (top.uni !== v) return; top.campuses = j.campuses || [];
                        if (top.campuses.length === 1) { top.campus = top.campuses[0].id; loadProgs(); }
                        render();
                    });
                } else if (k === 'campus') {
                    top.campus = v; top.progs = null; slots = slots.map(blank); render();
                    if (v) loadProgs();
                }
                return;
            }
            if (!t.hasAttribute('data-k')) return;
            var s = slots[+t.getAttribute('data-i')], key = t.getAttribute('data-k');
            if (key === 'off') { s.off = v; render(); return; }
            if (key === 'uni') {
                s.uni = v; s.course = ''; s.off = ''; s.opts = {}; render();
                if (!v) return;
                if (mode === 'course') loadOffs(s, v, top.course);
                else get('uni=' + encodeURIComponent(v)).then(function (j) { if (s.uni !== v) return; s.opts.progs = j.programmes || []; render(); });
            } else if (key === 'course') {
                s.course = v; s.off = ''; s.opts.offs = null; render();
                if (v) loadOffs(s, s.uni, v);
            }
        });
        function loadOffs(s, uni, course) {
            get('uni=' + encodeURIComponent(uni) + '&course=' + course).then(function (j) {
                if (s.uni !== uni) return;
                s.opts.offs = j.offerings || [];
                if (s.opts.offs.length) s.off = String(s.opts.offs[0].id);   // first campus picked; change it if needed
                render();
            });
        }
        function loadProgs() {
            var c = top.campus;
            get('uni=' + encodeURIComponent(top.uni) + '&campus=' + encodeURIComponent(c)).then(function (j) { if (top.campus !== c) return; top.progs = j.programmes || []; render(); });
        }
        render();
    }
})();
