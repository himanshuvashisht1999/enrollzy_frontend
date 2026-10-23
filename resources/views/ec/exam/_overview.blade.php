{{-- Exam details: every section built from the exam's record in the CRM; a section with no data is left out ($secs). --}}
@php
    use App\Support\Ec\Ec;
    use Illuminate\Support\Str;
    $H = fn ($id, $t, $sub = null) => '<div class="ec-ihead" id="sec-' . $id . '"><h2>' . e($t) . '</h2>' . ($sub ? '<p>' . e($sub) . '</p>' : '') . '</div>';
    $ti = fn ($p) => '<span class="ti"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg></span>';
    $nm = $e['short_name'] ?: $e['name'];
    $pattern = collect($page['pattern'] ?? []);
    $p0 = $pattern->first();
    $dur = fn ($m) => $m ? ($m % 60 ? ($m >= 60 ? intdiv($m, 60) . ' h ' . ($m % 60) . ' min' : $m . ' minutes') : ($m / 60) . ' ' . Str::plural('hour', $m / 60)) : null;
    $marking = fn ($p) => $p ? ($p['negative_marking'] ? ($p['negative_marks'] ? '−' . Ec::num($p['negative_marks']) . ' for a wrong answer' : 'Negative marking') : 'No negative marking') : null;
    $fees = collect($page['fees'] ?? []);
    $langs = !empty($e['languages']) ? \Illuminate\Support\Facades\DB::table('languages')->whereIn('id', $e['languages'])->pluck('title')->filter()->implode(', ') : null;
    $stages = collect($page['stages'] ?? []);
    $multiStage = $stages->count() > 1;
    // important dates by kind
    $groups = ['Application' => ['registration', 'late-fee-window', 'correction-window', 'fee-deposit-payment'], 'Exam' => ['city-intimation-slip', 'admit-card', 'exam-date'],
        'Result' => ['provisional-answer-key', 'answer-key-objection', 'final-answer-key', 'result', 'scorecard', 'merit-list']];
    $byGroup = collect($groups)->map(fn ($types) => $dates->filter(fn ($d) => in_array($d['type']['slug'] ?? '', $types, true))->values())->filter->isNotEmpty();
    $other = $dates->filter(fn ($d) => !in_array($d['type']['slug'] ?? '', array_merge(...array_values($groups)), true))->values();
    if ($other->isNotEmpty()) $byGroup['Other dates'] = $other;
@endphp
<section class="ec-osec ec-gutter"><div class="ec-wrap ec-ilayout">
    <aside class="ec-toc" aria-label="On this page"><b>On this page</b>@foreach($secs as $id => $l)<a href="#sec-{{ $id }}" data-ec-toc="{{ $id }}">{{ $l }}</a>@endforeach</aside>
    <div class="ec-icontent">

    {{-- 1 highlights --}}
    {!! $H('highlights', $nm . ($year ? ' ' . $year : '') . ' highlights', trim($e['name'] . (!empty($e['conducting_body']) ? ' is conducted by ' . $e['conducting_body']['name'] : '') . (!empty($e['program_levels']) ? ' for ' . implode(' and ', $e['program_levels']) . ' admissions' : '') . '.')) !!}
    @php
        $rows = array_filter([
            'Full name' => $e['name'], 'Short name' => $e['short_name'],
            'Conducting body' => $e['conducting_body']['name'] ?? null,
            'Exam level' => trim(($e['type_label'] ?? '') . (!empty($e['states']) ? ' (' . implode(', ', $e['states']) . ')' : '')) ?: null,
            'Course level' => !empty($e['program_levels']) ? implode(', ', $e['program_levels']) : null,
            'Exam category' => !empty($e['categories']) ? implode(', ', $e['categories']) : null,
            'Held' => $e['frequency'] ?? null,
            'Stages' => $multiStage ? $stages->pluck('name')->implode(' → ') : null,
            'Mode' => $modes->implode(' / ') ?: null,
            'Duration' => $dur($p0['duration_minutes'] ?? null),
            'Questions' => $p0['total_questions'] ?? null, 'Total marks' => isset($p0['total_marks']) ? Ec::num($p0['total_marks']) : null,
            'Marking' => $marking($p0),
            'Languages' => $langs ?: null,
            'Application fee' => $fees->isNotEmpty() ? ($fees->min('amount') == $fees->max('amount') ? Ec::money($fees->min('amount'), $fees->first()['currency']) : Ec::money($fees->min('amount')) . ' – ' . Ec::money($fees->max('amount'))) : null,
            'Used in' => $counsellings->isNotEmpty() ? $counsellings->count() . ' ' . Str::plural('counselling', $counsellings->count()) : 'College-wise admission',
        ], fn ($v) => $v !== null && $v !== '');
    @endphp
    <div class="ec-cardx"><table class="ec-kvt"><tbody>
        @foreach($rows as $k => $v)<tr><th>{{ $k }}</th><td>{{ $v }}</td></tr>@endforeach
        @if(!empty($e['official_website']))<tr><th>Official website</th><td><a href="{{ $e['official_website'] }}" target="_blank" rel="noopener">{{ parse_url($e['official_website'], PHP_URL_HOST) ?: $e['official_website'] }} ↗</a></td></tr>@endif
    </tbody></table></div>
    @if($e['about'])<div class="ec-cardx ec-mt ec-rich">{!! Ec::rich($e['about']) !!}</div>@endif
    @if(!empty($page['cycle']['status_note']))<div class="ec-callout"><b>Update for {{ $year }}</b><div>{{ $page['cycle']['status_note'] }}</div></div>@endif

    {{-- 2 dates --}}
    @isset($secs['dates'])
        {!! $H('dates', 'Important dates', $title . ' schedule from registration to result. Dates change only through official notices.') !!}
        <div class="ec-tcard"><table class="ec-t">
            <colgroup><col style="width:46%"><col style="width:36%"><col style="width:18%"></colgroup>
            <thead><tr><th>Event</th><th>Date</th><th class="c">Status</th></tr></thead>
            <tbody>
            @foreach($byGroup as $g => $list)
                <tr class="ec-grp"><td colspan="3" style="--c:var(--blue)"><span>{{ $g }}</span></td></tr>
                @foreach($list as $d)
                    @php [$pc, $pl] = Ec::eventPill($d); @endphp
                    <tr class="ec-row{{ $pc === 'closed' ? ' ec-closedrow' : '' }}"><td class="nmc">{{ Ec::eventName($d) }}@if($d['note'])<div class="ec-none">{{ $d['note'] }}</div>@endif</td>
                        <td class="ec-dt" data-l="Date"><b>{{ Ec::dateText($d['date_text']) }}</b>@if($d['link_url'])<small><a href="{{ $d['link_url'] }}" target="_blank" rel="noopener">Official link ↗</a></small>@endif</td>
                        <td class="c stc"><span class="ec-st {{ $pc }}">{{ $pl }}</span></td></tr>
                @endforeach
            @endforeach
            @if($counsellings->isNotEmpty())
                <tr class="ec-grp"><td colspan="3" style="--c:var(--orange)"><span>Counselling</span></td></tr>
                @foreach($counsellings->take(3) as $c)
                    @php $f = $c['_s']['first'] ?? null; @endphp
                    <tr class="ec-row"><td class="nmc"><a href="{{ route('counselling.show', $c['slug']) }}">{{ $c['name'] }}</a>{{ $f ? ': ' . $f['name'] : '' }}</td>
                        <td class="ec-dt" data-l="Date"><b>{{ $f ? Ec::fmt($f['s']) . ($f['e'] && !$f['e']->eq($f['s']) ? ' – ' . Ec::fmt($f['e']) : '') : ($c['now']['when'] ?? 'To be announced') }}</b></td>
                        <td class="c stc"><span class="ec-st {{ Ec::COUN_PILL[$c['_s']['state']] }}">{{ Ec::COUN_LABEL[$c['_s']['state']] }}</span></td></tr>
                @endforeach
            @endif
            </tbody>
        </table></div>
    @endisset

    {{-- 3 eligibility --}}
    @isset($secs['eligibility'])
        {!! $H('eligibility', 'Eligibility', 'Check every point before you apply. Ineligible candidates can be disqualified even after the result.') !!}
        @foreach($page['eligibility'] as $el)
            @if($multiStage && $el['stage'])<h3 class="ec-mt" style="font-size:16px;margin-bottom:10px">{{ $el['stage'] }}</h3>@endif
            @php
                $age = $el['age'] ?? [];
                $ageText = $age['min'] || $age['max'] ? trim(($age['min'] ? 'At least ' . $age['min'] . ' years' : '') . ($age['min'] && $age['max'] ? ', ' : '') . ($age['max'] ? 'at most ' . $age['max'] . ' years' : '') . ($age['as_of'] ? ' as on ' . Ec::fmt(Ec::d($age['as_of'])) : '') . '.') : null;
                $cards = array_filter(['Nationality' => $el['nationality'] ?? null, 'Age' => $ageText ? ucfirst($ageText) . (!empty($el['age_relaxation']) ? ' Relaxation: ' . collect($el['age_relaxation'])->map(fn ($a) => $a['category'] . ' ' . $a['years'] . ' yrs')->implode(', ') . '.' : '') : null,
                    'Attempts' => $el['max_attempts'] ? 'At most ' . $el['max_attempts'] . ' ' . Str::plural('attempt', $el['max_attempts']) . '.' : null]);
                $ticks = array_filter([$el['qualification'] ? 'Qualification: ' . $el['qualification'] : null, !empty($el['subjects']) ? 'Subjects: ' . implode(', ', $el['subjects']) : null,
                    $el['appearing_allowed'] === true ? 'Candidates appearing in the qualifying exam can apply' : ($el['appearing_allowed'] === false ? 'The qualifying exam must already be passed' : null)]);
            @endphp
            @if($cards)<div class="ec-grid3">@foreach($cards as $k => $v)<div class="ec-cardx"><h3>{{ $k }}</h3><p>{{ $v }}</p></div>@endforeach</div>@endif
            @if($ticks || $el['min_percentage_general'] !== null || $el['other_conditions'])
                <div class="ec-grid2 ec-mt">
                    @if($ticks || $el['other_conditions'])<div class="ec-cardx"><h3>Qualifying exam</h3>@if($ticks)<ul class="ec-ticks">@foreach($ticks as $t)<li>{{ $t }}</li>@endforeach</ul>@endif @if($el['other_conditions'])<div class="ec-rich ec-mt">{!! Ec::rich($el['other_conditions']) !!}</div>@endif</div>@endif
                    @if($el['min_percentage_general'] !== null || $el['min_percentage_reserved'] !== null)
                        <div class="ec-cardx"><h3>Minimum marks in the qualifying exam</h3><table class="ec-mini"><thead><tr><th>Category</th><th class="r">Minimum</th></tr></thead><tbody>
                            @if($el['min_percentage_general'] !== null)<tr><td>General</td><td class="r"><b>{{ Ec::num($el['min_percentage_general']) }}%</b></td></tr>@endif
                            @if($el['min_percentage_reserved'] !== null)<tr><td>Reserved categories</td><td class="r"><b>{{ Ec::num($el['min_percentage_reserved']) }}%</b></td></tr>@endif
                        </tbody></table></div>
                    @endif
                </div>
            @endif
        @endforeach
    @endisset

    {{-- 4 apply --}}
    @isset($secs['apply'])
        {!! $H('apply', 'How to apply', 'Apply on the official website only. Keep your documents ready before you start.') !!}
        <ol class="ec-steps">@foreach([['Register', 'Create an account on the official website with your mobile number and email.'], ['Fill the form', 'Personal, academic and address details' . ($page['centres'] ?? false ? ', exam city choices' : '') . '.'], ['Upload documents', 'Photo, signature and certificates in the sizes the form asks for.'], ['Pay the fee', 'Online. The fee is usually not refundable.'], ['Submit', 'Check every field before you submit.'], ['Save confirmation', 'Download and keep the confirmation page.']] as $i => [$t, $d])<li><i>{{ $i + 1 }}</i><b>{{ $t }}</b><span>{{ $d }}</span></li>@endforeach</ol>
        <div class="ec-grid2 ec-mt">
            @if(!empty($page['documents']))
                <div class="ec-cardx"><h3>Documents to upload</h3><table class="ec-mini"><colgroup><col style="width:58%"><col style="width:42%"></colgroup><thead><tr><th>Document</th><th class="r">Notes</th></tr></thead><tbody>
                    @foreach($page['documents'] as $d)<tr><td>{{ $d['name'] }}@if($multiStage && $d['stage'])<div class="ec-none">{{ $d['stage'] }}</div>@endif</td><td class="r">{{ $d['notes'] ?: ($d['is_mandatory'] ? 'Required' : 'If applicable') }}</td></tr>@endforeach
                </tbody></table></div>
            @endif
            <div class="ec-cardx"><h3>Application fee</h3>
                @if($fees->isNotEmpty())
                    <table class="ec-mini"><thead><tr><th>Category</th><th class="r">Fee</th></tr></thead><tbody>
                        @foreach($fees as $f)<tr><td>{{ implode(' · ', array_filter([$f['category'] ?: 'All candidates', $f['gender'], $multiStage ? $f['stage'] : null])) }}</td><td class="r"><b>{{ Ec::money($f['amount'], $f['currency']) }}</b></td></tr>@endforeach
                    </tbody></table>
                @endif
                <p class="ec-mt">@if($s['grp'] === 0 && $s['re'])Registration closes on <b>{{ Ec::fmt($s['re']) }}</b>.@elseif($s['grp'] === 1 && $s['rs'])Registration opens on <b>{{ Ec::fmt($s['rs']) }}</b>.@elseif($s['rs'])Registration for this cycle is closed.@endif</p>
                @if($s['grp'] === 0 && $s['apply_url'])<a class="ec-btn ec-btn-orange ec-btn-sm ec-mt" href="{{ $s['apply_url'] }}" target="_blank" rel="noopener">Apply on the official website ↗</a>@endif
            </div>
        </div>
    @endisset

    {{-- 5 pattern --}}
    @isset($secs['pattern'])
        {!! $H('pattern', 'Exam pattern', implode(', ', array_filter([$p0['total_questions'] ? $p0['total_questions'] . ' questions' : null, isset($p0['total_marks']) ? Ec::num($p0['total_marks']) . ' marks' : null, $dur($p0['duration_minutes'] ?? null)])) ?: null) !!}
        @foreach($pattern as $p)
            @if($multiStage && $p['stage'])<h3 class="ec-mt" style="font-size:16px;margin-bottom:10px">{{ $p['stage'] }}</h3>@endif
            @php $tiles = array_filter([['<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M8 20h8M12 16v4"/>', 'Mode', $p['mode']], ['<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>', 'Duration', $dur($p['duration_minutes'])], ['<path d="M8 6h13M8 12h13M8 18h13M3 6h1M3 12h1M3 18h1"/>', 'Questions', $p['total_questions']], ['<path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9z"/>', 'Total marks', $p['total_marks'] !== null ? Ec::num($p['total_marks']) : null], ['<path d="M5 12h14M12 5v14"/>', 'Marking', $marking($p)], ['<path d="M4 5h9M8.5 3v2M6 5c0 4 3 7 6 8M11 5c0 4-3 7-6 8M13 20l4-9 4 9M14.5 17h5"/>', 'Question types', !empty($p['question_types']) ? implode(', ', $p['question_types']) : null]], fn ($t) => $t[2] !== null && $t[2] !== ''); @endphp
            <div class="ec-tiles">@foreach($tiles as [$ic, $l, $v])<div class="ec-tile">{!! $ti($ic) !!}<span><small>{{ $l }}</small><b>{{ $v }}</b></span></div>@endforeach</div>
            @if(!empty($p['sections']))
                <div class="ec-grid2 ec-mt">
                    <div class="ec-cardx"><h3>Section-wise distribution</h3><table class="ec-mini"><colgroup><col style="width:56%"><col style="width:22%"><col style="width:22%"></colgroup><thead><tr><th>Section</th><th class="r">Questions</th><th class="r">Marks</th></tr></thead><tbody>
                        @foreach($p['sections'] as $sc)<tr><td>{{ $sc['name'] }}</td><td class="r">{{ $sc['questions'] ?? '–' }}</td><td class="r"><b>{{ $sc['marks'] ?? '–' }}</b></td></tr>@endforeach
                    </tbody></table></div>
                    <div class="ec-cardx"><h3>Marking scheme</h3><table class="ec-mini"><tbody>
                        <tr><td>Wrong answer</td><td class="r"><b class="{{ $p['negative_marking'] ? 'ec-neg' : '' }}">{{ $p['negative_marking'] ? ($p['negative_marks'] ? '−' . Ec::num($p['negative_marks']) : 'Negative marking') : 'No deduction' }}</b></td></tr>
                        <tr><td>Not attempted</td><td class="r"><b>0</b></td></tr>
                    </tbody></table>@if($p['negative_marking'])<p class="ec-mt">Negative marking applies, so avoid blind guesses.</p>@endif</div>
                </div>
            @endif
        @endforeach
    @endisset

    {{-- 6 syllabus: one subject at a time (tabs in the page) --}}
    @isset($secs['syllabus'])
        @php $syl = collect($page['syllabus']); @endphp
        {!! $H('syllabus', 'Syllabus', $syl->count() . ' ' . Str::plural('subject', $syl->count()) . ', ' . $syl->sum(fn ($x) => count($x['topics'] ?? [])) . ' topics. Pick a subject.') !!}
        @if($syl->count() > 1)
            <div class="ec-tabs-row"><div class="ec-tabs" role="tablist" data-ec-tabs="syl">@foreach($syl as $i => $x)<button type="button" role="tab" data-ec-tab="{{ $i }}" aria-selected="{{ $i ? 'false' : 'true' }}">{{ $x['subject'] }}{{ $multiStage && $x['stage'] ? ' (' . $x['stage'] . ')' : '' }}<small>{{ count($x['topics'] ?? []) }}</small></button>@endforeach</div></div>
        @endif
        @foreach($syl as $i => $x)
            <div class="ec-cardx ec-sylbox" data-ec-pane="syl" data-ec-key="{{ $i }}" @if($i) hidden @endif>
                <div class="ec-sylhead"><b>{{ $x['subject'] }}</b><span>{{ count($x['topics'] ?? []) }} topics</span>@if($x['pdf_url'])<a class="ec-btn ec-btn-line ec-btn-sm" href="{{ $x['pdf_url'] }}" target="_blank" rel="noopener">Download syllabus PDF</a>@endif</div>
                @if(!empty($x['topics']))<ol class="ec-syl">@foreach($x['topics'] as $j => $t)<li><span class="sn">{{ str_pad($j + 1, 2, '0', STR_PAD_LEFT) }}</span><span>{{ is_array($t) ? ($t['name'] ?? $t['title'] ?? '') : $t }}</span>@if(is_array($t) && !empty($t['class']))<span class="sc">Class {{ $t['class'] }}</span>@endif</li>@endforeach</ol>@endif
            </div>
        @endforeach
    @endisset

    {{-- 7 centres --}}
    @isset($secs['centres'])
        @php $cities = collect($page['centres'])->sum(fn ($c) => count($c['cities'])); @endphp
        {!! $H('centres', 'Exam centres', $cities . ' exam ' . Str::plural('city', $cities) . '. You choose cities in the form; the exact centre is on the admit card.') !!}
        <div class="ec-cardx"><div class="ec-cgrid">@foreach($page['centres'] as $c)<div class="ec-cst" title="{{ implode(', ', $c['cities']) }}"><b>{{ $c['state'] }}</b><span>{{ count($c['cities']) }} {{ Str::plural('city', count($c['cities'])) }}</span></div>@endforeach</div></div>
    @endisset

    {{-- the exam's own extra sections (admit card, exam day rules, helpline... added in the CRM) --}}
    @foreach($page['extra'] ?? [] as $x)
        {!! $H('x-' . Str::slug($x['key'] ?: $x['label']), $x['label']) !!}
        <div class="ec-cardx ec-rich">{!! Ec::rich($x['value']) !!}</div>
    @endforeach

    {{-- 10 answer key and result --}}
    @isset($secs['result'])
        @php $rd = $dates->filter(fn ($d) => in_array($d['type']['slug'] ?? '', $resultTypes, true))->values(); @endphp
        {!! $H('result', 'Answer key and result', 'Check the provisional answer key, raise objections if needed, then get your score.') !!}
        <ol class="ec-steps {{ $rd->count() >= 4 ? 'four' : '' }}">@foreach($rd->take(4) as $i => $d)<li><i>{{ $i + 1 }}</i><b>{{ Ec::eventName($d) }}</b><span>{{ Ec::dateText($d['date_text']) }}</span></li>@endforeach</ol>
    @endisset

    {{-- 11 previous papers --}}
    @isset($secs['prep'])
        {!! $H('prep', 'Previous year papers', 'Practise them under exam time limits.') !!}
        <div class="ec-cardx"><div class="ec-papers">@foreach($page['papers'] as $pp)<a href="{{ $pp['url'] ?: '#' }}" target="_blank" rel="noopener"><b>{{ $pp['year'] }}</b><span>{{ $pp['title'] }}{{ $pp['shift'] ? ' · ' . $pp['shift'] : '' }}</span><em>PDF</em></a>@endforeach</div></div>
    @endisset

    {{-- 12 counselling and cutoffs --}}
    {!! $H('after', 'Counselling and cutoffs', $counsellings->isNotEmpty() ? 'Your ' . $nm . ' rank is used in ' . $counsellings->count() . ' ' . Str::plural('counselling', $counsellings->count()) . '.' : 'No central counselling; colleges admit directly.') !!}
    @if($counsellings->isNotEmpty())
        <div class="ec-cprev">
            @foreach($counsellings->sortBy(fn ($c) => [($c['level'] === 'state' ? 1 : 0), $c['_s']['grp']])->take(3) as $c)
                @php $cs = $c['_s']; @endphp
                <article class="ec-ccard"><h3>{{ $c['name'] }}</h3><span class="meta">{{ implode(' · ', array_filter([$c['conducting_body'] ?? null, Ec::LEVEL[$c['level']] ?? null, $c['level'] === 'state' ? implode(', ', $c['states'] ?? []) : null])) }}</span>
                    <div class="now">@if($cs['cur'])<b>{{ $cs['cur']['name'] }} live</b> · ends {{ Ec::inDays($cs['cur']['e']) }}@elseif($cs['state'] === 'upcoming')<b>Starts {{ Ec::fmt($cs['first']['s']) }}</b>@elseif($cs['state'] === 'between')<b>Next: {{ $cs['next']['name'] }}</b> · {{ Ec::fmt($cs['next']['s']) }}@elseif($cs['state'] === 'completed')<b>Completed</b> · cutoffs are final@else<b>{{ $c['now']['step'] ?? 'Schedule awaited' }}</b>@endif</div>
                    <div class="row2"><a class="ec-btn ec-btn-blue ec-btn-sm" href="{{ route('counselling.show', $c['slug']) }}">See counselling</a><a class="ec-btn ec-btn-line ec-btn-sm" href="{{ route('cutoffs.index', ['exam' => $slug, 'counselling' => $c['slug']]) }}">Cutoffs</a></div></article>
            @endforeach
        </div>
        <div class="ec-center"><a class="ec-btn ec-btn-blue" href="{{ route('exam.tab', [$slug, 'counselling']) }}">All {{ $counsellings->count() }} {{ Str::plural('counselling', $counsellings->count()) }}</a><a class="ec-btn ec-btn-line" href="{{ route('exam.tab', [$slug, 'cutoffs']) }}">All cutoffs</a></div>
    @else
        <div class="ec-note"><b>Admission is college-wise</b>Each college that accepts {{ $nm }} runs its own process and publishes its own cutoff.</div>
    @endif

    {{-- 13 colleges --}}
    @isset($secs['colleges'])
        {!! $H('colleges', 'Colleges accepting ' . $nm, count($colleges) . ' ' . Str::plural('college course', count($colleges)) . ' on Enrollzy accept ' . $nm . ' scores.') !!}
        <div class="ec-colgrid">@foreach(array_slice($colleges, 0, 6) as $c)<{{ $c['url'] ? 'a' : 'div' }} class="ec-colc" @if($c['url']) href="{{ $c['url'] }}" @endif><b>{{ $c['college'] }}</b><span>{{ implode(' · ', array_filter([$c['course'], $c['place']])) }}</span></{{ $c['url'] ? 'a' : 'div' }}>@endforeach</div>
        @if(count($colleges) > 6)<div class="ec-center"><a class="ec-btn ec-btn-line" href="{{ route('exam.tab', [$slug, 'colleges']) }}">See all colleges</a></div>@endif
    @endisset

    {{-- 14 contact --}}
    @isset($secs['contact'])
        {!! $H('contact', 'Contact and official links', 'For anything about your form, admit card or result, contact the conducting body.') !!}
        <div class="ec-grid3">
            @if(!empty($e['conducting_body']))<div class="ec-cardx"><h3>Conducting body</h3><p><b>{{ $e['conducting_body']['name'] }}</b></p>@if(!empty($e['conducting_body']['website']))<a class="ec-btn ec-btn-line ec-btn-sm ec-mt" href="{{ $e['conducting_body']['website'] }}" target="_blank" rel="noopener">Website ↗</a>@endif</div>@endif
            @if(!empty($e['official_website']))<div class="ec-cardx"><h3>Official website</h3><p><b>{{ parse_url($e['official_website'], PHP_URL_HOST) ?: $e['official_website'] }}</b></p><a class="ec-btn ec-btn-line ec-btn-sm ec-mt" href="{{ $e['official_website'] }}" target="_blank" rel="noopener">Open website ↗</a></div>@endif
            <div class="ec-cardx"><h3>Get alerts</h3><p>An email when dates change or registration opens.</p><a class="ec-btn ec-btn-line ec-btn-sm ec-mt" href="#alerts" data-ec-alerts-open data-type="exam" data-slug="{{ $slug }}" data-name="{{ $title }}">Get alerts</a></div>
        </div>
    @endisset

    {{-- 15 faq --}}
    @isset($secs['faq'])
        {!! $H('faq', $nm . ' FAQs') !!}
        <div class="ec-fqlist">@foreach($page['faqs'] as $i => $f)<details class="ec-fq" @if(!$i) open @endif><summary>{{ $f['question'] }}</summary><div class="ec-rich">{!! Ec::rich($f['answer']) !!}</div></details>@endforeach</div>
    @endisset
    </div>
</div></section>
