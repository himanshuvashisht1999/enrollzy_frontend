{{-- Exam → Cutoffs tab: latest closing ranks of one of the exam's counsellings (choose another), then the full finder. $coun, $preview --}}
@php
    use App\Support\Ec\Ec;
    $nm = $e['short_name'] ?: $e['name'];
    $label = fn ($c) => $c['level'] === 'state' && !empty($c['states']) ? $c['states'][0] : ($c['short_name'] ?: $c['name']);
@endphp
<section class="ec-osec ec-gutter"><div class="ec-wrap">
    @if(!$coun)
        <div class="ec-lhead tight"><h2>Cutoffs</h2></div>
        <div class="ec-note"><b>No central cutoffs</b>Colleges accepting {{ $nm }} publish their own cutoffs on their pages.</div>
    @else
        <div class="ec-lhead tight"><h2>{{ $nm }} cutoffs</h2><p>@if($preview)Closing {{ !empty($preview['rows'][0]) && !$preview['rows'][0]['higher_is_worse'] ? mb_strtolower($preview['rows'][0]['rank_type_label']) . 's' : 'ranks' }} from {{ preg_replace('/\s\d{4}$/', '', $coun['name']) }} {{ $preview['year'] }}, {{ $preview['round']['name'] }}{{ $preview['category'] ? ', ' . $preview['category']['name'] : '' }}.@else{{ $coun['name'] }} has not published cutoffs yet.@endif {{ $counsellings->count() > 1 ? 'Choose another counselling below.' : '' }}</p></div>
        @if($counsellings->count() > 1)
            <form class="ec-subfilters" method="get" action="{{ route('exam.tab', [$slug, 'cutoffs']) }}" data-ec-autosubmit>
                <label class="ec-mystate">Counselling<select name="counselling">
                    @php $ai = $counsellings->filter(fn ($c) => $c['level'] !== 'state'); @endphp @php $st = $counsellings->filter(fn ($c) => $c['level'] === 'state'); @endphp
                    @if($ai->isNotEmpty() && $st->isNotEmpty())
                        <optgroup label="All India ({{ $ai->count() }})">@foreach($ai as $c)<option value="{{ $c['slug'] }}" @selected($c['slug'] === $coun['slug'])>{{ $label($c) }}</option>@endforeach</optgroup>
                        <optgroup label="State counselling ({{ $st->count() }})">@foreach($st as $c)<option value="{{ $c['slug'] }}" @selected($c['slug'] === $coun['slug'])>{{ $label($c) }}</option>@endforeach</optgroup>
                    @else
                        @foreach($counsellings as $c)<option value="{{ $c['slug'] }}" @selected($c['slug'] === $coun['slug'])>{{ $label($c) }}</option>@endforeach
                    @endif
                </select></label>
            </form>
        @endif
        @if($preview && $preview['rows'])
            @php $unit = $preview['rows'][0]['higher_is_worse'] ? 'rank' : mb_strtolower($preview['rows'][0]['rank_type_label']); @endphp
            <div class="ec-tcard"><table class="ec-t">
                <colgroup><col style="width:56%"><col style="width:22%"><col style="width:22%"></colgroup>
                <thead><tr><th>College and course</th><th class="num">Opening {{ $unit }}</th><th class="num">Closing {{ $unit }}</th></tr></thead>
                <tbody>@foreach($preview['rows'] as $r)<tr class="ec-row"><td class="nmc"><div class="ec-nm"><span><b>{{ $r['college']['name'] }}</b><small>{{ $r['course']['name'] }} · {{ $r['quota'] }}</small></span></div></td><td class="num numc" data-l="Opening {{ $unit }}">{{ Ec::num($r['opening_value']) }}</td><td class="num numc" data-l="Closing {{ $unit }}"><b>{{ Ec::num($r['closing_value']) }}</b></td></tr>@endforeach</tbody>
            </table>
            <div class="ec-tfoot"><span>Top {{ count($preview['rows']) }} of {{ number_format($preview['total']) }} rows</span><a class="ec-see" href="{{ route('cutoffs.index', ['exam' => $slug, 'counselling' => $coun['slug']]) }}">All cutoffs, categories and rounds →</a></div></div>
        @else
            <div class="ec-note"><b>No cutoffs yet</b>Cutoffs appear round by round as {{ $coun['name'] }} publishes them.</div>
        @endif
    @endif
</div></section>
