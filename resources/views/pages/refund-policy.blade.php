@extends('layouts.app')

@section('meta_title', $page->meta_title ?? 'Refund Policy | Enrollzy')
@section('meta_keywords', $page->meta_keywords ?? '')
@section('meta_description', $page->meta_description ?? 'Refund Policy of Uniband8 Education Technology Pvt. Ltd. (Enrollzy): how payments for counselling services are handled and when a refund may or may not be issued.')

@push('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600&family=Inter:wght@400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">

<style>
  .refund-page {
    --han: #0171E0;
    --han-deep: #0159B3;
    --ghost: #F7FAFD;
    --ink: #0A2540;
    --body-text: #41566F;
    --line: rgba(10, 37, 64, .10);

    --font-display: "Syne", "Arial Black", system-ui, sans-serif;
    --font-body: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
    --font-hand: "Caveat", "Segoe Print", "Bradley Hand", cursive;

    position: relative; 
    isolation: isolate;
    background: var(--ghost);
    color: var(--ink);
    font-family: var(--font-body);
    font-size: 1rem; 
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
    padding-bottom: 50px;
  }

  .refund-page::before {
    content: ""; 
    position: absolute; 
    inset: 0; 
    z-index: -1; 
    pointer-events: none;
    background-image: linear-gradient(to bottom, rgba(10, 37, 64, .07) 1px, transparent 1px);
    background-size: 100% 54px;
    -webkit-mask-image: linear-gradient(to bottom, transparent 0, #000 300px);
    mask-image: linear-gradient(to bottom, transparent 0, #000 300px);
  }

  .refund-page h1, .refund-page h2, .refund-page p, .refund-page ul, .refund-page dl, .refund-page dd { 
    margin: 0; 
  }
  .refund-page ul { 
    padding: 0; 
    list-style: none; 
  }
  .refund-page a { 
    color: var(--han-deep); 
    text-underline-offset: 3px; 
  }
  .refund-page a:hover { 
    color: var(--han); 
  }
  .refund-page address { 
    font-style: normal; 
  }

  .refund-wrap { 
    width: min(840px, 100% - 32px); 
    margin-inline: auto; 
  }
  @media (min-width: 720px) { 
    .refund-wrap { width: min(840px, 100% - 64px); } 
  }

  /* Masthead */
  .refund-mast { 
    text-align: center; 
    padding: 40px 0 10px; 
  }
  .refund-mast h1 {
    font-family: var(--font-display); 
    font-weight: 800;
    font-size: clamp(2rem, 5.5vw, 3.8rem); 
    line-height: 1.05; 
    letter-spacing: -.025em;
    margin: 10px 0 18px; 
    color: var(--ink);
    text-shadow: 0 2px 0 rgba(255,255,255,.9);
    text-wrap: balance;
  }
  .refund-mast .lead { 
    max-width: 66ch; 
    margin: 0 auto; 
    color: var(--body-text); 
    font-size: .88rem; 
    line-height: 1.65; 
  }

  /* Board: two staggered columns of pinned notes */
  .refund-page .board {
    position: relative;
    display: grid; 
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    column-gap: clamp(28px, 4.5vw, 60px); 
    row-gap: 33px;
    align-items: start;
    padding: 38px 0 48px;
  }
  .refund-page .is-right { margin-top: 68px; }
  @media (min-width: 861px) {
    .refund-page .note { max-width: 340px; justify-self: start; }
    .refund-page .note.is-right { justify-self: end; }
  }
  .refund-page .links { 
    position: absolute; 
    inset: 0; 
    z-index: 0; 
    pointer-events: none; 
    overflow: visible; 
  }
  .refund-page .links path { 
    fill: none; 
    stroke: rgba(10, 37, 64, .3); 
    stroke-width: 1.5; 
    stroke-dasharray: 7 7; 
    stroke-linecap: round; 
  }

  /* Tones */
  .tone-a { --t1: #EBF4FE; --t2: #DCEBFC; --tb: #C7DEF7; --tn: #0171E0; --p-hi: #9BCBFF; --p-mid: #1F86EE; --p-dark: #0159B3; --p-glow: rgba(1,113,224,.55); }
  .tone-b { --t1: #EEF0FE; --t2: #E0E5FD; --tb: #CBD2F7; --tn: #3341C2; --p-hi: #B5BEFF; --p-mid: #5566F0; --p-dark: #3040C4; --p-glow: rgba(70,86,230,.5); }
  .tone-c { --t1: #E7F6FE; --t2: #D6EEFB; --tb: #BEE1F4; --tn: #05719F; --p-hi: #A6E3FF; --p-mid: #2FA8E8; --p-dark: #0B7DB8; --p-glow: rgba(20,150,220,.5); }

  .refund-page .note {
    --rot: 0deg; 
    --tilt: 1;
    position: relative; 
    z-index: 1;
    padding: 47px 8px 8px;
    border-radius: 26px;
    background: linear-gradient(180deg, #FFFFFF, #FBFDFF);
    border: 1px solid #fff;
    box-shadow:
      inset 0 1px 0 #fff,
      0 2px 5px rgba(10, 37, 64, .05),
      0 0 0 1px rgba(10, 37, 64, .04),
      0 26px 38px -20px rgba(10, 37, 64, .3);
    transform: rotate(calc(var(--rot) * var(--tilt)));
    transition: transform .35s cubic-bezier(.2, .8, .2, 1);
  }
  @media (hover: hover) {
    .refund-page .note:hover, .refund-page .note:focus-within { 
      transform: rotate(0deg) translateY(-6px); 
    }
  }
  .r1 { --rot: 3deg; } 
  .r2 { --rot: -3.5deg; } 
  .r3 { --rot: 3.5deg; } 
  .r4 { --rot: -3deg; }
  .r5 { --rot: 2.5deg; } 
  .r6 { --rot: -3deg; } 
  .r7 { --rot: 3deg; }

  /* Push-pin */
  .refund-page .pin { 
    position: absolute; 
    left: 50%; 
    top: 10px; 
    width: 58px; 
    height: 52px; 
    transform: translateX(-50%) scale(.59); 
    transform-origin: top center; 
  }
  .refund-page .pin i { 
    position: absolute; 
    display: block; 
  }
  .refund-page .pin .base {
    left: 0; right: 0; bottom: 0; height: 26px; border-radius: 50%;
    background: linear-gradient(180deg, var(--p-mid), var(--p-dark));
    box-shadow: 0 14px 22px -4px var(--p-glow), inset 0 2px 3px rgba(255,255,255,.35);
  }
  .refund-page .pin .dome {
    left: 8px; right: 8px; top: 0; height: 40px;
    border-radius: 50% 50% 46% 46% / 62% 62% 38% 38%;
    background: radial-gradient(ellipse at 36% 26%, var(--p-hi) 0 10%, var(--p-mid) 46%, var(--p-dark) 100%);
    box-shadow: inset 0 -5px 8px rgba(0, 20, 70, .22);
  }

  /* Tinted inner panel */
  .refund-page .panel {
    padding: 11px 14px 14px;
    border-radius: 18px;
    background: linear-gradient(160deg, var(--t1), var(--t2));
    border: 1px solid var(--tb);
  }
  .refund-page .num { 
    display: block; 
    margin-bottom: 3px; 
    color: var(--tn); 
    font-family: var(--font-hand); 
    font-weight: 500; 
    font-size: 1.6rem; 
    line-height: 1; 
  }
  .refund-page .panel h2 {
    margin-bottom: 7px;
    font-family: var(--font-body); 
    font-weight: 700; 
    letter-spacing: -.015em;
    font-size: clamp(.95rem, 1.25vw, 1rem); 
    line-height: 1.2; 
    color: var(--ink);
    text-wrap: balance;
  }
  .refund-page .txt { 
    display: grid; 
    gap: 6px; 
    color: var(--body-text); 
    font-size: .78rem; 
    line-height: 1.5; 
  }
  .refund-page .txt strong { 
    color: var(--ink); 
    font-weight: 600; 
  }

  /* Lists inside notes */
  .refund-page .items { 
    color: var(--body-text); 
    font-size: .78rem; 
    line-height: 1.5; 
  }
  .refund-page .items li { 
    position: relative; 
    padding: 6px 0 6px 14px; 
    border-top: 1px solid var(--line); 
  }
  .refund-page .items li:first-child { 
    border-top: 0; 
    padding-top: 2px; 
  }
  .refund-page .items li:last-child { 
    padding-bottom: 0; 
  }
  .refund-page .items li::before {
    content: ""; 
    position: absolute; 
    left: 0; 
    top: .95em; 
    width: 5px; 
    height: 5px; 
    border-radius: 50%; 
    background: var(--tn);
  }
  .refund-page .items li:first-child::before { top: .6em; }
  .refund-page .items .lead-in { 
    display: block; 
    color: var(--ink); 
    font-weight: 600; 
  }
  .refund-page .intro-line { 
    margin-bottom: 4px; 
    color: var(--body-text); 
    font-size: .78rem; 
    line-height: 1.5; 
  }

  .refund-page .btn-action {
    display: inline-flex; 
    align-items: center; 
    justify-content: center;
    min-height: 34px; 
    padding: 0 14px; 
    margin-top: 9px;
    border-radius: 999px; 
    background: var(--han); 
    color: #fff !important;
    font: 600 .75rem/1.2 var(--font-body); 
    text-decoration: none;
    box-shadow: 0 10px 18px -10px rgba(1, 113, 224, .7);
    transition: background-color .15s;
  }
  .refund-page .btn-action:hover { 
    background: var(--han-deep); 
    color: #fff !important; 
  }

  /* Contact details */
  .refund-page .facts > div { 
    padding: 5px 0; 
    border-top: 1px solid var(--line); 
  }
  .refund-page .facts > div:first-child { 
    border-top: 0; 
    padding-top: 2px; 
  }
  .refund-page .facts > div:last-child { 
    padding-bottom: 0; 
  }
  .refund-page .facts dt { 
    color: var(--body-text); 
    font-size: .7rem; 
    font-weight: 600; 
    line-height: 1.4; 
  }
  .refund-page .facts dd { 
    color: var(--ink); 
    font-size: .78rem; 
    line-height: 1.5; 
    font-weight: 500; 
    overflow-wrap: anywhere; 
  }
  .refund-page .intro-line + .facts { margin-top: 4px; }

  /* Sign-off */
  .refund-page .signoff { 
    position: relative; 
    z-index: 1; 
    display: grid; 
    justify-items: center; 
    align-content: start; 
    gap: 10px; 
    text-align: center; 
    padding-top: 22px; 
  }
  .refund-page .signoff .mark-brand { 
    display: grid; 
    place-items: center; 
    width: 57px; 
    height: 57px; 
    border-radius: 50%; 
    font-size: 1.45rem; 
    background: linear-gradient(145deg, #58A9FF 0%, #0171E0 52%, #0159B3 100%);
    box-shadow: inset 0 2px 0 rgba(255,255,255,.45), inset 0 -3px 6px rgba(0,40,110,.25), 0 0 0 4px #fff, 0 14px 22px -8px rgba(10,37,64,.4); 
    color: #fff;
    font-family: var(--font-display);
    font-weight: 800;
  }
  .refund-page .signoff p { 
    max-width: 24ch; 
    color: var(--body-text); 
    font-size: .75rem; 
    line-height: 1.5; 
    transform: rotate(-3deg); 
  }
  .refund-page .signoff strong { 
    display: block; 
    color: var(--ink); 
    font-weight: 600; 
  }

  /* Single column on mobile */
  @media (max-width: 860px) {
    .refund-page .board { 
      grid-template-columns: minmax(0, 1fr); 
      row-gap: 33px; 
      padding-top: 36px; 
    }
    .refund-page .is-right { margin-top: 0; }
    .refund-page .note { 
      --tilt: .45; 
      width: calc(100% - 34px); 
      justify-self: center; 
      padding: 44px 7px 7px; 
      border-radius: 23px; 
    }
    .refund-page .panel { 
      padding: 11px 12px 14px; 
      border-radius: 17px; 
    }
    .refund-page .signoff { padding-top: 6px; }
  }
  @media (prefers-reduced-motion: reduce) {
    .refund-page .note, .refund-page .btn-action { transition: none; }
  }

  @media print {
    .refund-page::before, .refund-page .links, .refund-page .pin, .refund-page .signoff { display: none !important; }
    .refund-page .board { display: block; padding: 0; }
    .refund-page .is-right { margin-top: 0; }
    .refund-page .note { transform: none !important; box-shadow: none; border: 1px solid #ccc; margin-bottom: 18px; break-inside: avoid; padding-top: 14px; }
    .refund-page .btn-action { display: none; }
  }
</style>
@endpush

@section('content')
<div class="refund-page">
  <div class="refund-wrap">
    <header class="refund-mast">
      <h1>{{ $page->title ?? 'Refund Policy' }}</h1>
      <p class="lead">This Refund Policy applies to the website <a href="https://enrollzy.com/">https://enrollzy.com/</a> (“Platform”), operated by Uniband8 Education Technology Pvt. Ltd. (“Enrollzy,” “we,” “us,” or “our”). It explains how payments made to Enrollzy are handled, and the circumstances under which a refund may or may not be issued. Please read this carefully before making any payment on the Platform.</p>
    </header>

    <main>
      <div class="board" id="board">
        <!-- 01 -->
        <article class="note tone-a r1" id="business-model" data-node data-out=".55" data-in=".3">
          <span class="pin" aria-hidden="true"><i class="base"></i><i class="dome"></i></span>
          <div class="panel">
            <span class="num" aria-hidden="true">01</span>
            <h2>Our Business Model — Why This Matters</h2>
            <div class="txt">
              <p>Enrollzy is a free-to-browse education discovery and comparison marketplace. Students can search, compare, and submit inquiries to institutions, coaching centers, and education programs at no cost.</p>
              <p>Enrollzy earns revenue primarily through commissions and listing/advertising fees paid by Institutions and Partners — this is a business arrangement between Enrollzy and the Institution, and does not involve any payment from Students. As such, this Refund Policy does not apply to Institution-side commercial arrangements.</p>
              <p>The only payments Enrollzy directly collects from Students are for paid counselling services offered through the Platform (e.g., one-on-one guidance, application counselling, exam or admission guidance sessions). This Refund Policy governs only these Student-paid counselling services.</p>
              <p>Any fees you pay directly to an Institution (such as application fees, tuition, admission fees, or deposits) are not collected or controlled by Enrollzy and are governed entirely by that Institution’s own refund and cancellation policy. Enrollzy is not responsible for refunds relating to Institution-side payments.</p>
            </div>
          </div>
        </article>

        <!-- 02 -->
        <article class="note tone-b r2 is-right" id="counselling-refunds" data-node data-out=".55" data-in=".2">
          <span class="pin" aria-hidden="true"><i class="base"></i><i class="dome"></i></span>
          <div class="panel">
            <span class="num" aria-hidden="true">02</span>
            <h2>Refunds for Counselling Services</h2>
            <ul class="items" role="list">
              <li><span class="lead-in">Before the session/service begins:</span> If you cancel your booked counselling session or service at least before the scheduled time, you are eligible for a full refund, or you may choose to reschedule at no extra cost.</li>
              <li><span class="lead-in">Late cancellation:</span> If you cancel within of the scheduled session, a partial refund may be issued, or the session may be non-refundable but eligible for a one-time reschedule, at Enrollzy’s discretion.</li>
              <li><span class="lead-in">After the session has been delivered:</span> Once a counselling session or service has been fully delivered as booked, the fee is non-refundable, since the service has already been rendered.</li>
              <li><span class="lead-in">No-show by the Student:</span> If you fail to attend a scheduled session without prior cancellation or rescheduling request, the session will be treated as delivered and is non-refundable.</li>
              <li><span class="lead-in">Service not delivered due to Enrollzy:</span> If Enrollzy is unable to provide the booked counselling service (e.g., counsellor unavailability, technical failure on our end), you will be offered a full refund or a free rescheduled session, at your preference.</li>
              <li><span class="lead-in">Dissatisfaction with service quality:</span> If you are unsatisfied with the quality of a delivered session, please raise the concern with us within 3 days of the session. We will review the matter on a case-by-case basis and may offer a partial refund, a complimentary follow-up session, or another resolution, at our discretion.</li>
            </ul>
          </div>
        </article>

        <!-- 03 -->
        <article class="note tone-c r3" id="request-refund" data-node data-out=".6" data-in=".3">
          <span class="pin" aria-hidden="true"><i class="base"></i><i class="dome"></i></span>
          <div class="panel">
            <span class="num" aria-hidden="true">03</span>
            <h2>How to Request a Refund</h2>
            <ul class="items" role="list">
              <li>Email your refund request to <a href="mailto:info@enrollzy.com?subject=Refund%20request">info@enrollzy.com</a> with your registered name, payment/transaction ID, date of payment, and reason for the refund request</li>
              <li>Requests will be acknowledged within 24–48 hours</li>
              <li>Approved refunds will be processed within 7–10 business days to the original payment method used, unless otherwise agreed</li>
            </ul>
            <a class="btn-action" href="mailto:info@enrollzy.com?subject=Refund%20request">Email your refund request</a>
          </div>
        </article>

        <!-- 04 -->
        <article class="note tone-a r4 is-right" id="non-refundable" data-node data-out=".55" data-in=".25">
          <span class="pin" aria-hidden="true"><i class="base"></i><i class="dome"></i></span>
          <div class="panel">
            <span class="num" aria-hidden="true">04</span>
            <h2>Non-Refundable Circumstances</h2>
            <p class="intro-line">Refunds will generally not be issued where:</p>
            <ul class="items" role="list">
              <li>The counselling session or service has already been fully delivered</li>
              <li>The refund request is made after the eligibility window mentioned above</li>
              <li>The Student provided incorrect information (e.g., wrong contact details) resulting in a missed session</li>
              <li>The request relates to a payment made directly to an Institution and not to Enrollzy</li>
            </ul>
          </div>
        </article>

        <!-- 05 -->
        <article class="note tone-b r5" id="gateway-charges" data-node data-out=".55" data-in=".3">
          <span class="pin" aria-hidden="true"><i class="base"></i><i class="dome"></i></span>
          <div class="panel">
            <span class="num" aria-hidden="true">05</span>
            <h2>Payment Gateway and Processing Charges</h2>
            <div class="txt">
              <p>Any payment gateway charges, transaction fees, or bank charges deducted at the time of payment may be non-refundable, and refunds may be issued net of such charges where applicable.</p>
            </div>
          </div>
        </article>

        <!-- 06 -->
        <article class="note tone-c r6 is-right" id="changes" data-node data-out=".55" data-in=".3">
          <span class="pin" aria-hidden="true"><i class="base"></i><i class="dome"></i></span>
          <div class="panel">
            <span class="num" aria-hidden="true">06</span>
            <h2>Changes to This Policy</h2>
            <div class="txt">
              <p>We may update this Refund Policy from time to time to reflect changes in our services or business practices. The updated version will be posted on this page with a revised “Last Updated” date.</p>
            </div>
          </div>
        </article>

        <!-- 07 -->
        <article class="note tone-a r7" id="contact" data-node data-out=".5" data-in=".3">
          <span class="pin" aria-hidden="true"><i class="base"></i><i class="dome"></i></span>
          <div class="panel">
            <span class="num" aria-hidden="true">07</span>
            <h2>Contact Us</h2>
            <p class="intro-line">For any questions or refund requests, please contact us at:</p>
            <dl class="facts">
              <div><dt>Company</dt><dd>Uniband8 Education Technology Pvt. Ltd.</dd></div>
              <div><dt>Email</dt><dd><a href="mailto:info@enrollzy.com?subject=Refund%20request">info@enrollzy.com</a></dd></div>
              <div><dt>Address</dt><dd><address class="mb-0">SCO 210-211,<br>401, 4th Floor, Sector 34A, Chandigarh, 160022.</address></dd></div>
              <div><dt>Website</dt><dd><a href="https://enrollzy.com/" target="_blank" rel="noopener">https://enrollzy.com/</a></dd></div>
            </dl>
          </div>
        </article>

        <!-- Sign-off -->
        <div class="signoff is-right" data-node data-in=".4">
          <span class="mark-brand" aria-hidden="true">E</span>
          <p><strong>Enrollzy</strong>Uniband8 Education Technology Pvt. Ltd.</p>
        </div>

        <svg class="links" id="links" aria-hidden="true" focusable="false"></svg>
      </div>
    </main>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  var board = document.getElementById('board');
  var svg = document.getElementById('links');
  if (!board || !svg) return;

  var nodes = Array.prototype.slice.call(board.querySelectorAll('[data-node]'));
  var NS = 'http://www.w3.org/2000/svg';

  function rel(el) {
    var b = board.getBoundingClientRect(), r = el.getBoundingClientRect();
    return { 
      l: r.left - b.left, 
      t: r.top - b.top, 
      r: r.right - b.left, 
      b: r.bottom - b.top,
      w: r.width, 
      h: r.height, 
      cx: r.left - b.left + r.width / 2 
    };
  }

  function num(el, attr, fallback) {
    var v = parseFloat(el.getAttribute(attr));
    return isNaN(v) ? fallback : v;
  }

  /* Dashed strings joining one note to the next */
  function draw() {
    var bb = board.getBoundingClientRect();
    svg.setAttribute('width', bb.width);
    svg.setAttribute('height', bb.height);
    svg.setAttribute('viewBox', '0 0 ' + bb.width + ' ' + bb.height);
    while (svg.firstChild) svg.removeChild(svg.firstChild);

    for (var i = 0; i < nodes.length - 1; i++) {
      var A = rel(nodes[i]), B = rel(nodes[i + 1]);
      var outY = num(nodes[i], 'data-out', .55), inY = num(nodes[i + 1], 'data-in', .3);
      var d, sx, sy, ex, ey;

      if (Math.abs(A.cx - B.cx) < A.w * .4) {
        /* single column: hang a loose string from one note down to the next pin */
        var sway = (i % 2 ? -1 : 1) * 70;
        sx = A.cx; sy = A.b - 10; ex = B.cx; ey = B.t + 34;
        d = 'M' + sx + ' ' + sy + ' C' + (sx + sway) + ' ' + (sy + (ey - sy) * .5) + ' ' +
            (ex - sway) + ' ' + (ey - (ey - sy) * .5) + ' ' + ex + ' ' + ey;
      } else if (A.cx < B.cx) {
        /* left note to right note */
        sx = A.r - 8; sy = A.t + A.h * outY; ex = B.l + 8; ey = B.t + B.h * inY;
        var dx = (ex - sx) * .5;
        d = 'M' + sx + ' ' + sy + ' C' + (sx + dx) + ' ' + sy + ' ' + (ex - dx) + ' ' + ey + ' ' + ex + ' ' + ey;
      } else {
        /* right note back to the pin of the next left note */
        sx = A.l + 8; sy = A.t + A.h * outY; ex = B.cx + B.w * .08; ey = B.t + 34;
        d = 'M' + sx + ' ' + sy + ' C' + (sx - (sx - ex) * .9) + ' ' + sy + ' ' + ex + ' ' +
            (ey - (ey - sy) * .55) + ' ' + ex + ' ' + ey;
      }
      var p = document.createElementNS(NS, 'path');
      p.setAttribute('d', d);
      svg.appendChild(p);
    }
  }

  draw();
  window.addEventListener('load', draw);
  window.addEventListener('resize', draw);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(draw);
  if (window.ResizeObserver) new ResizeObserver(draw).observe(board);
})();
</script>
@endpush
