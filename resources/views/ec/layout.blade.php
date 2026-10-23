{{-- Frame of the Exams, Counselling & Cutoffs pages: section bar (breadcrumb + Exam → Counselling → Cutoffs), the page,
     the FAQ zone (hub and list tabs only), the alerts form. The site's own header and footer stay (layouts.app).
     A page sets: $gbarAt (exams|counselling|cutoffs), $crumbs [[label, url|null]...], $showFaq. --}}
@extends('layouts.app')
@php
    use App\Support\Ec\Ec;
@endphp

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/ec.css') }}?v={{ @filemtime(public_path('assets/css/ec.css')) }}">
    @stack('ec_head')
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/ec.js') }}?v={{ @filemtime(public_path('assets/js/ec.js')) }}"></script>
@endpush

@section('content')
<main class="ec" data-alerts-url="{{ route('alerts.follow') }}">
    <div class="ec-gbar ec-gutter"><div class="ec-wrap">
        <nav class="ec-gcrumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a> › <a href="{{ route('top-exams') }}">Exams, Counselling &amp; Cutoffs</a>
            @foreach($crumbs as $i => [$label, $href])
                › @if($href && $i < count($crumbs) - 1)<a href="{{ $href }}">{{ $label }}</a>@else<b>{{ $label }}</b>@endif
            @endforeach
        </nav>
        <nav class="ec-gflow" aria-label="Exam, counselling and cutoffs">
            @foreach([['exams', 'exam', 'Exams', route('top-exams')], ['counselling', 'coun', 'Counselling', route('counselling.index')], ['cutoffs', 'cut', 'Cutoffs', route('cutoffs.index')]] as $i => [$k, $ic, $l, $u])
                @if($i)<i aria-hidden="true">→</i>@endif<a href="{{ $u }}" @if($gbarAt === $k) aria-current="page" @endif>{!! Ec::svg($ic) !!}{{ $l }}</a>
            @endforeach
            <i aria-hidden="true">→</i><span class="seat">Your seat</span>
        </nav>
    </div></div>

    @yield('ec')

    @if(!empty($showFaq))
        <section class="ec-faqsec ec-gutter">
            <div class="ec-wrap">
                <div class="ec-lhead"><h2>The FAQ Zone</h2><p>How exams, counselling and cutoffs fit together.</p></div>
                <div class="ec-fqlist">
                    <details class="ec-fq" open><summary>What is the difference between an exam and counselling?</summary><div>The exam gives you a rank or score. Counselling is the separate process where you register, fill college choices and get a seat using that rank. One exam can feed several counsellings, for example an All India counselling and each state's own counselling.</div></details>
                    <details class="ec-fq"><summary>What is a cutoff?</summary><div>The opening and closing rank at which seats in a college and course were allotted in a counselling round. Cutoffs belong to a counselling, a year, a round, a category and a quota, so always compare like with like.</div></details>
                    <details class="ec-fq"><summary>Why do some exams have no counselling?</summary><div>For some exams there is no central counselling. Each college runs its own admission, so cutoffs are published college-wise.</div></details>
                </div>
            </div>
        </section>
    @endif

    {{-- "Get alerts": follow an exam or counselling by email (confirmed by a link) --}}
    <div class="ec-modal" data-ec-alerts hidden>
        <div class="ec-modal-box" role="dialog" aria-modal="true" aria-labelledby="ec-al-t">
            <button class="ec-modal-x" type="button" data-ec-close aria-label="Close">×</button>
            <h3 id="ec-al-t">Get alerts</h3>
            <p data-ec-alerts-text>We email you when dates change or a new round opens.</p>
            <form data-ec-alerts-form>
                @csrf
                <input type="hidden" name="type"><input type="hidden" name="slug">
                <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px" aria-hidden="true">
                <input type="email" name="email" required maxlength="190" placeholder="Your email" autocomplete="email" aria-label="Your email">
                <button class="ec-btn ec-btn-orange" type="submit">Get alerts</button>
                <div class="ok" data-ec-alerts-msg hidden></div>
            </form>
        </div>
    </div>
</main>
@endsection
