/* University pages: campus pickers, section campus pop-overs, in-page filters, the call-back form, the compare
   tray (localStorage, max 4 offerings) and the compare table. Pages work without it (links and forms); this makes them live. */
(function () {
    'use strict';
    var root = document.querySelector('main.uz');
    if (!root) return;
    var $$ = function (sel, el) { return Array.prototype.slice.call((el || root).querySelectorAll(sel)); };
    var esc = function (s) { return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); };

    // ------------------------------------------------------------------ toast
    var toastEl = null, toastT = null;
    function toast(msg) {
        if (!toastEl) { toastEl = document.createElement('div'); toastEl.className = 'cz-toast'; toastEl.setAttribute('role', 'status'); root.appendChild(toastEl); }
        toastEl.textContent = msg; toastEl.hidden = false; clearTimeout(toastT);
        toastT = setTimeout(function () { toastEl.hidden = true; }, 2600);
    }

    // ------------------------------------------------------------------ pop-overs (campus picker, section campus)
    function closePops(except) {
        $$('[data-uz-pop]').forEach(function (p) {
            if (p === except) return;
            var panel = p.querySelector('[data-uz-pop-panel]'), btn = p.querySelector('[data-uz-pop-btn]');
            if (panel) panel.hidden = true; if (btn) btn.setAttribute('aria-expanded', 'false');
        });
    }
    root.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-uz-pop-btn]');
        if (btn) {
            var pop = btn.closest('[data-uz-pop]'), panel = pop.querySelector('[data-uz-pop-panel]');
            closePops(pop);
            panel.hidden = !panel.hidden; btn.setAttribute('aria-expanded', String(!panel.hidden));
            if (!panel.hidden) { var f = panel.querySelector('[data-uz-filter]'); if (f) f.focus(); }
            return;
        }
        if (!e.target.closest('[data-uz-pop]')) closePops(null);
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closePops(null); closeModal(); } });
    root.addEventListener('input', function (e) {
        if (!e.target.matches('[data-uz-filter]')) return;
        var q = e.target.value.trim().toLowerCase(), list = e.target.closest('[data-uz-pop-panel]');
        $$('[data-uz-item]', list).forEach(function (it) { it.hidden = !!q && it.getAttribute('data-uz-item') !== 'all' && it.getAttribute('data-uz-item').indexOf(q) === -1; });
        // hide a state heading when none of its campuses is shown
        $$('[data-uz-grp]', list).forEach(function (g) {
            var n = g.nextElementSibling, any = false;
            while (n && !n.hasAttribute('data-uz-grp')) { if (!n.hidden && n.hasAttribute('data-uz-item')) any = true; n = n.nextElementSibling; }
            g.hidden = !any;
        });
    });
    // multi-campus section: "Show selected"
    root.addEventListener('click', function (e) {
        var b = e.target.closest('[data-uz-multi-apply]'); if (!b) return;
        var panel = b.closest('[data-uz-multi]'), param = panel.getAttribute('data-uz-multi');
        var picked = $$('input[type=checkbox]:checked', panel).map(function (c) { return c.value; });
        var url = new URL(panel.getAttribute('data-uz-base'), location.href);
        if (picked.length) url.searchParams.set(param, picked.join(',')); else url.searchParams.delete(param);
        location.href = url.toString() + panel.getAttribute('data-uz-anchor');
    });

    // ------------------------------------------------------------------ "Read more", stream chips
    $$('[data-uz-clamp]').forEach(function (p) {
        var btn = p.nextElementSibling;
        if (!btn || !btn.hasAttribute('data-uz-clamp-btn')) return;
        if (p.scrollHeight > p.clientHeight + 4) btn.hidden = false;
        btn.addEventListener('click', function () { var open = p.classList.toggle('open'); btn.textContent = open ? 'Show less' : 'Read more'; });
    });
    $$('[data-uz-streams]').forEach(function (g) {
        g.addEventListener('click', function (e) {
            var b = e.target.closest('[data-uz-stream]'); if (!b) return;
            $$('[data-uz-stream]', g).forEach(function (x) { x.setAttribute('aria-pressed', String(x === b)); });
            var card = g.closest('.cz-card');
            $$('[data-uz-stream-rows]', card).forEach(function (tb) { tb.hidden = tb.getAttribute('data-uz-stream-rows') !== b.getAttribute('data-uz-stream'); });
        });
    });

    // ------------------------------------------------------------------ filter forms that submit by themselves
    $$('form[data-uz-autosubmit]').forEach(function (form) {
        var t = null;
        form.addEventListener('change', function (e) { if (e.target.tagName === 'SELECT') form.submit(); });
        $$('[data-uz-debounce]', form).forEach(function (inp) {
            inp.addEventListener('input', function () { clearTimeout(t); t = setTimeout(function () { form.submit(); }, 600); });
        });
    });
    var sortSel = root.querySelector('[data-uz-sort]');
    if (sortSel) sortSel.addEventListener('change', function () {
        var form = root.querySelector('form[data-uz-autosubmit]'); if (!form) return;
        form.querySelector('[name="sort"]').value = sortSel.value; form.submit();
    });

    // ------------------------------------------------------------------ in-page filters: fees by campus, campus finder, cutoff category
    $$('[data-uz-feetable]').forEach(function (card) {
        var q = card.querySelector('[data-uz-fee-q]'), st = card.querySelector('[data-uz-fee-state]'), none = card.querySelector('[data-uz-fee-none]'), count = card.querySelector('[data-uz-fee-count]');
        var rows = $$('[data-uz-fee-row]', card);
        function apply() {
            var s = q ? q.value.trim().toLowerCase() : '', state = st ? st.value : '', shown = 0;
            rows.forEach(function (r) { var ok = (!s || r.getAttribute('data-uz-fee-row').indexOf(s) !== -1) && (!state || r.getAttribute('data-uz-state') === state); r.hidden = !ok; if (ok) shown++; });
            if (none) none.hidden = shown > 0;
            if (count) count.textContent = shown + ' of ' + rows.length + ' campuses';
        }
        if (q) q.addEventListener('input', apply);
        if (st) st.addEventListener('change', apply);
    });
    $$('[data-uz-finder]').forEach(function (card) {
        var q = card.querySelector('[data-uz-finder-q]'), st = card.querySelector('[data-uz-finder-state]'), none = card.querySelector('[data-uz-finder-none]'), count = card.querySelector('[data-uz-finder-count]');
        var cards = $$('[data-uz-campus-card]', card);
        function apply() {
            var s = q.value.trim().toLowerCase(), state = st ? st.value : '', shown = 0;
            cards.forEach(function (c) {
                var ok = (!s || c.getAttribute('data-uz-campus-card').indexOf(s) !== -1 || c.getAttribute('data-uz-courses').indexOf(s) !== -1) && (!state || c.getAttribute('data-uz-state') === state);
                c.hidden = !ok; if (ok) shown++;
            });
            none.hidden = shown > 0; count.textContent = shown + ' of ' + cards.length + ' campuses';
        }
        q.addEventListener('input', apply);
        if (st) st.addEventListener('change', apply);
    });
    $$('[data-uz-cat]').forEach(function (sel) {
        sel.addEventListener('change', function () {
            $$('[data-uz-cat-row]', sel.closest('.cz-card')).forEach(function (r) { r.hidden = r.getAttribute('data-uz-cat-row') !== sel.value; });
        });
    });

    // ------------------------------------------------------------------ call-back form (Apply, Brochure, Contact...)
    var modal = root.querySelector('[data-uz-modal]');
    function closeModal() { if (modal) modal.hidden = true; }
    root.addEventListener('click', function (e) {
        var a = e.target.closest('[data-uz-enquire]');
        if (a) {
            e.preventDefault();
            var kind = a.getAttribute('data-uz-enquire'), course = a.getAttribute('data-uz-course') || '';
            var form = modal.querySelector('form');
            modal.querySelector('[data-uz-modal-title]').textContent = { Apply: 'Apply with an admission expert', Brochure: 'Get the brochure', Contact: 'Contact the admissions team', Scholarship: 'Ask about scholarships', 'Online advisor': 'Talk to an online advisor', 'Compare help': 'Talk to a counsellor' }[kind] || 'Talk to an admission expert';
            form.setAttribute('data-kind', kind);
            if (course) form.querySelector('[data-uz-programme]').value = course;
            form.querySelector('[data-uz-ok]').hidden = true;
            modal.hidden = false;
            var first = form.querySelector('input[name="name"]'); if (first) first.focus();
            return;
        }
        if (e.target.closest('[data-uz-modal-close]') || e.target === modal) closeModal();
    });
    $$('form[data-uz-enquiry]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var kind = form.getAttribute('data-kind') || 'Enquiry';
            var campus = form.querySelector('[data-uz-campus]'), prog = form.querySelector('[data-uz-programme]');
            var lines = [kind + ' request from the university page: ' + location.pathname];
            if (prog && prog.value) lines.push('Programme: ' + prog.value);
            if (campus && campus.value) lines.push('Preferred campus: ' + campus.value);
            if (window.ezCompareSummary) lines.push('Compared: ' + window.ezCompareSummary);
            form.querySelector('[data-uz-message]').value = lines.join('\n');
            if (prog) prog.value = prog.value.slice(0, 100);   // the lead form allows 100; the full text is in the message
            var subject = form.querySelector('[data-uz-subject]');
            subject.value = subject.value.replace(/^[^:]*:/, kind + ':');
            var btn = form.querySelector('button[type=submit]'); btn.disabled = true;
            fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' })
                .then(function (r) { return r.json().then(function (j) { return { ok: r.ok, j: j }; }); })
                .then(function (res) {
                    var ok = form.querySelector('[data-uz-ok]');
                    ok.hidden = false;
                    ok.textContent = res.ok ? 'Thank you. An admission expert will call you back shortly.' : (res.j && res.j.message ? res.j.message : 'Please check your name and phone number.');
                    if (res.ok) form.reset();
                })
                .catch(function () { toast('Could not send right now. Please try again.'); })
                .then(function () { btn.disabled = false; });
        });
    });

    // ------------------------------------------------------------------ compare tray (offerings: course x campus, any university)
    var KEY = 'ez-uni-compare';
    function tray() { try { return JSON.parse(localStorage.getItem(KEY) || '[]').map(String).slice(0, 4); } catch (e) { return []; } }
    function saveTray(t) { try { localStorage.setItem(KEY, JSON.stringify(t)); } catch (e) {} }
    function paintTray() {
        var t = tray(), bar = root.querySelector('[data-uz-tray]'), onCompare = !!root.querySelector('[data-uz-compare]');
        if (bar) { bar.hidden = !t.length || onCompare; bar.querySelector('[data-uz-tray-text]').textContent = t.length + ' selected to compare'; }
        $$('[data-uz-cmp]').forEach(function (b) {
            var on = t.indexOf(b.getAttribute('data-uz-cmp')) !== -1;
            b.setAttribute('aria-pressed', String(on));
            b.textContent = b.classList.contains('cz-btn') ? (on ? '✓ Added to compare' : '+ Add to compare') : (on ? '✓ Comparing' : '+ Compare');
        });
    }
    root.addEventListener('click', function (e) {
        var b = e.target.closest('[data-uz-cmp]');
        if (b) {
            e.preventDefault();
            var id = b.getAttribute('data-uz-cmp'), t = tray();
            if (t.indexOf(id) !== -1) t = t.filter(function (x) { return x !== id; });
            else { if (t.length >= 4) { toast('You can compare up to 4. Remove one first.'); return; } t.push(id); }
            saveTray(t); paintTray(); return;
        }
        if (e.target.closest('[data-uz-tray-clear]')) { saveTray([]); paintTray(); }
    });
    paintTray();

    // ------------------------------------------------------------------ compare page
    var box = root.querySelector('[data-uz-compare]');
    if (box) initCompare(box);

    function initCompare(box) {
        var tab = box.getAttribute('data-tab');
        var unis = JSON.parse(box.getAttribute('data-universities') || '[]');
        var dataUrl = box.getAttribute('data-data-url'), optUrl = box.getAttribute('data-options-url'), homeUni = box.getAttribute('data-uni');
        var slots = JSON.parse(box.getAttribute('data-slots') || '[]').map(String);
        if (tab === 'custom' && !slots.length) slots = tray();
        var cols = {};                 // offering id -> column data
        var progCache = {}, offCache = {};
        var slotsEl = box.querySelector('[data-uz-slots]'), head = box.querySelector('[data-uz-cmp-head]'), body = box.querySelector('[data-uz-cmp-body]'), empty = box.querySelector('[data-uz-cmp-empty]'), diff = box.querySelector('[data-uz-diff]');

        function getJSON(url) { return fetch(url, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' }).then(function (r) { return r.ok ? r.json() : {}; }); }
        function programmes(uni) { if (!progCache[uni]) progCache[uni] = getJSON(optUrl + '?uni=' + encodeURIComponent(uni)).then(function (j) { return j.programmes || []; }); return progCache[uni]; }
        function offerings(uni, course) { var k = uni + '|' + course; if (!offCache[k]) offCache[k] = getJSON(optUrl + '?uni=' + encodeURIComponent(uni) + '&course=' + course).then(function (j) { return j.offerings || []; }); return offCache[k]; }
        function load() {
            var need = slots.filter(function (id) { return !cols[id]; });
            var p = need.length ? getJSON(dataUrl + '?ids=' + need.join(',')).then(function (j) { (j.columns || []).forEach(function (c) { cols[String(c.id)] = c; }); }) : Promise.resolve();
            return p.then(render);
        }
        function inr(n) { if (!n) return '–'; var s = String(Math.round(n)); if (s.length > 3) s = s.slice(0, -3).replace(/\B(?=(\d{2})+(?!\d))/g, ',') + ',' + s.slice(-3); return '₹' + s; }
        function lpa(n) { if (!n) return '–'; var l = n >= 1000 ? n / 100000 : n; return '₹' + (Math.round(l * 10) / 10) + ' LPA'; }

        function render() {
            var list = slots.map(function (id) { return cols[id]; }).filter(Boolean);
            window.ezCompareSummary = list.filter(function (c) { return !c.missing; }).map(function (c) { return c.course + ' at ' + c.uni + (c.campus ? ' (' + c.campus + ')' : ''); }).join('; ');
            // slot pickers
            slotsEl.innerHTML = slots.map(function (id, i) {
                var c = cols[id] || {};
                return '<div class="uz-slot" data-slot="' + i + '">' +
                    '<label class="cz-field">University<select data-k="uni"' + (tab === 'same-uni' ? ' disabled' : '') + '>' + unis.map(function (u) { return '<option value="' + esc(u.slug) + '"' + (u.slug === c.uni_slug ? ' selected' : '') + '>' + esc(u.name) + '</option>'; }).join('') + '</select></label>' +
                    '<label class="cz-field">Course<select data-k="course"' + (tab === 'same-course' && i > 0 ? ' disabled' : '') + '><option>' + esc(c.course || 'Loading…') + '</option></select></label>' +
                    '<label class="cz-field">Campus<select data-k="off"><option>' + esc(c.campus || '–') + '</option></select></label>' +
                    '<button class="rm" type="button" data-rm="' + i + '">Remove</button></div>';
            }).join('') + (slots.length < 4 ? '<button class="uz-slot add" type="button" data-add>+ Add a column</button>' : '');
            // fill course and campus options in the background
            slots.forEach(function (id, i) {
                var c = cols[id]; if (!c || c.missing) return;
                var el = slotsEl.querySelector('[data-slot="' + i + '"]');
                programmes(c.uni_slug).then(function (ps) {
                    el.querySelector('[data-k="course"]').innerHTML = ps.map(function (p) { return '<option value="' + p.course_id + '"' + (p.course_id === c.course_id ? ' selected' : '') + '>' + esc(p.label) + '</option>'; }).join('');
                });
                offerings(c.uni_slug, c.course_id).then(function (os) {
                    el.querySelector('[data-k="off"]').innerHTML = os.map(function (o) { return '<option value="' + o.id + '"' + (String(o.id) === String(id) ? ' selected' : '') + '>' + esc(o.label) + '</option>'; }).join('');
                });
            });
            // table
            empty.hidden = list.length > 0;
            head.innerHTML = list.length ? '<tr><th>Compare</th>' + list.map(function (c) { return c.missing ? '<td>Not available</td>' : '<td>' + esc(c.course) + '<small>' + esc(c.uni) + (c.campus ? ' · ' + esc(c.campus) : '') + '</small></td>'; }).join('') + '</tr>' : '';
            var rows = [
                ['Fees / year', 'annual_fee', inr, 'min'], ['Total course fee', 'total_fee', inr, 'min'],
                ['Duration', 'years', function (v) { return v ? v + ' years' : '–'; }, null], ['Entrance exam', 'exam', function (v) { return esc(v || '–'); }, null],
                ['Median package', 'median', lpa, 'max'], ['Students placed', 'placed_pct', function (v) { return v ? v + '%' : '–'; }, 'max'],
                ['Seats', 'seats', function (v) { return v || '–'; }, 'max'], ['Hostel', 'hostel', function (v) { return v || '–'; }, null],
                ['NIRF rank', 'nirf', function (v) { return v ? '#' + v : '–'; }, 'min'], ['Also online', 'online', function (v) { return v || '–'; }, null]
            ];
            var only = diff.checked;
            body.innerHTML = !list.length ? '' : rows.map(function (r) {
                var vals = list.map(function (c) { return c.missing ? null : (c[r[1]] == null ? null : c[r[1]]); });
                var real = vals.filter(function (v) { return v !== null && v !== ''; });
                var same = real.length > 1 && real.every(function (v) { return v === real[0]; });
                if (!real.length || (only && same)) return '';
                var target = r[3] && real.length > 1 && !same ? (r[3] === 'min' ? Math.min.apply(null, real) : Math.max.apply(null, real)) : null;
                return '<tr' + (same ? ' class="same"' : '') + '><th>' + r[0] + '</th>' + vals.map(function (v) { return '<td class="cz-num' + (v !== null && v === target ? ' best' : '') + '">' + (v === null ? '<span class="cz-muted">Not listed</span>' : r[2](v)) + '</td>'; }).join('') + '</tr>';
            }).join('') + '<tr><th>Next step</th>' + list.map(function (c) { return '<td>' + (c.missing ? '' : '<div style="display:grid;gap:6px;justify-items:start"><a class="cz-btn cz-btn-outline cz-btn-sm" href="#enquire" data-uz-enquire="Apply" data-uz-course="' + esc(c.course + ' at ' + c.uni + (c.campus ? ' (' + c.campus + ')' : '')) + '">Admission enquiry</a><a class="cz-link" href="' + esc(c.url) + '" style="font-size:14px">View course details →</a></div>') + '</td>'; }).join('') + '</tr>';
            if (tab === 'custom') saveTray(slots.slice(0, 4));
        }

        slotsEl.addEventListener('change', function (e) {
            var el = e.target.closest('[data-slot]'); if (!el) return;
            var i = +el.getAttribute('data-slot'), k = e.target.getAttribute('data-k');
            if (k === 'off') { slots[i] = e.target.value; load(); return; }
            var uni = k === 'uni' ? e.target.value : cols[slots[i]].uni_slug;
            var p = k === 'uni'
                ? programmes(uni).then(function (ps) { var keep = ps.filter(function (x) { return x.course_id === (cols[slots[i]] || {}).course_id; })[0]; return keep ? keep.first : (ps[0] ? ps[0].first : null); })
                : offerings(uni, +e.target.value).then(function (os) { return os[0] ? os[0].id : null; });
            p.then(function (id) { if (id) { slots[i] = String(id); load(); } else toast('This university does not list that course.'); });
        });
        slotsEl.addEventListener('click', function (e) {
            var rm = e.target.closest('[data-rm]');
            if (rm) { slots.splice(+rm.getAttribute('data-rm'), 1); render(); return; }
            if (!e.target.closest('[data-add]')) return;
            var last = cols[slots[slots.length - 1]] || {};
            var used = slots.map(function (id) { return (cols[id] || {}).uni_slug; });
            var uni = last.uni_slug || homeUni;
            var pick = tab === 'same-course' && last.course_id
                ? getJSON(optUrl + '?next_for=' + last.course_id + '&exclude=' + encodeURIComponent(used.filter(Boolean).join(','))).then(function (j) { return j.offering || null; })
                : programmes(uni).then(function (ps) { var other = ps.filter(function (p) { return slots.every(function (id) { return (cols[id] || {}).course_id !== p.course_id; }); })[0] || ps[0]; return other ? other.first : null; });
            pick.then(function (id) { if (id) { slots.push(String(id)); load(); } else toast(tab === 'same-course' ? 'No other university lists this course yet.' : 'Nothing more to add here.'); });
        });
        diff.addEventListener('change', render);
        load();
    }
})();
