{{-- Hub: Exams | Counselling | Cutoffs. $hubTab picks the body. --}}
@extends('ec.layout')
@php
    use App\Support\Ec\Ec;
    $gbarAt = $hubTab;
    $tabs = [
        'exams' => ['exam', 'Exams', $examCount . ' ' . \Illuminate\Support\Str::plural('exam', $examCount) . ', dates and status', route('top-exams')],
        'counselling' => ['coun', 'Counselling', $counCount . ' ' . \Illuminate\Support\Str::plural('counselling', $counCount) . ' and rounds', route('counselling.index')],
        'cutoffs' => ['cut', 'Cutoffs', 'Opening and closing ranks', route('cutoffs.index')],
    ];
    $sub = [
        'exams' => 'Registration and exam dates for every major entrance exam. Open applications first.',
        'counselling' => 'Every counselling and its current round. Live rounds first; filter by All India or your state.',
        'cutoffs' => 'Opening and closing ranks by counselling, year, round and category. Add your rank to see where you stand.',
    ];
    $crumbs = $hubTab === 'cutoffs' && !empty($exam)
        ? [['Cutoffs', route('cutoffs.index')], [$exam['short_name'] ?: $exam['name'], route('exam.detail', $exam['slug'])], [$coun['name'] ?? 'Cutoffs', null]]
        : [[$tabs[$hubTab][1], null]];
    $showFaq = true;
    $title = ['exams' => 'Entrance exams: dates, registration and status', 'counselling' => 'Counselling: rounds, dates and status', 'cutoffs' => 'Cutoffs: opening and closing ranks'][$hubTab];
@endphp
@section('meta_title', $title . ' | Enrollzy')
@section('meta_description', $sub[$hubTab])
@push('ec_head')<link rel="canonical" href="{{ $tabs[$hubTab][3] }}">@endpush

@section('ec')
<section class="ec-hero ec-gutter"><div class="ec-wrap">
    <h1 class="ec-sr">Exams, Counselling and Cutoffs</h1>
    <nav class="ec-htabs" aria-label="Section">
        @foreach($tabs as $k => [$ic, $l, $s, $u])
            <a href="{{ $u }}" @if($k === $hubTab) aria-current="page" @endif><span class="sic">{!! Ec::svg($ic) !!}</span><span><b>{{ $l }}</b><small>{{ $s }}</small></span></a>
        @endforeach
    </nav>
    <p class="ec-hsub">{{ $sub[$hubTab] }}</p>
    @if($hubTab !== 'cutoffs')
        <form class="ec-psearch" role="search" method="get" action="{{ $tabs[$hubTab][3] }}" data-ec-autosubmit>
            {!! Ec::svg('search') !!}
            @foreach(request()->except(['q', 'page']) as $k => $v)@if(is_string($v))<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif @endforeach
            <input name="q" type="search" value="{{ request('q') }}" placeholder="Search an exam or counselling, e.g. NEET, JoSAA" aria-label="Search" autocomplete="off" data-ec-debounce>
        </form>
    @endif
</div></section>

<section class="ec-sec ec-gutter" id="list"><div class="ec-wrap">
    @if(count($streams) > 2)
        <div class="ec-tabs-row"><div class="ec-tabs" role="tablist" aria-label="Category">
            @foreach($streams as $k => $n)
                <a role="tab" href="{{ Ec::url(request(), ['stream' => $k ?: null, 'page' => null, 'exam' => null, 'counselling' => null, 'round' => null, 'year' => null, 'seat' => null]) }}" aria-selected="{{ (string) $stream === (string) $k ? 'true' : 'false' }}">{{ $k ?: 'All' }}<small>{{ $n }}</small></a>
            @endforeach
        </div></div>
    @endif
    @include('ec.hub._' . $hubTab)
</div></section>
@endsection
