@extends('layouts.app')
@php
    use App\Support\CounsellingUi as Ui;
    $x = $exam['exam'];
    $cycle = $exam['cycle'];
    $short = $x['short_name'] ?: $x['name'];
    $yearTxt = $cycle ? $cycle['year'] . ($cycle['session_label'] ? ' ' . $cycle['session_label'] : '') : '';
    $n = count($counsellings);
    $hubUrl = route('counselling.index', ['exam' => $x['slug']]);
    $card = collect($exam['status_card'] ?? [])->keyBy('key');
    $mode = collect($exam['pattern'] ?? [])->pluck('mode')->filter()->first();
    $firstSource = collect($exam['dates'] ?? [])->pluck('source_url')->filter()->first();

    // the counselling box in the status strip: open beats upcoming beats the rest
    $cnsNow = collect($counsellings)->pluck('now')->filter()->sortBy(fn ($s) => Ui::statusOrder($s['state'] ?? null))->first();

    // "Colleges and cutoffs" jump cards open the most relevant counselling: the home state's, else the national one
    $target = collect($mine)->first(fn ($c) => $c['level'] !== 'national') ?? ($mine[0] ?? ($counsellings[0] ?? null));
    $colleges = collect($counsellings)->sum('colleges_count');

    $el = $exam['eligibility'][0] ?? null;
    $pt = $exam['pattern'][0] ?? null;
    $perQ = $pt && $pt['total_questions'] && $pt['total_marks'] ? $pt['total_marks'] / $pt['total_questions'] : null;
    $tabs = array_filter([
        'x-dates' => count($exam['dates'] ?? []) ? 'Dates' : null,
        'x-elig' => $el ? 'Eligibility' : null,
        'x-pattern' => ($pt || count($exam['syllabus'] ?? [])) ? 'Pattern & syllabus' : null,
        'x-coun' => $n ? 'Counselling' : null,
        'x-col' => $target ? 'Colleges & cutoffs' : null,
        'x-fees' => count($exam['fees'] ?? []) ? 'Fees' : null,
        'x-faq' => count($exam['faqs'] ?? []) ? 'FAQs' : null,
    ]);
    $num = fn ($v) => $v === null ? null : rtrim(rtrim(number_format((float) $v, 2), '0'), '.');
@endphp
@section('meta_title', $exam['seo']['title'] ?? $short)
@section('meta_description', $exam['seo']['description'] ?? '')

@section('content')
@include('counselling._assets', ['canonical' => $exam['seo']['canonical'] ?? null])
<main class="cz" data-cz-reload-on-profile>
    <div class="cz-hero cz-gutter">
        <div class="cz-container">
            <nav class="cz-crumbs" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Home</a>›<a href="{{ url('/top-exams') }}">Exams</a>›
                @if(!empty($x['categories']))<span>{{ $x['categories'][0] }}</span>›@endif
                <span>{{ $short }}</span>
            </nav>
            <div class="cz-hero-main">
                <div class="cz-logo" aria-hidden="true">
                    @if($x['logo_url'])<img src="{{ $x['logo_url'] }}" alt="">@else{{ $x['conducting_body']['short_name'] ?? Ui::initials($x) }}@endif
                </div>
                <div class="cz-hero-text">
                    <h1>{{ $short }} {{ $yearTxt }}</h1>
                    @if($x['short_name'] && $x['short_name'] !== $x['name'])<div class="full">{{ $x['name'] }}</div>@endif
                    <div class="cz-tags">
                        @if($x['type_label'])<span class="cz-tag blue">{{ $x['type_label'] }}</span>@endif
                        @foreach(array_merge($x['categories'] ?? [], $x['program_levels'] ?? []) as $t)<span class="cz-tag">{{ $t }}</span>@endforeach
                        @if($mode)<span class="cz-tag">{{ $mode }}</span>@endif
                    </div>
                    <div class="cz-hero-meta">
                        @if($x['conducting_body'])<span>Conducted by <b>{{ $x['conducting_body']['short_name'] ?: $x['conducting_body']['name'] }}</b></span>@endif
                        @if($n)<span>Used by <b><a href="{{ $hubUrl }}" style="color:inherit">{{ $n }} {{ \Illuminate\Support\Str::plural('counselling', $n) }}</a></b></span>@endif
                        @if(!empty($exam['last_verified_at']))<span>Dates verified {{ Ui::date($exam['last_verified_at']) }}</span>@endif
                    </div>
                </div>
                <div class="cz-hero-actions">
                    <button type="button" class="cz-btn cz-btn-orange" data-cz-soon="Date alerts">Get date alerts</button>
                    @if($x['official_website'])<a class="cz-btn cz-btn-outline" href="{{ $x['official_website'] }}" target="_blank" rel="noopener">Official website ↗</a>@endif
                </div>
            </div>
            @if($cycle && in_array($cycle['status'], ['postponed', 'cancelled']))
                <div class="cz-notice {{ $cycle['status'] === 'cancelled' ? 'bad' : 'warn' }}"><b>{{ ucfirst($cycle['status']) }}.</b> {{ $cycle['status_note'] }}</div>
            @endif
            @if($cycle)
                <div class="cz-status-card">
                    @foreach(['registration', 'admit-card', 'exam-date'] as $k)
                        @php $s = $card[$k] ?? null; @endphp
                        <div>
                            <span class="k">{{ $s['label'] ?? ucfirst(str_replace('-', ' ', $k)) }}</span>
                            {{ Ui::pillHtml($s['state'] ?? 'tba', $s['text'] ?? 'To be announced') }}
                            @if(!empty($s['date_text']) && ($s['date_text'] !== ($s['text'] ?? null)))<span class="d">{{ $s['date_text'] }}</span>@endif
                        </div>
                    @endforeach
                    <div>
                        <span class="k">Counselling</span>
                        @if($cnsNow){{ Ui::pillHtml($cnsNow['state'], $cnsNow['label'] ?? null) }}@else{{ Ui::pillHtml('tba') }}@endif
                        <span class="d">@if($n)<a href="{{ $hubUrl }}">{{ $n }} {{ \Illuminate\Support\Str::plural('counselling', $n) }}</a>@else Not linked yet @endif</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(count($tabs) > 1)
        <div class="cz-tabs-bar cz-gutter">
            <div class="cz-container">
                <nav class="cz-tabs" aria-label="Exam sections">
                    @foreach($tabs as $id => $label)<a href="#{{ $id }}">{{ $label }}</a>@endforeach
                </nav>
            </div>
        </div>
    @endif

    <div class="cz-page cz-gutter">
        <div class="cz-container cz-grid2">
            <div class="cz-stack">
                @if(!$cycle)
                    <div class="cz-card cz-empty"><b>Dates to be announced</b>This exam's schedule appears here as soon as it is published.</div>
                @endif

                @if(count($exam['dates'] ?? []))
                    <div class="cz-card" id="x-dates">
                        <h2>Important dates</h2>
                        <p class="sub">All times in {{ $cycle['timezone'] === 'Asia/Kolkata' ? 'IST' : $cycle['timezone'] }}.</p>
                        <div class="cz-tbl-wrap">
                            <table>
                                <thead><tr><th>Event</th><th>Date</th><th>Status</th></tr></thead>
                                <tbody>
                                    @foreach($exam['dates'] as $e)
                                        <tr>
                                            <td>{{ $e['label'] ?: $e['type']['name'] }}@if($e['stage'] ?? null)<span class="small">{{ $e['stage'] }}</span>@endif</td>
                                            <td class="cz-num">{{ $e['date_text'] }}@if($e['date_precision'] === 'month_only')<span class="small">Month only</span>@endif @if($e['extended_end_at'])<span class="small">Extended</span>@endif</td>
                                            <td>{{ Ui::eventPillHtml($e) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($firstSource)<p class="cz-source">Source: <a href="{{ $firstSource }}" target="_blank" rel="noopener">official notice</a>@if(!empty($exam['last_verified_at'])) · verified {{ Ui::date($exam['last_verified_at']) }}@endif</p>@endif
                    </div>
                @endif

                @if($n)
                    <div class="cz-card" id="x-coun">
                        <div class="cz-head-row"><h2>Counselling after {{ $short }}</h2><a class="cz-link" href="{{ $hubUrl }}">See all {{ $n }} →</a></div>
                        <p class="sub">{{ $n }} {{ \Illuminate\Support\Str::plural('counselling', $n) }} use your {{ $short }} rank. Most students apply to two: the national one and their home state's.</p>
                        @include('counselling._profile', ['fields' => ['state'], 'idp' => 'p-x', 'label' => 'Show what applies to me', 'flat' => true, 'domicileHint' => true])
                        <div>
                            @forelse($mine as $c)
                                <div class="cz-finder-row">
                                    <div class="nm">
                                        <span class="why">{{ $c['level'] === 'national' ? 'Open to all states' : 'Your home state' }}</span><br>
                                        <a href="{{ route('counselling.show', $c['slug']) }}">{{ $c['name'] }}</a>
                                        @if(!empty($c['quotas']) || $c['seat_scope_note'])<div>{{ $c['seat_scope_note'] ?: implode(', ', $c['quotas']) }}</div>@endif
                                    </div>
                                    <div class="when">
                                        {{ Ui::pillHtml($c['now']['state'] ?? 'tba', $c['now']['label'] ?? null) }}
                                        <span>{{ $c['now']['step'] ?? 'Schedule awaited' }} · {{ $c['now']['when'] ?? '' }}</span>
                                    </div>
                                    <a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ route('counselling.show', $c['slug']) }}" aria-label="Open {{ $c['name'] }}">Open</a>
                                </div>
                            @empty
                                <p class="cz-muted" style="padding:10px 0">Pick your home state above to see the counsellings that apply to you.</p>
                            @endforelse
                        </div>
                        @if(count($others))
                            <details class="cz-acc" style="margin-top:8px">
                                <summary>{{ $profile['state'] ? 'Other states (only if you meet their domicile rules)' : 'State and other counsellings' }}</summary>
                                <div class="cz-acc-body"><div class="cz-chips">
                                    @foreach($others as $c)
                                        <a class="cz-tag" href="{{ route('counselling.show', $c['slug']) }}">{{ $c['level'] === 'state' && count($c['states'] ?? []) === 1 ? $c['states'][0] : $c['name'] }}</a>
                                    @endforeach
                                </div></div>
                            </details>
                        @endif
                    </div>
                @endif

                @if($el)
                    <div class="cz-card" id="x-elig">
                        <h2>Eligibility</h2>
                        <div class="cz-facts" style="margin-top:12px">
                            @if($el['qualification'] || $el['subjects'])<div class="cz-fact"><span class="k">Qualification</span><span class="v">{{ $el['qualification'] ?: implode(', ', array_slice($el['subjects'], 0, 4)) }}</span></div>@endif
                            @if($el['age']['min'])<div class="cz-fact"><span class="k">Minimum age</span><span class="v cz-num">{{ $el['age']['min'] }} years</span></div>@endif
                            @if($el['age']['max'])<div class="cz-fact"><span class="k">Maximum age</span><span class="v cz-num">{{ $el['age']['max'] }} years</span></div>@endif
                            @if($el['min_percentage_general'] !== null)<div class="cz-fact"><span class="k">Min. marks (Gen)</span><span class="v cz-num">{{ $num($el['min_percentage_general']) }}%</span></div>@endif
                            @if($el['min_percentage_reserved'] !== null)<div class="cz-fact"><span class="k">Min. marks (reserved)</span><span class="v cz-num">{{ $num($el['min_percentage_reserved']) }}%</span></div>@endif
                            <div class="cz-fact"><span class="k">Attempts</span><span class="v">{{ $el['max_attempts'] ? $el['max_attempts'] : 'No limit' }}</span></div>
                        </div>
                        <ul class="cz-small" style="margin:12px 0 0;padding-left:20px;color:var(--cz-ink-2)">
                            @if($el['subjects'])<li>Subjects: {{ implode(', ', $el['subjects']) }}</li>@endif
                            @if($el['nationality'])<li>Nationality: {{ $el['nationality'] }}</li>@endif
                            @if($el['appearing_allowed'] !== null)<li>{{ $el['appearing_allowed'] ? 'Students appearing in the qualifying exam can apply' : 'Only students who have passed the qualifying exam can apply' }}</li>@endif
                            @foreach($el['age_relaxation'] ?? [] as $a)<li>Age relaxation: {{ $a['category'] }} {{ $a['years'] }} years</li>@endforeach
                            @if($el['other_conditions'])<li>{{ $el['other_conditions'] }}</li>@endif
                        </ul>
                    </div>
                @endif

                @if($pt || count($exam['syllabus'] ?? []))
                    <div class="cz-card" id="x-pattern">
                        <h2>Pattern and syllabus</h2>
                        @if($pt)
                            <div class="cz-facts" style="margin-top:12px">
                                @if($pt['total_questions'])<div class="cz-fact"><span class="k">Questions</span><span class="v cz-num">{{ $pt['total_questions'] }}</span></div>@endif
                                @if($pt['total_marks'] !== null)<div class="cz-fact"><span class="k">Marks</span><span class="v cz-num">{{ $num($pt['total_marks']) }}</span></div>@endif
                                @if($pt['duration_minutes'])<div class="cz-fact"><span class="k">Duration</span><span class="v cz-num">{{ $pt['duration_minutes'] % 60 === 0 ? ($pt['duration_minutes'] / 60) . ' ' . \Illuminate\Support\Str::plural('hour', $pt['duration_minutes'] / 60) : $pt['duration_minutes'] . ' min' }}</span></div>@endif
                                <div class="cz-fact"><span class="k">Marking</span><span class="v cz-num">{{ $perQ ? '+' . $num($perQ) : '' }}{{ $pt['negative_marking'] ? ' / −' . ($num($pt['negative_marks']) ?? '') : ' / no negative' }}</span></div>
                            </div>
                            @if(count($pt['sections']))
                                <div class="cz-tbl-wrap" style="margin-top:12px">
                                    <table>
                                        <thead><tr><th>Section</th><th class="r">Questions</th><th class="r">Marks</th></tr></thead>
                                        <tbody>@foreach($pt['sections'] as $s)<tr><td>{{ $s['name'] }}</td><td class="r cz-num">{{ $s['questions'] ?? '–' }}</td><td class="r cz-num">{{ $s['marks'] ?? '–' }}</td></tr>@endforeach</tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                        @if(count($exam['syllabus'] ?? []))
                            <details class="cz-acc" style="margin-top:12px">
                                <summary>Syllabus by subject</summary>
                                <div class="cz-acc-body">
                                    @foreach($exam['syllabus'] as $s)
                                        <p style="margin:8px 0 4px"><b>{{ $s['subject'] ?: 'Syllabus' }}</b>@if($s['pdf_url']) · <a href="{{ $s['pdf_url'] }}" target="_blank" rel="noopener">PDF ↓</a>@endif</p>
                                        @if($s['topics'])<p style="margin:0">{{ implode(' · ', $s['topics']) }}</p>@endif
                                    @endforeach
                                </div>
                            </details>
                        @endif
                    </div>
                @endif

                @if($target)
                    <div class="cz-card" id="x-col">
                        <div class="cz-head-row"><h2>Colleges and cutoffs</h2></div>
                        <p class="sub">Too many to list here. Pick a counselling and explore with filters.</p>
                        <div class="cz-jumps">
                            <a class="cz-jump" href="{{ route('counselling.colleges', $target['slug']) }}"><span class="k">Colleges</span><span class="v cz-num">{{ $colleges ? Ui::num($colleges) : '–' }}</span><span class="m">{{ $target['name'] }}: filter by state, fee and type</span><span class="go">Browse colleges →</span></a>
                            <a class="cz-jump" href="{{ route('counselling.cutoffs', $target['slug']) }}"><span class="k">Cutoffs</span><span class="v">Closing ranks</span><span class="m">See where your rank fits</span><span class="go">Check cutoffs →</span></a>
                            <a class="cz-jump" href="{{ $hubUrl }}"><span class="k">Counsellings</span><span class="v cz-num">{{ $n }}</span><span class="m">National and state</span><span class="go">Compare →</span></a>
                        </div>
                    </div>
                @endif

                @if(count($exam['fees'] ?? []))
                    <div class="cz-card" id="x-fees">
                        <h2>Application fee</h2>
                        <div class="cz-tbl-wrap" style="margin-top:12px">
                            <table>
                                <thead><tr><th>Category</th><th class="r">Fee</th></tr></thead>
                                <tbody>@foreach($exam['fees'] as $fee)<tr><td>{{ $fee['category'] }}{{ $fee['gender'] ? ' (' . $fee['gender'] . ')' : '' }}@if($fee['stage'])<span class="small">{{ $fee['stage'] }}</span>@endif</td><td class="r cz-num">{{ $fee['currency'] === 'INR' ? Ui::inr($fee['amount']) : $fee['currency'] . ' ' . Ui::num($fee['amount']) }}</td></tr>@endforeach</tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if(count($exam['documents'] ?? []) || count($exam['papers'] ?? []))
                    <div class="cz-card">
                        <h2>Documents and previous papers</h2>
                        @if(count($exam['documents'] ?? []))
                            <details class="cz-acc" style="margin-top:12px"><summary>Documents needed</summary><div class="cz-acc-body"><ul>
                                @foreach($exam['documents'] as $d)<li>{{ $d['name'] }}{{ $d['is_mandatory'] ? '' : ' (optional)' }}{{ $d['notes'] ? ' · ' . $d['notes'] : '' }}</li>@endforeach
                            </ul></div></details>
                        @endif
                        @if(count($exam['papers'] ?? []))
                            <details class="cz-acc" style="margin-top:8px"><summary>Previous papers</summary><div class="cz-acc-body"><ul>
                                @foreach($exam['papers'] as $p)<li>@if($p['url'])<a href="{{ $p['url'] }}" target="_blank" rel="noopener">{{ $p['title'] }}</a>@else{{ $p['title'] }}@endif {{ $p['year'] ? '· ' . $p['year'] : '' }}{{ $p['shift'] ? ' · ' . $p['shift'] : '' }}</li>@endforeach
                            </ul></div></details>
                        @endif
                    </div>
                @endif

                @if(count($exam['faqs'] ?? []))
                    <div class="cz-card" id="x-faq">
                        <h2>FAQs</h2>
                        <div style="margin-top:12px">
                            @foreach($exam['faqs'] as $q)
                                <details class="cz-acc"><summary>{{ $q['question'] }}</summary><div class="cz-acc-body">{!! nl2br(e($q['answer'])) !!}</div></details>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($x['about'])
                    <div class="cz-card">
                        <h2>About {{ $short }}</h2>
                        <p style="margin-top:10px">{!! nl2br(e(strip_tags($x['about']))) !!}</p>
                    </div>
                @endif
            </div>

            <aside class="cz-aside">
                <div class="cz-side-card cta">
                    <h3>Never miss a {{ $short }} date</h3>
                    <p>Registration, admit card, result and counselling rounds.</p>
                    <label class="cz-check"><input type="checkbox" checked> Also on WhatsApp</label>
                    <button type="button" class="cz-btn cz-btn-orange" data-cz-soon="Date alerts">Follow {{ $short }}</button>
                </div>
                <div class="cz-side-card">
                    <h3>Not sure which colleges you can get?</h3>
                    <p>Enter your expected rank on the cutoffs page, or talk to a counsellor.</p>
                    <a class="cz-btn cz-btn-blue" href="{{ url('/contact-us') }}">Book free counselling</a>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection
