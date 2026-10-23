@extends('layouts.app')

@section('meta_title', $page->meta_title ?? 'Grievance Redressal Policy | Enrollzy')
@section('meta_keywords', $page->meta_keywords ?? '')
@section('meta_description', $page->meta_description ?? 'Grievance Redressal Policy of Uniband8 Education Technology Pvt. Ltd. (Enrollzy): how to raise a complaint, who handles it, and how it is resolved.')

@push('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;700&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  .grievance-page {
    --han: #0171E0;
    --han-deep: #015FBD;
    --ghost: #F7FAFD;
    --ink: #0A2540;
    --muted: #465B72;
    --tint: #E6F1FC;
    --tint-2: #CFE3F9;
    --line: #DCE8F6;
    --white: #FFFFFF;

    --r-hero: 36px;
    --r-panel: 28px;
    --r-card: 24px;
    --r-row: 20px;
    --r-chip: 14px;

    --font-head: "Bricolage Grotesque", "Trebuchet MS", system-ui, sans-serif;
    --font-body: "Figtree", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;

    background: var(--ghost);
    color: var(--ink);
    font-family: var(--font-body);
    font-size: 1rem;
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
    padding-top: 30px;
    padding-bottom: 50px;
  }

  .grievance-page h1, .grievance-page h2, .grievance-page h3, 
  .grievance-page p, .grievance-page ul, .grievance-page ol, 
  .grievance-page dl, .grievance-page dd { 
    margin: 0; 
  }
  .grievance-page ul, .grievance-page ol { 
    padding: 0; 
    list-style: none; 
  }
  .grievance-page a { 
    color: var(--han); 
    text-underline-offset: 3px; 
  }
  .grievance-page a:hover { 
    color: var(--han-deep); 
  }
  .grievance-page address { 
    font-style: normal; 
  }

  .grievance-wrap { 
    width: min(1200px, 100% - 40px); 
    margin-inline: auto; 
  }
  @media (min-width: 720px) { 
    .grievance-wrap { width: min(1200px, 100% - 64px); } 
  }

  .grievance-page .ic {
    width: 20px; height: 20px; flex: none;
    fill: none; stroke: currentColor; stroke-width: 1.8;
    stroke-linecap: round; stroke-linejoin: round;
  }

  /* Buttons */
  .grievance-page .btn-g {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    min-height: 48px; padding: 0 22px;
    border-radius: 999px; border: 2px solid transparent;
    font: 700 1rem/1.2 var(--font-body); text-decoration: none; text-align: center;
    cursor: pointer;
    transition: background-color .15s, color .15s, border-color .15s;
  }
  .grievance-page .btn-solid { background: var(--han); color: #fff !important; }
  .grievance-page .btn-solid:hover { background: var(--han-deep); color: #fff !important; }
  .grievance-page .btn-line { background: var(--white); color: var(--han) !important; border-color: var(--han); }
  .grievance-page .btn-line:hover { background: var(--tint); color: var(--han-deep) !important; }
  .grievance-page .btn-light { background: #fff; color: var(--han) !important; }
  .grievance-page .btn-light:hover { background: var(--tint); color: var(--han-deep) !important; }
  .grievance-page .btn-ghost { background: transparent; color: #fff !important; border-color: rgba(255,255,255,.75); }
  .grievance-page .btn-ghost:hover { background: rgba(255,255,255,.14); color: #fff !important; }

  /* Hero */
  .grievance-page .hero { padding-bottom: 28px; }
  .grievance-page .hero-card {
    position: relative; overflow: hidden; isolation: isolate;
    display: grid; grid-template-columns: minmax(0, 1.35fr) minmax(0, 1fr);
    gap: 40px; align-items: center;
    padding: clamp(28px, 5vw, 64px);
    border-radius: var(--r-hero);
    background: var(--han); color: #fff;
  }
  .grievance-page .hero-card::before {
    content: ""; position: absolute; z-index: -1;
    width: 440px; height: 440px; border-radius: 50%;
    right: -140px; top: -170px; background: rgba(255,255,255,.08);
  }
  .grievance-page .hero-card::after {
    content: ""; position: absolute; z-index: -1;
    width: 230px; height: 230px; border-radius: 50%;
    left: -80px; bottom: -120px; border: 2px solid rgba(255,255,255,.2);
  }
  .grievance-page .hero h1 {
    font-family: var(--font-head); font-weight: 700;
    font-size: clamp(2.2rem, 5vw, 3.6rem); line-height: 1.05; letter-spacing: -.02em;
    text-wrap: balance; margin-bottom: 20px; color: #fff;
  }
  .grievance-page .lead { font-size: 1.0625rem; line-height: 1.7; max-width: 62ch; color: rgba(255,255,255,.95); }
  .grievance-page .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px; }

  .grievance-page .commit { display: grid; gap: 14px; }
  .grievance-page .commit li {
    display: flex; align-items: center; gap: 14px;
    padding: 18px 20px; border-radius: var(--r-card);
    background: var(--ghost); color: var(--ink);
  }
  .grievance-page .commit li:nth-child(2) { margin-left: 32px; }
  .grievance-page .commit-ic {
    display: grid; place-items: center; flex: none;
    width: 46px; height: 46px; border-radius: 50%;
    background: var(--tint); color: var(--han);
  }
  .grievance-page .commit strong { display: block; font-family: var(--font-head); font-size: 1.05rem; line-height: 1.3; }
  .grievance-page .commit span.t { display: block; color: var(--muted); font-size: .9375rem; line-height: 1.45; margin-top: 2px; }

  @media (max-width: 860px) {
    .grievance-page .hero-card { grid-template-columns: minmax(0, 1fr); gap: 32px; }
    .grievance-page .commit li:nth-child(2) { margin-left: 0; }
  }

  /* Tabs + panels */
  .grievance-page .stage {
    display: grid; grid-template-columns: 340px minmax(0, 1fr);
    gap: 28px; padding-bottom: 30px; scroll-margin-top: 12px;
  }
  .grievance-page .tabs-col { display: block; }
  .grievance-page .tablist { display: flex; flex-direction: column; gap: 8px; position: sticky; top: 24px; }

  .grievance-page .tab-btn {
    display: flex; align-items: center; gap: 12px; width: 100%;
    padding: 8px 18px 8px 8px; margin: 0;
    border-radius: 999px; border: 1.5px solid var(--line); background: var(--white);
    color: var(--ink); font: 600 1rem/1.3 var(--font-body); text-align: left;
    cursor: pointer;
    transition: background-color .15s, color .15s, border-color .15s;
  }
  .grievance-page .tab-btn:hover { border-color: var(--han); }
  .grievance-page .tab-ic {
    display: grid; place-items: center; flex: none;
    width: 38px; height: 38px; border-radius: 50%;
    background: var(--tint); color: var(--han);
    transition: background-color .15s;
  }
  .grievance-page .tab-btn[aria-selected="true"] { background: var(--han); border-color: var(--han); color: #fff; }
  .grievance-page .tab-btn[aria-selected="true"] .tab-ic { background: #fff; }

  .grievance-page .panels { display: grid; gap: 20px; min-width: 0; }
  .grievance-page .panel {
    background: var(--white); border: 1px solid var(--line);
    border-radius: var(--r-panel);
    padding: clamp(22px, 4vw, 40px);
    box-shadow: 0 30px 60px -42px rgba(1,113,224,.4);
  }
  .grievance-page .panel[hidden] { display: none; }
  .grievance-page .panel.enter { animation: panel-in .28s ease-out; }
  @keyframes panel-in { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }

  .grievance-page .panel-head { display: flex; align-items: center; gap: 14px; margin-bottom: 24px; }
  .grievance-page .panel-ic {
    display: grid; place-items: center; flex: none;
    width: 54px; height: 54px; border-radius: 50%;
    background: var(--tint); color: var(--han);
  }
  .grievance-page .panel-ic .ic { width: 26px; height: 26px; }
  .grievance-page .panel h2 {
    font-family: var(--font-head); font-weight: 700;
    font-size: clamp(1.5rem, 2.6vw, 2rem); line-height: 1.15; letter-spacing: -.01em;
    text-wrap: balance; color: var(--ink);
  }
  .grievance-page .intro { color: var(--muted); font-size: 1.0625rem; max-width: 62ch; margin-bottom: 20px; }

  /* Rows */
  .grievance-page .rows { display: grid; gap: 12px; }
  .grievance-page .rows.two { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .grievance-page .row-item {
    display: flex; align-items: flex-start; gap: 16px;
    padding: 16px 18px; border-radius: var(--r-row);
    background: var(--ghost); border: 1px solid var(--line);
  }
  .grievance-page .row-ic {
    display: grid; place-items: center; flex: none;
    width: 46px; height: 46px; border-radius: var(--r-chip);
    background: var(--han); color: #fff;
  }
  .grievance-page .row-item p, .grievance-page .row-item .val { padding-top: 8px; }
  .grievance-page .row-item.labeled .row-ic { align-self: center; }
  .grievance-page .row-item.labeled > div { padding: 2px 0; min-width: 0; overflow-wrap: anywhere; }
  .grievance-page .lbl { display: block; color: var(--muted); font-size: .875rem; font-weight: 600; line-height: 1.4; }
  .grievance-page .row-item .val { display: block; padding-top: 0; font-weight: 500; }
  .grievance-page .row-item a { font-weight: 600; }
  .grievance-page .quote-mark { font-weight: 600; }

  .grievance-page .actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 24px; }

  /* Steps */
  .grievance-page .steps { position: relative; }
  .grievance-page .step { position: relative; display: grid; grid-template-columns: 44px minmax(0, 1fr); gap: 16px; padding-bottom: 20px; }
  .grievance-page .step:last-child { padding-bottom: 0; }
  .grievance-page .step::before {
    content: ""; position: absolute; left: 21px; top: 44px; bottom: 0; width: 2px; background: var(--tint-2);
  }
  .grievance-page .step:last-child::before { display: none; }
  .grievance-page .dot {
    display: grid; place-items: center; width: 44px; height: 44px; border-radius: 50%;
    background: var(--han); color: #fff; font-family: var(--font-head); font-weight: 700; font-size: 1.1rem;
  }
  .grievance-page .step-body {
    padding: 14px 18px; border-radius: var(--r-row);
    background: var(--ghost); border: 1px solid var(--line);
  }
  .grievance-page .step-body h3 { font-family: var(--font-head); font-weight: 700; font-size: 1.1rem; line-height: 1.3; margin-bottom: 2px; color: var(--ink); }

  /* Officer */
  .grievance-page .officer {
    display: grid; grid-template-columns: auto minmax(0, 1fr); gap: 28px; align-items: start;
    padding: clamp(20px, 3vw, 28px); border-radius: var(--r-card);
    background: var(--ghost); border: 1px solid var(--line);
  }
  .grievance-page .avatar {
    display: grid; place-items: center; width: 104px; height: 104px; border-radius: 50%;
    background: var(--han); color: #fff; box-shadow: 0 0 0 6px var(--tint);
    font-family: var(--font-head); font-weight: 700; font-size: 2.2rem;
  }
  .grievance-page .facts { display: grid; grid-template-columns: minmax(96px, 150px) minmax(0, 1fr); width: 100%; }
  .grievance-page .facts dt, .grievance-page .facts dd { padding: 13px 0; border-bottom: 1px solid var(--line); }
  .grievance-page .facts dt { color: var(--muted); font-weight: 600; }
  .grievance-page .facts dd { font-weight: 500; overflow-wrap: anywhere; }
  .grievance-page .facts dt:nth-last-of-type(1), .grievance-page .facts dd:nth-last-of-type(1) { border-bottom: 0; }
  .grievance-page .facts dt:first-of-type, .grievance-page .facts dd:first-of-type { padding-top: 0; }

  /* Confidentiality */
  .grievance-page .seal {
    display: grid; justify-items: center; gap: 22px; text-align: center;
    padding: clamp(28px, 5vw, 48px) clamp(20px, 4vw, 40px); border-radius: var(--r-card);
    background: var(--ghost); border: 1px solid var(--line);
  }
  .grievance-page .seal-ring {
    display: grid; place-items: center; width: 96px; height: 96px; border-radius: 50%;
    background: var(--white); border: 3px solid var(--han); color: var(--han);
  }
  .grievance-page .seal-ring .ic { width: 40px; height: 40px; }
  .grievance-page .seal p { font-size: 1.2rem; line-height: 1.6; max-width: 44ch; }

  /* Pager */
  .grievance-page .pager {
    display: flex; justify-content: space-between; gap: 12px; flex-wrap: wrap;
    margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--line);
  }
  .grievance-page .pager .btn-g { flex-direction: row; text-align: left; padding: 10px 22px; min-height: 56px; }
  .grievance-page .pager .btn-g.next { margin-left: auto; text-align: right; }
  .grievance-page .pager small { display: block; font-size: .8125rem; font-weight: 600; opacity: .85; line-height: 1.2; }
  .grievance-page .pager b { display: block; font-size: .9875rem; line-height: 1.3; }
  .grievance-page .pager .ic { width: 18px; height: 18px; }

  /* Toast */
  .grievance-toast {
    position: fixed; left: 50%; bottom: 24px; z-index: 9999;
    transform: translate(-50%, 16px); opacity: 0; pointer-events: none;
    background: var(--ink); color: #fff; padding: 12px 22px; border-radius: 999px;
    font-weight: 600; font-size: .9375rem;
    transition: opacity .2s, transform .2s;
  }
  .grievance-toast.show { opacity: 1; transform: translate(-50%, 0); }

  /* Responsive styles */
  @media (max-width: 960px) {
    .grievance-page .stage { grid-template-columns: minmax(0, 1fr); gap: 16px; }
    .grievance-page .tabs-col {
      min-width: 0;
      position: sticky; top: 0; z-index: 20;
      margin-inline: -20px; padding: 10px 20px;
      background: rgba(247,250,253,.96);
      border-bottom: 1px solid var(--line);
    }
    .grievance-page .tablist {
      position: static; flex-direction: row; gap: 8px;
      overflow-x: auto; padding: 4px 2px; scroll-snap-type: x proximity;
      scrollbar-width: thin; scrollbar-color: var(--tint-2) transparent;
    }
    .grievance-page .tab-btn { width: auto; flex: none; white-space: nowrap; scroll-snap-align: center; padding-right: 20px; }
  }
  @media (min-width: 720px) and (max-width: 960px) {
    .grievance-page .tabs-col { margin-inline: -32px; padding-inline: 32px; }
  }
  @media (max-width: 720px) {
    .grievance-page .rows.two { grid-template-columns: 1fr; }
    .grievance-page .officer { grid-template-columns: 1fr; justify-items: start; gap: 22px; }
    .grievance-page .avatar { width: 88px; height: 88px; font-size: 1.9rem; }
    .grievance-page .pager .btn-g { flex: 1 1 100%; }
    .grievance-page .pager .btn-g.next { margin-left: 0; text-align: left; justify-content: flex-end; }
  }
  @media (max-width: 520px) {
    .grievance-page .facts { grid-template-columns: 1fr; }
    .grievance-page .facts dt { border-bottom: 0; padding-bottom: 0; }
    .grievance-page .facts dd { padding-top: 2px; }
    .grievance-page .facts dd:nth-last-of-type(1) { border-bottom: 0; }
    .grievance-page .facts dt:first-of-type { padding-top: 0; }
    .grievance-page .facts dd:first-of-type { padding-top: 2px; }
    .grievance-page .panel-ic { width: 46px; height: 46px; }
    .grievance-page .panel-ic .ic { width: 22px; height: 22px; }
  }

  @media (prefers-reduced-motion: reduce) {
    .grievance-page .panel.enter { animation: none; }
    .grievance-toast, .grievance-page .tab-btn, .grievance-page .btn-g { transition: none; }
  }

  @media print {
    .grievance-page .tabs-col, .grievance-page .pager, .grievance-page .hero-actions, .grievance-toast, .grievance-page .actions { display: none !important; }
    .grievance-page .stage { display: block; padding-bottom: 0; }
    .grievance-page .panel[hidden] { display: block !important; }
    .grievance-page .panel { box-shadow: none; break-inside: avoid; margin-bottom: 16px; }
    .grievance-page .hero-card { background: #fff; color: var(--ink); border: 2px solid var(--han); }
    .grievance-page .hero-card::before, .grievance-page .hero-card::after { display: none; }
    .grievance-page .commit { display: none; }
    .grievance-page .hero-card { display: block; }
  }
</style>
@endpush

@section('content')
<div class="grievance-page">

  <!-- SVG Icon Sprite -->
  <svg width="0" height="0" style="position:absolute; display:none;" aria-hidden="true" focusable="false">
    <symbol id="i-target" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></symbol>
    <symbol id="i-list" viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></symbol>
    <symbol id="i-mail" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/></symbol>
    <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></symbol>
    <symbol id="i-users" viewBox="0 0 24 24"><circle cx="9" cy="8" r="4"/><path d="M2 21v-1a6 6 0 0 1 12 0v1M16 4a4 4 0 0 1 0 8M22 21v-1a6 6 0 0 0-4-5.6"/></symbol>
    <symbol id="i-refresh" viewBox="0 0 24 24"><path d="M3 12a9 9 0 0 1 15.5-6.2L21 8M21 3v5h-5M21 12a9 9 0 0 1-15.5 6.2L3 16M3 21v-5h5"/></symbol>
    <symbol id="i-building" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="1.5"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M10 21v-4h4v4"/></symbol>
    <symbol id="i-lock" viewBox="0 0 24 24"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></symbol>
    <symbol id="i-pencil" viewBox="0 0 24 24"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></symbol>
    <symbol id="i-at" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8"/></symbol>
    <symbol id="i-msg" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></symbol>
    <symbol id="i-eye" viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></symbol>
    <symbol id="i-file" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></symbol>
    <symbol id="i-alert" viewBox="0 0 24 24"><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/><path d="M12 9v4M12 17h.01"/></symbol>
    <symbol id="i-monitor" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></symbol>
    <symbol id="i-clipboard" viewBox="0 0 24 24"><rect x="5" y="4" width="14" height="17" rx="2"/><path d="M9 2h6v4H9zM9 12h6M9 16h4"/></symbol>
    <symbol id="i-help" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3M12 17h.01"/></symbol>
    <symbol id="i-pin" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></symbol>
    <symbol id="i-tag" viewBox="0 0 24 24"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><path d="M7 7h.01"/></symbol>
    <symbol id="i-send" viewBox="0 0 24 24"><path d="m22 2-11 11M22 2l-7 20-4-9-9-4z"/></symbol>
    <symbol id="i-link" viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></symbol>
    <symbol id="i-globe" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/></symbol>
    <symbol id="i-copy" viewBox="0 0 24 24"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></symbol>
    <symbol id="i-chev-l" viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></symbol>
    <symbol id="i-chev-r" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></symbol>
  </svg>

  <!-- Hero Section -->
  <section class="hero">
    <div class="grievance-wrap">
      <div class="hero-card">
        <div class="hero-copy">
          <h1>{{ $page->title ?? 'Grievance Redressal Policy' }}</h1>
          <p class="lead">Uniband8 Education Technology Pvt. Ltd. (“Enrollzy,” “we,” “us,” or “our”), operating the website <a href="https://enrollzy.com/" style="color:#fff; text-decoration: underline;">https://enrollzy.com/</a> (“Platform”), is committed to providing a safe, transparent, and trustworthy experience for all Students, Users, Institutions, and Partners. This Grievance Redressal Policy outlines the process for raising complaints or concerns and how we address them, in accordance with the Information Technology Act, 2000, and the Information Technology (Intermediary Guidelines and Digital Media Ethics Code) Rules, 2021, and other applicable Indian laws.</p>
          <div class="hero-actions">
            <a class="btn-g btn-light" href="#raise" data-goto="raise">How to raise a grievance</a>
            <a class="btn-g btn-ghost" href="mailto:info@enrollzy.com?subject=Grievance%20%E2%80%93%20">Email the Grievance Officer</a>
          </div>
        </div>

        <ul class="commit" role="list">
          <li>
            <span class="commit-ic"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>
            <div><strong>Acknowledgment</strong><span class="t">Within 24–48 hours of receiving your grievance</span></div>
          </li>
          <li>
            <span class="commit-ic"><svg class="ic" aria-hidden="true"><use href="#i-clock"/></svg></span>
            <div><strong>Resolution</strong><span class="t">Aimed within 15 working days from the date of receipt, wherever reasonably possible</span></div>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Stage: Tabs + Panels -->
  <main class="grievance-wrap stage" id="stage">

    <div class="tabs-col">
      <div class="tablist" role="tablist" aria-label="Policy sections" aria-orientation="vertical">
        <button class="tab-btn" role="tab" id="tab-purpose" aria-controls="purpose" aria-selected="true">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-target"/></svg></span><span class="tab-label">Purpose of This Policy</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-counts" aria-controls="counts" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-list"/></svg></span><span class="tab-label">What Counts as a Grievance</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-raise" aria-controls="raise" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-mail"/></svg></span><span class="tab-label">How to Raise a Grievance</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-officer" aria-controls="officer" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-user"/></svg></span><span class="tab-label">Grievance Officer</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-process" aria-controls="process" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-refresh"/></svg></span><span class="tab-label">Our Resolution Process</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-cannot" aria-controls="cannot" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-building"/></svg></span><span class="tab-label">What We Cannot Resolve Directly</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-confidentiality" aria-controls="confidentiality" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-lock"/></svg></span><span class="tab-label">Confidentiality</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-changes" aria-controls="changes" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-pencil"/></svg></span><span class="tab-label">Changes to This Policy</span>
        </button>
        <button class="tab-btn" role="tab" id="tab-contact" aria-controls="contact" aria-selected="false" tabindex="-1">
          <span class="tab-ic"><svg class="ic" aria-hidden="true"><use href="#i-at"/></svg></span><span class="tab-label">Contact Us</span>
        </button>
      </div>
    </div>

    <div class="panels">

      <!-- 1. Purpose -->
      <section class="panel" id="purpose" role="tabpanel" aria-labelledby="tab-purpose" tabindex="0">
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-target"/></svg></span>
          <h2>Purpose of This Policy</h2>
        </header>
        <ul class="rows" role="list">
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-msg"/></svg></span><p>To provide Users with a clear, accessible channel to raise complaints, grievances, or concerns regarding the Platform, its content, or its services</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-clock"/></svg></span><p>To ensure timely acknowledgment and resolution of grievances</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-eye"/></svg></span><p>To maintain transparency and accountability in how Enrollzy operates as an education marketplace and intermediary</p></li>
        </ul>
      </section>

      <!-- 2. What counts -->
      <section class="panel" id="counts" role="tabpanel" aria-labelledby="tab-counts" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-list"/></svg></span>
          <h2>What Counts as a Grievance</h2>
        </header>
        <p class="intro">You may raise a grievance with us regarding matters such as:</p>
        <ul class="rows" role="list">
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-file"/></svg></span><p>Inaccurate, misleading, or outdated information displayed about an institution, course, or program on the Platform</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-lock"/></svg></span><p>Concerns about how your personal information or inquiry data has been collected, used, or shared</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-alert"/></svg></span><p>Unauthorized, offensive, defamatory, or unlawful content appearing on the Platform</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-monitor"/></svg></span><p>Technical issues preventing access to the Platform or its core features</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-users"/></svg></span><p>Complaints regarding the conduct of an Institution or Partner discovered through the Platform (which we will forward and follow up on, where appropriate, though the underlying relationship remains between you and the Institution)</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-clipboard"/></svg></span><p>Any violation of our Terms and Conditions, Privacy Policy, or Disclaimer Policy</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-help"/></svg></span><p>Any other concern related to your use of the Platform</p></li>
        </ul>
      </section>

      <!-- 3. How to raise -->
      <section class="panel" id="raise" role="tabpanel" aria-labelledby="tab-raise" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-mail"/></svg></span>
          <h2>How to Raise a Grievance</h2>
        </header>
        <ul class="rows" role="list">
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-mail"/></svg></span><p>Write to us with a clear description of your concern, relevant screenshots or supporting documents (if any), and your contact details, at the email address below</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-send"/></svg></span><p>Alternatively, send a written communication to our registered address below</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-tag"/></svg></span><p>Please use the subject line <span class="quote-mark">“Grievance – [Brief Description]”</span> to help us route your complaint efficiently</p></li>
        </ul>

        <div class="rows two" style="margin-top:12px">
          <div class="row-item labeled">
            <span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-mail"/></svg></span>
            <div><span class="lbl">Email</span><a class="val" href="mailto:info@enrollzy.com?subject=Grievance%20%E2%80%93%20">info@enrollzy.com</a></div>
          </div>
          <div class="row-item labeled">
            <span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-pin"/></svg></span>
            <div><span class="lbl">Address</span><address class="val">SCO 210-211,<br>401, 4th Floor, Sector 34A, Chandigarh, 160022.</address></div>
          </div>
        </div>

        <div class="actions">
          <a class="btn-g btn-solid" href="mailto:info@enrollzy.com?subject=Grievance%20%E2%80%93%20">Email your grievance</a>
          <button class="btn-g btn-line" type="button" data-copy="info@enrollzy.com"><svg class="ic" aria-hidden="true"><use href="#i-copy"/></svg>Copy email address</button>
        </div>
      </section>

      <!-- 4. Grievance Officer -->
      <section class="panel" id="officer" role="tabpanel" aria-labelledby="tab-officer" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-user"/></svg></span>
          <h2>Grievance Officer</h2>
        </header>
        <p class="intro">In accordance with the Information Technology Act, 2000, and rules made thereunder, the following Grievance Officer has been appointed:</p>
        <div class="officer">
          <div class="avatar" aria-hidden="true">JC</div>
          <dl class="facts">
            <dt>Name</dt><dd>Janvi Chauhan</dd>
            <dt>Designation</dt><dd>Grievance Officer</dd>
            <dt>Company</dt><dd>Uniband8 Education Technology Pvt. Ltd.</dd>
            <dt>Email</dt><dd><a href="mailto:info@enrollzy.com?subject=Grievance%20%E2%80%93%20">info@enrollzy.com</a></dd>
            <dt>Address</dt><dd><address>SCO 210-211,<br>401, 4th Floor, Sector 34A, Chandigarh, 160022.</address></dd>
          </dl>
        </div>
      </section>

      <!-- 5. Resolution process -->
      <section class="panel" id="process" role="tabpanel" aria-labelledby="tab-process" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-refresh"/></svg></span>
          <h2>Our Resolution Process</h2>
        </header>
        <ol class="steps" role="list">
          <li class="step"><span class="dot" aria-hidden="true">1</span><div class="step-body"><h3>Acknowledgment</h3><p>We will acknowledge receipt of your grievance within 24–48 hours of receiving it</p></div></li>
          <li class="step"><span class="dot" aria-hidden="true">2</span><div class="step-body"><h3>Review</h3><p>Our team will review the grievance, gather relevant facts, and, where necessary, reach out to the concerned Institution or Partner for clarification</p></div></li>
          <li class="step"><span class="dot" aria-hidden="true">3</span><div class="step-body"><h3>Resolution</h3><p>We aim to resolve grievances within 15 working days from the date of receipt, wherever reasonably possible, in line with applicable timelines under Indian law</p></div></li>
          <li class="step"><span class="dot" aria-hidden="true">4</span><div class="step-body"><h3>Escalation</h3><p>If you are not satisfied with the resolution or response, you may request escalation, and the matter will be reviewed by a senior member of our team</p></div></li>
          <li class="step"><span class="dot" aria-hidden="true">5</span><div class="step-body"><h3>Communication</h3><p>We will keep you informed of the status of your grievance and the final outcome via the contact details you provide</p></div></li>
        </ol>
      </section>

      <!-- 6. What we cannot resolve directly -->
      <section class="panel" id="cannot" role="tabpanel" aria-labelledby="tab-cannot" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-building"/></svg></span>
          <h2>What We Cannot Resolve Directly</h2>
        </header>
        <ul class="rows" role="list">
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-link"/></svg></span><p>As an aggregator and intermediary, Enrollzy connects Students with Institutions but is not a party to the admission, enrollment, or payment relationship between you and an Institution</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-building"/></svg></span><p>Grievances relating specifically to an Institution’s own admission decisions, refund policies, academic delivery, or contractual terms must primarily be raised with that Institution</p></li>
          <li class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-send"/></svg></span><p>We will, where appropriate, assist by forwarding your concern to the relevant Institution and following up, but final resolution of such matters rests with the Institution</p></li>
        </ul>
      </section>

      <!-- 7. Confidentiality -->
      <section class="panel" id="confidentiality" role="tabpanel" aria-labelledby="tab-confidentiality" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-lock"/></svg></span>
          <h2>Confidentiality</h2>
        </header>
        <div class="seal">
          <span class="seal-ring"><svg class="ic" aria-hidden="true"><use href="#i-lock"/></svg></span>
          <p>All grievances will be handled with due confidentiality, and information shared will only be used for the purpose of investigating and resolving the complaint</p>
        </div>
      </section>

      <!-- 8. Changes -->
      <section class="panel" id="changes" role="tabpanel" aria-labelledby="tab-changes" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-pencil"/></svg></span>
          <h2>Changes to This Policy</h2>
        </header>
        <div class="rows">
          <div class="row-item"><span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-pencil"/></svg></span><p>We may revise this Grievance Redressal Policy from time to time to reflect changes in our processes or applicable law. The updated version will be posted on this page with a revised “Last Updated” date</p></div>
        </div>
      </section>

      <!-- 9. Contact -->
      <section class="panel" id="contact" role="tabpanel" aria-labelledby="tab-contact" tabindex="0" hidden>
        <header class="panel-head">
          <span class="panel-ic"><svg class="ic" aria-hidden="true"><use href="#i-at"/></svg></span>
          <h2>Contact Us</h2>
        </header>
        <div class="rows two">
          <div class="row-item labeled">
            <span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-building"/></svg></span>
            <div><span class="lbl">Company</span><span class="val">Uniband8 Education Technology Pvt. Ltd.</span></div>
          </div>
          <div class="row-item labeled">
            <span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-mail"/></svg></span>
            <div><span class="lbl">Email</span><a class="val" href="mailto:info@enrollzy.com?subject=Grievance%20%E2%80%93%20">info@enrollzy.com</a></div>
          </div>
          <div class="row-item labeled">
            <span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-pin"/></svg></span>
            <div><span class="lbl">Address</span><address class="val">SCO 210-211,<br>401, 4th Floor, Sector 34A, Chandigarh, 160022.</address></div>
          </div>
          <div class="row-item labeled">
            <span class="row-ic"><svg class="ic" aria-hidden="true"><use href="#i-globe"/></svg></span>
            <div><span class="lbl">Website</span><a class="val" href="https://enrollzy.com/" target="_blank" rel="noopener">https://enrollzy.com/</a></div>
          </div>
        </div>
        <div class="actions">
          <a class="btn-g btn-solid" href="mailto:info@enrollzy.com?subject=Grievance%20%E2%80%93%20">Email your grievance</a>
          <button class="btn-g btn-line" type="button" data-copy="info@enrollzy.com"><svg class="ic" aria-hidden="true"><use href="#i-copy"/></svg>Copy email address</button>
        </div>
      </section>

    </div>
  </main>

  <div class="grievance-toast" id="toast" role="status" aria-live="polite"></div>

</div>
@endsection

@push('scripts')
<script>
(function () {
  var tablist = document.querySelector('.grievance-page [role="tablist"]');
  if (!tablist) return;

  var tabs = Array.prototype.slice.call(tablist.querySelectorAll('.tab-btn'));
  var panels = tabs.map(function (t) { return document.getElementById(t.getAttribute('aria-controls')); });
  var stage = document.getElementById('stage');
  var mobile = window.matchMedia('(max-width: 960px)');
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)');

  function behavior() { return reduce.matches ? 'auto' : 'smooth'; }
  function syncOrientation() { tablist.setAttribute('aria-orientation', mobile.matches ? 'horizontal' : 'vertical'); }
  syncOrientation();
  if (mobile.addEventListener) mobile.addEventListener('change', syncOrientation);

  /* Previous / next buttons at the bottom of each panel */
  var chevL = '<svg class="ic" aria-hidden="true"><use href="#i-chev-l"/></svg>';
  var chevR = '<svg class="ic" aria-hidden="true"><use href="#i-chev-r"/></svg>';
  panels.forEach(function (panel, i) {
    if (!panel) return;
    var nav = document.createElement('nav');
    nav.className = 'pager';
    nav.setAttribute('aria-label', 'Section navigation');
    if (i > 0) {
      var prev = document.createElement('button');
      prev.type = 'button';
      prev.className = 'btn-g btn-line prev';
      prev.setAttribute('data-go', i - 1);
      prev.innerHTML = chevL + '<span><small>Previous</small><b>' + label(i - 1) + '</b></span>';
      nav.appendChild(prev);
    }
    if (i < panels.length - 1) {
      var next = document.createElement('button');
      next.type = 'button';
      next.className = 'btn-g btn-solid next';
      next.setAttribute('data-go', i + 1);
      next.innerHTML = '<span><small>Next</small><b>' + label(i + 1) + '</b></span>' + chevR;
      nav.appendChild(next);
    }
    panel.appendChild(nav);
  });

  function label(i) { return tabs[i].querySelector('.tab-label').textContent; }

  function reveal(force) {
    if (!stage) return;
    var top = stage.getBoundingClientRect().top;
    if (force || top < 0) {
      window.scrollTo({ top: window.pageYOffset + top - 20, behavior: behavior() });
    }
  }

  function activate(i, opts) {
    opts = opts || {};
    tabs.forEach(function (t, j) {
      var on = i === j;
      t.setAttribute('aria-selected', on ? 'true' : 'false');
      t.tabIndex = on ? 0 : -1;
      if (panels[j]) panels[j].hidden = !on;
    });
    var p = panels[i];
    if (p) {
      p.classList.remove('enter');
      void p.offsetWidth;
      p.classList.add('enter');
      if (opts.hash !== false) {
        try { history.replaceState(null, '', '#' + p.id); } catch (e) {}
      }
    }
    if (opts.focus) tabs[i].focus();
    if (opts.reveal) {
      if (mobile.matches) tabs[i].scrollIntoView({ inline: 'center', block: 'nearest', behavior: behavior() });
      reveal(opts.force);
    }
  }

  function indexFromHash() {
    var id = decodeURIComponent(location.hash.replace('#', ''));
    for (var i = 0; i < panels.length; i++) if (panels[i] && panels[i].id === id) return i;
    return -1;
  }

  tabs.forEach(function (t, i) {
    t.addEventListener('click', function () { activate(i, { reveal: true }); });
  });

  tablist.addEventListener('keydown', function (e) {
    var cur = tabs.indexOf(document.activeElement);
    if (cur < 0) return;
    var n = null;
    if (e.key === 'ArrowDown' || e.key === 'ArrowRight') n = (cur + 1) % tabs.length;
    else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') n = (cur - 1 + tabs.length) % tabs.length;
    else if (e.key === 'Home') n = 0;
    else if (e.key === 'End') n = tabs.length - 1;
    if (n !== null) { e.preventDefault(); activate(n, { focus: true, reveal: true }); }
  });

  document.addEventListener('click', function (e) {
    var go = e.target.closest('[data-go]');
    if (go) { activate(parseInt(go.getAttribute('data-go'), 10), { reveal: true, force: true }); return; }
    var jump = e.target.closest('[data-goto]');
    if (jump) {
      e.preventDefault();
      var idx = panels.map(function (p) { return p ? p.id : ''; }).indexOf(jump.getAttribute('data-goto'));
      if (idx > -1) activate(idx, { reveal: true, force: true });
    }
  });

  window.addEventListener('hashchange', function () {
    var i = indexFromHash();
    if (i > -1) activate(i, { hash: false, reveal: true, force: true });
  });

  /* Copy email address toast */
  var toast = document.getElementById('toast');
  var toastTimer;
  function showToast(msg) {
    if (!toast) return;
    toast.textContent = msg;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { toast.classList.remove('show'); }, 2200);
  }
  function fallbackCopy(text) {
    var ta = document.createElement('textarea');
    ta.value = text; ta.setAttribute('readonly', '');
    ta.style.position = 'fixed'; ta.style.opacity = '0';
    document.body.appendChild(ta); ta.select();
    var ok = false;
    try { ok = document.execCommand('copy'); } catch (e) {}
    document.body.removeChild(ta);
    return ok;
  }
  document.querySelectorAll('.grievance-page [data-copy]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var text = btn.getAttribute('data-copy');
      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(
          function () { showToast('Email address copied'); },
          function () { showToast(fallbackCopy(text) ? 'Email address copied' : 'Copy failed. Select the address and copy it manually.'); }
        );
      } else {
        showToast(fallbackCopy(text) ? 'Email address copied' : 'Copy failed. Select the address and copy it manually.');
      }
    });
  });

  /* Initial state */
  var start = indexFromHash();
  activate(start > -1 ? start : 0, { hash: false });
})();
</script>
@endpush
