@extends('university.base')
@php
    use App\Support\University\UniversityData as U;
    $o = $u->org;
    $view = $items->take($f['shown']);
    $num = fn ($y) => $y ? rtrim(rtrim(number_format($y, 1), '0'), '.') : null;
@endphp
@section('meta_title', 'Courses and fees - ' . $o['name'] . ($scopeCampus ? ', ' . $scopeCampus['name'] : '') . ' | Enrollzy')
@section('meta_description', 'All courses at ' . $o['name'] . ' with fees per campus, duration, entrance exam and online options.')

@section('uz')
<div class="cz-page cz-gutter">
    <div class="cz-container cz-stack">
        <div class="uz-backrow"><a class="uz-back" href="{{ $L->overview() }}"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M12 4l-6 6 6 6"/></svg>Back to {{ $o['name'] }}</a></div>
        <h1 class="uz-title">Courses and fees</h1>
        @if($u->campuses->count() > 1)
            <div class="uz-note">@if($scope)Showing <b>{{ $scopeCampus['name'] }}</b>. <a class="cz-link" href="{{ route('university.courses', $o['slug']) }}" style="font-size:14.5px">Show all campuses</a>@else Showing <b>all {{ $u->campuses->count() }} campuses</b>. Pick a campus for its exact fees.@endif</div>
        @endif

        <form class="cz-fbar" method="get" action="{{ url()->current() }}" data-uz-autosubmit>
            <label class="cz-field grow" for="c-q">Search course<input id="c-q" type="search" name="q" value="{{ $f['q'] }}" placeholder="e.g. Computer Science" data-uz-debounce></label>
            @if($u->campuses->count() > 1)
                <label class="cz-field" for="c-camp">Campus
                    <select id="c-camp" name="campus"><option value="">All campuses</option>
                        @foreach($statesByCampus as $state => $cs)<optgroup label="{{ $state ?: 'Other' }}">@foreach($cs as $cc)<option value="{{ $cc['slug'] }}" @selected($scope === $cc['id'])>{{ $cc['name'] }}</option>@endforeach</optgroup>@endforeach
                    </select>
                </label>
            @endif
            @if($onlineCount)
                <label class="cz-field" for="c-mode">Mode<select id="c-mode" name="mode"><option value="">On campus + online</option><option value="campus" @selected($f['mode'] === 'campus')>On campus</option><option value="online" @selected($f['mode'] === 'online')>Online only</option></select></label>
            @endif
            <label class="cz-field" for="c-level">Level<select id="c-level" name="level"><option value="">All levels</option>@foreach($levels as $lv)<option @selected($f['level'] === $lv)>{{ $lv }}</option>@endforeach</select></label>
            <label class="cz-field" for="c-stream">Stream<select id="c-stream" name="stream"><option value="">All streams</option>@foreach($streams as $st)<option @selected($f['stream'] === $st)>{{ $st }}</option>@endforeach</select></label>
            <label class="cz-field" for="c-fee">Fees / year<select id="c-fee" name="fee"><option value="">Any</option>@foreach(['100000' => 'Under ₹1 L', '150000' => 'Under ₹1.5 L', '250000' => 'Under ₹2.5 L', '500000' => 'Under ₹5 L'] as $v => $l)<option value="{{ $v }}" @selected((string) $f['fee'] === $v)>{{ $l }}</option>@endforeach</select></label>
            <input type="hidden" name="sort" value="{{ $f['sort'] !== 'pop' ? $f['sort'] : '' }}">
            <noscript><button class="cz-btn cz-btn-blue cz-btn-sm">Apply</button></noscript>
        </form>

        <div class="cz-result-meta">
            <span>@if($items->count())Showing <b class="cz-num">{{ $view->count() }}</b> of <b class="cz-num">{{ $items->count() }}</b>@if($scopeCampus) · <span class="uz-campus-tag">{{ $scopeCampus['name'] }}</span>@endif @endif</span>
            <label class="cz-field" for="c-sort">Sort<select id="c-sort" data-uz-sort><option value="">Most offered</option><option value="fee" @selected($f['sort'] === 'fee')>Fees: low to high</option><option value="name" @selected($f['sort'] === 'name')>Name A–Z</option></select></label>
        </div>

        <div class="uz-grid">
            @forelse($view as $it)
                @php $p = $it['p']; @endphp
                @if($it['kind'] === 'online')
                    <div class="uz-card online">
                        <span class="uz-online-badge">Online</span>
                        <a class="t" href="{{ $L->online() }}">{{ $p['name'] }}</a>
                        <span class="m">{{ implode(' · ', array_filter([$p['level'], $p['years'] ? $num($p['years']) . ' years' : null, $p['mode']])) }}</span>
                        <div class="row"><span>{{ $p['exam_text'] ?? (collect($p['exams'])->pluck('name')->implode(' / ') ?: '') }}</span><span class="cz-num"><b>{{ $p['total_fee'] ? U::inr($p['total_fee']) : U::feeRange($p['annual_fee'], $p['annual_fee']) }}</b>{{ $p['total_fee'] ? ' total' : '' }}</span></div>
                        <a class="go" href="{{ $L->online() }}" style="color:var(--cz-online)">View online course →</a>
                    </div>
                @else
                    @php $one = $scope ? $p['offerings'][0] : null; @endphp
                    <div class="uz-card hov">
                        <a class="t" href="{{ $L->course($p['slug']) }}">{{ $p['name'] }}</a>
                        <span class="m">{{ implode(' · ', array_filter([$p['level'], $p['years'] ? $num($p['years']) . ' years' : null, $p['exam_text']])) }}</span>
                        <div class="row"><span>@if($scope)<span class="uz-campus-tag">{{ $scopeCampus['city'] ?: $scopeCampus['name'] }}</span>@else At <b class="cz-num">{{ $p['n'] }}</b> {{ \Illuminate\Support\Str::plural('campus', $p['n']) }}@endif</span><span class="cz-num"><b>{{ U::feeRange($p['fee_min'], $p['fee_max']) }}</b>{{ $p['fee_min'] ? '/yr' : '' }}</span></div>
                        <div class="acts"><a class="go" href="{{ $L->course($p['slug']) }}">View course →</a>
                            @if($one)<button type="button" class="uz-cmp-btn" data-uz-cmp="{{ $one['id'] }}" aria-pressed="false">+ Compare</button>
                            @else<a class="uz-cmp-btn" href="{{ $L->course($p['slug']) }}" style="text-decoration:none">Pick campus to compare</a>@endif
                        </div>
                    </div>
                @endif
            @empty
                <div class="cz-empty" style="grid-column:1/-1"><b>No course matches</b>Try "All campuses" or clear a filter.</div>
            @endforelse
        </div>
        @if($items->count() > $f['shown'])
            <div class="uz-more"><a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ request()->fullUrlWithQuery(['shown' => $f['shown'] + 24]) }}" data-uz-keep-scroll>Show more</a></div>
        @endif
    </div>
</div>
@endsection
