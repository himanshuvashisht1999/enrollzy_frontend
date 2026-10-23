{{-- Exam → Counselling tab: All India first, "My state" pinned, status filter, search, paged. $flat, $pager, $type, $st, $q, $my, $myStates --}}
@php
    use App\Support\Ec\Ec;
    $nm = $e['short_name'] ?: $e['name'];
    $ai = $counsellings->filter(fn ($c) => $c['level'] !== 'state');
    $sc = $counsellings->filter(fn ($c) => $c['level'] === 'state');
    $live = $counsellings->filter(fn ($c) => $c['_s']['grp'] === 0)->count();
    $GH = ['m' => ['Your state', 'var(--orange)', $my], 'a' => ['All India · ' . $flat->where('g', 'a')->count(), 'var(--blue)', 'Open to candidates from every state'],
        's' => ['State counselling · ' . $flat->where('g', 's')->count(), '#b4540a', 'Mostly for candidates domiciled in that state. Live rounds first.']];
    $last = null;
    $stage = function ($c) {
        $s = $c['_s'];
        if ($s['cur']) return '<b>' . e($s['cur']['name']) . '</b><small class="' . (Ec::days($s['cur']['e']) <= 5 ? 'hot' : 'go') . '">Ends ' . Ec::inDays($s['cur']['e']) . '</small>';
        if ($s['state'] === 'between') return '<b>Next: ' . e($s['next']['name']) . '</b><small>' . Ec::fmt($s['next']['s']) . '</small>';
        if ($s['state'] === 'upcoming') return '<b>Starts ' . Ec::fmt($s['first']['s']) . '</b><small>' . count($s['rounds']) . ' rounds</small>';
        if ($s['state'] === 'completed') return '<b>Completed</b><small>Ended ' . Ec::fmt($s['last']['e']) . '</small>';
        return '<b>' . e($c['now']['step'] ?? 'Schedule awaited') . '</b><small>' . e($c['now']['when'] ?? '') . '</small>';
    };
@endphp
<section class="ec-osec ec-gutter" id="list"><div class="ec-wrap">
    <div class="ec-lhead tight"><h2>Counselling after {{ $nm }}</h2><p>{{ $counsellings->isNotEmpty() ? $counsellings->count() . ' ' . \Illuminate\Support\Str::plural('counselling', $counsellings->count()) . ($counsellings->count() === 1 ? ' uses' : ' use') . ' this exam\'s rank. Register for the All India counselling and for your own state\'s counselling; most states only admit their own domicile candidates.' : 'No central counselling for this exam.' }}</p></div>
    @if($counsellings->isEmpty())
        <div class="ec-note"><b>Admission is college-wise</b>Each college that accepts {{ $nm }} runs its own process. Check the college pages for their cutoffs.</div>
    @else
        <div class="ec-stats">
            <a href="{{ Ec::url(request(), ['type' => null, 'status' => null, 'page' => null]) }}#list" aria-pressed="{{ !$type && !$st ? 'true' : 'false' }}"><b>{{ $counsellings->count() }}</b>All counsellings</a>
            <a href="{{ Ec::url(request(), ['type' => 'national', 'status' => null, 'page' => null]) }}#list" aria-pressed="{{ $type === 'national' ? 'true' : 'false' }}"><b>{{ $ai->count() }}</b>All India</a>
            <a href="{{ Ec::url(request(), ['type' => 'state', 'status' => null, 'page' => null]) }}#list" aria-pressed="{{ $type === 'state' ? 'true' : 'false' }}"><b>{{ $sc->count() }}</b>State</a>
            <a class="g" href="{{ Ec::url(request(), ['status' => $st === 'live' ? null : 'live', 'page' => null]) }}#list" aria-pressed="{{ $st === 'live' ? 'true' : 'false' }}"><b>{{ $live }}</b>Live now</a>
        </div>
        <form class="ec-subfilters" method="get" action="{{ route('exam.tab', [$slug, 'counselling']) }}#list" data-ec-autosubmit>
            @if($type)<input type="hidden" name="type" value="{{ $type }}">@endif
            @if($myStates->isNotEmpty())<label class="ec-mystate">My state<select name="my" aria-label="My state" data-ec-remember="state"><option value="">Choose your state</option>@foreach($myStates as $x)<option @selected($x === $my)>{{ $x }}</option>@endforeach</select></label>@endif
            <select name="status" aria-label="Status"><option value="">Any status</option>@foreach(['live' => 'Live now', 'upcoming' => 'Upcoming', 'completed' => 'Completed'] as $k => $l)<option value="{{ $k }}" @selected($st === $k)>{{ $l }}</option>@endforeach</select>
            <input name="q" type="search" class="ec-q" placeholder="Search a state or counselling" aria-label="Search counselling" value="{{ request('q') }}" data-ec-debounce>
        </form>
        <div class="ec-tcard"><table class="ec-t">
            <colgroup><col style="width:34%"><col style="width:12%"><col style="width:19%"><col style="width:14%"><col style="width:21%"></colgroup>
            <thead><tr><th>Counselling</th><th>Seats</th><th>Current stage</th><th class="c">Status</th><th class="r">Cutoffs and details</th></tr></thead>
            <tbody>
            @forelse($pager['items'] as $i => $row)
                @php $c = $row['c']; @endphp
                @if($row['g'] !== $last)
                    @php $cont = $i === 0 && $pager['from'] > 1 && ($flat[$pager['from'] - 2]['g'] ?? null) === $row['g']; @endphp
                    <tr class="ec-grp"><td colspan="5" style="--c:{{ $GH[$row['g']][1] }}"><span>{{ $GH[$row['g']][0] }}@if($cont) <em>continued</em>@endif</span><small>{{ $GH[$row['g']][2] }}</small></td></tr>
                    @php $last = $row['g']; @endphp
                @endif
                <tr class="ec-row{{ $c['_s']['grp'] === 2 ? ' ec-closedrow' : '' }}{{ $row['g'] === 'm' ? ' ec-mine' : '' }}">
                    <td class="nmc"><div class="ec-nm"><span><b><a href="{{ route('counselling.show', $c['slug']) }}">{{ $c['name'] }}</a>@if($row['g'] === 'm')<span class="ec-yours">Your state</span>@endif</b><small>{{ $c['seat_scope_note'] ?? implode(' · ', array_filter([$c['conducting_body'] ?? null, $c['level'] === 'state' ? implode(', ', $c['states'] ?? []) : (Ec::LEVEL[$c['level']] ?? null)])) }}</small></span></div></td>
                    <td class="ec-dt" data-l="Seats"><b>{{ !empty($c['seats']) ? Ec::num($c['seats']) : '–' }}</b><small>{{ !empty($c['colleges_count']) ? $c['colleges_count'] . ' colleges' : '' }}</small></td>
                    <td class="ec-dt" data-l="Current stage">{!! $stage($c) !!}</td>
                    <td class="c stc"><span class="ec-st {{ Ec::COUN_PILL[$c['_s']['state']] }}">{{ Ec::COUN_LABEL[$c['_s']['state']] }}</span></td>
                    <td class="r act"><a class="ec-lk cut" href="{{ route('cutoffs.index', ['exam' => $slug, 'counselling' => $c['slug']]) }}">Cutoffs</a> <a class="ec-see" href="{{ route('counselling.show', $c['slug']) }}">See details →</a></td>
                </tr>
            @empty
                <tr><td colspan="5"><div class="ec-empty"><b>No counselling matches</b>Clear the search or status filter.</div></td></tr>
            @endforelse
            </tbody>
        </table>
        @if($flat->isNotEmpty())@include('ec._pager', ['p' => $pager, 'noun' => 'counsellings', 'anchor' => '#list'])@endif
        </div>
    @endif
</div></section>
