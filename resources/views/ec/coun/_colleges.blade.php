{{-- Counselling → Participating colleges: colleges and their courses, paged by the API. $institutes, $pager --}}
@php use App\Support\Ec\Ec; use Illuminate\Support\Str; @endphp
<section class="ec-osec ec-gutter" id="list"><div class="ec-wrap">
    <div class="ec-lhead tight"><h2>Participating colleges</h2><p>Colleges and courses that fill seats through {{ $c['name'] }}.</p></div>
    <form class="ec-subfilters" method="get" action="{{ route('counselling.colleges', $slug) }}#list" data-ec-autosubmit>
        @if($year)<input type="hidden" name="year" value="{{ $year }}">@endif
        <input name="q" type="search" class="ec-q" placeholder="Search a college or course" aria-label="Search colleges" value="{{ request('q') }}" data-ec-debounce>
    </form>
    <div class="ec-tcard"><table class="ec-t">
        <colgroup><col style="width:40%"><col style="width:34%"><col style="width:26%"></colgroup>
        <thead><tr><th>College</th><th>Courses</th><th class="r">Links</th></tr></thead>
        <tbody>
        @forelse($institutes['data'] ?? [] as $x)
            <tr class="ec-row"><td class="nmc"><div class="ec-nm"><span><b>{{ $x['college']['name'] }}</b><small>{{ implode(' · ', array_filter([$x['college']['city'] ?? null, $x['college']['state'] ?? null, implode(', ', $x['institute_types'] ?? [])])) }}</small></span></div></td>
                <td class="ec-dt" data-l="Courses"><b>{{ Str::limit(implode(', ', $x['courses'] ?? []), 90) }}</b><small>{{ implode(' · ', array_filter([implode(', ', $x['quotas'] ?? []), $x['seats'] ? Ec::num($x['seats']) . ' seats' : null])) }}</small></td>
                <td class="r act">@if($primary)<a class="ec-lk cut" href="{{ route('cutoffs.index', ['exam' => $primary['slug'], 'counselling' => $slug, 'q' => $x['college']['name']]) }}">Cutoff</a>@endif @if(!empty($x['college']['slug']))<a class="ec-see" href="{{ route('university.detail', $x['college']['slug']) }}">College →</a>@endif</td></tr>
        @empty
            <tr><td colspan="3"><div class="ec-empty"><b>{{ request('q') ? 'No college matches' : 'No participating colleges listed yet' }}</b>{{ request('q') ? 'Clear the search.' : 'They appear here once the counselling publishes them.' }}</div></td></tr>
        @endforelse
        </tbody>
    </table>
    @if($pager['total'])@include('ec._pager', ['p' => $pager, 'noun' => 'colleges', 'anchor' => '#list'])@endif
    </div>
</div></section>
