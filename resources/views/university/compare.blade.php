@extends('university.base')
@php
    $o = $u->org;
    $q = array_filter(['slug' => $o['slug'], 'campus' => $scopeCampus['slug'] ?? null, 'course' => request('course')]);
    $tabs = [
        'same-uni' => ['Related courses here', 'Same university, different courses'],
        'same-course' => ['Same course, other universities', 'Pick a course, see it elsewhere'],
        'custom' => ['Build your own', 'Any course, any university'],
    ];
@endphp
@section('meta_title', 'Compare courses - ' . $o['name'] . ' | Enrollzy')
@section('meta_description', 'Compare fees, placements and seats of courses at ' . $o['name'] . ' and other universities, side by side.')

@section('uz')
<div class="cz-page cz-gutter">
    <div class="cz-container cz-stack">
        <div class="uz-backrow"><a class="uz-back" href="{{ $L->overview() }}"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M12 4l-6 6 6 6"/></svg>Back to {{ $o['name'] }}</a></div>
        <h1 class="uz-title">Compare</h1>
        <nav class="uz-ctabs" role="tablist" aria-label="Compare type">
            @foreach($tabs as $k => [$t, $s])<a role="tab" href="{{ route('university.compare', $q + ['tab' => $k]) }}" aria-selected="{{ $compareTab === $k ? 'true' : 'false' }}">{{ $t }}<small>{{ $s }}</small></a>@endforeach
        </nav>
        <div class="uz-note">
            @if($compareTab === 'same-uni')Related courses at <b>{{ $o['name'] }}</b>{{ $base ? ', ' . ($u->campus($base['campus_id'])['name'] ?? '') : '' }}. Change any course or campus below.
            @elseif($compareTab === 'same-course')<b>{{ $base['name'] ?? 'This course' }}</b> at {{ $o['name'] }} and other universities that list it. Each column has its own campus.
            @else Mix any university, course and campus. Courses you added with "+ Compare" appear here.@endif
        </div>

        <div data-uz-compare data-tab="{{ $compareTab }}" data-slots="{{ json_encode($slots) }}"
             data-data-url="{{ route('university.compare.data') }}" data-options-url="{{ route('university.compare.options') }}" data-uni="{{ $o['slug'] }}"
             data-universities="{{ json_encode($universities->map(fn ($x) => ['slug' => $x->slug, 'name' => $x->name])->values()) }}">
            <div class="uz-slots" data-uz-slots></div>
            <div class="uz-legend" style="margin-top:12px"><span><i></i>Best value in the row</span><label class="cz-check"><input type="checkbox" data-uz-diff> Show only rows that differ</label></div>
            <div class="cz-tbl-wrap" style="margin-top:8px"><table class="uz-cmp"><thead data-uz-cmp-head></thead><tbody data-uz-cmp-body></tbody></table></div>
            <div class="cz-empty" data-uz-cmp-empty hidden><b>Nothing to compare yet</b>Add a column above, or use "+ Compare" on any course.</div>
        </div>

        <div class="uz-online-strip" style="background:linear-gradient(110deg, var(--cz-blue-soft), var(--cz-white) 70%);border-color:rgba(31,95,216,.25)">
            <div class="t"><b>Still deciding between these?</b><span>A counsellor will go through these options with you, free.</span></div>
            <a class="cz-btn cz-btn-orange" href="#enquire" data-uz-enquire="Compare help">Talk to a counsellor</a>
        </div>
    </div>
</div>
@endsection
