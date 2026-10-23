{{-- Counselling details: every section from the counselling's record in the CRM; empty ones are left out ($secs).
     $seats (seat-matrix API, 1 row: categories with totals), $institutes (6 colleges), $preview (latest cutoffs) --}}
@php
    use App\Support\Ec\Ec;
    use Illuminate\Support\Str;
    $H = fn ($id, $t, $sub = null) => '<div class="ec-ihead" id="sec-' . $id . '"><h2>' . e($t) . '</h2>' . ($sub ? '<p>' . e($sub) . '</p>' : '') . '</div>';
    $nm = $c['short_name'] ?: $c['name'];
    $isState = $c['level'] === 'state';
    $examNames = $exams->map(fn ($x) => $x['short_name'] ?: $x['name'])->implode(' / ');
    $fees = collect($page['fees'] ?? []);
    $regFee = $fees->first(fn ($f) => Str::contains(Str::lower($f['fee_type'] . ' ' . $f['fee_type_label']), 'regist'));
    $roundsApi = collect($page['rounds'] ?? []);
@endphp
<section class="ec-osec ec-gutter"><div class="ec-wrap ec-ilayout">
    <aside class="ec-toc" aria-label="On this page"><b>On this page</b>@foreach($secs as $id => $l)<a href="#sec-{{ $id }}" data-ec-toc="{{ $id }}">{{ $l }}</a>@endforeach</aside>
    <div class="ec-icontent">

    {{-- highlights --}}
    {!! $H('highlights', $name . ' highlights', trim(($c['conducting_body']['name'] ?? 'This counselling') . ' allots seats' . ($collegeCount ? ' in ' . $collegeCount . ' ' . Str::plural('college', $collegeCount) : '') . ($examNames ? ' using ' . $examNames . ' ranks' : '') . '.')) !!}
    @php
        $rows = array_filter([
            'Conducted by' => $c['conducting_body']['name'] ?? null,
            'Based on exam' => $examNames ?: null,
            'Level' => (Ec::LEVEL[$c['level']] ?? ucfirst((string) $c['level'])) . ($isState && $c['states'] ? ' (' . implode(', ', $c['states']) . ')' : ''),
            'Courses' => !empty($c['program_levels']) ? implode(', ', array_merge($c['course_categories'] ?? [], $c['program_levels'])) : null,
            'Quotas' => !empty($page['institutes']['quotas']) ? implode(', ', $page['institutes']['quotas']) : null,
            'Total seats' => $seatTotal ? Ec::num($seatTotal) . ' (latest seat matrix)' : null,
            'Participating colleges' => $collegeCount ?: null,
            'Rounds' => $rounds ? count($rounds) . ': ' . collect($rounds)->pluck('name')->implode(', ') : null,
            'Mode' => $c['mode'] ? ucfirst($c['mode']) : null,
            'Seat allotment' => $cy['seat_allotment_method'] ?? null,
            'Registration fee' => $regFee ? Ec::money($regFee['amount'], $regFee['currency']) . ($regFee['category'] ? ' (' . $regFee['category'] . ')' : '') : null,
            'Cutoffs available' => !empty($page['available_years']) ? implode(', ', $page['available_years']) : null,
        ], fn ($v) => $v !== null && $v !== '');
    @endphp
    <div class="ec-cardx"><table class="ec-kvt"><tbody>@foreach($rows as $k => $v)<tr><th>{{ $k }}</th><td>{{ $v }}</td></tr>@endforeach</tbody></table></div>
    @if($c['about'])<div class="ec-cardx ec-mt ec-rich">{!! Ec::rich($c['about']) !!}</div>@endif
    @if($s['cur'])<div class="ec-callout"><b>{{ $s['cur']['name'] }} is live</b><ul><li>Ends on {{ Ec::fmt($s['cur']['e']) }} ({{ Ec::days($s['cur']['e']) }} {{ Ec::days($s['cur']['e']) === 1 ? 'day' : 'days' }} left).</li>@if(!empty($page['now']['step']))<li>Now: {{ $page['now']['step'] }} · {{ $page['now']['when'] }}</li>@endif</ul></div>
    @elseif(!empty($cy['status_note']))<div class="ec-callout"><b>Update</b><div>{{ $cy['status_note'] }}</div></div>@endif

    {{-- rounds and dates --}}
    @isset($secs['dates'])
        {!! $H('dates', 'Rounds and dates', count($rounds) . ' ' . Str::plural('round', count($rounds)) . '. Each round has registration, choice filling, allotment and reporting.') !!}
        <div class="ec-tcard"><table class="ec-t">
            <colgroup><col style="width:46%"><col style="width:36%"><col style="width:18%"></colgroup>
            <thead><tr><th>Event</th><th>Date</th><th class="c">Status</th></tr></thead>
            <tbody>
            @if(!empty($page['dates']['cycle']))
                <tr class="ec-grp"><td colspan="3" style="--c:var(--blue)"><span>Before the rounds</span></td></tr>
                @foreach($page['dates']['cycle'] as $d)@php [$pc, $pl] = Ec::eventPill($d); @endphp<tr class="ec-row{{ $pc === 'closed' ? ' ec-closedrow' : '' }}"><td class="nmc">{{ Ec::eventName($d) }}</td><td class="ec-dt" data-l="Date"><b>{{ Ec::dateText($d['date_text']) }}</b></td><td class="c stc"><span class="ec-st {{ $pc }}">{{ $pl }}</span></td></tr>@endforeach
            @endif
            @foreach($page['dates']['rounds'] ?? [] as $i => $r)
                @php $span = $s['rounds'][$i] ?? null; @endphp
                <tr class="ec-grp"><td colspan="3" style="--c:{{ !$span || !$span['s'] ? 'var(--blue)' : (Ec::days($span['e']) < 0 ? '#9aa6bb' : (Ec::days($span['s']) <= 0 ? 'var(--green)' : 'var(--blue)')) }}"><span>{{ $r['name'] }}</span>@if($span && $span['s'])<small>{{ Ec::fmt($span['s'], false) }} – {{ Ec::fmt($span['e']) }}</small>@endif</td></tr>
                @forelse($r['events'] as $d)
                    @php [$pc, $pl] = Ec::eventPill($d); @endphp
                    <tr class="ec-row{{ $pc === 'closed' ? ' ec-closedrow' : '' }}"><td class="nmc">{{ Ec::eventName($d) }}@if($d['note'])<div class="ec-none">{{ $d['note'] }}</div>@endif</td>
                        <td class="ec-dt" data-l="Date"><b>{{ Ec::dateText($d['date_text']) }}</b>@if($d['link_url'])<small><a href="{{ $d['link_url'] }}" target="_blank" rel="noopener">Official link ↗</a></small>@endif</td>
                        <td class="c stc"><span class="ec-st {{ $pc }}">{{ $pl }}</span></td></tr>
                @empty
                    <tr class="ec-row"><td class="nmc" colspan="3"><span class="ec-none">Dates for this round are not announced yet.</span></td></tr>
                @endforelse
            @endforeach
            </tbody>
        </table></div>
    @endisset

    {{-- eligibility and quotas --}}
    @isset($secs['eligibility'])
        {!! $H('eligibility', 'Eligibility and quotas', $isState ? 'For candidates who meet ' . implode(', ', $c['states']) . '\'s domicile rules, plus any open seats.' : 'Who can register, and the quotas this counselling fills.') !!}
        <div class="ec-grid2">
            @foreach($page['eligibility'] as $el)
                @php
                    $ticks = array_filter([
                        $examNames ? 'A valid ' . $examNames . ' rank or score' : null,
                        $el['qualifying_class'] ? 'Passed ' . $el['qualifying_class'] . (!empty($el['qualifying_subjects']) ? ' with ' . implode(', ', $el['qualifying_subjects']) : '') : null,
                        !empty($el['nationality_allowed']) ? 'Open to: ' . implode(', ', $el['nationality_allowed']) : null,
                        ($el['age']['min'] ?? null) ? 'At least ' . $el['age']['min'] . ' years old' . (!empty($el['age']['as_of']) ? ' on ' . Ec::fmt(Ec::d($el['age']['as_of'])) : '') : null,
                        ($el['domicile']['label'] ?? null) ? $el['domicile']['label'] . (!empty($el['domicile']['states']) ? ': ' . implode(', ', $el['domicile']['states']) : '') . (!empty($el['domicile']['study_years_required']) ? ' (' . $el['domicile']['study_years_required'] . ' years of study)' : '') : null,
                        $el['domicile']['notes'] ?? null,
                    ]);
                @endphp
                <div class="ec-cardx"><h3>Who can register{{ $el['quota'] ? ': ' . $el['quota'] : '' }}</h3>
                    @if($ticks)<ul class="ec-ticks">@foreach($ticks as $t)<li>{{ $t }}</li>@endforeach</ul>@endif
                    @if(!empty($el['minimum_scores']))
                        <table class="ec-mini ec-mt"><thead><tr><th>Category</th><th class="r">Minimum to qualify</th></tr></thead><tbody>
                            @foreach($el['minimum_scores'] as $ms)<tr><td>{{ $ms['category'] }}{{ $ms['exam'] ? ' · ' . $ms['exam'] : '' }}</td><td class="r"><b>{{ $ms['min_percentile'] !== null ? Ec::num($ms['min_percentile']) . ' percentile' : ($ms['min_score'] !== null ? Ec::num($ms['min_score']) . ' marks' : ($ms['max_rank'] ? 'Rank up to ' . Ec::num($ms['max_rank']) : ($ms['min_qualifying_percent'] !== null ? Ec::num($ms['min_qualifying_percent']) . '%' : '–'))) }}</b></td></tr>@endforeach
                        </tbody></table>
                    @endif
                    @if($el['other_conditions'])<div class="ec-rich ec-mt">{!! Ec::rich($el['other_conditions']) !!}</div>@endif
                </div>
            @endforeach
            @if(!empty($page['institutes']['quotas']))
                <div class="ec-cardx"><h3>Quotas covered</h3><ul class="ec-ticks">@foreach($page['institutes']['quotas'] as $q)<li>{{ $q }}</li>@endforeach</ul>@if(!empty($cy['reservation_policy']))<div class="ec-rich ec-mt">{!! Ec::rich($cy['reservation_policy']) !!}</div>@endif</div>
            @endif
        </div>
    @endisset

    {{-- seat matrix --}}
    @isset($secs['seats'])
        @php $v = $seats['meta']['version']; @endphp @php $cats = collect($seats['categories'] ?? []); @endphp
        {!! $H('seats', 'Seat matrix', Ec::num($v['total_seats']) . ' seats in ' . ($seats['meta']['round']['name'] ?? 'the latest round') . '. The seat matrix is updated before every round.') !!}
        <div class="ec-grid2">
            @if($cats->isNotEmpty())
                @php $cm = max(1, (int) $cats->max('seats')); @endphp
                <div class="ec-cardx"><h3>Seats by category</h3><div class="ec-bars">@foreach($cats as $k)<div class="ec-bar"><span title="{{ $k['name'] }}">{{ $k['short_name'] ?? $k['name'] }}</span><i style="--w:{{ round(($k['seats'] ?? 0) / $cm * 100, 1) }}%"></i><b>{{ Ec::num($k['seats'] ?? 0) }}</b></div>@endforeach</div></div>
            @endif
            <div class="ec-cardx"><h3>Seat matrix versions</h3><div class="ec-papers">
                @foreach($roundsApi as $r)@foreach($r['seat_matrix']['versions'] ?? [] as $ver)
                    <a href="{{ route('counselling.seats', $slug) }}?round={{ $r['id'] }}{{ $year ? '&year=' . $year : '' }}"><b style="font-size:13px">{{ $r['name'] }}</b><span>{{ $ver['label'] ?: 'Version ' . $ver['version_no'] }}{{ $ver['published_on'] ? ' · ' . Ec::fmt(Ec::d($ver['published_on'])) : '' }}</span><em style="{{ $ver['is_live'] ? 'color:var(--green);background:var(--green-soft)' : '' }}">{{ $ver['is_live'] ? 'Live' : 'Old' }}</em></a>
                @endforeach @endforeach
            </div><div class="ec-center" style="margin-top:12px"><a class="ec-btn ec-btn-line ec-btn-sm" href="{{ route('counselling.seats', $slug) }}{{ $year ? '?year=' . $year : '' }}">See the full seat matrix</a></div></div>
        </div>
    @endisset

    {{-- fees --}}
    @isset($secs['fees'])
        {!! $H('fees', 'Fees and security deposit', 'Paid online during registration. Refund rules are below.') !!}
        <div class="ec-cardx"><table class="ec-mini"><colgroup><col style="width:46%"><col style="width:30%"><col style="width:24%"></colgroup><thead><tr><th>Payment</th><th>Applies to</th><th class="r">Amount</th></tr></thead><tbody>
            @foreach($fees as $f)<tr><td>{{ $f['fee_type_label'] }}@if($f['note'])<div class="ec-none">{{ $f['note'] }}</div>@endif</td><td>{{ implode(' · ', array_filter([$f['category'], $f['quota'], $f['institute_type']])) ?: 'Everyone' }}</td><td class="r"><b>{{ Ec::money($f['amount'], $f['currency']) }}</b><div class="ec-none">{{ $f['is_refundable'] ? 'Refundable' : 'Not refundable' }}</div></td></tr>@endforeach
        </tbody></table></div>
    @endisset

    {{-- process --}}
    @isset($secs['process'])
        {!! $H('process', 'Counselling process', 'The same steps repeat in every round.') !!}
        <ol class="ec-steps">@foreach($page['process'] as $i => $p)<li><i>{{ $p['step_no'] ?: $i + 1 }}</i><b>{{ $p['title'] }}</b>@if($p['description'])<span>{{ Str::limit(strip_tags($p['description']), 160) }}</span>@endif @if($p['date'])<span style="color:var(--blue);font-weight:600">{{ $p['date']['text'] }}</span>@endif</li>@endforeach</ol>
    @endisset

    {{-- options after allotment (willingness per round) --}}
    @isset($secs['options'])
        @php $opts = $roundsApi->flatMap(fn ($r) => $r['willingness_options'] ?? [])->unique()->values(); @endphp
        {!! $H('options', 'Options after allotment', 'What you can do with an allotted seat in each round.') !!}
        <div class="ec-tcard"><table class="ec-t">
            <thead><tr><th>Round</th>@foreach($opts as $o)<th class="c">{{ $o }}</th>@endforeach</tr></thead>
            <tbody>@foreach($roundsApi as $r)<tr class="ec-row"><td class="nmc"><b>{{ $r['name'] }}</b>@if($r['fresh_registration_allowed'] === false)<div class="ec-none">No fresh registration</div>@endif</td>@foreach($opts as $o)<td class="c">{!! in_array($o, $r['willingness_options'] ?? [], true) ? '<span class="ec-pos">✔</span>' : '<span class="ec-none">—</span>' !!}</td>@endforeach</tr>@endforeach</tbody>
        </table></div>
    @endisset

    {{-- choice filling tips --}}
    {!! $H('choice', 'Choice filling tips', 'Your choice list decides your seat. Order matters more than length.') !!}
    <div class="ec-cardx"><div class="ec-tips">@foreach(['Fill more choices than you think you need, including safer options at the end.', 'Order by your real preference; you get the highest choice your rank allows.', 'Compare with last year\'s closing ranks for your category and round.', 'Check fees and bond conditions before adding private and deemed colleges.', 'Do not leave choices unlocked till the last hour; portals slow down.', 'Print or save your locked choice list.'] as $i => $t)<div><i>{{ $i + 1 }}</i>{{ $t }}</div>@endforeach</div>
        <div class="ec-center">@if($primary)<a class="ec-btn ec-btn-blue ec-btn-sm" href="{{ route('cutoffs.index', ['exam' => $primary['slug'], 'counselling' => $slug]) }}">Check cutoffs for my rank</a>@endif<a class="ec-btn ec-btn-line ec-btn-sm" href="{{ route('experts') }}">Get help from an expert</a></div></div>

    {{-- documents --}}
    @isset($secs['documents'])
        {!! $H('documents', 'Documents', 'Carry originals and self-attested copies.') !!}
        @php $docGroups = collect($page['documents'])->groupBy(fn ($d) => $d['needed_at'] ?: 'Documents'); @endphp
        <div class="ec-grid2">@foreach($docGroups as $g => $docs)<div class="ec-cardx"><h3>{{ $g }}</h3><ul class="ec-ticks">@foreach($docs as $d)<li><span>{{ $d['name'] }}{{ $d['is_mandatory'] ? '' : ' (if applicable)' }}{{ $d['quota'] || $d['category'] ? ' · ' . implode(', ', array_filter([$d['quota'], $d['category']])) : '' }}@if($d['format_notes'])<br><small class="ec-none">{{ $d['format_notes'] }}</small>@endif @if($d['template_url'])<br><a href="{{ $d['template_url'] }}" target="_blank" rel="noopener">Format ↗</a>@endif</span></li>@endforeach</ul></div>@endforeach</div>
    @endisset

    {{-- participating institutes --}}
    @isset($secs['institutes'])
        {!! $H('institutes', 'Participating institutes', $collegeCount . ' ' . Str::plural('college', $collegeCount) . ' take part. Seats and fees differ by college type.') !!}
        <div class="ec-colgrid">@foreach($institutes['data'] as $x)@php $col = $x['college'] ?? $x; @endphp<a class="ec-colc" href="{{ !empty($col['slug']) ? route('university.detail', $col['slug']) : '#' }}"><b>{{ $col['name'] ?? '' }}</b><span>{{ implode(' · ', array_filter([$col['city'] ?? null, $col['state'] ?? null, isset($x['courses']) ? count($x['courses']) . ' ' . Str::plural('course', count($x['courses'])) : null])) }}</span></a>@endforeach</div>
        <div class="ec-center"><a class="ec-btn ec-btn-line" href="{{ $tabUrl('colleges') }}">See all participating colleges</a></div>
    @endisset

    {{-- cutoffs --}}
    @isset($secs['cutoffs'])
        @php $unit = $preview['rows'][0]['higher_is_worse'] ? 'rank' : mb_strtolower($preview['rows'][0]['rank_type_label']); @endphp
        {!! $H('cutoffs', 'Cutoffs', 'Closing ' . $unit . 's from ' . $preview['year'] . ', ' . $preview['round']['name'] . ($preview['category'] ? ', ' . $preview['category']['name'] : '') . '.') !!}
        <div class="ec-tcard"><table class="ec-t">
            <colgroup><col style="width:50%"><col style="width:25%"><col style="width:25%"></colgroup>
            <thead><tr><th>College and course</th><th class="num">Opening {{ $unit }}</th><th class="num">Closing {{ $unit }}</th></tr></thead>
            <tbody>@foreach($preview['rows'] as $r)<tr class="ec-row"><td class="nmc"><div class="ec-nm"><span><b>{{ $r['college']['name'] }}</b><small>{{ $r['course']['name'] }} · {{ $r['quota'] }}</small></span></div></td><td class="num numc" data-l="Opening {{ $unit }}">{{ Ec::num($r['opening_value']) }}</td><td class="num numc" data-l="Closing {{ $unit }}"><b>{{ Ec::num($r['closing_value']) }}</b></td></tr>@endforeach</tbody>
        </table>
        <div class="ec-tfoot"><span>Top {{ count($preview['rows']) }} of {{ number_format($preview['total']) }} rows</span>@if($primary)<a class="ec-see" href="{{ route('cutoffs.index', ['exam' => $primary['slug'], 'counselling' => $slug]) }}">All cutoffs, rounds and categories →</a>@endif</div></div>
    @endisset

    {{-- rules --}}
    @isset($secs['rules'])
        {!! $H('rules', 'Rules and refunds', 'Read these before you accept or leave a seat.') !!}
        <div class="ec-tcard"><table class="ec-t">
            <colgroup><col style="width:30%"><col style="width:26%"><col style="width:22%"><col style="width:22%"></colgroup>
            <thead><tr><th>If you</th><th>Deposit</th><th>Seat</th><th>Next round</th></tr></thead>
            <tbody>@foreach($page['rules'] as $r)<tr class="ec-row"><td class="nmc"><b>{{ $r['action'] }}</b>@if($r['quota'] || $r['institute_type'])<div class="ec-none">{{ implode(' · ', array_filter([$r['quota'], $r['institute_type']])) }}</div>@endif</td>
                <td class="ec-dt" data-l="Deposit"><b>{{ $r['deposit']['label'] ?? '–' }}</b>@if($r['deposit']['refund_percent'] !== null || $r['deposit']['refund_amount'] !== null)<small>{{ $r['deposit']['refund_percent'] !== null ? Ec::num($r['deposit']['refund_percent']) . '% refunded' : Ec::money($r['deposit']['refund_amount']) . ' refunded' }}</small>@endif</td>
                <td class="ec-dt" data-l="Seat"><b>{{ $r['seat_outcome'] ? ucfirst(str_replace('_', ' ', $r['seat_outcome'])) : '–' }}</b>@if($r['penalty_note'])<small>{{ $r['penalty_note'] }}</small>@endif</td>
                <td class="ec-dt" data-l="Next round"><b>{{ $r['eligible_for_next_round'] ? 'Can take part' : 'Cannot take part' }}</b></td></tr>@endforeach</tbody>
        </table></div>
    @endisset

    {{-- contact --}}
    @isset($secs['contact'])
        {!! $H('contact', 'Contact and official links') !!}
        <div class="ec-grid3">
            @if($c['helpline'])<div class="ec-cardx"><h3>Helpline</h3><p><b>{{ $c['helpline'] }}</b></p></div>@endif
            @if($portal)<div class="ec-cardx"><h3>Official portal</h3><p><b>{{ parse_url($portal, PHP_URL_HOST) ?: $portal }}</b></p><a class="ec-btn ec-btn-line ec-btn-sm ec-mt" href="{{ $portal }}" target="_blank" rel="noopener">Open portal ↗</a></div>@endif
            @if($bulletin)<div class="ec-cardx"><h3>Information bulletin</h3><p>Rules, seat matrix and schedule.</p><a class="ec-btn ec-btn-line ec-btn-sm ec-mt" href="{{ $bulletin }}" target="_blank" rel="noopener">Download ↗</a></div>@endif
        </div>
    @endisset
    @if(!empty($cy['source_url']))<p class="ec-src">Source: <a href="{{ $cy['source_url'] }}" target="_blank" rel="noopener">official notice ↗</a></p>@endif
    </div>
</div></section>
