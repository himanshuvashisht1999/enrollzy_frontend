{{-- Exam page: hero (status, next date, journey, relation bar), tabs: Exam details | Counselling | Cutoffs | Colleges.
     $page (API exam page), $e (= $page['exam']), $item (list item with _s), $counsellings (with _s), $colleges, $tab --}}
@extends('ec.layout')
@php
    use App\Support\Ec\Ec;
    $s = $item['_s'];
    $short = $e['short_name'] ?: $e['name'];
    $year = $page['cycle']['year'] ?? null;
    $title = $short . ($year && !str_contains($short, (string) $year) ? ' ' . $year : '');
    $gbarAt = 'exams';
    $tabNames = ['overview' => 'Exam details', 'counselling' => 'Counselling', 'cutoffs' => 'Cutoffs', 'colleges' => 'Colleges'];
    $crumbs = [['Exams', route('top-exams')], [$title, route('exam.detail', $slug)], [$tabNames[$tab], null]];
    $showFaq = $tab !== 'overview';
    // the journey: registration → exam → result → counselling
    $firstCoun = $counsellings->map(fn ($c) => $c['_s']['first']['s'] ?? null)->filter()->sort()->first();
    $evs = collect([[$s['rs'], 'Registration opens'], [$s['re'] && $s['rs'] && !$s['re']->eq($s['rs']) ? $s['re'] : null, 'Registration closes'], [$s['ex'], 'Exam day'], [$s['res'], 'Result'], [$firstCoun, 'Counselling starts']])
        ->filter(fn ($x) => $x[0])->sortBy(fn ($x) => $x[0]->timestamp)->values();
    $nxt = $evs->first(fn ($x) => Ec::days($x[0]) >= 0);
    $passed = $evs->filter(fn ($x) => Ec::days($x[0]) < 0)->count();
    $prog = 0;
    if ($evs->count() > 1 && $passed) {
        $prog = $passed >= $evs->count() ? 1 : ($passed - 1 + (Ec::today()->timestamp - $evs[$passed - 1][0]->timestamp) / max(1, $evs[$passed][0]->timestamp - $evs[$passed - 1][0]->timestamp)) / ($evs->count() - 1);
    }
    $modes = collect($page['pattern'] ?? [])->pluck('mode')->filter()->unique()->values();
    $liveCoun = $counsellings->first(fn ($c) => $c['_s']['grp'] === 0);
    $seo = $page['seo'] ?? [];
    // sections of "Exam details" that have something to show (the contents list, the quick links)
    $dates = collect($page['dates'] ?? []);
    $resultTypes = ['provisional-answer-key', 'answer-key-objection', 'final-answer-key', 'result', 'scorecard', 'merit-list'];
    $secs = array_filter([
        'highlights' => 'Highlights',
        'dates' => $dates->isNotEmpty() ? 'Important dates' : null,
        'eligibility' => !empty($page['eligibility']) ? 'Eligibility' : null,
        'apply' => !empty($page['fees']) || !empty($page['documents']) || $s['apply_url'] ? 'How to apply' : null,
        'pattern' => !empty($page['pattern']) ? 'Exam pattern' : null,
        'syllabus' => !empty($page['syllabus']) ? 'Syllabus' : null,
        'centres' => !empty($page['centres']) ? 'Exam centres' : null,
    ] + collect($page['extra'] ?? [])->mapWithKeys(fn ($x) => ['x-' . \Illuminate\Support\Str::slug($x['key'] ?: $x['label']) => $x['label']])->all() + [
        'result' => $dates->contains(fn ($d) => in_array($d['type']['slug'] ?? '', $resultTypes, true)) ? 'Answer key and result' : null,
        'prep' => !empty($page['papers']) ? 'Previous papers' : null,
        'after' => 'Counselling and cutoffs',
        'colleges' => count($colleges) ? 'Colleges accepting' : null,
        'contact' => !empty($e['official_website']) || !empty($e['conducting_body']['website']) ? 'Contact' : null,
        'faq' => !empty($page['faqs']) ? 'FAQs' : null,
    ]);
@endphp
@section('meta_title', ($seo['title'] ?? $title . ' - Dates, Eligibility, Pattern, Syllabus & Counselling') . ' | Enrollzy')
@section('meta_description', $seo['description'] ?? ($e['name'] . ': dates, eligibility, pattern, syllabus, counselling and cutoffs.'))
@push('ec_head')
    <link rel="canonical" href="{{ $tab === 'overview' ? route('exam.detail', $slug) : route('exam.tab', [$slug, $tab]) }}">
    @if(($seo['robots'] ?? '') && $tab === 'overview')<meta name="robots" content="{{ $seo['robots'] }}">@endif
@endpush

@section('ec')
<section class="ec-ehero ec-gutter"><div class="ec-wrap">
    <div class="ec-egrid">
        <div>
            <div class="ec-eid">@include('ec._lg', ['lgName' => $e['name'], 'lgShort' => $e['short_name'], 'lgLogo' => $e['logo_url'] ?? null, 'lgStream' => $e['categories'][0] ?? ''])<div><h1>{{ $title }}</h1><div class="full">{{ $e['name'] }}</div></div></div>
            <div class="ec-etags">
                <span class="ec-st {{ $s['state'] }}">{{ Ec::EXAM_LABEL[$s['state']] }}</span>
                @if(!empty($e['conducting_body']))<span>Conducted by <b>{{ $e['conducting_body']['short_name'] ?: $e['conducting_body']['name'] }}</b></span>@endif
                @if(!empty($e['type_label']))<span><b>{{ $e['type_label'] }}</b>{{ !empty($e['states']) ? ' · ' . implode(', ', $e['states']) : '' }}</span>@endif
                @if(!empty($e['program_levels']))<span><b>{{ implode(', ', $e['program_levels']) }}</b> admissions</span>@endif
                @if($modes->isNotEmpty())<span><b>{{ $modes->implode(' / ') }}</b></span>@endif
                @if($counsellings->isNotEmpty())<span><b>{{ $counsellings->count() }}</b> {{ \Illuminate\Support\Str::plural('counselling', $counsellings->count()) }}</span>@endif
            </div>
            @if(!empty($page['last_verified_at']))
                <div class="ec-verified"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>Dates checked against the official notice on {{ Ec::fmt(Ec::d($page['last_verified_at'])) }}</div>
            @endif
            @include('ec.exam._qlinks')
        </div>
        <aside class="ec-next{{ $nxt && $nxt[1] === 'Registration closes' && Ec::days($nxt[0]) <= 10 ? ' hot' : '' }}">
            @if($nxt)
                <span class="lbl">{{ $nxt[1] }} in</span>
                <div class="big"><b>{{ Ec::days($nxt[0]) }}</b><span>{{ Ec::days($nxt[0]) === 1 ? 'day' : 'days' }}</span></div>
                <span class="when">{{ Ec::fmt($nxt[0]) }}</span>
            @else
                <span class="lbl">This cycle</span>
                <div class="big"><b style="font-size:26px">{{ $evs->isEmpty() ? 'Dates awaited' : 'All dates passed' }}</b></div>
                <span class="when">{{ $s['res'] ? 'Result declared ' . Ec::fmt($s['res']) : ($evs->isEmpty() ? 'We update this page when the notice is out' : '') }}</span>
            @endif
            @if($s['grp'] === 0 && $s['apply_url'])<a class="ec-btn ec-btn-orange" href="{{ $s['apply_url'] }}" target="_blank" rel="noopener">Apply now ↗</a>
            @elseif($liveCoun)<a class="ec-btn ec-btn-orange" href="{{ route('exam.tab', [$slug, 'counselling']) }}">Counselling is live</a>@endif
            <div class="two">
                <a class="ec-btn ec-btn-line ec-btn-sm" href="#alerts" data-ec-alerts-open data-type="exam" data-slug="{{ $slug }}" data-name="{{ $title }}">Get alerts</a>
                @if(!empty($e['official_website']))<a class="ec-btn ec-btn-line ec-btn-sm" href="{{ $e['official_website'] }}" target="_blank" rel="noopener">Official site ↗</a>@endif
            </div>
        </aside>
    </div>
    @if($evs->count() > 1)
        <div class="ec-jline"><ol style="--n:{{ $evs->count() }};--p:{{ round($prog, 3) }}">
            @foreach($evs as $i => [$d, $l])
                <li class="{{ Ec::days($d) < 0 ? 'done' : ($i === $passed ? 'now' : '') }}"><i></i><b>{{ $l }}</b><span>{{ $i === $passed ? Ec::inDays($d) . ' · ' : '' }}{{ Ec::fmt($d) }}</span></li>
            @endforeach
        </ol></div>
    @endif
    @include('ec._relbar', ['rel' => ['exam' => $e, 'couns' => $counsellings, 'coun' => null, 'at' => 'exam']])
</div></section>

<nav class="ec-subnav ec-gutter" aria-label="Exam sections"><div class="ec-wrap">
    @foreach(['overview' => [null], 'counselling' => [$counsellings->count()], 'cutoffs' => [null], 'colleges' => [count($colleges)]] as $k => [$n])
        @if($k !== 'colleges' || $n)
            <a href="{{ $k === 'overview' ? route('exam.detail', $slug) : route('exam.tab', [$slug, $k]) }}" @if($k === $tab) aria-current="page" @endif>{{ $tabNames[$k] }}@if($n !== null)<small>{{ $n }}</small>@endif</a>
        @endif
    @endforeach
</div></nav>

@include('ec.exam._' . $tab)
@endsection
