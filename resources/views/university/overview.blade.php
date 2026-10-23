@extends('university.base')
@php
    use App\Support\University\UniversityData as U;
    $o = $u->org;
    $q = $u->quality;
    $graded = collect($q['accreditations']);
@endphp
@section('meta_title', $o['name'] . ' - Courses, Fees, Campuses, Admission & Placements | Enrollzy')
@section('meta_description', \Illuminate\Support\Str::limit($o['about'] ?: $o['name'] . ': courses and fees at every campus, admission, placements, rankings and reviews.', 155))

@section('uz')
<div class="cz-page cz-gutter">
    <div class="cz-container cz-grid2">
        <div class="cz-stack">
            @if($u->campuses->count() > 1)
                <div class="uz-note">
                    @if($scope)Showing <b>{{ $scopeCampus['name'] }}</b>{{ $scopeCampus['state'] ? ', ' . $scopeCampus['state'] : '' }}. <a class="cz-link" href="{{ route('university.detail', $o['slug']) }}" style="font-size:14.5px">Show all campuses</a>
                    @else Showing <b>all {{ $u->campuses->count() }} campuses</b>. Pick a campus at the top for its exact fees, seats and hostel.@endif
                </div>
            @endif

            @if($onlineCount)
                <div class="uz-online-strip">
                    <span class="uz-online-badge">Online</span>
                    <div class="t"><b>Study online from anywhere</b><span>{{ $onlineCount }} online {{ \Illuminate\Support\Str::plural('programme', $onlineCount) }}: {{ $u->online()->take(4)->pluck('name')->implode(', ') }}{{ $onlineCount > 4 ? ' and more' : '' }}.</span></div>
                    <a class="cz-btn uz-btn-online cz-btn-sm" href="{{ $L->online() }}">See online courses</a>
                </div>
            @endif

            @if($o['about'])
                <div class="cz-card" id="s-about">
                    <div class="cz-head-row"><h2>About the university</h2></div>
                    <p class="uz-clamp" data-uz-clamp style="margin-top:8px">{{ $o['about'] }}</p>
                    <button type="button" class="cz-link" data-uz-clamp-btn hidden>Read more</button>
                </div>
            @endif

            @php
                $kv = array_filter([
                    'Awards its own degrees' => $o['degree_by'] ? 'Yes' : null,
                    'Approvals' => $q['approvals'] ? implode(', ', $q['approvals']) : null,
                    'Run by' => $o['trust'],
                    'Chancellor' => $o['chancellor'],
                    'Vice Chancellor' => $o['vc'],
                    'Category' => implode(' · ', array_filter([$o['type'], $o['category'], $o['autonomous'] && !in_array(strtolower((string) $o['autonomous']), ['no', '0', 'false']) ? 'Autonomous' : null])) ?: null,
                    'International' => $o['international'] ? implode(', ', $o['international']) : null,
                ]);
            @endphp
            @if($graded->isNotEmpty() || $q['rankings'] || $kv)
                <div class="cz-card" id="s-recog">
                    <div class="cz-head-row"><h2>Recognition and governance</h2></div>
                    @if($graded->isNotEmpty() || $q['rankings'])
                        <div class="uz-stats" style="margin:12px 0">
                            @foreach($graded as $a)<div class="uz-stat"><span class="k">{{ $a['body'] }}{{ $a['applied'] ? ' (applied)' : '' }}</span><span class="v">{{ $a['grade'] }}@if($a['verified'])<span class="uz-verified">Verified</span>@endif</span></div>@endforeach
                            @foreach(array_slice($q['rankings'], 0, 4) as $r)<div class="uz-stat"><span class="k">{{ $r['body'] }} {{ $r['category'] !== 'Category not stated' ? $r['category'] : 'rank' }}{{ $r['year'] ? ' ' . $r['year'] : '' }}</span><span class="v cz-num">{{ $r['rank'] }}@if($r['verified'])<span class="uz-verified">Verified</span>@endif</span></div>@endforeach
                        </div>
                    @endif
                    @if($kv)
                        <dl class="uz-kv">@foreach($kv as $k => $v)<dt>{{ $k }}</dt><dd>{{ $v }}</dd>@endforeach</dl>
                    @endif
                </div>
            @endif

            @if($u->departments->isNotEmpty())
                <div class="cz-card" id="s-depts">
                    <div class="cz-head-row"><h2>Departments</h2><span class="cz-muted cz-small">{{ $departments->count() }} {{ \Illuminate\Support\Str::plural('department', $departments->count()) }}</span></div>
                    @include('university._secscope', ['key' => 'depts'])
                    @if($departments->isNotEmpty())
                        <div class="uz-grid">
                            @foreach($departments->take(6) as $d)@include('university._dept', ['d' => $d, 'where' => $deptCampus ? 'At ' . $u->campus($deptCampus)['name'] : ($d['campuses'] > 1 ? 'At ' . $d['campuses'] . ' campuses · university totals' : null)])@endforeach
                        </div>
                        @if($departments->count() > 6)<details class="cz-acc" style="margin-top:10px"><summary>All {{ $departments->count() }} departments</summary><div class="cz-acc-body"><div class="uz-grid">@foreach($departments->slice(6) as $d)@include('university._dept', ['d' => $d, 'where' => null])@endforeach</div></div></details>@endif
                    @else
                        <div class="cz-empty"><b>No departments listed for this campus</b>Pick another campus.</div>
                    @endif
                </div>
            @endif

            @if($o['constituent'] || $o['affiliated'] || $u->colleges)
                <div class="cz-card" id="s-colleges">
                    <div class="cz-head-row"><h2>Colleges under this university</h2></div>
                    <p class="sub">{{ implode(' · ', array_filter([$o['constituent'] ? number_format($o['constituent']) . ' constituent ' . \Illuminate\Support\Str::plural('college', (int) $o['constituent']) : null, $o['affiliated'] ? number_format($o['affiliated']) . ' affiliated ' . \Illuminate\Support\Str::plural('college', (int) $o['affiliated']) : null])) ?: count($u->colleges) . ' colleges' }}</p>
                    @if($u->colleges)
                        <div class="uz-grid">@foreach($u->colleges as $col)<div class="uz-card"><b>{{ $col['name'] }}</b>@if($col['place'])<span class="m">{{ $col['place'] }}</span>@endif</div>@endforeach</div>
                    @endif
                </div>
            @endif

            <div class="cz-card" id="s-courses">
                <div class="cz-head-row"><h2>Courses and fees</h2><a class="cz-link" href="{{ $L->courses() }}">All courses →</a></div>
                @include('university._secscope', ['key' => 'courses'])
                @php
                    $streams = $courseProgrammes->groupBy('stream')->sortByDesc(fn ($g) => $g->count());
                    $oneCampus = count($sec['courses']['ids'] ?? []) === 1;
                @endphp
                @if($courseProgrammes->isNotEmpty())
                    <div class="cz-chips" role="group" aria-label="Stream" style="margin-bottom:12px" data-uz-streams>
                        @foreach($streams->take(8) as $stream => $g)<button type="button" class="cz-chip" aria-pressed="{{ $loop->first ? 'true' : 'false' }}" data-uz-stream="{{ $loop->index }}">{{ $stream }} <span class="cz-muted">{{ $g->count() }}</span></button>@endforeach
                    </div>
                    <div class="cz-tbl-wrap"><table>
                        <thead><tr><th>Course</th><th>Exam</th><th>{{ $oneCampus ? 'Seats' : 'Offered at' }}</th><th class="r">Fees / year</th><th></th></tr></thead>
                        @foreach($streams->take(8) as $stream => $g)
                            <tbody data-uz-stream-rows="{{ $loop->index }}" @unless($loop->first) hidden @endunless>
                                @foreach($g->sortByDesc('n')->take(6) as $p)
                                    <tr>
                                        <td><a class="rowlink" href="{{ $L->course($p['slug']) }}">{{ $p['name'] }}</a>@if($p['has_online']) <span class="uz-online-badge">Also online</span>@endif
                                            <span class="small">{{ implode(' · ', array_filter([$p['level'], $p['years'] ? rtrim(rtrim(number_format($p['years'], 1), '0'), '.') . ' years' : null])) }}</span></td>
                                        <td>{{ $p['exam_text'] ?? '–' }}</td>
                                        <td>@if($oneCampus){{ $p['seats_total'] ? number_format($p['seats_total']) : '–' }}@else<span class="cz-num">{{ $p['n'] }}</span> {{ \Illuminate\Support\Str::plural('campus', $p['n']) }}@endif</td>
                                        <td class="r cz-num">{{ U::feeRange($p['fee_min'], $p['fee_max']) }}</td>
                                        <td class="r"><a class="cz-link" href="{{ $L->course($p['slug']) }}">Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    </table></div>
                @else
                    <div class="cz-empty"><b>No courses listed for this campus yet</b>Pick another campus.</div>
                @endif
            </div>

            <div class="cz-card" id="s-admission">
                <div class="cz-head-row"><h2>Admission</h2></div>
                @include('university._secscope', ['key' => 'admission'])
                <form class="uz-adm-pick" method="get" action="{{ url()->current() }}#s-admission" data-uz-autosubmit>
                    @foreach(request()->except(['adm_course', 'sc_admission']) as $k => $v)@if(is_string($v))<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif @endforeach
                    <span style="font:600 15px var(--cz-font-display);align-self:center">See the exact procedure for</span>
                    <label class="cz-field" for="adm-course">Course
                        <select id="adm-course" name="adm_course"><option value="">Select a course</option>@foreach($admOptions as $p)<option value="{{ $p['slug'] }}" @selected($admCourse === $p['slug'])>{{ $p['name'] }}</option>@endforeach</select>
                    </label>
                    @if($u->campuses->count() > 1)
                        <label class="cz-field" for="adm-campus">Campus
                            <select id="adm-campus" name="sc_admission"><option value="">Select a campus</option>
                                @foreach($admCampusOptions->groupBy('state')->sortKeys() as $state => $cs)<optgroup label="{{ $state ?: 'Other' }}">@foreach($cs as $cc)<option value="{{ $cc['slug'] }}" @selected(($admCampus['id'] ?? null) === $cc['id'])>{{ $cc['name'] }}</option>@endforeach</optgroup>@endforeach
                            </select>
                        </label>
                    @endif
                    <noscript><button class="cz-btn cz-btn-blue cz-btn-sm">Show</button></noscript>
                </form>
                @if($admOffering)
                    @php $ao = $admOffering; @endphp
                    <div class="uz-adm">
                        <h3>{{ $ao['name'] }} at {{ $admCampus['name'] }}</h3>
                        <dl class="uz-kv" style="max-width:none">
                            @if($ao['exams'])<dt>Admission route</dt><dd>{{ collect($ao['exams'])->pluck('name')->implode(' / ') }} score</dd>@endif
                            @if($ao['eligibility'])<dt>Eligibility</dt><dd style="font-weight:500">{{ \Illuminate\Support\Str::limit($ao['eligibility'], 320) }}</dd>@endif
                            @if($ao['seats'])<dt>Seats at this campus</dt><dd class="cz-num">{{ number_format($ao['seats']) }}</dd>@endif
                            @if($ao['annual_fee'])<dt>Fees / year</dt><dd class="cz-num">{{ U::inr($ao['annual_fee']) }}</dd>@endif
                            @if($ao['total_fee'])<dt>Total course fee</dt><dd class="cz-num">{{ U::inr($ao['total_fee']) }}</dd>@endif
                            @if($ao['hostel_fee'])<dt>Hostel fee</dt><dd class="cz-num">{{ U::inr($ao['hostel_fee']) }}</dd>@endif
                            @if($ao['admission'])<dt class="long">How admission works</dt><dd class="long">{{ \Illuminate\Support\Str::limit($ao['admission'], 360) }}</dd>@endif
                        </dl>
                        <div class="cz-chips"><a class="cz-btn cz-btn-orange cz-btn-sm" href="#enquire" data-uz-enquire="Apply" data-uz-course="{{ $ao['name'] }}">Apply for this</a><a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ $L->course($ao['slug'], $admCampus['slug']) }}">Course page</a><a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ $L->campus($admCampus['slug']) }}">Campus page</a></div>
                    </div>
                @elseif($admCampus && $admCourse)
                    <div class="cz-empty"><b>This course is not offered at {{ $admCampus['name'] }}</b>Pick another campus.</div>
                @else
                    <p style="margin:0 0 12px;color:var(--cz-ink-2)">Admission rules, seats and fees differ by campus. Pick a course{{ $u->campuses->count() > 1 ? ' and a campus' : '' }} to see exactly what applies. The general steps are below.</p>
                @endif
                @if($exams->isNotEmpty())
                    <div class="cz-chips" style="margin-bottom:6px">@foreach($exams as $e)<a class="cz-tag blue" href="{{ route('exam.detail', $e['slug']) }}">{{ $e['name'] }} → {{ $e['n'] }} {{ \Illuminate\Support\Str::plural('course', $e['n']) }}</a>@endforeach @if($onlineCount)<span class="uz-online-badge">Online: see each course</span>@endif</div>
                @endif
                <h3>{{ $admOffering ? 'General steps' : 'How to apply' }}</h3>
                <ol class="uz-steps">
                    <li><div><b>Pick a course{{ $u->campuses->count() > 1 ? ' and a campus' : '' }}</b><span>Fees, seats and hostel can differ by campus.</span></div></li>
                    <li><div><b>Check eligibility and the entrance exam</b><span>Each course page lists what it needs.</span></div></li>
                    <li><div><b>Apply{{ $o['admission_portal'] ? ' on the university portal' : '' }}</b><span>@if($o['admission_portal'])<a href="{{ $o['admission_portal'] }}" target="_blank" rel="noopener nofollow">Open the admission portal ↗</a>@else Our admission experts can help you apply.@endif</span></div></li>
                    <li><div><b>Verify documents and pay the fee</b><span>At the campus that offers you a seat.</span></div></li>
                </ol>
            </div>

            @if($cutoffs)
                <div class="cz-card" id="s-cutoff">
                    <div class="cz-head-row"><h2>Cutoffs</h2></div>
                    <p class="sub">Latest published closing ranks, General category, through counselling.</p>
                    <div class="cz-tbl-wrap"><table><thead><tr><th>Course</th><th>Counselling</th><th>Quota</th><th class="r">Closing (General)</th></tr></thead><tbody>
                        @foreach(collect($cutoffs)->where('category', 'General')->sortBy('closing')->take(6) as $x)
                            <tr><td>{{ $x['course'] }}<span class="small">{{ $x['round'] }}{{ $x['year'] ? ' ' . $x['year'] : '' }}</span></td><td><a href="{{ $x['counselling_url'] }}">{{ $x['counselling'] }}</a></td><td>{{ $x['quota'] }}</td><td class="r cz-num">{{ number_format($x['closing']) }}</td></tr>
                        @endforeach
                    </tbody></table></div>
                </div>
            @endif

            @if($u->hasPlacements())
            <div class="cz-card" id="s-placement">
                <div class="cz-head-row"><h2>Placements</h2></div>
                @include('university._secscope', ['key' => 'placement'])
                @if($placementRows->isNotEmpty())
                    <div class="cz-tbl-wrap"><table><thead><tr><th>Campus</th><th class="r">Median</th><th class="r">Placed</th><th class="r">Year</th></tr></thead><tbody>
                        @foreach($placementRows as $r)<tr><td>{{ $r['campus']['name'] }}</td><td class="r cz-num">{{ U::lpa($r['p']['median']) }}</td><td class="r cz-num">{{ $r['p']['pct'] ? $r['p']['pct'] . '%' : '–' }}</td><td class="r cz-num">{{ $r['p']['year'] ?: '–' }}</td></tr>@endforeach
                    </tbody></table></div>
                @elseif($placement)
                    <div class="uz-stats">
                        @if($placement['median'])<div class="uz-stat"><span class="k">Median package</span><span class="v cz-num">{{ U::lpa($placement['median']) }}</span></div>@endif
                        @if($placement['average'])<div class="uz-stat"><span class="k">Average package</span><span class="v cz-num">{{ U::lpa($placement['average']) }}</span></div>@endif
                        @if($placement['highest'])<div class="uz-stat"><span class="k">Highest package</span><span class="v cz-num">{{ U::lpa($placement['highest']) }}</span></div>@endif
                        @if($placement['pct'])<div class="uz-stat"><span class="k">Students placed</span><span class="v cz-num">{{ $placement['pct'] }}%</span></div>@endif
                        @if($placement['placed'])<div class="uz-stat"><span class="k">Placed / graduating</span><span class="v cz-num">{{ number_format($placement['placed']) }}{{ $placement['graduating'] ? ' / ' . number_format($placement['graduating']) : '' }}</span></div>@endif
                    </div>
                    <p class="cz-source">{{ $placement['year'] ? 'Year ' . $placement['year'] . '. ' : '' }}{{ $placement['verified'] ? 'Verified by Enrollzy.' : 'As reported by the university.' }}</p>
                @else
                    <div class="cz-empty"><b>No placement data yet{{ $sec['placement']['ids'] ? ' for this campus' : '' }}</b>Ask our admission experts for the latest figures.</div>
                @endif
            </div>
            @endif

            @if($u->campuses->count() > 1)
                <div class="cz-card" id="s-campus">
                    <div class="cz-head-row"><h2>Campuses</h2><a class="cz-link" href="{{ $L->campus() }}">Find a campus →</a></div>
                    <p class="sub">{{ $u->campuses->count() }} campuses. Use the campus picker at the top to choose any campus.</p>
                    <div class="uz-grid">@foreach($topCampuses as $cc)@include('university._campus_card', ['cc' => $cc])@endforeach</div>
                </div>
            @endif

            @if($u->hasReviews())
            <div class="cz-card" id="s-reviews">
                <div class="cz-head-row"><h2>Student reviews</h2></div>
                @include('university._secscope', ['key' => 'reviews'])
                @include('university._reviews', ['r' => $reviews])
            </div>
            @endif

            <div class="cz-card" id="s-contact">
                <div class="cz-head-row"><h2>Contact</h2></div>
                @include('university._secscope', ['key' => 'contact'])
                <dl class="uz-kv">
                    @if($contactCampus)
                        <dt>Campus</dt><dd>{{ $contactCampus['name'] }}</dd>
                        <dt>City</dt><dd>{{ implode(', ', array_filter([$contactCampus['city'], $contactCampus['state']])) }}</dd>
                        @if($contactCampus['address'])<dt>Address</dt><dd style="font-weight:500">{{ $contactCampus['address'] }}</dd>@endif
                        <dt>Admissions desk</dt><dd><a href="#enquire" data-uz-enquire="Contact">Request a call back</a></dd>
                    @else
                        @if($o['hq'])<dt>Headquarters</dt><dd>{{ $o['hq'] }}</dd>@endif
                        <dt>Central admissions</dt><dd><a href="#enquire" data-uz-enquire="Contact">Request a call back</a></dd>
                        @if($o['admission_portal'])<dt>Admission portal</dt><dd><a href="{{ $o['admission_portal'] }}" target="_blank" rel="noopener nofollow">Apply on the university portal ↗</a></dd>@endif
                        @if($o['student_portal'])<dt>Current students</dt><dd><a href="{{ $o['student_portal'] }}" target="_blank" rel="noopener nofollow">Student portal ↗</a></dd>@endif
                        @if($o['website'])<dt>Website</dt><dd><a href="{{ $o['website'] }}" target="_blank" rel="noopener nofollow">Official website ↗</a></dd>@endif
                        @if($u->campuses->count() > 1)<dt>Campus offices</dt><dd>Pick a campus above</dd>@endif
                    @endif
                </dl>
            </div>
        </div>

        <aside class="cz-aside">
            <div class="cz-side-card cta" id="enquire">
                <h3>Talk to an admission expert</h3>
                <p>Help choosing a course and the right campus.</p>
                @include('university._enquiry', ['id' => 'enq-side'])
            </div>
            @if($onlineCount)
                <div class="cz-side-card" style="border-color:rgba(109,63,209,.3)">
                    <span class="uz-online-badge">Online</span>
                    <h3>Can't relocate?</h3>
                    <p>{{ $onlineCount }} online {{ \Illuminate\Support\Str::plural('programme', $onlineCount) }} from {{ $o['short'] ?: $o['name'] }}.</p>
                    <a class="cz-btn uz-btn-online" href="{{ $L->online() }}">Explore online</a>
                </div>
            @endif
        </aside>
    </div>
</div>
@endsection
