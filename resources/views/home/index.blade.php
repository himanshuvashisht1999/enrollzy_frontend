{{-- Homepage (client design "Home page v11"). Everything here is managed in the backend:
     - words, links, lists, order and show / hide: admin "Homepage Sections" (App\Support\Home\HomeContent)
     - the data in each section: stream tabs, noteworthy mentions, scholarships, schools, experts, blogs, FAQs... (App\Support\Home\HomeData)
     - title, description and social tags: admin "Homepage SEO"
     A section with no data is left out. The site's own header and footer stay (layouts.app). --}}
@extends('layouts.app')
@php
    use App\Support\Home\HomeContent;
    $c = $h['c'];
    $seo = $h['seo'];
    $ico = fn ($paths, $w = 2) => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . $w . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths . '</svg>';
    $check = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $arrow = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $lines = fn ($t) => nl2br(e((string) $t), false);                  // titles may have a line break
    $link = fn ($u, $fallback = null) => HomeContent::url($u) ?? $fallback;
@endphp
@section('meta_title', $seo['title'] ?? 'Enrollzy - Find the right college, course, school and scholarship')
@section('meta_description', $seo['description'] ?? 'Compare universities, courses, schools and scholarships. Exam and counselling dates from official notices, and free admission counselling.')
@if(!empty($seo['keywords']))@section('meta_keywords', $seo['keywords'])@endif

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}?v={{ @filemtime(public_path('assets/css/home.css')) }}">
    <link rel="canonical" href="{{ $seo['canonical'] ?? url('/') }}">
    @if(!empty($seo['robots']))<meta name="robots" content="{{ $seo['robots'] }}">@endif
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $seo['canonical'] ?? url('/') }}">
    <meta property="og:title" content="{{ $seo['og_title'] ?? 'Enrollzy' }}">
    @if(!empty($seo['og_description']))<meta property="og:description" content="{{ $seo['og_description'] }}">@endif
    @if(!empty($seo['og_image']))<meta property="og:image" content="{{ $seo['og_image'] }}">@endif
    <meta name="twitter:card" content="summary_large_image">
    @if(!empty($seo['twitter_title']))<meta name="twitter:title" content="{{ $seo['twitter_title'] }}">@endif
    @if(!empty($seo['twitter_description']))<meta name="twitter:description" content="{{ $seo['twitter_description'] }}">@endif
    @if(!empty($seo['twitter_image']))<meta name="twitter:image" content="{{ $seo['twitter_image'] }}">@endif
    @if(!empty($seo['schema']) && json_decode($seo['schema']) !== null)<script type="application/ld+json">{!! json_encode(json_decode($seo['schema']), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>@endif
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/home.js') }}?v={{ @filemtime(public_path('assets/js/home.js')) }}"></script>
@endpush

@section('content')
<main class="hz" id="hz-top" data-live-url="{{ route('live.search') }}" data-search-url="{{ route('search.results') }}"
      data-options-url="{{ route('university.compare.options') }}" data-compare-url="{{ url('university-detail') }}">

    {{-- sections in the order set in the admin; a hidden section is not in the list --}}
    @foreach($h['order'] as $key)
        @include('home.sections.' . HomeContent::SECTIONS[$key], ['s' => $c[$key]])
    @endforeach

    {{-- call-back form (Book free counselling, online advisor, school enquiry); its words are in "Free counselling" --}}
    @php($f = $c['free_counselling'])
    <div class="hz-modal" data-hz-modal hidden>
        <div class="hz-modal-box" role="dialog" aria-modal="true" aria-labelledby="hz-modal-t">
            <button class="hz-modal-x" type="button" data-hz-close aria-label="Close">×</button>
            <h3 id="hz-modal-t" data-hz-modal-title data-default="{{ $f['form_title'] }}">{{ $f['form_title'] }}</h3>
            <p>{{ $f['form_text'] }}</p>
            <form class="hz-form" action="{{ route('contact.submit') }}" method="post" data-hz-enquiry>
                @csrf
                <input type="hidden" name="subject" value="Homepage enquiry" data-hz-subject>
                <input type="hidden" name="message" value="" data-hz-message>
                <label>Name<input name="name" required maxlength="255" autocomplete="name" placeholder="Your name"></label>
                <label>Phone<input name="phone" required maxlength="20" inputmode="tel" autocomplete="tel" placeholder="10-digit mobile"></label>
                @if($f['form_options'])<label>I'm looking for<select name="programme"><option value="">Choose one</option>@foreach($f['form_options'] as $o)<option>{{ \Illuminate\Support\Str::limit($o, 100, '') }}</option>@endforeach</select></label>@endif
                <button class="hz-btn hz-btn-orange" type="submit">Get a call back</button>
                <div class="ok" data-hz-ok hidden></div>
            </form>
        </div>
    </div>
    @if($f['mobile_bar'])
        <div class="hz-mbar"><a class="hz-btn hz-btn-ghost" href="#hz-top" data-hz-focus-search>Search</a><a class="hz-btn hz-btn-orange" href="#enquire" data-hz-enquire="Free counselling">{{ $f['cta_title'] }}</a></div>
    @endif
</main>
@endsection
