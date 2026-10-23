{{-- Hub: counselling by status (live, upcoming, completed). With no filter, state counsellings of one exam are one row.
     $rows (ordered, each ['bundle', 'c' | 'exam'+'list', 'grp']), $page, $level, $state, $states, $levelCounts, $bundled --}}
@php
    use App\Support\Ec\Ec;
    $G = [['Live now', 'var(--green)', 'A round is running or between rounds'], ['Upcoming', 'var(--blue)', 'Starts after the exam result'], ['Completed', '#9aa6bb', 'All rounds are over; cutoffs are final']];
    $gcount = fn ($g) => $rows->where('grp', $g)->sum(fn ($r) => $r['bundle'] ? $r['list']->count() : 1);
    $last = null;
    $stage = function ($c) {
        $s = $c['_s'];
        if ($s['cur']) return '<b>' . e($s['cur']['name']) . '</b><small class="' . (Ec::days($s['cur']['e']) <= 5 ? 'hot' : 'go') . '">Ends ' . Ec::inDays($s['cur']['e']) . ' · ' . Ec::fmt($s['cur']['s'], false) . ' – ' . Ec::fmt($s['cur']['e'], false) . '</small>';
        if ($s['state'] === 'between') return '<b>Next: ' . e($s['next']['name']) . '</b><small>Starts ' . Ec::fmt($s['next']['s']) . '</small>';
        if ($s['state'] === 'upcoming') return '<b>Starts ' . Ec::fmt($s['first']['s']) . '</b><small>' . count($s['rounds']) . ' ' . \Illuminate\Support\Str::plural('round', count($s['rounds'])) . '</small>';
        if ($s['state'] === 'tba') return '<b>' . e($c['now']['step'] ?? 'Schedule awaited') . '</b><small>' . e($c['now']['when'] ?? 'No dates yet') . '</small>';
        return '<b>All ' . count($s['rounds']) . ' rounds done</b><small>Ended ' . Ec::fmt($s['last']['e']) . '</small>';
    };
@endphp
<form class="ec-fbar" method="get" action="{{ route('counselling.index') }}" data-ec-autosubmit>
    <span class="fl">Show</span>
    <div class="ec-fseg" role="group" aria-label="Level">
        @foreach(['' => 'All India + State', 'national' => 'All India', 'state' => 'State only'] as $v => $l)
            <a href="{{ Ec::url(request(), ['level' => $v ?: null, 'state' => null, 'page' => null]) }}" aria-pressed="{{ $level === $v && !$state ? 'true' : 'false' }}">{{ $l }} <small>{{ $levelCounts[$v] }}</small></a>
        @endforeach
    </div>
    @if($states->isNotEmpty())
        <label class="ec-fstate{{ $state ? ' on' : '' }}"><span>My state</span><select name="state" aria-label="State" data-ec-remember="state"><option value="">Choose a state</option>@foreach($states as $st)<option @selected($st === $state)>{{ $st }}</option>@endforeach</select></label>
    @endif
    @foreach(request()->only(['q', 'stream']) as $k => $v)@if(is_string($v) && $v !== '')<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif @endforeach
    @if($level || $state)<a class="ec-fclear" href="{{ Ec::url(request(), ['level' => null, 'state' => null, 'page' => null]) }}">Clear</a>@endif
</form>

<div class="ec-tcard"><table class="ec-t">
    <colgroup><col style="width:27%"><col style="width:15%"><col style="width:19%"><col style="width:12%"><col style="width:13%"><col style="width:14%"></colgroup>
    <thead><tr><th>Counselling</th><th>Based on exam</th><th>Current stage</th><th>Cutoffs</th><th class="c">Status</th><th class="r">Details</th></tr></thead>
    <tbody>
    @forelse($page['items'] as $i => $r)
        @if($r['grp'] !== $last)
            @php $cont = $i === 0 && $page['from'] > 1 && ($rows[$page['from'] - 2]['grp'] ?? null) === $r['grp']; @endphp
            <tr class="ec-grp"><td colspan="6" style="--c:{{ $G[$r['grp']][1] }}"><span>{{ $G[$r['grp']][0] }} · {{ $gcount($r['grp']) }}@if($cont) <em>continued</em>@endif</span><small>{{ $G[$r['grp']][2] }}</small></td></tr>
            @php $last = $r['grp']; @endphp
        @endif
        @if($r['bundle'])
            @php
                $L = $r['list']; $ex = $r['exam'];
                $live = $L->filter(fn ($c) => $c['_s']['grp'] === 0)->count(); $up = $L->filter(fn ($c) => in_array($c['_s']['state'], ['upcoming', 'tba']))->count(); $done = $L->filter(fn ($c) => $c['_s']['state'] === 'completed')->count();
            @endphp
            <tr class="ec-row ec-bundle">
                <td class="nmc"><div class="ec-nm"><span class="ec-lg" style="background:#fff4dc;font-size:15px">{{ $L->count() }}</span><span><b><a href="{{ route('exam.tab', [$ex['slug'], 'counselling']) }}">State counsellings for {{ $ex['short_name'] ?: $ex['name'] }}</a></b><small>{{ $L->count() }} states and UTs · each runs its own rounds</small></span></div></td>
                <td class="lkc"><a class="ec-lk exam" href="{{ route('exam.detail', $ex['slug']) }}">{{ $ex['short_name'] ?: $ex['name'] }}</a></td>
                <td class="ec-dt" data-l="Current stage"><b>{{ $live ? $live . ' live now' : ($up ? $up . ' upcoming' : 'All completed') }}</b><small>{{ implode(' · ', array_filter([$live && $up ? $up . ' upcoming' : null, $done ? $done . ' completed' : null])) }}</small></td>
                <td class="lkc"><a class="ec-lk cut" href="{{ route('cutoffs.index', ['exam' => $ex['slug'], 'counselling' => $L->first()['slug']]) }}">State cutoffs</a></td>
                <td class="c stc"><span class="ec-st {{ $live ? 'open' : ($up ? 'upcoming' : 'closed') }}">{{ $live ? 'Rounds live' : ($up ? 'Upcoming' : 'Completed') }}</span></td>
                <td class="r act"><a class="ec-see" href="{{ route('exam.tab', [$ex['slug'], 'counselling']) }}">Choose state <span aria-hidden="true">→</span></a></td>
            </tr>
        @else
            @php $c = $r['c']; @endphp
            <tr class="ec-row{{ $r['grp'] === 2 ? ' ec-closedrow' : '' }}">
                <td class="nmc"><div class="ec-nm">@include('ec._lg', ['lgName' => $c['name'], 'lgShort' => $c['short_name'], 'lgStates' => $c['level'] === 'state' ? ($c['states'] ?? []) : null, 'lgLogo' => $c['logo_url'] ?? null, 'lgStream' => $c['course_categories'][0] ?? ''])<span><b><a href="{{ route('counselling.show', $c['slug']) }}">{{ $c['name'] }}</a></b><small>{{ implode(' · ', array_filter([$c['conducting_body'] ?? null, Ec::LEVEL[$c['level']] ?? ucfirst((string) $c['level']), $c['level'] === 'state' ? implode(', ', $c['states'] ?? []) : null])) }}</small></span></div></td>
                <td class="lkc">@forelse($c['exams'] ?? [] as $x)<a class="ec-lk exam" href="{{ route('exam.detail', $x['slug']) }}">{{ $x['short_name'] ?: $x['name'] }}</a>@empty<span class="ec-none">–</span>@endforelse</td>
                <td class="ec-dt" data-l="Current stage">{!! $stage($c) !!}</td>
                <td class="lkc">@if(!empty($c['exams']))<a class="ec-lk cut" href="{{ route('cutoffs.index', ['exam' => $c['exams'][0]['slug'], 'counselling' => $c['slug']]) }}">{{ !empty($c['current_cycle']['year']) ? $c['current_cycle']['year'] . ' cutoffs' : 'Cutoffs' }}</a>@else<span class="ec-none">–</span>@endif</td>
                <td class="c stc"><span class="ec-st {{ Ec::COUN_PILL[$c['_s']['state']] }}">{{ Ec::COUN_LABEL[$c['_s']['state']] }}</span></td>
                <td class="r act"><a class="ec-see" href="{{ route('counselling.show', $c['slug']) }}">See details <span aria-hidden="true">→</span></a></td>
            </tr>
        @endif
    @empty
        <tr><td colspan="6"><div class="ec-empty"><b>No counselling matches</b>Try another category or clear the filters. Where there is no central counselling, colleges admit directly. <a href="{{ route('top-exams') }}">See the exams</a>.</div></td></tr>
    @endforelse
    </tbody>
</table>
@if($rows->isNotEmpty())@include('ec._pager', ['p' => $page, 'noun' => $bundled ? 'rows · state counsellings grouped under their exam' : 'counsellings', 'anchor' => '#list'])@endif
</div>
