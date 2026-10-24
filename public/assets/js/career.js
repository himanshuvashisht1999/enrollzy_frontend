/* Career roadmap page (client design "Career roadmap redesign") on the Career Roadmap module: the "Build your
   roadmap" wizard (stage group → class → group → its roadmap), search, explore tabs, stream quiz, topic filter and
   the lead forms. Data: #cr-data (CareerController / CareerData); a group's roadmap is loaded when it is opened.
   Forms post to /career-roadmap/lead; the name and number are remembered (session), so later buttons need one tap.
   "Download PDF" prints the roadmap (the browser saves it as a PDF). */
(function () {
    'use strict';
    var root = document.querySelector('main.cr'), dataEl = document.getElementById('cr-data');
    if (!root || !dataEl) return;
    var D = JSON.parse(dataEl.textContent);
    var CATS = D.cats || [], CLASSES = D.classes || {}, GROUPS = D.groups || [];
    var TREES = {}; if (D.state.group) TREES[D.state.group] = D.tree || [];
    var S = { cls: D.state.cls, group: D.state.group };
    var LEAD = D.lead || null;
    var CSRF = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';

    var q = function (sel, el) { return (el || root).querySelector(sel); };
    var qa = function (sel, el) { return Array.prototype.slice.call((el || root).querySelectorAll(sel)); };
    var esc = function (s) { return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); };
    var group = function (id) { id = +id; for (var i = 0; i < GROUPS.length; i++) if (GROUPS[i].id === id) return GROUPS[i]; return null; };
    var cls = function (id) { return CLASSES[id] || null; };
    var catOf = function (clsId) { for (var i = 0; i < CATS.length; i++) if (CATS[i].classes.indexOf(+clsId) > -1) return CATS[i]; return CATS[0]; };
    var groupsOf = function (clsId) { return GROUPS.filter(function (g) { return g.cls === +clsId; }); };
    var label = function (g) { var c = g && cls(g.cls); return g ? (c ? c.title + ' · ' : '') + g.title : ''; };
    var svg = function (k) { return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' + (D.icons[k] || D.icons.eng) + '</svg>'; };
    var DL = '<svg class="cr-dl" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12M7 10l5 5 5-5M4 21h16"/></svg>';
    var store = { get: function (k) { try { return sessionStorage.getItem(k); } catch (e) { return null; } }, set: function (k, v) { try { sessionStorage.setItem(k, v); } catch (e) {} } };
    var para = function (t) { return esc(t).replace(/\n/g, '<br>'); };

    var toastT;
    function toast(m) { var t = q('[data-cr-toast]'); if (!t) return; t.textContent = m; t.hidden = false; clearTimeout(toastT); toastT = setTimeout(function () { t.hidden = true; }, 2600); }

    // ------------------------------------------------------------------ wizard
    /** "Class 5–8" for a run of numbered classes, else the titles. */
    function range(cat) {
        var t = cat.classes.map(function (id) { return cls(id) ? cls(id).title : ''; });
        var n = t.map(function (x) { var m = /^class\s+(\d+)$/i.exec(x); return m ? m[1] : null; });
        if (n.every(Boolean) && n.length > 1) return 'Class ' + n[0] + '–' + n[n.length - 1];
        return t.join(' · ');
    }

    function renderStages() {
        var box = q('[data-cr-stages]'); if (!box) return;
        var cur = catOf(S.cls);
        box.innerHTML = CATS.map(function (c) {
            var seen = {}, chips = [];
            c.classes.forEach(function (id) { groupsOf(id).forEach(function (g) { var k = g.title.toLowerCase(); if (!seen[k] && chips.length < 3) { seen[k] = 1; chips.push('<em>' + esc(g.title) + '</em>'); } }); });
            return '<button type="button" class="cr-stg" data-cr-stage="' + c.id + '" aria-pressed="' + (cur && c.id === cur.id) + '"><small>' + esc(c.name) + '</small><b>' + esc(range(c)) + '</b><span class="chips">' + chips.join('') + '</span></button>';
        }).join('');
        q('[data-cr-cls]').innerHTML = cur && cur.classes.length > 1 ? cur.classes.map(function (id) { return '<button type="button" data-cr-clsb="' + id + '" aria-pressed="' + (+id === +S.cls) + '">' + esc(cls(id).title) + '</button>'; }).join('') : '';
    }

    function renderInts() {
        var L = groupsOf(S.cls);
        if (!L.some(function (g) { return g.id === +S.group; })) S.group = L[0] ? L[0].id : null;
        q('[data-cr-l2]').textContent = L.length ? L.length + ' paths for ' + (cls(S.cls) ? cls(S.cls).title : 'your class') + '.' : 'Nothing for this class yet.';
        q('[data-cr-ints]').innerHTML = L.map(function (g) {
            return '<button type="button" class="cr-int" data-cr-group="' + g.id + '" aria-pressed="' + (g.id === +S.group) + '"><span class="ic">' + svg(g.ic) + '</span><span><b>' + esc(g.title) + '</b><small>' + esc(g.hint) + '</small></span></button>';
        }).join('');
    }

    function loadTree(id) {
        if (TREES[id]) return Promise.resolve(TREES[id]);
        return fetch(D.urls.group.replace('__ID__', id), { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' })
            .then(function (r) { if (!r.ok) throw new Error(r.status); return r.json(); })
            .then(function (j) { TREES[id] = j.steps || []; return TREES[id]; });
    }

    /** Long text: the first lines, the rest behind "Read more". */
    function textBlock(t, long) {
        var all = [t, long].filter(Boolean).join('\n\n');
        if (!all) return '';
        if (all.length <= 260) return '<p>' + para(all) + '</p>';
        var cut = all.lastIndexOf(' ', 220);
        return '<p class="cr-more"><span>' + para(all.slice(0, cut > 120 ? cut : 220)) + '…</span><span hidden>' + para(all) + '</span> <button type="button" class="cr-rm" data-cr-more>Read more</button></p>';
    }

    function feePill(s) { return s.fee ? '<span class="dur" title="' + esc(s.feeLabel) + '">' + esc(s.feeLabel ? s.feeLabel + ': ' : '') + esc(s.fee.split('\n')[0]) + '</span>' : ''; }

    function subPanel(s) {
        return '<div class="cr-sub" data-cr-sub="' + s.id + '" hidden><div class="tt"><b>' + esc(s.title) + '</b>' + feePill(s) + '</div>' + textBlock(s.text, s.long)
            + (s.fee && s.fee.indexOf('\n') > -1 ? '<p class="cr-fee">' + para(s.fee) + '</p>' : '')
            + (s.children.length ? '<div class="cr-tlinks">' + s.children.map(function (k) { return '<span class="cr-lk t-col">' + esc(k.title) + '</span>'; }).join('') + '</div>' : '') + '</div>';
    }

    function renderOut(focusTitle) {
        var out = q('[data-cr-out]'); if (!out) return;
        var g = group(S.group), c = g && cls(g.cls), cat = g && catOf(g.cls);
        if (!g) { out.innerHTML = '<div class="cr-wlabel"><i>3</i><b>Your roadmap</b></div><div class="cr-empty"><b>Pick a path above</b>Your roadmap appears here.</div>'; return; }
        var head = '<div class="cr-wlabel"><i>3</i><b>Your roadmap</b><span>' + esc(c.title) + ': ' + esc(g.title) + '</span></div>';
        if (!TREES[g.id]) {
            out.innerHTML = head + '<div class="cr-empty"><b>Loading the roadmap…</b></div>';
            loadTree(g.id).then(function () { if (+S.group === g.id) renderOut(focusTitle); }).catch(function () { out.innerHTML = head + '<div class="cr-empty"><b>The roadmap could not be loaded</b>Please try again.</div>'; });
            return;
        }
        var steps = TREES[g.id].map(function (s, i) {
            var hit = focusTitle && s.title.toLowerCase() === focusTitle.toLowerCase();
            var kids = s.children.length ? '<div class="cr-tlinks">' + s.children.map(function (k) { return '<button type="button" class="cr-lk t-crs" data-cr-subopen="' + k.id + '">' + esc(k.title) + '</button>'; }).join('') + '</div>' + s.children.map(subPanel).join('') : '';
            var btns = s.buttons.length ? '<div class="cr-tlinks">' + s.buttons.map(function (b) { return '<a class="cr-lk t-exam" href="' + esc(b.url) + '">' + esc(b.label) + '</a>'; }).join('') + '</div>' : '';
            var fee = s.fee && s.fee.indexOf('\n') > -1 ? '<p class="cr-fee">' + para(s.fee) + '</p>' : '';
            return '<li class="' + (hit ? 'now' : '') + '" data-cr-step="' + esc(s.title.toLowerCase()) + '"><span class="cr-tdot">' + (i + 1) + '</span><div class="cr-tcard"><div class="tt"><b>' + esc(s.title) + '</b>' + feePill(s) + '</div>' + textBlock(s.text, s.long) + fee + btns + kids + '</div></li>';
        }).join('');
        var n = TREES[g.id].length;
        out.innerHTML = head
            + '<div class="cr-rmap"><div class="cr-print-area"><div class="cr-rhead"><div><h3>' + esc(c.title) + ' → ' + esc(g.title) + '</h3><p>' + n + (n === 1 ? ' option' : ' options') + ' · ' + esc(cat ? cat.name : '') + '</p></div>'
            + '<div class="cr-rbtns"><button type="button" class="cr-btn cr-btn-orange cr-btn-sm" data-cr-pdf="' + g.id + '">' + DL + ' Download PDF</button><button type="button" class="cr-btn cr-btn-ghost cr-btn-sm" data-cr-share>Share roadmap</button></div></div>'
            + (g.alert ? '<div class="cr-alert">' + esc(g.alert) + '</div>' : '')
            + '<ol class="cr-tline">' + steps + '</ol><p class="cr-print-foot">Enrollzy career roadmap · ' + esc(shareUrl()) + '</p></div>'
            + '<aside class="cr-side"><div class="cr-sbox"><h4>Your next step</h4><div class="next">Compare the options, then book a free call to pick the one that fits your marks and budget.</div></div>'
            + '<div class="cr-sbox"><h4>At a glance</h4><dl class="cr-kv"><dt>Class</dt><dd>' + esc(c.title) + '</dd><dt>Stage</dt><dd>' + esc(cat ? cat.name : '') + '</dd><dt>Options</dt><dd>' + n + '</dd></dl></div>'
            + '<div class="cr-sbox cta"><h4>' + esc(D.cta.title) + '</h4>' + (D.cta.text ? '<p>' + esc(D.cta.text) + '</p>' : '') + '<div data-cr-form="roadmap" data-group="' + g.id + '"></div></div></aside></div>';
        mountForms(out);
        if (focusTitle) { var li = q('li.now', out); if (li) setTimeout(function () { li.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 60); }
    }

    function shareUrl() { var c = cls(S.cls); return D.urls.page + '?' + new URLSearchParams({ class: c ? c.slug : '', group: S.group || '' }).toString() + '#build'; }
    function syncUrl() { try { var c = cls(S.cls); history.replaceState(null, '', D.urls.page + '?' + new URLSearchParams({ class: c ? c.slug : '', group: S.group || '' }).toString() + location.hash); } catch (e) {} }
    function renderAll(focus) { renderStages(); renderInts(); renderOut(focus); syncUrl(); }

    function openGroup(id, focus, scroll) {
        var g = group(id); if (!g) return;
        S.cls = g.cls; S.group = g.id; renderAll(focus); seen();
        if (scroll !== false && !focus) { var b = document.getElementById('build'); if (b) b.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    }

    // ------------------------------------------------------------------ search: groups and their items
    var INDEX = [];
    GROUPS.forEach(function (g) {
        INDEX.push({ g: g.id, t: g.title, sub: label(g), item: null });
        g.items.forEach(function (it) { INDEX.push({ g: g.id, t: it, sub: label(g), item: it }); });
    });
    var input = q('[data-cr-q]'), sugg = q('[data-cr-sugg]');
    function suggest() {
        var v = input.value.trim().toLowerCase();
        if (v.length < 2) { sugg.hidden = true; return; }
        var seenKey = {}, hits = INDEX.filter(function (x) { var ok = (x.t + ' ' + x.sub).toLowerCase().indexOf(v) > -1, k = x.g + '|' + x.t; if (ok && !seenKey[k]) { seenKey[k] = 1; return true; } return false; })
            .sort(function (a, b) { return (a.t.toLowerCase().indexOf(v) === 0 ? 0 : 1) - (b.t.toLowerCase().indexOf(v) === 0 ? 0 : 1); }).slice(0, 8);
        sugg.innerHTML = hits.length ? hits.map(function (x) { return '<button type="button" data-cr-open="' + x.g + '"' + (x.item ? ' data-item="' + esc(x.item) + '"' : '') + '>' + esc(x.t) + '<small>' + esc(x.sub) + '</small></button>'; }).join('')
            : '<button type="button" data-cr-lead="search">No match yet. Ask a career expert<small>Free</small></button>';
        sugg.hidden = false;
    }
    if (input) {
        input.addEventListener('input', suggest);
        input.addEventListener('keydown', function (e) {
            var items = qa('button', sugg), on = items.findIndex(function (b) { return b.classList.contains('on'); });
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault(); if (sugg.hidden || !items.length) return;
                if (on > -1) items[on].classList.remove('on');
                on = e.key === 'ArrowDown' ? (on + 1) % items.length : (on - 1 + items.length) % items.length;
                items[on].classList.add('on');
            } else if (e.key === 'Enter') { e.preventDefault(); if (items[on > -1 ? on : 0]) items[on > -1 ? on : 0].click(); }
            else if (e.key === 'Escape') sugg.hidden = true;
        });
    }

    // ------------------------------------------------------------------ explore: tabs, "show all"
    var cat = '', cAll = false;
    function renderExplore() {
        var cards = qa('[data-cr-cgrid] > .cr-ccard'), shown = cards.filter(function (a) { return !cat || a.getAttribute('data-cat') === String(cat); });
        var lim = cAll ? 9999 : (window.matchMedia('(max-width: 600px)').matches ? 4 : 9);
        cards.forEach(function (a) { a.hidden = true; });
        shown.slice(0, lim).forEach(function (a) { a.hidden = false; });
        qa('[data-cr-cat]').forEach(function (b) { b.setAttribute('aria-selected', String(b.getAttribute('data-cr-cat') === String(cat))); });
        var more = q('[data-cr-cmore]'); if (more) { more.hidden = shown.length <= lim; more.textContent = 'Show all ' + shown.length; }
    }

    // ------------------------------------------------------------------ read, ask and discuss: topics
    function renderTopic(t) {
        qa('[data-cr-topic]').forEach(function (b) { b.setAttribute('aria-pressed', String(b.getAttribute('data-cr-topic') === t)); });
        qa('[data-cr-list]').forEach(function (list) {
            var max = list.getAttribute('data-cr-list') === 'blogs' ? 4 : 5, n = 0;
            qa('a[data-topics]', list).forEach(function (a) {
                var ok = !t || JSON.parse(a.getAttribute('data-topics') || '[]').indexOf(t) > -1;
                a.hidden = !(ok && n < max); if (ok && n < max) n++;
            });
            var none = q('[data-cr-none]', list); if (none) none.hidden = n > 0;
        });
    }

    // ------------------------------------------------------------------ PDF: print the roadmap (the browser saves it as PDF)
    function printGroup(id) {
        var go = function () {
            renderOut();
            qa('.cr-print-area [data-cr-more]').forEach(function (b) { b.click(); });
            qa('.cr-print-area [data-cr-sub]').forEach(function (p) { p.hidden = false; });
            document.body.classList.add('cr-printing');
            setTimeout(function () { window.print(); }, 150);
        };
        if (+S.group !== +id) { var g = group(id); if (g) { S.cls = g.cls; S.group = g.id; renderStages(); renderInts(); syncUrl(); } }
        loadTree(id).then(go).catch(function () { toast('The roadmap could not be loaded. Please try again.'); });
    }
    window.addEventListener('afterprint', function () { document.body.classList.remove('cr-printing'); });

    // ------------------------------------------------------------------ lead forms
    var BUTTON = { hero: 'Get my free roadmap call', roadmap: 'Send me this roadmap', band: 'Book my free call', card: 'Send me this roadmap', nudge: 'Send me this roadmap',
        sticky: 'Book my free call', quiz: 'Get my full stream report', ask: 'Post and get a call', pdf: 'Download PDF', search: 'Book my free call' };
    var ROADMAPISH = { roadmap: 1, card: 1, nudge: 1 };
    var curClass = function () { var c = cls(S.cls); return c ? c.title : ''; };
    /** The class a lead is about: the roadmap's own class, else the one open in the wizard. */
    var classFor = function (groupId) { var g = group(groupId), c = g && cls(g.cls); return c ? c.title : curClass(); };
    var utm = (function () {
        var p = new URLSearchParams(location.search), u = ['utm_source', 'utm_medium', 'utm_campaign'].map(function (k) { return p.get(k) ? k + '=' + p.get(k) : ''; }).filter(Boolean).join('; ');
        if (u) store.set('cr-utm', u);
        return u || store.get('cr-utm') || '';
    })();

    function doneHtml(src, groupId) {
        var g = group(groupId), first = esc(String(LEAD.name).split(' ')[0]);
        var msg = src === 'pdf' ? 'Your roadmap is ready to save: choose "Save as PDF" in the print window. <a href="#" data-cr-pdf="' + (g ? g.id : '') + '">Open it again</a>'
            : ROADMAPISH[src] && g ? 'We will send the ' + esc(label(g)) + ' roadmap to your WhatsApp on ' + esc(LEAD.mobile) + '.'
            : src === 'ask' ? 'Your question is with our counsellors. We will call you on ' + esc(LEAD.mobile) + '.'
            : 'A counsellor will call you on ' + esc(LEAD.mobile) + '.';
        return '<div class="cr-done"><div class="tick">✓</div><b>Thanks, ' + first + '!</b><p>' + msg + ' <a href="#" data-cr-relead>Not you?</a></p></div>';
    }

    function formHtml(src, groupId, opts) {
        opts = opts || {};
        var g = group(groupId), full = !(src === 'roadmap' || src === 'pdf');
        var clsOpts = (D.classList || []).map(function (x) { return '<option' + (x === curClass() ? ' selected' : '') + '>' + esc(x) + '</option>'; }).join('');
        var sts = '<option value="">Select state</option>' + (D.states || []).map(function (x) { return '<option>' + esc(x) + '</option>'; }).join('');
        return '<form class="cr-lf" data-src="' + src + '" data-group="' + esc(groupId || '') + '" novalidate>'
            + (g ? '<span class="chip">Roadmap: ' + esc(label(g)) + '</span>' : '')
            + (opts.chip ? '<span class="chip">' + esc(opts.chip) + '</span>' : '')
            + '<div class="row2"><label>Your name<input name="name" autocomplete="name" placeholder="Full name" maxlength="80" required></label>'
            + '<label>' + (src === 'pdf' ? 'WhatsApp number' : 'Mobile') + '<div class="ph"><span>+91</span><input name="mobile" inputmode="numeric" maxlength="10" autocomplete="tel-national" placeholder="10-digit number" required></div></label></div>'
            + (full ? '<div class="row2"><label>I am in<select name="cls">' + clsOpts + '</select></label><label>State<select name="state">' + sts + '</select></label></div>' : '')
            + '<label class="wa"><input type="checkbox" name="wa" value="1"> Also send me updates on WhatsApp</label>'
            + '<input class="hp" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">'
            + (opts.question ? '<input type="hidden" name="question" value="' + esc(opts.question) + '">' : '')
            + (opts.result ? '<input type="hidden" name="result" value="' + esc(opts.result) + '">' : '')
            + '<span class="err" aria-live="polite"></span>'
            + '<button class="cr-btn cr-btn-orange" type="submit">' + esc(BUTTON[src] || 'Submit') + '</button>'
            + '<span class="fine">Free. By continuing you agree to be contacted by Enrollzy about your query.</span></form>';
    }

    /** A form container: the form, or (number known) the thank-you, or for the roadmap box a one-tap "send it to me". */
    function mountForms(scope) {
        qa('[data-cr-form]', scope).forEach(function (el) {
            var src = el.getAttribute('data-cr-form'), id = el.getAttribute('data-group') || (src === 'roadmap' ? S.group : '');
            if (!LEAD) { el.innerHTML = formHtml(src, id); return; }
            if (src === 'roadmap') {
                el.innerHTML = '<div class="cr-done"><b>Send the ' + esc(label(group(id))) + ' roadmap to ' + esc(LEAD.mobile) + '?</b><p><a href="#" data-cr-relead>Not you?</a></p><button type="button" class="cr-btn cr-btn-orange" data-cr-onetap="roadmap" data-group="' + esc(id) + '">Send me this roadmap</button></div>';
                return;
            }
            el.innerHTML = doneHtml(src, id);
        });
    }

    function post(fields) {
        var fd = new FormData();
        Object.keys(fields).forEach(function (k) { if (fields[k] != null && fields[k] !== '') fd.append(k, fields[k]); });
        fd.append('utm', utm); fd.append('page', location.href.split('#')[0].slice(0, 290));
        return fetch(D.urls.lead, { method: 'POST', body: fd, credentials: 'same-origin', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': CSRF } })
            .then(function (r) { return r.json().catch(function () { return {}; }).then(function (j) { return { ok: r.ok, status: r.status, j: j }; }); });
    }

    function afterLead(src, groupId, box, res) {
        LEAD = { name: res.j.name || (LEAD && LEAD.name) || '', mobile: res.j.mobile || (LEAD && LEAD.mobile) || '' };
        mountForms(document);
        if (box) box.innerHTML = doneHtml(src, groupId);
        var n = q('[data-cr-nudge]'); if (n) n.hidden = true;
        if (src === 'pdf') { closeModal(); printGroup(groupId); }
    }

    /** One tap once the number is known: records what was asked for, then the thank-you (or the print). */
    function oneTap(src, groupId, box, extra) {
        if (box) box.innerHTML = '<div class="cr-done"><p>Sending…</p></div>';
        return post(Object.assign({ source: src, group: groupId || '', cls: classFor(groupId) }, extra || {})).then(function (res) {
            if (res.ok) return afterLead(src, groupId, box, res);
            if (res.status === 422 || res.status === 419) { LEAD = null; if (box) box.innerHTML = formHtml(src, groupId, extra); mountForms(document); return; }
            if (box) box.innerHTML = '<div class="cr-done"><p>Something went wrong. Please try again.</p></div>';
        }).catch(function () { toast('No connection. Please try again.'); });
    }

    document.addEventListener('submit', function (e) {
        if (!root.contains(e.target)) return;
        var f = e.target.closest('form.cr-lf');
        if (f) {
            e.preventDefault();
            var err = q('.err', f), btn = q('button[type=submit]', f);
            var name = f.elements.name.value.trim(), mobile = f.elements.mobile.value.replace(/\D/g, '');
            if (name.length < 2) { err.textContent = 'Please enter your name.'; f.elements.name.focus(); return; }
            if (!/^[6-9]\d{9}$/.test(mobile)) { err.textContent = 'Please enter a valid 10-digit mobile number.'; f.elements.mobile.focus(); return; }
            err.textContent = ''; btn.disabled = true;
            var src = f.getAttribute('data-src'), groupId = f.getAttribute('data-group');
            var fields = { name: name, mobile: mobile, source: src, group: groupId, cls: f.elements.cls ? f.elements.cls.value : classFor(groupId), state: f.elements.state ? f.elements.state.value : '',
                wa: f.elements.wa.checked ? 1 : '', website: f.elements.website.value, question: f.elements.question ? f.elements.question.value : '', result: f.elements.result ? f.elements.result.value : '' };
            post(fields).then(function (res) {
                btn.disabled = false;
                if (res.ok) return afterLead(src, groupId, f.parentNode, res);
                var errs = res.j && res.j.errors ? Object.keys(res.j.errors).map(function (k) { return res.j.errors[k][0]; }) : [];
                err.textContent = errs[0] || (res.status === 419 ? 'The page has expired. Please refresh and try again.' : res.status === 429 ? 'Too many tries. Please wait a minute.' : 'Something went wrong. Please try again.');
            }).catch(function () { btn.disabled = false; err.textContent = 'No connection. Please try again.'; });
            return;
        }
        var ask = e.target.closest('[data-cr-ask]');
        if (ask) {
            e.preventDefault();
            var qtext = q('input', ask).value.trim();
            if (qtext.length < 8) { toast('Please type your question.'); return; }
            if (LEAD) { openModal('<h3>Post your question</h3><p class="msub">“' + esc(qtext) + '”</p><div data-cr-mform></div>'); oneTap('ask', '', q('[data-cr-mform]', modal), { question: qtext }); q('input', ask).value = ''; return; }
            openModal('<h3>Post your question</h3><p class="msub">“' + esc(qtext) + '”</p><p class="msub">Add your number so a counsellor can answer you, and call if you want.</p>' + formHtml('ask', '', { question: qtext }));
        }
    });
    document.addEventListener('input', function (e) { if (e.target.name === 'mobile' && e.target.closest('.cr-lf')) e.target.value = e.target.value.replace(/\D/g, '').slice(0, 10); });

    // ------------------------------------------------------------------ modal, leads from buttons
    var modal = q('[data-cr-modal]'), lastFocus = null;
    function openModal(html) {
        lastFocus = document.activeElement;
        q('[data-cr-mbody]', modal).innerHTML = html; modal.hidden = false;
        var f = q('input:not([type=hidden]):not(.hp), button', q('[data-cr-mbody]', modal)); if (f) setTimeout(function () { f.focus(); }, 30);
    }
    function closeModal() { if (modal.hidden) return; modal.hidden = true; if (lastFocus && lastFocus.focus) lastFocus.focus(); }

    function openPdf(id) {
        var g = group(id); if (!g) return;
        if (LEAD) { oneTap('pdf', id, null); return; }
        openModal('<h3>Download the ' + esc(label(g)) + ' roadmap (PDF)</h3><p class="msub">Enter your WhatsApp number. The roadmap opens to save as a PDF right away, and a counsellor can send it to you on WhatsApp too.</p>' + formHtml('pdf', id));
    }
    function openLead(src, id) {
        var g = group(id);
        var title = g ? 'Get the ' + esc(label(g)) + ' roadmap, free' : 'Book a free career call';
        var sub = g ? 'We send the full roadmap to your WhatsApp, and a counsellor can check it with your marks.' : 'A counsellor calls you with two or three paths that fit.';
        if (LEAD) { openModal('<h3>' + title + '</h3><div data-cr-mform></div>'); oneTap(src, id, q('[data-cr-mform]', modal)); return; }
        openModal('<h3>' + title + '</h3><p class="msub">' + sub + '</p>' + formHtml(src, id));
    }

    // ------------------------------------------------------------------ stream quiz
    var answers = [];
    function quizStep() {
        var Q = D.quiz || [];
        if (answers.length < Q.length) {
            var item = Q[answers.length];
            openModal('<div class="cr-qz"><div class="bar"><i style="width:' + (answers.length / Q.length * 100) + '%"></i></div><span class="qn">Question ' + (answers.length + 1) + ' of ' + Q.length + '</span><h4>' + esc(item.question) + '</h4><div class="opts">'
                + item.options.map(function (o) { return '<button type="button" data-cr-qa="' + esc(o.stream || '') + '">' + esc(o.text) + '</button>'; }).join('') + '</div></div>');
            return;
        }
        var count = {}; answers.forEach(function (v) { if (v) count[v] = (count[v] || 0) + 1; });
        var top = Object.keys(count).sort(function (a, b) { return count[b] - count[a]; })[0];
        if (!top) { closeModal(); return; }
        var opens = (D.streams || {})[top];
        var body = '<h3>Your best fit</h3><div class="cr-qres"><b>' + esc(top) + '</b>' + (opens ? '<span>Opens the door to ' + esc(opens) + '.</span>' : '') + '</div>';
        if (LEAD) { openModal(body + '<div data-cr-mform></div>'); oneTap('quiz', '', q('[data-cr-mform]', modal), { result: top }); return; }
        openModal(body + '<p class="msub">Get the full report with matching careers, exams and colleges, and a free call to discuss it.</p>' + formHtml('quiz', '', { result: top, chip: 'Quiz result: ' + top }));
    }

    // ------------------------------------------------------------------ "save your roadmap?" after a couple of roadmaps
    var views = 0;
    function seen() {
        views++;
        if (views < 2 || LEAD || store.get('cr-nudged')) return;
        store.set('cr-nudged', '1');
        var n = q('[data-cr-nudge]'), g = group(S.group); if (!n || !g) return;
        q('[data-cr-nudget]', n).textContent = 'We can send the ' + label(g) + ' roadmap to your WhatsApp, free.';
        n.hidden = false;
    }

    // ------------------------------------------------------------------ clicks
    document.addEventListener('click', function (e) {
        var t = e.target, b;
        if (!root.contains(t)) return;
        if ((b = t.closest('[data-cr-stage]'))) { var c = CATS.filter(function (x) { return x.id === +b.getAttribute('data-cr-stage'); })[0]; if (c) { S.cls = c.classes[c.classes.length - 1]; renderAll(); } return; }
        if ((b = t.closest('[data-cr-clsb]'))) { S.cls = +b.getAttribute('data-cr-clsb'); renderAll(); return; }
        if ((b = t.closest('[data-cr-group]'))) { S.group = +b.getAttribute('data-cr-group'); renderInts(); renderOut(); syncUrl(); seen(); return; }
        if ((b = t.closest('[data-cr-more]'))) { var p = b.closest('.cr-more'); p.children[0].hidden = true; p.children[1].hidden = false; b.remove(); return; }
        if ((b = t.closest('[data-cr-subopen]'))) {
            var card = b.closest('.cr-tcard'), id = b.getAttribute('data-cr-subopen'), panel = q('[data-cr-sub="' + id + '"]', card), open = panel.hidden;
            qa('[data-cr-sub]', card).forEach(function (x) { x.hidden = true; }); qa('[data-cr-subopen]', card).forEach(function (x) { x.setAttribute('aria-pressed', 'false'); });
            panel.hidden = !open; b.setAttribute('aria-pressed', String(open)); return;
        }
        if ((b = t.closest('[data-cr-pdf]'))) { e.preventDefault(); closeModal(); openPdf(b.getAttribute('data-cr-pdf')); return; }
        if ((b = t.closest('[data-cr-open]'))) { e.preventDefault(); if (sugg) sugg.hidden = true; openGroup(b.getAttribute('data-cr-open'), b.getAttribute('data-item')); if (b.getAttribute('data-item')) { var bd = document.getElementById('build'); if (bd) bd.scrollIntoView({ block: 'start' }); } return; }
        if ((b = t.closest('[data-cr-lead]'))) { e.preventDefault(); if (sugg) sugg.hidden = true; var nd = q('[data-cr-nudge]'); if (nd) nd.hidden = true; openLead(b.getAttribute('data-cr-lead'), b.getAttribute('data-group') || (b.getAttribute('data-cr-lead') === 'nudge' ? S.group : '')); return; }
        if ((b = t.closest('[data-cr-onetap]'))) { e.preventDefault(); oneTap(b.getAttribute('data-cr-onetap'), b.getAttribute('data-group'), b.closest('[data-cr-form]')); return; }
        if (t.closest('[data-cr-share]')) {
            e.preventDefault(); var url = shareUrl(), g = group(S.group);
            if (navigator.share) { navigator.share({ title: (g ? label(g) + ' roadmap' : 'Career roadmap') + ' | Enrollzy', url: url }).catch(function () {}); return; }
            (navigator.clipboard ? navigator.clipboard.writeText(url) : Promise.reject()).then(function () { toast('Link copied. Share it with anyone.'); }, function () { window.prompt('Copy this link', url); });
            return;
        }
        if (t.closest('[data-cr-close]')) { closeModal(); return; }
        if (t.closest('[data-cr-nudgex]')) { q('[data-cr-nudge]').hidden = true; return; }
        if ((b = t.closest('[data-cr-cat]'))) { cat = b.getAttribute('data-cr-cat'); cAll = false; renderExplore(); return; }
        if (t.closest('[data-cr-cmore]')) { cAll = true; renderExplore(); return; }
        if (t.closest('[data-cr-quiz]')) { answers = []; quizStep(); return; }
        if ((b = t.closest('[data-cr-qa]'))) { answers.push(b.getAttribute('data-cr-qa')); quizStep(); return; }
        if ((b = t.closest('[data-cr-topic]'))) { renderTopic(b.getAttribute('data-cr-topic')); return; }
        if (t.closest('[data-cr-relead]')) { e.preventDefault(); LEAD = null; mountForms(document); if (t.closest('[data-cr-mform]')) closeModal(); return; }
        if (sugg && !t.closest('[data-cr-search]')) sugg.hidden = true;
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && modal && !modal.hidden) closeModal(); });
    window.addEventListener('resize', function () { if (!cAll) renderExplore(); });

    // ------------------------------------------------------------------ start
    if (q('[data-cr-stages]')) renderAll();
    mountForms(document);
    renderExplore();
})();
