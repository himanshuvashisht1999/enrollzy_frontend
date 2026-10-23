{{-- Exam → Colleges tab: every college course on Enrollzy that admits through this exam, paged. $pager --}}
@php $nm = $e['short_name'] ?: $e['name']; @endphp
<section class="ec-osec ec-gutter" id="list"><div class="ec-wrap">
    <div class="ec-lhead tight"><h2>Colleges accepting {{ $nm }}</h2><p>Every college and course on Enrollzy that admits through this exam.</p></div>
    <div class="ec-tcard"><table class="ec-t">
        <colgroup><col style="width:44%"><col style="width:36%"><col style="width:20%"></colgroup>
        <thead><tr><th>College</th><th>Course</th><th class="r">Details</th></tr></thead>
        <tbody>
        @forelse($pager['items'] as $c)
            <tr class="ec-row"><td class="nmc"><div class="ec-nm"><span><b>{{ $c['college'] }}</b>@if($c['place'])<small>{{ $c['place'] }}</small>@endif</span></div></td>
                <td class="ec-dt" data-l="Course"><b>{{ $c['course'] }}</b></td>
                <td class="r act">@if($c['url'])<a class="ec-see" href="{{ $c['url'] }}">Course page →</a>@endif</td></tr>
        @empty
            <tr><td colspan="3"><div class="ec-empty"><b>No colleges listed yet</b></div></td></tr>
        @endforelse
        </tbody>
    </table>
    @if($pager['total'])@include('ec._pager', ['p' => $pager, 'noun' => 'colleges and courses', 'anchor' => '#list'])@endif
    </div>
</div></section>
