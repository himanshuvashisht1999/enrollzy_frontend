import re

with open(r'C:\xampp\htdocs\enrollzy_new_design\all-schools.html', 'r', encoding='utf-8') as f:
    content = f.read()

start_idx = content.find('<main class="about-hero-section')
end_idx = content.find('</section>', start_idx) + len('</section>')

html_block = content[start_idx:end_idx]

right_col_start = html_block.find('<!-- Right catalog list grid -->')

left_part = html_block[:right_col_start]

dynamic_right_col = '''<!-- Right catalog list grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Title header info -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold" style="font-size: 16px; color: #3771C8;">Boarding Schools in India</span>
                            <span class="text-muted" style="font-size: 16px;">- {{ $schools->total() }} Schools | Updated at : {{ now()->format('d M Y, h:i a') }}</span>
                        </div>
                    </div>

                    <!-- Schools Grid row -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach($schools as $school)
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{ $school->cover_image_url ? env('BACKEND_URL') . '/' . $school->cover_image_url : asset('assets/images/about_team_meeting.png') }}" alt="{{ $school->name }} Cover">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> {{ $school->average_rating ?? '4.5' }}</span>
                                    @if($school->minority_type || $school->brand_type)
                                    <span class="school-gender-badge">{{ $school->minority_type ?? $school->brand_type }}</span>
                                    @endif
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box">
                                            <img src="{{ $school->logo_url ? env('BACKEND_URL') . '/' . $school->logo_url : asset('assets/images/school-card-logo.png') }}" alt="{{ $school->name }} Logo">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name">{{ $school->name }}</h3>
                                            @php
                                                $locations = array_merge($school->cities_present_in ?? [], $school->states_present_in ?? []);
                                            @endphp
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> {{ implode(', ', $locations) }}</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">Ask</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">{{ implode(', ', $school->education_boards_supported ?? []) }}</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">{{ implode(', ', $school->education_levels_supported ?? []) }}</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">{{ $school->established_year ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">{{ Str::limit($school->meta_description ?? strip_tags($school->about_organisation ?? ''), 200, '...') }}</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $schools->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>'''

final_content = "@extends('layouts.app')\n@section('content')\n" + left_part + dynamic_right_col + "\n@endsection\n"

with open(r'c:\xampp\htdocs\enrollzy_frontend\resources\views\all-schools.blade.php', 'w', encoding='utf-8') as f:
    f.write(final_content)

print("File reconstructed successfully.")
