@extends('university.base')
@php
    use App\Support\University\UniversityData as U;
    $o = $u->org;
    $cityLabel = $c['city'] && !str_contains(mb_strtolower($c['name']), mb_strtolower($c['city'])) ? $c['city'] : null;
    $about = array_filter([
        'Campus type' => $c['main'] ? 'Main campus' : ($c['type'] ?: null),
        'Established' => $c['established'],
        'Address' => $c['address'] ?: implode(', ', array_filter([$c['city'], $c['state']])),
        'Nearest transport' => $c['transport'],
        'Landmark' => $c['landmark'],
    ]);
    $stats = array_filter([
        'Area' => $c['area'] ? rtrim(rtrim(number_format($c['area'], 1), '0'), '.') . ' ' . $c['area_unit'] : null,
        'Students' => $c['students'] ? number_format($c['students']) : null,
        'Courses' => $courses->count() ?: null,
        'Hostel' => $c['hostel'] ? 'Yes' : 'No',
        'Rating' => $reviews['rating'] ? $reviews['rating'] . ' / 5' : null,
    ]);
@endphp
@section('meta_title', $c['name'] . ' - ' . $o['name'] . ': Courses, Fees, Hostel | Enrollzy')
@section('meta_description', $c['name'] . ' of ' . $o['name'] . ': courses and fees, hostel, infrastructure, transport and placements.')

@section('uz')
<div class="cz-page cz-gutter">
    <div class="cz-container cz-grid2">
        <div class="cz-stack">
            <div>
                <div class="uz-backrow">
                    <a class="uz-back" href="{{ $L->overview() }}"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M12 4l-6 6 6 6"/></svg>Back to {{ $o['name'] }}</a>
                    <nav class="cz-crumbs" aria-label="Breadcrumb"><a href="{{ $L->overview() }}">{{ $o['name'] }}</a>›<span>Campuses</span>›<span>{{ $c['name'] }}</span></nav>
                </div>
                <h1 class="uz-title">{{ $c['full_name'] }}</h1>
                <p style="margin:6px 0 0;color:var(--cz-ink-2)">{{ implode(' · ', array_filter([implode(', ', array_filter([$cityLabel, $c['state']])), $courses->count() ? $courses->count() . ' ' . \Illuminate\Support\Str::plural('course', $courses->count()) : null, $c['students'] ? number_format($c['students']) . ' students' : null])) }}</p>
            </div>

            @if($u->campuses->count() > 1)
                <div class="cz-card" data-uz-finder>
                    <div class="cz-head-row"><h2>Find a campus</h2><span class="cz-muted cz-small" data-uz-finder-count>{{ $u->campuses->count() }} campuses</span></div>
                    <div class="uz-tools">
                        <label class="cz-field grow" for="ca-q">City, state or course<input id="ca-q" type="search" placeholder="e.g. Pune, or MBA" data-uz-finder-q></label>
                        @if($statesByCampus->count() > 1)<label class="cz-field" for="ca-state">State<select id="ca-state" data-uz-finder-state><option value="">All states</option>@foreach($statesByCampus->keys() as $st)<option>{{ $st }}</option>@endforeach</select></label>@endif
                    </div>
                    <div class="uz-grid">@foreach($u->campuses as $cc)@include('university._campus_card', ['cc' => $cc, 'mine' => $cc['id'] === $c['id']])@endforeach</div>
                    <div class="cz-empty" data-uz-finder-none hidden><b>No campus matches</b>Try a city or state name.</div>
                </div>
            @endif

            <div class="cz-card"><div class="uz-stats">@foreach($stats as $k => $v)<div class="uz-stat"><span class="k">{{ $k }}</span><span class="v cz-num">{{ $v }}</span></div>@endforeach</div></div>

            @if($about)
                <div class="cz-card">
                    <div class="cz-head-row"><h2>About this campus</h2></div>
                    <dl class="uz-kv" style="margin-top:8px">@foreach($about as $k => $v)<dt>{{ $k }}</dt><dd style="{{ in_array($k, ['Address', 'Nearest transport', 'Landmark']) ? 'font-weight:500' : '' }}">{{ $v }}</dd>@endforeach</dl>
                    <div style="margin-top:12px"><a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ $c['map'] ?: 'https://www.google.com/maps/search/' . rawurlencode($c['name'] . ' ' . $c['city'] . ' ' . $c['state']) }}" target="_blank" rel="noopener">Open in Google Maps ↗</a></div>
                </div>
            @endif

            @if($c['infra'])
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Infrastructure and library</h2></div>
                    <div class="uz-stats" style="margin-top:8px">@foreach($c['infra'] as $k => $v)<div class="uz-stat"><span class="k">{{ $k }}</span><span class="v cz-num">{{ is_numeric($v) ? number_format($v) : $v }}</span></div>@endforeach</div>
                </div>
            @endif

            @if($c['safety'])
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Transport and safety</h2></div>
                    <div class="cz-chips" style="margin-top:8px">@foreach($c['safety'] as $label => $yes)<span class="cz-tag">✓ {{ $label }}</span>@endforeach</div>
                </div>
            @endif

            <div class="cz-card">
                <div class="cz-head-row"><h2>Courses at this campus</h2><a class="cz-link" href="{{ $L->courses() }}">See with filters →</a></div>
                @if($courses->isNotEmpty())
                    <div class="cz-tbl-wrap" style="margin-top:8px"><table><thead><tr><th>Course</th><th>Exam</th><th class="r">Fees / year</th><th class="r">Seats</th></tr></thead><tbody>
                        @foreach($courses->take(25) as $p)<tr><td><a class="rowlink" href="{{ $L->course($p['slug'], $c['slug']) }}">{{ $p['name'] }}</a><span class="small">{{ implode(' · ', array_filter([$p['level'], $p['stream']])) }}</span></td><td>{{ $p['exam_text'] ?? '–' }}</td><td class="r cz-num">{{ U::inr($p['fee_min']) }}</td><td class="r cz-num">{{ $p['seats_total'] ? number_format($p['seats_total']) : '–' }}</td></tr>@endforeach
                    </tbody></table></div>
                    @if($courses->count() > 25)<div class="uz-more"><a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ $L->courses() }}">All {{ $courses->count() }} courses at this campus</a></div>@endif
                @else
                    <div class="cz-empty"><b>No courses listed for this campus yet</b></div>
                @endif
            </div>

            @if($placements->isNotEmpty() || $campusPlacement)
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Placements at this campus</h2></div>
                    @if($campusPlacement)
                        <div class="uz-stats" style="margin:8px 0">
                            @if($campusPlacement['median'])<div class="uz-stat"><span class="k">Median package</span><span class="v cz-num">{{ U::lpa($campusPlacement['median']) }}</span></div>@endif
                            @if($campusPlacement['pct'])<div class="uz-stat"><span class="k">Students placed</span><span class="v cz-num">{{ $campusPlacement['pct'] }}%</span></div>@endif
                            @if($campusPlacement['highest'])<div class="uz-stat"><span class="k">Highest package</span><span class="v cz-num">{{ U::lpa($campusPlacement['highest']) }}</span></div>@endif
                        </div>
                    @endif
                    @if($placements->count() > 1)
                        <div class="cz-tbl-wrap"><table><thead><tr><th>Course</th><th class="r">Placed</th><th class="r">Median</th><th class="r">Year</th></tr></thead><tbody>
                            @foreach($placements->sortByDesc(fn ($r) => $r['p']['median'] ?? 0)->take(15) as $r)<tr><td><a class="rowlink" href="{{ $L->course($r['o']['slug'], $c['slug']) }}">{{ $r['o']['name'] }}</a></td><td class="r cz-num">{{ $r['p']['pct'] ? $r['p']['pct'] . '%' : '–' }}</td><td class="r cz-num">{{ U::lpa($r['p']['median']) }}</td><td class="r cz-num">{{ $r['p']['year'] ?: '–' }}</td></tr>@endforeach
                        </tbody></table></div>
                    @endif
                </div>
            @endif

            <div class="cz-card">
                <div class="cz-head-row"><h2>Hostel and facilities</h2></div>
                <p style="margin-top:8px">@if($c['hostel']){{ implode(' ', array_filter(['Hostel available' . ($c['hostel_type'] ? ' (' . $c['hostel_type'] . ')' : '') . '.', $c['hostel_capacity'] ? 'Capacity ' . number_format($c['hostel_capacity']) . '.' : null])) }}@else No hostel listed for this campus. Our admission experts can share verified stays nearby.@endif</p>
                @if($c['facilities'] || $c['sports'])<div class="cz-chips">@foreach(array_merge($c['facilities'], $c['sports']) as $fac)<span class="cz-tag">{{ is_string($fac) ? $fac : '' }}</span>@endforeach</div>@endif
            </div>

            @if($reviews['count'])
                <div class="cz-card"><div class="cz-head-row"><h2>Student reviews</h2></div><div style="margin-top:8px">@include('university._reviews', ['r' => $reviews])</div></div>
            @endif

            @if($c['faqs'])
                <div class="cz-card"><div class="cz-head-row"><h2>FAQs</h2></div><div style="margin-top:8px">@foreach($c['faqs'] as $fq)<details class="cz-acc"><summary>{{ $fq['q'] }}</summary><div class="cz-acc-body">{{ $fq['a'] }}</div></details>@endforeach</div></div>
            @endif
        </div>

        <aside class="cz-aside">
            <div class="cz-side-card cta" id="enquire">
                <h3>Visit this campus</h3>
                <p>A counsellor can arrange a guided visit or answer your questions.</p>
                @include('university._enquiry', ['id' => 'enq-side'])
            </div>
            @if($onlineCount)
                <div class="cz-side-card"><h3>Not near this campus?</h3><p>{{ $o['short'] ?: $o['name'] }} also teaches online.</p><a class="cz-btn uz-btn-online" href="{{ $L->online() }}">Online courses</a></div>
            @endif
        </aside>
    </div>
</div>
@endsection
