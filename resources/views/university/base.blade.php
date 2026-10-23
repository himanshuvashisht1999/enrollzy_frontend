{{-- Frame of every university page: hero (overview only), sticky university bar with the campus picker, compare tray.
     The site's own header and footer stay as they are (layouts.app). --}}
@extends('layouts.app')
@php
    use App\Support\University\UniversityData as U;
    $o = $u->org;
    $routeName = request()->route()->getName();
    $routeParams = collect(request()->route()->parameters())->except(['campusSlug'])->all();
    // switching campus keeps the page but drops every other filter (as the design asks)
    $scopeUrl = fn (?string $campusSlug) => $routeName === 'university.campus'
        ? route('university.campus', array_filter(['slug' => $o['slug'], 'campusSlug' => $campusSlug]))
        : route($routeName, array_filter($routeParams + ['campus' => $campusSlug]));
    $initials = $o['short'] ?: collect(preg_split('/\s+/', $o['name']))->filter(fn ($w) => ctype_upper(mb_substr($w, 0, 1)))->map(fn ($w) => mb_substr($w, 0, 1))->take(4)->implode('');
@endphp

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/counselling.css') }}?v={{ @filemtime(public_path('assets/css/counselling.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/university.css') }}?v={{ @filemtime(public_path('assets/css/university.css')) }}">
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/university.js') }}?v={{ @filemtime(public_path('assets/js/university.js')) }}"></script>
@endpush

@section('content')
<main class="cz uz" data-uni="{{ $o['slug'] }}" data-compare-url="{{ route('university.compare', ['slug' => $o['slug'], 'tab' => 'custom']) }}">

    @if($tab === 'overview')
        @php
            $scoped = $u->onCampus($scopeIds);
            $fees = $scoped->pluck('annual_fee')->filter();
            $placementNow = $scope ? $u->campusPlacement($scope) : $u->universityPlacement();
            $rating = $u->reviews($scopeIds);
            $facts = array_filter([
                ['Courses', number_format($u->programmes($scoped)->count()), $scope ? 'at this campus' : 'across campuses'],
                $fees->isNotEmpty() ? ['Fees from', U::lakh($fees->min()), 'per year'] : null,
                ['Campuses', $scope ? 1 : $u->campuses->count(), $scope ? $scopeCampus['city'] : count($o['states']) . ' ' . \Illuminate\Support\Str::plural('state', count($o['states']))],
                $onlineCount ? ['Online courses', $onlineCount, 'study from anywhere'] : null,
                $placementNow && ($placementNow['median'] || $placementNow['pct']) ? ($placementNow['median'] ? ['Median package', U::lpa($placementNow['median']), $placementNow['year'] ?: 'latest'] : ['Students placed', $placementNow['pct'] . '%', $placementNow['year'] ?: 'latest']) : null,
                $rating['rating'] ? ['Rating', $rating['rating'] . ' / 5', $rating['count'] . ' ' . \Illuminate\Support\Str::plural('review', $rating['count'])] : null,
            ]);
            $naac = collect($u->quality['accreditations'])->firstWhere('body', 'NAAC');
            $nirf = collect($u->quality['rankings'])->firstWhere('category', 'Overall') ?? ($u->quality['rankings'][0] ?? null);
        @endphp
        <section class="cz-hero cz-gutter" id="hero">
            <div class="cz-container">
                <nav class="cz-crumbs" aria-label="Breadcrumb"><a href="{{ url('/') }}">Home</a>›<a href="{{ route('university') }}">Universities</a>›<span>{{ $o['name'] }}</span></nav>
                <div class="cz-hero-main">
                    <div class="cz-logo uz-logo" aria-hidden="true">@if($o['logo'])<img src="{{ $o['logo'] }}" alt="">@else{{ mb_strtoupper(mb_substr($initials ?: $o['name'], 0, 5)) }}@endif</div>
                    <div class="cz-hero-text">
                        <h1>{{ $o['name'] }}</h1>
                        @if($o['short'] || $o['trust'])<div class="full">@if($o['short'])Also known as <b>{{ $o['short'] }}</b>@endif{{ $o['short'] && $o['trust'] ? ' · ' : '' }}@if($o['trust'])Run by {{ $o['trust'] }}@endif</div>@endif
                        <div class="cz-hero-meta">
                            @if($o['hq'])<span>Headquarters: <b>{{ $o['hq'] }}</b></span>@endif
                            @if($u->campuses->count() > 1)<span><b>{{ $u->campuses->count() }}</b>&nbsp;campuses in <b>{{ count($o['states']) }}</b>&nbsp;{{ \Illuminate\Support\Str::plural('state', count($o['states'])) }}</span>@endif
                            @if($o['ownership'] || $o['established'])<span>{{ implode(' · ', array_filter([$o['ownership'], $o['established'] ? 'Estd. ' . $o['established'] : null])) }}</span>@endif
                        </div>
                        <div class="cz-tags" style="margin-top:4px">
                            @if($nirf)<span class="cz-tag blue">{{ $nirf['body'] }} {{ $nirf['rank'] }}{{ $nirf['category'] && $nirf['category'] !== 'Category not stated' ? ' ' . $nirf['category'] : '' }}</span>@endif
                            @if($naac)<span class="cz-tag">NAAC {{ $naac['grade'] }}</span>@endif
                            @if($o['type'])<span class="cz-tag">{{ $o['type'] }}</span>@endif
                            @if($o['category'])<span class="cz-tag">{{ $o['category'] }}</span>@endif
                            @if($o['autonomous'] && !in_array(strtolower((string) $o['autonomous']), ['no', '0', 'false']))<span class="cz-tag">Autonomous</span>@endif
                            @if($onlineCount)<span class="uz-online-badge">Online degrees</span>@endif
                        </div>
                    </div>
                    <div class="cz-hero-actions">
                        <a class="cz-btn cz-btn-orange" href="#enquire" data-uz-enquire="Apply">Apply now</a>
                        <a class="cz-btn cz-btn-outline" href="#enquire" data-uz-enquire="Brochure">Get brochure</a>
                    </div>
                </div>
                <div class="uz-facts" style="--n: {{ max(1, count($facts)) }}">
                    @foreach($facts as [$k, $v, $s])<div><span class="k">{{ $k }}</span><span class="v cz-num">{{ $v }}</span><span class="s">{{ $s }}</span></div>@endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- sticky university bar: campus picker + sections, same on every university page --}}
    <div class="uz-bar cz-gutter">
        <div class="cz-container">
            @if($u->campuses->count() > 1)
                <div class="uz-scope" data-uz-pop>
                    <button class="uz-scope-btn" type="button" data-uz-pop-btn aria-haspopup="listbox" aria-expanded="false">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M10 18s6-5.3 6-10a6 6 0 10-12 0c0 4.7 6 10 6 10z"/><circle cx="10" cy="8" r="2"/></svg>
                        <span>{{ $scopeCampus['name'] ?? 'All campuses' }}</span>
                    </button>
                    <div class="uz-pop" data-uz-pop-panel hidden>
                        <input type="search" placeholder="Search {{ $u->campuses->count() }} campuses by city or state" aria-label="Search campus" data-uz-filter autocomplete="off">
                        <div class="uz-list" role="listbox" aria-label="Campuses">
                            @if($routeName !== 'university.campus')
                                <a href="{{ $scopeUrl(null) }}" role="option" aria-selected="{{ $scope ? 'false' : 'true' }}" data-uz-item="all"><span>All campuses</span><small>{{ $u->campuses->count() }} campuses</small></a>
                            @endif
                            @foreach($statesByCampus as $state => $cs)
                                <div class="grp" data-uz-grp>{{ $state ?: 'Other' }}</div>
                                @foreach($cs as $cc)
                                    <a href="{{ $scopeUrl($cc['slug']) }}" role="option" aria-selected="{{ $scope === $cc['id'] ? 'true' : 'false' }}" data-uz-item="{{ mb_strtolower($cc['name'] . ' ' . $cc['city'] . ' ' . $state) }}"><span>{{ $cc['name'] }}</span><small>{{ $u->programmes($u->onCampus([$cc['id']]))->count() }} courses</small></a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <nav class="uz-tabs" aria-label="University sections">
                <a href="{{ $L->overview() }}" class="{{ $tab === 'overview' ? 'on' : '' }}">Overview</a>
                <a href="{{ $L->courses() }}" class="{{ $tab === 'courses' ? 'on' : '' }}">Courses &amp; fees</a>
                @if($onlineCount)<a href="{{ $L->online() }}" class="online {{ $tab === 'online' ? 'on' : '' }}">Online courses</a>@endif
                <a href="{{ $L->overview('#s-admission') }}">Admission</a>
                @if($u->hasPlacements())<a href="{{ $L->overview('#s-placement') }}">Placements</a>@endif
                <a href="{{ $L->campus() }}" class="{{ $tab === 'campus' ? 'on' : '' }}">Campuses</a>
                <a href="{{ $L->compare() }}" class="{{ $tab === 'compare' ? 'on' : '' }}">Compare</a>
                @if($u->hasReviews())<a href="{{ $L->overview('#s-reviews') }}">Reviews</a>@endif
                <a href="{{ $L->overview('#s-contact') }}">Contact</a>
            </nav>
            <a class="cz-btn cz-btn-orange cz-btn-sm apply" href="#enquire" data-uz-enquire="Apply">Apply now</a>
        </div>
    </div>

    @yield('uz')

    <div class="uz-tray" data-uz-tray hidden><span data-uz-tray-text></span><a class="cz-btn cz-btn-orange cz-btn-sm" href="{{ route('university.compare', ['slug' => $o['slug'], 'tab' => 'custom']) }}">Compare now</a><button class="x" type="button" data-uz-tray-clear>Clear</button></div>
    {{-- "Apply now" / "Get brochure" open this call-back form --}}
    <div class="uz-modal" data-uz-modal hidden role="dialog" aria-modal="true" aria-labelledby="uz-modal-h">
        <div class="cz-side-card cta uz-modal-box">
            <button type="button" class="uz-modal-x" data-uz-modal-close aria-label="Close">✕</button>
            <h3 id="uz-modal-h" data-uz-modal-title>Talk to an admission expert</h3>
            <p>Help choosing a course and the right campus. We call you back, free.</p>
            @include('university._enquiry', ['id' => 'enq-modal'])
        </div>
    </div>
    <div class="uz-mbar">@if($onlineCount)<a class="cz-btn cz-btn-outline" href="{{ $L->online() }}">Online</a>@endif<a class="cz-btn cz-btn-orange" href="#enquire" data-uz-enquire="Apply">Apply now</a></div>
</main>
@endsection
