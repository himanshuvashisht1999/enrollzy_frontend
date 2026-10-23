@extends('university.base')
@php
    use App\Support\University\UniversityData as U;
    $o = $u->org;
    $f = $prog['first'];
    $num = fn ($y) => $y ? rtrim(rtrim(number_format($y, 1), '0'), '.') : null;
    $fees = $offerings->pluck('annual_fee')->filter();
    $seats = $offerings->sum(fn ($x) => $x['seats'] ?? 0);
    $exams = $offerings->flatMap(fn ($x) => $x['exams'])->unique('slug')->values();
    $place = $sel ? $u->offeringPlacement($sel) : null;
    $placeAll = $placements->pluck('p');
    $avg = fn ($k) => ($v = $placeAll->pluck($k)->filter()) && $v->isNotEmpty() ? round($v->avg(), 1) : null;
    $P = $place ?? ($placeAll->isNotEmpty() ? ['pct' => $avg('pct') ? round($avg('pct')) : null, 'median' => $avg('median'), 'average' => $avg('average'), 'highest' => $placeAll->pluck('highest')->filter()->max(), 'recruiters' => null] : null);
    $states = $offerings->pluck('campus.state')->filter()->unique()->sort()->values();
    $rows = $offerings->sortBy(fn ($x) => $x['annual_fee'] ?: PHP_INT_MAX)->values();
    if ($sel) $rows = collect([$sel])->concat($rows->reject(fn ($x) => $x['id'] === $sel['id']))->values();
    $cats = collect($cutoffs)->pluck('category')->unique()->values();
@endphp
@section('meta_title', $prog['name'] . ' at ' . $o['name'] . ' - Fees, Campuses, Placements | Enrollzy')
@section('meta_description', $prog['name'] . ' at ' . $o['name'] . ': fees at each campus, seats, eligibility, placements and cutoffs.')

@section('uz')
<div class="cz-page cz-gutter">
    <div class="cz-container cz-grid2">
        <div class="cz-stack">
            <div>
                <div class="uz-backrow">
                    <a class="uz-back" href="{{ $L->courses() }}"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M12 4l-6 6 6 6"/></svg>All courses</a>
                    <nav class="cz-crumbs" aria-label="Breadcrumb"><a href="{{ $L->overview() }}">{{ $o['name'] }}</a>›<a href="{{ $L->courses() }}">Courses</a>›<span>{{ $prog['name'] }}</span></nav>
                </div>
                <h1 class="uz-title">{{ $prog['name'] }}</h1>
                <div class="cz-chips" style="margin-top:8px">
                    @if($f['level'])<span class="cz-tag blue">{{ $f['level'] }}</span>@endif
                    @if($f['years'])<span class="cz-tag">{{ $num($f['years']) }} years</span>@endif
                    @if($f['stream'])<span class="cz-tag">{{ $f['stream'] }}</span>@endif
                    @if($offerings->count())<span class="cz-tag">Offered at {{ $offerings->count() }} {{ \Illuminate\Support\Str::plural('campus', $offerings->count()) }}</span>@endif
                </div>
            </div>
            @if($u->campuses->count() > 1)
                <div class="uz-note">@if($scope)Showing <b>{{ $scopeCampus['name'] }}</b>. <a class="cz-link" href="{{ route('university.course', ['slug' => $o['slug'], 'course' => $prog['slug']]) }}" style="font-size:14.5px">Show all campuses</a>@else Showing <b>all campuses</b>. Pick a campus at the top for its exact fee, seats and hostel.@endif</div>
            @endif

            <div class="cz-card">
                @if($scope && !$sel)
                    <div class="cz-empty"><b>Not offered at {{ $scopeCampus['name'] }}</b>See the campuses that offer it below, or <a href="{{ route('university.course', ['slug' => $o['slug'], 'course' => $prog['slug']]) }}">show all campuses</a>.</div>
                @elseif($sel)
                    <div class="uz-stats">
                        <div class="uz-stat"><span class="k">Fees / year at {{ $sel['campus']['city'] ?: $sel['campus']['name'] }}</span><span class="v cz-num">{{ $sel['annual_fee'] ? U::lakh($sel['annual_fee']) : 'On request' }}</span></div>
                        @if($sel['total_fee'])<div class="uz-stat"><span class="k">Total course fee</span><span class="v cz-num">{{ U::lakh($sel['total_fee']) }}</span></div>@endif
                        @if($sel['seats'])<div class="uz-stat"><span class="k">Seats</span><span class="v cz-num">{{ number_format($sel['seats']) }}</span></div>@endif
                        @if($place && $place['median'])<div class="uz-stat"><span class="k">Median package</span><span class="v cz-num">{{ U::lpa($place['median']) }}</span></div>@endif
                        @if($sel['exams'])<div class="uz-stat"><span class="k">Exam</span><span class="v">{{ collect($sel['exams'])->pluck('name')->implode(' / ') }}</span></div>@endif
                    </div>
                @else
                    <div class="uz-stats">
                        <div class="uz-stat"><span class="k">Fees / year</span><span class="v cz-num">{{ $fees->isNotEmpty() ? U::feeRange($fees->min(), $fees->max()) : 'On request' }}</span></div>
                        <div class="uz-stat"><span class="k">Campuses</span><span class="v cz-num">{{ $offerings->count() ?: 'Online' }}</span></div>
                        @if($seats)<div class="uz-stat"><span class="k">Total seats</span><span class="v cz-num">{{ number_format($seats) }}</span></div>@endif
                        @if($exams->isNotEmpty())<div class="uz-stat"><span class="k">Exam</span><span class="v">{{ $exams->pluck('name')->implode(' / ') }}</span></div>@endif
                    </div>
                @endif
            </div>

            @if($prog['online'])
                <div class="cz-card">
                    <div class="uz-online-strip" style="border:0;padding:0;background:none">
                        <span class="uz-online-badge">Also online</span>
                        <div class="t"><b>{{ $prog['name'] }} online{{ $prog['online']['total_fee'] ? ': ' . U::inr($prog['online']['total_fee']) . ' total' : '' }}</b><span>Same university, study from anywhere.</span></div>
                        <a class="cz-btn uz-btn-online cz-btn-sm" href="{{ $L->online() }}">View online version</a>
                    </div>
                </div>
            @endif

            @if($offerings->isNotEmpty())
                <div class="cz-card" data-uz-feetable>
                    <div class="cz-head-row"><h2>Fees by campus</h2><span class="cz-muted cz-small" data-uz-fee-count>{{ $offerings->count() }} {{ \Illuminate\Support\Str::plural('campus', $offerings->count()) }}</span></div>
                    <p class="sub">Fees, seats and hostel can differ by campus.{{ $sel ? ' Your selected campus is pinned and highlighted.' : '' }}</p>
                    @if($offerings->count() > 5)
                        <div class="uz-tools">
                            <label class="cz-field grow" for="fee-q">Find a campus<input id="fee-q" type="search" placeholder="City or state" data-uz-fee-q></label>
                            @if($states->count() > 1)<label class="cz-field" for="fee-state">State<select id="fee-state" data-uz-fee-state><option value="">All states</option>@foreach($states as $st)<option>{{ $st }}</option>@endforeach</select></label>@endif
                        </div>
                    @endif
                    <div class="cz-tbl-wrap"><table>
                        <thead><tr><th>Campus</th><th class="r">Tuition / year</th><th class="r">Total course fee</th><th class="r">Seats</th><th>Hostel</th><th></th></tr></thead>
                        <tbody>
                            @foreach($rows as $x)
                                <tr @if($sel && $x['id'] === $sel['id']) class="mine" @endif data-uz-fee-row="{{ mb_strtolower(($x['campus']['name'] ?? '') . ' ' . ($x['campus']['city'] ?? '') . ' ' . ($x['campus']['state'] ?? '')) }}" data-uz-state="{{ $x['campus']['state'] ?? '' }}">
                                    <td><a class="rowlink" href="{{ $L->campus($x['campus']['slug'] ?? null) }}">{{ $x['campus']['name'] ?? 'Campus' }}</a><span class="small">{{ $x['campus']['state'] ?? '' }}{{ $sel && $x['id'] === $sel['id'] ? ' · your selected campus' : '' }}</span></td>
                                    <td class="r cz-num">{{ U::inr($x['annual_fee']) }}</td>
                                    <td class="r cz-num">{{ U::inr($x['total_fee']) }}</td>
                                    <td class="r cz-num">{{ $x['seats'] ? number_format($x['seats']) : '–' }}</td>
                                    <td>{{ ($x['campus']['hostel'] ?? false) ? 'Yes' . ($x['hostel_fee'] ? ' · ' . U::inr($x['hostel_fee']) : '') : 'No' }}</td>
                                    <td class="r"><button type="button" class="uz-cmp-btn" data-uz-cmp="{{ $x['id'] }}" aria-pressed="false">+ Compare</button></td>
                                </tr>
                            @endforeach
                            <tr data-uz-fee-none hidden><td colspan="6">No campus matches. Clear the search.</td></tr>
                        </tbody>
                    </table></div>
                </div>
            @endif

            @if($ref && $ref['fee_structure'])
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Fee details</h2>@if(!$sel && ($ref['campus_id'] ?? null))<span class="uz-campus-tag">{{ $u->campus($ref['campus_id'])['name'] ?? '' }}</span>@endif</div>
                    <p class="uz-fee-text uz-clamp" data-uz-clamp style="margin-top:8px">{{ $ref['fee_structure'] }}</p>
                    <button type="button" class="cz-link" data-uz-clamp-btn hidden>Read more</button>
                </div>
            @endif

            @if($P)
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Placements for this course</h2><span class="uz-campus-tag">{{ $sel ? $sel['campus']['name'] : 'All campuses (average)' }}</span></div>
                    <div class="uz-stats" style="margin-top:10px">
                        @if($P['pct'])<div class="uz-stat"><span class="k">Students placed</span><span class="v cz-num">{{ $P['pct'] }}%</span></div>@endif
                        @if($P['median'])<div class="uz-stat"><span class="k">Median package</span><span class="v cz-num">{{ U::lpa($P['median']) }}</span></div>@endif
                        @if($P['average'])<div class="uz-stat"><span class="k">Average package</span><span class="v cz-num">{{ U::lpa($P['average']) }}</span></div>@endif
                        @if($P['highest'])<div class="uz-stat"><span class="k">Highest package</span><span class="v cz-num">{{ U::lpa($P['highest']) }}</span></div>@endif
                        @if($P['recruiters'])<div class="uz-stat"><span class="k">Recruiters</span><span class="v cz-num">{{ $P['recruiters'] }}</span></div>@endif
                    </div>
                    @if(count($placementYears) > 1)
                        <h3>By year</h3>
                        <div class="cz-tbl-wrap"><table><thead><tr><th>Year</th><th class="r">Placed</th><th class="r">Median</th><th class="r">Average</th><th class="r">Highest</th></tr></thead><tbody>
                            @foreach(array_slice($placementYears, 0, 3) as $y)<tr><td class="cz-num">{{ $y['year'] ?: '–' }}</td><td class="r cz-num">{{ $y['pct'] ? $y['pct'] . '%' : '–' }}</td><td class="r cz-num">{{ U::lpa($y['median']) }}</td><td class="r cz-num">{{ U::lpa($y['average']) }}</td><td class="r cz-num">{{ U::lpa($y['highest']) }}</td></tr>@endforeach
                        </tbody></table></div>
                    @endif
                    @if($placements->count() > 1)
                        <h3>Placements by campus</h3>
                        <div class="cz-tbl-wrap"><table><thead><tr><th>Campus</th><th class="r">Placed</th><th class="r">Median</th><th class="r">Year</th></tr></thead><tbody>
                            @foreach($placements->sortByDesc(fn ($r) => $r['p']['median'] ?? 0) as $r)<tr @if($sel && $r['o']['id'] === $sel['id']) class="mine" @endif><td>{{ $r['o']['campus']['name'] ?? '' }}</td><td class="r cz-num">{{ $r['p']['pct'] ? $r['p']['pct'] . '%' : '–' }}</td><td class="r cz-num">{{ U::lpa($r['p']['median']) }}</td><td class="r cz-num">{{ $r['p']['year'] ?: '–' }}</td></tr>@endforeach
                        </tbody></table></div>
                    @endif
                    <p class="cz-source">Placement figures are recorded per course and campus, or per department where that is all the university publishes.</p>
                </div>
            @endif

            @if($cutoffs->isNotEmpty())
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Cutoffs</h2></div>
                    @if($cats->count() > 1)
                        <div class="uz-tools"><label class="cz-field" for="co-cat">Category<select id="co-cat" data-uz-cat>@foreach($cats as $cat)<option @selected($cat === 'General')>{{ $cat }}</option>@endforeach</select></label></div>
                    @endif
                    <div class="cz-tbl-wrap"><table><thead><tr><th>Counselling</th><th>Round</th><th>Quota</th><th class="r">Closing</th></tr></thead><tbody>
                        @foreach($cutoffs as $x)<tr data-uz-cat-row="{{ $x['category'] }}" @if($cats->count() > 1 && $x['category'] !== ($cats->contains('General') ? 'General' : $cats->first())) hidden @endif><td><a href="{{ $x['counselling_url'] }}">{{ $x['counselling'] }}</a></td><td>{{ $x['round'] }}{{ $x['year'] ? ' ' . $x['year'] : '' }}</td><td>{{ $x['quota'] }}</td><td class="r cz-num">{{ number_format($x['closing']) }}</td></tr>@endforeach
                    </tbody></table></div>
                </div>
            @endif

            @php $e = $sel ?? $ref; @endphp
            @if($e && ($e['eligibility'] || $e['admission'] || $e['mode']))
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Eligibility and admission</h2></div>
                    @if($e['eligibility'])<p style="margin-top:8px">{{ $e['eligibility'] }}</p>@endif
                    <dl class="uz-kv">
                        @if($e['mode'])<dt>Mode</dt><dd>{{ $e['mode'] }}</dd>@endif
                        @if($f['years'])<dt>Duration</dt><dd>{{ $num($f['years']) }} years</dd>@endif
                        @if($exams->isNotEmpty())<dt>Entrance exam</dt><dd>@foreach($exams as $ex)<a href="{{ route('exam.detail', $ex['slug']) }}">{{ $ex['name'] }}</a>{{ $loop->last ? '' : ' / ' }}@endforeach</dd>@endif
                        @if($sel ? $sel['seats'] : $seats)<dt>Seats {{ $sel ? 'at ' . ($sel['campus']['city'] ?: $sel['campus']['name']) : 'in total' }}</dt><dd class="cz-num">{{ number_format($sel ? $sel['seats'] : $seats) }}</dd>@endif
                    </dl>
                    @if($e['admission'])<details class="cz-acc" style="margin-top:12px"><summary>How admission works</summary><div class="cz-acc-body">{{ $e['admission'] }}</div></details>@endif
                </div>
            @endif

            @if($dept)
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Department</h2></div>
                    <div class="uz-grid" style="margin-top:8px">@include('university._dept', ['d' => $dept, 'where' => $u->campus($dept['campus_id'])['name'] ?? null])</div>
                </div>
            @endif

            @if($f['specializations'] || ($e['curriculum'] ?? null) || ($e['careers'] ?? null))
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Specialisations, curriculum and careers</h2></div>
                    @if($f['specializations'])<div class="cz-chips" style="margin:8px 0">@foreach($f['specializations'] as $sp)<span class="cz-tag">{{ $sp }}</span>@endforeach</div>@endif
                    @if($e['curriculum'] ?? null)<details class="cz-acc"><summary>Curriculum</summary><div class="cz-acc-body">{{ $e['curriculum'] }}</div></details>@endif
                    @if($e['careers'] ?? null)<details class="cz-acc"><summary>Career prospects</summary><div class="cz-acc-body">{{ $e['careers'] }}</div></details>@endif
                </div>
            @endif

            @if($offerings->contains('scholarship', true))
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Scholarships for this course</h2></div>
                    <p style="margin-top:8px">The university offers scholarships for this course{{ $offerings->where('scholarship', true)->count() < $offerings->count() ? ' at some campuses' : '' }}. Our admission experts can tell you who qualifies and how much.</p>
                    <a class="cz-btn cz-btn-outline cz-btn-sm" href="#enquire" data-uz-enquire="Scholarship" data-uz-course="{{ $prog['name'] }}">Ask about scholarships</a>
                </div>
            @endif

            @if($reviews['count'])
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Reviews</h2><span class="uz-campus-tag">{{ $sel ? $sel['campus']['name'] : 'All campuses' }}</span></div>
                    <div style="margin-top:8px">@include('university._reviews', ['r' => $reviews])</div>
                </div>
            @endif

            <div class="cz-card">
                <div class="cz-head-row"><h2>FAQs about this course</h2></div>
                <div style="margin-top:8px">
                    @if($u->campuses->count() > 1)
                        <details class="cz-acc"><summary>Is {{ $prog['name'] }} offered at every campus?</summary><div class="cz-acc-body">{{ $offerings->count() >= $u->campuses->count() ? 'Yes, at all ' . $u->campuses->count() . ' campuses.' : 'No. It is offered at ' . $offerings->count() . ' of the ' . $u->campuses->count() . ' campuses: ' . $offerings->pluck('campus.name')->implode(', ') . '.' }}</div></details>
                    @endif
                    <details class="cz-acc"><summary>What is the fee for {{ $prog['name'] }}?</summary><div class="cz-acc-body">{{ $fees->isNotEmpty() ? ($fees->min() == $fees->max() ? U::inr($fees->min()) . ' a year.' : 'From ' . U::inr($fees->min()) . ' to ' . U::inr($fees->max()) . ' a year, depending on the campus.') : 'The university has not published the fee yet. Our admission experts can find out for you.' }}</div></details>
                    @if($exams->isNotEmpty())<details class="cz-acc"><summary>Which entrance exam is needed?</summary><div class="cz-acc-body">{{ $exams->pluck('name')->implode(' or ') }}.</div></details>@endif
                </div>
            </div>

            <div class="cz-card">
                <div class="cz-head-row"><h2>Compare this course</h2><a class="cz-link" href="{{ route('university.compare', array_filter(['slug' => $o['slug'], 'campus' => $scopeCampus['slug'] ?? null, 'course' => $prog['slug']])) }}">Open compare →</a></div>
                <p class="sub">Start with related courses here, or the same course at other universities.</p>
                <div class="cz-chips">
                    <a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ route('university.compare', array_filter(['slug' => $o['slug'], 'campus' => $scopeCampus['slug'] ?? null, 'course' => $prog['slug']])) }}">With related courses here</a>
                    <a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ route('university.compare', array_filter(['slug' => $o['slug'], 'campus' => $scopeCampus['slug'] ?? null, 'course' => $prog['slug'], 'tab' => 'same-course'])) }}">With other universities</a>
                </div>
            </div>
        </div>

        <aside class="cz-aside">
            <div class="cz-side-card cta" id="enquire">
                <h3>Interested in this course?</h3>
                <p>{{ $sel ? 'Apply for ' . $prog['name'] . ' at ' . ($sel['campus']['city'] ?: $sel['campus']['name']) . '.' : 'Our admission experts will help you pick the right campus.' }}</p>
                @include('university._enquiry', ['id' => 'enq-side', 'course' => $prog['name']])
            </div>
            <div class="cz-side-card">
                <h3>Add to compare</h3>
                <p>Compare fees and placements side by side.</p>
                @if($sel)<button class="cz-btn cz-btn-outline" type="button" data-uz-cmp="{{ $sel['id'] }}" aria-pressed="false">+ Add to compare</button>
                @else<p class="cz-small cz-muted">Pick a campus at the top, or use "+ Compare" in the fees table.</p>@endif
            </div>
        </aside>
    </div>
</div>
@endsection
