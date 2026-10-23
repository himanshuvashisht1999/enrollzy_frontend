{{-- Counselling → Cutoffs tab: the latest closing ranks, then the full finder. $preview --}}
@php use App\Support\Ec\Ec; @endphp
<section class="ec-osec ec-gutter"><div class="ec-wrap">
    @if($preview && $preview['rows'])
        @php $unit = $preview['rows'][0]['higher_is_worse'] ? 'rank' : mb_strtolower($preview['rows'][0]['rank_type_label']); @endphp
        <div class="ec-lhead tight"><h2>Cutoffs</h2><p>Closing {{ $unit }}s from {{ $preview['year'] }}, {{ $preview['round']['name'] }}{{ $preview['category'] ? ', ' . $preview['category']['name'] : '' }}.</p></div>
        <div class="ec-tcard"><table class="ec-t">
            <colgroup><col style="width:56%"><col style="width:22%"><col style="width:22%"></colgroup>
            <thead><tr><th>College and course</th><th class="num">Opening {{ $unit }}</th><th class="num">Closing {{ $unit }}</th></tr></thead>
            <tbody>@foreach($preview['rows'] as $r)<tr class="ec-row"><td class="nmc"><div class="ec-nm"><span><b>{{ $r['college']['name'] }}</b><small>{{ $r['course']['name'] }} · {{ $r['quota'] }}</small></span></div></td><td class="num numc" data-l="Opening {{ $unit }}">{{ Ec::num($r['opening_value']) }}</td><td class="num numc" data-l="Closing {{ $unit }}"><b>{{ Ec::num($r['closing_value']) }}</b></td></tr>@endforeach</tbody>
        </table>
        <div class="ec-tfoot"><span>Top {{ count($preview['rows']) }} of {{ number_format($preview['total']) }} rows</span>@if($primary)<a class="ec-see" href="{{ route('cutoffs.index', ['exam' => $primary['slug'], 'counselling' => $slug]) }}">All cutoffs, categories and rounds →</a>@endif</div></div>
    @else
        <div class="ec-lhead tight"><h2>Cutoffs</h2></div>
        <div class="ec-note"><b>No cutoffs yet</b>Cutoffs appear round by round as {{ $c['name'] }} publishes them.</div>
    @endif
</div></section>
