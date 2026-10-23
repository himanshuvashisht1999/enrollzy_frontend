{{-- Hub: exams by status (open, upcoming, closed), paged after ordering. $list (sorted), $page --}}
@php
    use App\Support\Ec\Ec;
    $G = [['Applications open', 'var(--green)', 'Apply before the closing date'], ['Upcoming', 'var(--blue)', 'Registration not open yet'], ['Applications closed', '#9aa6bb', 'Registration is over for this cycle']];
    $counts = $list->countBy(fn ($e) => $e['_s']['grp']);
    $last = null;
@endphp
<div class="ec-tcard"><table class="ec-t">
    <colgroup><col style="width:25%"><col style="width:18%"><col style="width:14%"><col style="width:19%"><col style="width:11%"><col style="width:13%"></colgroup>
    <thead><tr><th>Exam</th><th>Registration</th><th>Exam date</th><th>Counselling</th><th class="c">Status</th><th class="r">Details</th></tr></thead>
    <tbody>
    @forelse($page['items'] as $i => $e)
        @php $s = $e['_s']; @endphp
        @if($s['grp'] !== $last)
            @php $cont = $i === 0 && $page['from'] > 1 && ($list[$page['from'] - 2]['_s']['grp'] ?? null) === $s['grp']; @endphp
            <tr class="ec-grp"><td colspan="6" style="--c:{{ $G[$s['grp']][1] }}"><span>{{ $G[$s['grp']][0] }} · {{ $counts[$s['grp']] ?? 0 }}@if($cont) <em>continued</em>@endif</span><small>{{ $G[$s['grp']][2] }}</small></td></tr>
            @php $last = $s['grp']; @endphp
        @endif
        @php $cs = collect($e['counsellings'] ?? []); @endphp
        <tr class="ec-row{{ $s['grp'] === 2 ? ' ec-closedrow' : '' }}">
            <td class="nmc"><div class="ec-nm">@include('ec._lg', ['lgName' => $e['name'], 'lgShort' => $e['short_name'], 'lgLogo' => $e['logo_url'] ?? null, 'lgStream' => $e['categories'][0] ?? ''])<span><b><a href="{{ route('exam.detail', $e['slug']) }}">{{ $e['short_name'] ?: $e['name'] }}{{ !empty($e['cycle']['year']) && !str_contains((string) $e['short_name'], (string) $e['cycle']['year']) ? ' ' . $e['cycle']['year'] : '' }}</a></b><small>{{ implode(' · ', array_filter([$e['conducting_body']['short_name'] ?? $e['conducting_body']['name'] ?? null, $e['type_label'] ?? null])) }}</small></span></div></td>
            <td class="ec-dt" data-l="Registration">
                @if($s['rs'])<b>{{ Ec::fmt($s['rs'], false) }}{{ $s['re'] && !$s['re']->eq($s['rs']) ? ' – ' . Ec::fmt($s['re']) : '' }}</b>@else<b>{{ $e['status']['registration']['text'] ?? 'To be announced' }}</b>@endif
                @if($s['grp'] === 0 && $s['re'])<small class="{{ $s['state'] === 'closing' ? 'hot' : 'go' }}">Closes {{ Ec::inDays($s['re']) }}</small>
                @elseif($s['grp'] === 1 && $s['rs'])<small>Opens {{ Ec::inDays($s['rs']) }}</small>
                @elseif($s['grp'] === 2)<small>Closed</small>@endif
            </td>
            <td class="ec-dt" data-l="Exam date"><b>{{ $s['ex'] ? Ec::fmt($s['ex']) : ($e['status']['exam-date']['text'] ?? 'To be announced') }}</b><small>{{ $s['ex'] ? (Ec::days($s['ex']) < 0 ? 'Exam done' : ucfirst(Ec::inDays($s['ex']))) : '' }}</small></td>
            <td class="lkc">
                @forelse($cs->take(2) as $c)<a class="ec-lk coun" href="{{ route('counselling.show', $c['slug']) }}" title="{{ $c['name'] }}">{{ $c['short_name'] ?: $c['name'] }}</a>@empty<span class="ec-none">College-wise admission</span>@endforelse
                @if($cs->count() > 2)<a class="ec-lk more" href="{{ route('exam.tab', [$e['slug'], 'counselling']) }}">+{{ $cs->count() - 2 }} more</a>@endif
            </td>
            <td class="c stc"><span class="ec-st {{ $s['state'] }}">{{ Ec::EXAM_LABEL[$s['state']] }}</span></td>
            <td class="r act"><a class="ec-see" href="{{ route('exam.detail', $e['slug']) }}">See details <span aria-hidden="true">→</span></a></td>
        </tr>
    @empty
        <tr><td colspan="6"><div class="ec-empty"><b>No exams match</b>Try another category or clear the search.</div></td></tr>
    @endforelse
    </tbody>
</table>
@if($list->isNotEmpty())@include('ec._pager', ['p' => $page, 'noun' => 'exams', 'anchor' => '#list'])@endif
</div>
