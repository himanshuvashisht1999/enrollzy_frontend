<footer class="footer-gradient-wrapper ptb-70 ">


        <!-- Floating Asterisk Shape -->


        <div class="container">
            <div class="footer-card">
                <div class="row g-5">
                    <!-- Left Column: Branding, Contact & Socials -->
                    <div class="col-lg-4">
                        <!-- Brand Logo -->
                        <a href="#" class="d-flex align-items-center mb-3 text-decoration-none">
                            <img src="{{ asset('assets/images/logo.svg') }}" alt="" style="    width: 246px;">
                        </a>
                        <!-- Tech description -->
                        <p class="text-muted mb-4"
                            style="font-size: 14px; line-height: 1.5; font-weight: 500;color: #777777 !important;">
                            {{ $siteSettings->footer_description ?? 'Enrollzy, a DPIIT-recognized education technology platform, enables students to explore, compare, and access quality education opportunities with transparency and confidence.' }}
                        </p>

                        <!-- Contact lists -->
                        <div class="footer-contact-item">
                            <span class="footer-contact-label">CONTACT US:</span>
                            <a href="mailto:{{ $siteSettings->contact_email ?? 'info@enrollzy.com' }}"
                                class="footer-contact-value text-decoration-none">{{ $siteSettings->contact_email ?? 'info@enrollzy.com' }}</a>
                        </div>
                        <div class="footer-contact-item d-flex align-items-start">
                            <span class="footer-contact-label mt-1">OUR ADDRESS:</span>
                            <span class="footer-contact-value" style="max-width: 220px; line-height: 1.4;">
                                {{ $siteSettings->address ?? 'Workaholics Workzone, SCO 364-365-366 Second Floor, Sector 34A, Chandigarh, 160022' }}
                            </span>
                        </div>

                        <!-- Socials -->
                        <div class="footer-contact-item d-flex align-items-center gap-2 mt-4">
                            <span class="footer-contact-label">CONNECT US:</span>
                            <div class="social-icons-list">
                                @if(!empty($siteSettings->twitter_url))
                                <a href="{{ $siteSettings->twitter_url }}" class="social-icon-circle social-twitter">
                                    <img src="{{ asset('assets/images/twitter-icon.png') }}" alt="Twitter">
                                </a>
                                @endif
                                @if(!empty($siteSettings->instagram_url))
                                <a href="{{ $siteSettings->instagram_url }}" class="social-icon-circle social-instagram">
                                    <img src="{{ asset('assets/images/footer-insta-icon.png') }}" alt="Instagram">
                                </a>
                                @endif
                                @if(!empty($siteSettings->facebook_url))
                                <a href="{{ $siteSettings->facebook_url }}" class="social-icon-circle social-facebook">
                                    <img src="{{ asset('assets/images/footer-facebook-icon.png') }}" alt="Facebook">
                                </a>
                                @endif
                                @if(!empty($siteSettings->linkedin_url))
                                <a href="{{ $siteSettings->linkedin_url }}" class="social-icon-circle social-linkedin">
                                    <img src="{{ asset('assets/images/footer-linkdin-icon.png') }}" alt="LinkedIn">
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Banner & link directory -->
                    <div class="col-lg-8">
                        <!-- Top Banner SVG illustration -->
                        <div class="footer-banner-box">
                            <img src="{{ asset('assets/images/footer-rect-img.png') }}" alt="" style="width: 100%;">
                        </div>

                        <!-- columns directories -->
                        <div class="row row-cols-2 row-cols-sm-4 g-4">
                            @foreach($footerColumns as $column)
                            <div class="col">
                                <h3 class="footer-link-heading mb-3">
                                    {{ $column->title }} <span class="footer-heading-line"></span>
                                </h3>
                                <ul class="footer-links">
                                    @foreach($column->children as $link)
                                    <li><a href="{{ $link->url }}">{{ $link->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Footer Divider -->
                <div class="footer-divider"></div>

                <!-- Copyright row -->
                <p class="footer-copyright">
                    {!! $siteSettings->footer_text ?? '© 2026 Uniband8 Education Technology Pvt. Ltd. <br> All Rights Reserved.' !!}
                </p>
            </div>
        </div>
    </footer>
    <div class="footer-vector">
        <img src="{{ asset('assets/images/footer-vector.png') }}" alt="">
    </div>
    <div class="bottom-gradient-div ptb-70 pt-0" style="z-index: -1;"></div>
