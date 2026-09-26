@extends('layouts.app')

@section('meta_title', $page->meta_title ?? 'Disclaimer Policy | Enrollzy')
@section('meta_keywords', $page->meta_keywords ?? '')
@section('meta_description', $page->meta_description ?? 'Disclaimer Policy of Uniband8 Education Technology Pvt. Ltd. (Enrollzy): terms and conditions regarding informational content, institutional listings, and third-party data.')

@push('css')
<style>
  .disclaimer-page {
    --blue: #0171E0;
    --ghost: #F7FAFD;
    --ink: #10243A;
    --muted: #5A6C7E;
    --white: #fff;
    --shadow: 0 18px 30px rgba(16, 36, 58, .18);

    background: var(--ghost);
    color: var(--ink);
    font-family: Arial, Helvetica, sans-serif;
    padding: 30px 0 60px;
    overflow-x: hidden;
  }

  .disclaimer-page * {
    box-sizing: border-box;
  }

  .disclaimer-wrap {
    width: min(1180px, 94%);
    margin: 0 auto;
  }

  /* Decorative portfolio-style background */
  .disclaimer-page .board {
    position: relative;
  }
  .disclaimer-page .board:before,
  .disclaimer-page .board:after {
    content: "✦";
    position: absolute;
    color: var(--blue);
    opacity: .14;
    font-size: 85px;
    pointer-events: none;
  }
  .disclaimer-page .board:before { left: -30px; top: 40px; }
  .disclaimer-page .board:after { right: -25px; bottom: 110px; }

  .disclaimer-page .card-custom {
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow);
    border-radius: 4px;
  }

  /* LARGE COVER */
  .disclaimer-page .cover {
    min-height: 430px;
    padding: 38px 52px;
    background: var(--blue);
    color: var(--white);
    margin: 0 auto 52px;
  }

  .disclaimer-page .cover .small-label {
    position: absolute;
    top: 34px;
    left: 54px;
    font-size: 14px;
    line-height: 1.2;
    font-weight: 600;
    letter-spacing: .01em;
    color: var(--white);
  }

  .disclaimer-page .cover .date-badge {
    position: absolute;
    top: 36px;
    right: 48px;
    font-size: 13px;
    opacity: .95;
    color: var(--white);
  }

  .disclaimer-page .cover h1 {
    position: absolute;
    left: 45px;
    bottom: 42px;
    margin: 0;
    font-size: clamp(64px, 12vw, 150px);
    line-height: .78;
    letter-spacing: -.075em;
    font-weight: 800;
    color: var(--white);
    text-transform: lowercase;
  }

  .disclaimer-page .cover .script {
    position: absolute;
    left: 50%;
    top: 51%;
    transform: translate(-50%, -50%) rotate(-4deg);
    font-family: "Brush Script MT", "Segoe Script", "Caveat", cursive;
    font-size: clamp(38px, 5.5vw, 72px);
    white-space: nowrap;
    color: var(--ghost);
    z-index: 3;
    pointer-events: none;
  }

  .disclaimer-page .cover .sub {
    position: absolute;
    left: 55px;
    bottom: 22px;
    font-size: 11px;
    letter-spacing: .04em;
    opacity: .9;
    color: var(--white);
  }

  /* Sparkles */
  .disclaimer-page .spark {
    position: absolute;
    width: 25px; 
    height: 25px;
    z-index: 2;
    color: var(--white);
    transform: rotate(45deg);
    pointer-events: none;
  }
  .disclaimer-page .spark:before,
  .disclaimer-page .spark:after {
    content: "";
    position: absolute;
    background: currentColor;
    left: 50%; 
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
  }
  .disclaimer-page .spark:before { width: 100%; height: 6px; }
  .disclaimer-page .spark:after { width: 6px; height: 100%; }
  .disclaimer-page .s1 { top: 25px; right: 20%; }
  .disclaimer-page .s2 { top: 105px; right: 25%; width: 19px; height: 19px; }
  .disclaimer-page .s3 { top: 155px; left: 8%; width: 17px; height: 17px; }
  .disclaimer-page .s4 { bottom: 65px; left: 24%; width: 21px; height: 21px; }
  .disclaimer-page .s5 { bottom: 75px; right: 8%; width: 15px; height: 15px; }

  /* Content cards */
  .disclaimer-page .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 46px 48px;
    align-items: stretch;
  }

  .disclaimer-page .policy {
    min-height: 330px;
    padding: 32px 34px 36px;
    border: 0;
  }

  .disclaimer-page .blue { background: var(--blue); color: var(--white); }
  .disclaimer-page .light { background: var(--ghost); color: var(--ink); border: 1px solid #e5edf4; }

  .disclaimer-page .policy .topline {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 22px;
  }

  .disclaimer-page .policy .number {
    font-size: 13px;
    font-weight: 800;
    letter-spacing: .12em;
    opacity: .8;
  }

  .disclaimer-page .policy .arrow {
    font-size: 20px;
    line-height: 1;
  }

  .disclaimer-page .policy h2 {
    margin: 0 0 18px;
    font-size: 28px;
    line-height: 1.05;
    letter-spacing: -.045em;
    font-weight: 800;
    max-width: 95%;
  }

  .disclaimer-page .policy p {
    margin: 0 0 14px;
    font-size: 13.5px;
    line-height: 1.6;
  }

  .disclaimer-page .policy ul {
    margin: 0 0 14px;
    padding-left: 20px;
    list-style: disc;
  }

  .disclaimer-page .policy li {
    margin: 7px 0;
    font-size: 13.5px;
    line-height: 1.5;
  }

  .disclaimer-page .blue p, .disclaimer-page .blue li { color: rgba(255, 255, 255, .94); }
  .disclaimer-page .light p, .disclaimer-page .light li { color: #334B61; }

  .disclaimer-page .mini-note {
    margin-top: 17px;
    padding: 13px 14px;
    border-left: 3px solid currentColor;
    background: rgba(255, 255, 255, .13);
    font-size: 12.5px;
    line-height: 1.5;
  }
  .disclaimer-page .light .mini-note {
    background: #eaf4ff;
    color: var(--blue);
  }

  .disclaimer-page .wide {
    grid-column: 1 / -1;
    min-height: auto;
  }

  .disclaimer-page .wide .inner-columns {
    display: grid;
    grid-template-columns: 1.1fr .9fr;
    gap: 30px;
  }

  /* Contact card */
  .disclaimer-page .contact {
    grid-column: 1 / -1;
    min-height: 300px;
    background: var(--blue);
    color: var(--white);
    padding: 42px 46px;
  }

  .disclaimer-page .contact .contact-title {
    font-size: clamp(40px, 6vw, 76px);
    line-height: .9;
    letter-spacing: -.07em;
    font-weight: 800;
    max-width: 420px;
    margin: 0 0 28px;
    color: var(--white);
  }

  .disclaimer-page .contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px 34px;
    max-width: 650px;
  }

  .disclaimer-page .contact-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 9px 0;
    border-bottom: 1px solid rgba(255, 255, 255, .25);
  }

  .disclaimer-page .contact-icon {
    width: 28px; 
    height: 28px;
    flex: 0 0 28px;
    border: 1px solid rgba(255, 255, 255, .7);
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 12px;
    color: #fff;
  }

  .disclaimer-page .contact-label {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: .12em;
    opacity: .75;
    display: block;
    margin-bottom: 2px;
    color: rgba(255, 255, 255, .9);
  }

  .disclaimer-page .contact-value {
    font-size: 13.5px;
    line-height: 1.45;
    overflow-wrap: anywhere;
    color: #fff;
  }

  .disclaimer-page .contact a {
    color: white;
    text-decoration: underline;
  }
  .disclaimer-page .contact a:hover {
    color: rgba(255, 255, 255, .85);
  }

  .disclaimer-page .disclaimer-subfoot {
    text-align: center;
    font-size: 12px;
    color: var(--muted);
    padding-top: 34px;
  }

  /* Responsive */
  @media (max-width: 850px) {
    .disclaimer-page .cover { min-height: 360px; padding: 28px 32px; }
    .disclaimer-page .cover .small-label { left: 32px; top: 28px; }
    .disclaimer-page .cover .date-badge { right: 30px; top: 30px; }
    .disclaimer-page .cover h1 { left: 30px; bottom: 48px; font-size: 78px; }
    .disclaimer-page .cover .script { font-size: 43px; }
    .disclaimer-page .grid { grid-template-columns: 1fr; gap: 28px; }
    .disclaimer-page .wide, .disclaimer-page .contact { grid-column: auto; }
    .disclaimer-page .wide .inner-columns { grid-template-columns: 1fr; }
    .disclaimer-page .contact-grid { grid-template-columns: 1fr; }
  }

  @media (max-width: 520px) {
    .disclaimer-wrap { width: 94%; }
    .disclaimer-page .cover { min-height: 330px; margin-bottom: 28px; padding: 20px; }
    .disclaimer-page .cover h1 { font-size: 56px; left: 20px; bottom: 44px; }
    .disclaimer-page .cover .script { font-size: 30px; }
    .disclaimer-page .cover .date-badge { font-size: 11px; top: 22px; right: 20px; }
    .disclaimer-page .cover .small-label { font-size: 12px; top: 20px; left: 20px; }
    .disclaimer-page .policy { padding: 25px 20px; min-height: auto; }
    .disclaimer-page .policy h2 { font-size: 24px; }
    .disclaimer-page .contact { padding: 30px 20px; }
    .disclaimer-page .contact .contact-title { font-size: 48px; }
  }

  @media print {
    .disclaimer-page { background: #fff; padding: 0; }
    .disclaimer-wrap { width: 100%; }
    .disclaimer-page .card-custom { box-shadow: none; border: 1px solid #ccc; margin-bottom: 20px; }
  }
</style>
@endpush

@section('content')
<div class="disclaimer-page">
  <div class="disclaimer-wrap">
    <div class="board">

      <!-- COVER / HERO -->
      <section class="card-custom cover">
        <div class="small-label">Enrollzy<br>Legal Information</div>
        <div class="date-badge">Disclaimer Policy&nbsp;&nbsp; →</div>

        <span class="spark s1"></span>
        <span class="spark s2"></span>
        <span class="spark s3"></span>
        <span class="spark s4"></span>
        <span class="spark s5"></span>

        <div class="script">Important Information</div>
        <h1>{{ $page->title ?? 'disclaimer' }}</h1>
        <div class="sub">UNIBAND8 EDUCATION TECHNOLOGY PVT. LTD.</div>
      </section>

      <section class="grid">

        <!-- 01 -->
        <article class="card-custom policy light">
          <div class="topline"><span class="number">01</span><span class="arrow">→</span></div>
          <h2>Disclaimer Policy</h2>
          <p>
            This Disclaimer Policy applies to the website <a href="https://enrollzy.com/" target="_blank" rel="noopener">https://enrollzy.com/</a> ("Platform"), operated by
            Uniband8 Education Technology Pvt. Ltd. ("Enrollzy," "we," "us," or "our"). By accessing or using
            the Platform, you acknowledge that you have read, understood, and agree to this Disclaimer. If you
            do not agree, please discontinue use of the Platform.
          </p>
        </article>

        <!-- 02 -->
        <article class="card-custom policy blue">
          <div class="topline"><span class="number">02</span><span class="arrow">↗</span></div>
          <h2>General Information Disclaimer</h2>
          <p>
            Enrollzy is a student-first education marketplace and aggregator that helps learners discover,
            compare, and access information about boarding schools, coaching institutes, competitive exam
            guidance, scholarships, undergraduate and postgraduate programs, online degrees, certifications,
            and career-focused learning opportunities.
          </p>
          <p>
            All content on the Platform — including institution listings, course details, fee structures,
            eligibility criteria, rankings, reviews, articles, and guidance content — is provided for general
            informational purposes only and does not constitute professional, academic, financial, immigration,
            or career advice.
          </p>
          <p>
            We make reasonable efforts to keep information accurate and up to date, but we make no representations
            or warranties, express or implied, about the completeness, accuracy, reliability, suitability, or
            availability of any information on the Platform.
          </p>
        </article>

        <!-- 03 -->
        <article class="card-custom policy blue">
          <div class="topline"><span class="number">03</span><span class="arrow">→</span></div>
          <h2>No Institutional Affiliation or Endorsement</h2>
          <p>
            Enrollzy is an independent intermediary and is not affiliated with, sponsored by, or officially
            connected to any educational institution, university, board, or government body unless explicitly stated.
          </p>
          <p>
            The inclusion of an institution, program, or course on the Platform does not constitute an endorsement,
            recommendation, or guarantee of its quality, accreditation, or legitimacy.
          </p>
          <p>
            Any commission, referral fee, or listing fee received by Enrollzy from an institution does not influence
            factual accuracy but may affect the visibility, ranking, or placement of that institution's listing.
            Sponsored or promoted content will be reasonably labeled where applicable.
          </p>
        </article>

        <!-- 04 -->
        <article class="card-custom policy light">
          <div class="topline"><span class="number">04</span><span class="arrow">↗</span></div>
          <h2>No Guarantee of Outcomes</h2>
          <p>Enrollzy does not guarantee:</p>
          <ul>
            <li>Admission, enrollment, or selection into any institution or program</li>
            <li>Approval of any scholarship, financial aid, or fee waiver</li>
            <li>Accuracy of eligibility criteria, cut-offs, deadlines, or fee amounts published by third parties</li>
            <li>Career, academic, or financial outcomes resulting from use of the Platform or reliance on its content</li>
          </ul>
          <p>
            Decisions relating to admissions, enrollment, payments, and academic commitments are made solely
            between you and the relevant institution, and are subject to that institution's own terms, policies,
            and processes.
          </p>
        </article>

        <!-- 05 -->
        <article class="card-custom policy light">
          <div class="topline"><span class="number">05</span><span class="arrow">→</span></div>
          <h2>Third-Party Content and Links</h2>
          <p>
            The Platform may contain content, data, or links sourced from third parties, including institutions,
            publicly available websites, and government portals.
          </p>
          <p>
            We do not control and are not responsible for the accuracy, legality, or content of third-party
            websites or materials, and linking to them does not imply endorsement.
          </p>
          <div class="mini-note">
            Users are strongly advised to independently verify all information — including accreditation, fees,
            and admission requirements — directly with the relevant institution before making any decision.
          </div>
        </article>

        <!-- 06 -->
        <article class="card-custom policy blue">
          <div class="topline"><span class="number">06</span><span class="arrow">↗</span></div>
          <h2>User Responsibility</h2>
          <p>
            Users are solely responsible for the decisions they make based on information found on the Platform,
            including academic, financial, or career-related decisions.
          </p>
          <p>
            Enrollzy strongly recommends conducting independent due diligence, including direct verification with
            institutions and, where appropriate, consultation with qualified academic or financial counselors,
            before making any enrollment or payment decision.
          </p>
        </article>

        <!-- 07 -->
        <article class="card-custom policy blue wide">
          <div class="topline"><span class="number">07</span><span class="arrow">→</span></div>
          <h2>Limitation of Liability</h2>
          <div class="inner-columns">
            <div>
              <p>
                To the maximum extent permitted under applicable law, Enrollzy and its officers, employees, and
                affiliates shall not be liable for any loss, damage, or harm — direct, indirect, incidental, or
                consequential — arising from:
              </p>
            </div>
            <div>
              <ul>
                <li>Reliance on information provided on the Platform</li>
                <li>Errors, omissions, or inaccuracies in institution or program listings</li>
                <li>Actions or omissions of any third-party institution or service provider</li>
                <li>Interruption, unavailability, or technical issues with the Platform</li>
              </ul>
              <p>
                This Disclaimer does not limit any liability that cannot be excluded under applicable Indian law.
              </p>
            </div>
          </div>
        </article>

        <!-- 08 -->
        <article class="card-custom policy light">
          <div class="topline"><span class="number">08</span><span class="arrow">↗</span></div>
          <h2>Changes to This Disclaimer</h2>
          <p>
            We may update this Disclaimer Policy from time to time to reflect changes in our Services or legal
            requirements. The updated version will be posted on this page with a revised "Last Updated" date.
          </p>
        </article>

        <!-- CONTACT -->
        <section class="card-custom contact">
          <div class="contact-title">Let's stay<br>in touch!</div>
          <div class="contact-grid">

            <div class="contact-item">
              <div class="contact-icon">@</div>
              <div>
                <span class="contact-label">Company</span>
                <div class="contact-value">Uniband8 Education Technology Pvt. Ltd.</div>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">✉</div>
              <div>
                <span class="contact-label">Email</span>
                <div class="contact-value"><a href="mailto:info@enrollzy.com">info@enrollzy.com</a></div>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">⌂</div>
              <div>
                <span class="contact-label">Address</span>
                <div class="contact-value">SCO 210-211, 401, 4th Floor, Sector 34A, Chandigarh, 160022.</div>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">↗</div>
              <div>
                <span class="contact-label">Website</span>
                <div class="contact-value"><a href="https://enrollzy.com/" target="_blank" rel="noopener">https://enrollzy.com/</a></div>
              </div>
            </div>

          </div>
        </section>

      </section>

      <div class="disclaimer-subfoot">
        Disclaimer Policy · Enrollzy · Uniband8 Education Technology Pvt. Ltd.
      </div>

    </div>
  </div>
</div>
@endsection
