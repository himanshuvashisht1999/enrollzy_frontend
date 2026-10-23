{{-- Counselling page: hero (status, round countdown, rounds strip, relation bar), tabs: Counselling details | Cutoffs |
     Participating colleges. $page (API counselling page), $c, $s (Ec::counState), $rounds, $exams, $primary, $relCouns, $tab --}}
@extends('ec.layout')
@php
    use App\Support\Ec\Ec;
    use Illuminate\Support\Str;
    $cy = $page['cycle'];
    $name = $c['name'] . ($cy && !str_contains($c['name'], (string) $cy['year']) ? ' ' . $cy['year'] : '');
    $gbarAt = 'counselling';
    $tabNames = ['overview' => 'Counselling details', 'cutoffs' => 'Cutoffs', 'colleges' => 'Participating colleges'];
    $crumbs = array_values(array_filter([['Counselling', route('counselling.index')], $primary ? [$primary['short_name'] ?: $primary['name'], route('exam.tab', [$primary['slug'], 'counselling'])] : null, [$name, route('counselling.show', $slug)], [$tabNames[$tab], null]]));
    $showFaq = $tab !== 'overview';
    $nr = $s['cur'] ?? $s['next'];
    $bulletin = $cy['information_bulletin']['pdf_url'] ?? $cy['information_bulletin']['url'] ?? null;
    $portal = $c['registration_portal_url'] ?: $c['official_website'];
    $collegeCount = $page['institutes']['colleges'] ?? 0;
    $seatTotal = collect($page['rounds'] ?? [])->reverse()->first(fn ($r) => !empty($r['seat_matrix']['live']))['seat_matrix']['live']['total_seats'] ?? null;
    $tabUrl = fn ($k) => $k === 'overview' ? route('counselling.show', array_filter(['slug' => $slug, 'year' => $year])) : route('counselling.' . $k, $slug) . ($year ? '?year=' . $year : '');
    // sections of "Counselling details" that have something to show
    $secs = array_filter([
        'highlights' => 'Highlights',
        'dates' => collect($page['dates']['rounds'] ?? [])->contains(fn ($r) => !empty($r['events'])) || !empty($page['dates']['cycle']) ? 'Rounds and dates' : null,
        'eligibility' => !empty($page['eligibility']) || !empty($page['institutes']['quotas']) ? 'Eligibility and quotas' : null,
        'seats' => !empty($seats['meta']['version']) ? 'Seat matrix' : null,
        'fees' => !empty($page['fees']) ? 'Fees and deposit' : null,
        'process' => !empty($page['process']) ? 'Counselling process' : null,
        'options' => collect($page['rounds'] ?? [])->contains(fn ($r) => !empty($r['willingness_options'])) ? 'Options after allotment' : null,
        'choice' => 'Choice filling tips',
        'documents' => !empty($page['documents']) ? 'Documents for reporting' : null,
        'institutes' => !empty($institutes['data']) ? 'Participating institutes' : null,
        'cutoffs' => !empty($preview['rows']) ? 'Cutoffs' : null,
        'rules' => !empty($page['rules']) ? 'Rules and refunds' : null,
        'contact' => $portal || $c['helpline'] || $bulletin ? 'Contact' : null,
    ]);
    $seo = $page['seo'] ?? [];
@endphp
@section('meta_title', ($seo['title'] ?? $name . ' - Dates, Eligibility, Seats and Cutoffs') . ' | Enrollzy')
@section('meta_description', $seo['description'] ?? ($name . ': rounds, dates, eligibility, seat matrix, fees and cutoffs.'))
@push('ec_head')
    <link rel="canonical" href="{{ $tabUrl($tab) }}">
    @if(($seo['robots'] ?? '') && $tab === 'overview')<meta name="robots" content="{{ $seo['robots'] }}">@endif
@endpush

@section('ec')
<section class="ec-ehero ec-gutter"><div class="ec-wrap">
    <div class="ec-egrid">
        <div>
            <div class="ec-eid">@include('ec._lg', ['lgName' => $c['name'], 'lgShort' => $c['short_name'], 'lgStates' => $c['level'] === 'state' ? $c['states'] : null, 'lgLogo' => $c['logo_url'] ?? null, 'lgStream' => $c['course_categories'][0] ?? ''])<div><h1>{{ $name }}</h1><div class="full">{{ $c['conducting_body']['name'] ?? (Ec::LEVEL[$c['level']] ?? '') . ' counselling' }}</div></div></div>
            <div class="ec-etags">
                <span class="ec-st {{ Ec::COUN_PILL[$s['state']] }}">{{ Ec::COUN_LABEL[$s['state']] }}</span>
                <span><b>{{ Ec::LEVEL[$c['level']] ?? ucfirst((string) $c['level']) }}</b>{{ $c['level'] === 'state' && $c['states'] ? ' · ' . implode(', ', $c['states']) : '' }}</span>
                @if($exams->isNotEmpty())<span>Based on @foreach($exams as $x)<a class="ec-lk exam" href="{{ route('exam.detail', $x['slug']) }}">{{ $x['short_name'] ?: $x['name'] }}</a>@endforeach</span>@endif
                @if($seatTotal)<span><b>{{ Ec::num($seatTotal) }}</b> seats</span>@endif
                @if($collegeCount)<span><b>{{ $collegeCount }}</b> colleges</span>@endif
                @if($rounds)<span><b>{{ count($rounds) }}</b> {{ Str::plural('round', count($rounds)) }}</span>@endif
            </div>
            @if(!empty($cy['last_verified_at']))<div class="ec-verified"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>Dates checked against the official notice on {{ Ec::fmt(Ec::d($cy['last_verified_at'])) }}</div>@endif
            @php $ql = array_intersect_key(['dates' => 'Rounds', 'eligibility' => 'Eligibility', 'seats' => 'Seat matrix', 'fees' => 'Fees', 'process' => 'Process', 'documents' => 'Documents', 'cutoffs' => 'Cutoffs'], $secs); @endphp
            @if($ql)<div class="ec-qlinks">@foreach($ql as $k => $l)<a href="{{ $tabUrl('overview') }}#sec-{{ $k }}" data-ec-toc="{{ $k }}">{{ $l }}</a>@endforeach</div>@endif
        </div>
        <aside class="ec-next{{ $s['cur'] && Ec::days($s['cur']['e']) <= 5 ? ' hot' : '' }}">
            @if($nr)
                <span class="lbl">{{ $s['cur'] ? $s['cur']['name'] . ' ends in' : $s['next']['name'] . ' starts in' }}</span>
                @php $d = $s['cur'] ? $s['cur']['e'] : $s['next']['s']; @endphp
                <div class="big"><b>{{ Ec::days($d) }}</b><span>{{ Ec::days($d) === 1 ? 'day' : 'days' }}</span></div>
                <span class="when">{{ Ec::fmt($d) }}</span>
            @else
                <span class="lbl">This cycle</span>
                <div class="big"><b style="font-size:26px">{{ $s['state'] === 'completed' ? 'All rounds done' : 'Dates awaited' }}</b></div>
                <span class="when">{{ $s['state'] === 'completed' ? 'Cutoffs are final' : ($page['now']['when'] ?? 'We update this page when the schedule is out') }}</span>
            @endif
            @if($s['cur'] && $portal)<a class="ec-btn ec-btn-orange" href="{{ $portal }}" target="_blank" rel="noopener">Go to official portal ↗</a>
            @elseif($primary)<a class="ec-btn ec-btn-orange" href="{{ route('cutoffs.index', ['exam' => $primary['slug'], 'counselling' => $slug]) }}">Check cutoffs</a>@endif
            <div class="two">
                <a class="ec-btn ec-btn-line ec-btn-sm" href="#alerts" data-ec-alerts-open data-type="counselling" data-slug="{{ $slug }}" data-name="{{ $name }}">Round alerts</a>
                @if($bulletin)<a class="ec-btn ec-btn-line ec-btn-sm" href="{{ $bulletin }}" target="_blank" rel="noopener">Bulletin ↗</a>@endif
            </div>
        </aside>
    </div>
    @if($rounds)
        <div class="ec-rounds">
            @foreach($s['rounds'] as $r)
                @php $st = !$r['s'] ? 'tba' : (Ec::days($r['e']) < 0 ? 'done' : (Ec::days($r['s']) <= 0 ? 'now' : 'up')); @endphp
                <div class="{{ $st === 'done' ? 'done' : ($st === 'now' ? 'now' : '') }}"><small>{{ ['done' => 'Done', 'now' => 'Live now', 'up' => 'Upcoming', 'tba' => 'Dates awaited'][$st] }}</small><b>{{ $r['name'] }}</b><span>{{ $r['s'] ? Ec::fmt($r['s'], false) . ' – ' . Ec::fmt($r['e'], false) : 'To be announced' }}</span></div>
            @endforeach
        </div>
    @endif
    @if($primary)
        @include('ec._relbar', ['rel' => ['exam' => $primary, 'couns' => $relCouns, 'coun' => $slug, 'at' => 'coun']])
    @endif
</div></section>

<nav class="ec-subnav ec-gutter" aria-label="Counselling sections"><div class="ec-wrap">
    @foreach(['overview' => null, 'cutoffs' => null, 'colleges' => $collegeCount ?: null] as $k => $n)
        <a href="{{ $tabUrl($k) }}" @if($k === $tab) aria-current="page" @endif>{{ $tabNames[$k] }}@if($n)<small>{{ $n }}</small>@endif</a>
    @endforeach
    <a href="{{ route('counselling.seats', $slug) }}{{ $year ? '?year=' . $year : '' }}">Seat matrix</a>
</div></nav>

@include('ec.coun._' . $tab)
@endsection
