@extends('layouts.app')
@php
    use App\Support\CounsellingUi as Ui;
    $c = $page['counselling'];
    $cycle = $page['cycle'];
    $now = $page['now'] ?? ['state' => 'tba', 'label' => 'Awaited', 'step' => 'Schedule awaited', 'when' => 'No dates yet'];
    $rounds = $page['rounds'] ?? [];
    $curId = $page['status_bar']['current_round']['id'] ?? null;
    $curIdx = collect($rounds)->search(fn ($r) => $r['id'] === $curId);
    $roundDates = collect($page['dates']['rounds'] ?? [])->keyBy('round_id');
    $portal = $c['registration_portal_url'] ?: $c['official_website'];
    $catName = collect($masters['categories'])->firstWhere('id', $catId)['name'] ?? (collect($source['categories'] ?? [])->firstWhere('id', $catId)['name'] ?? 'General');
    $examShort = $primary ? ($primary['short_name'] ?: $primary['name']) : null;
    $examYear = collect($cycle['exam_cycles'] ?? [])->first()['year'] ?? ($cycle['year'] ?? null);
    $yq = $year ? ['year' => $year] : [];

    // seat matrix: the latest round with a live version
    $seatRound = collect($rounds)->reverse()->first(fn ($r) => !empty($r['seat_matrix']['live']));

    // dates of "now": the current round's events, else the cycle-level ones
    $currentEvents = $curId ? ($roundDates[$curId]['events'] ?? []) : ($page['dates']['cycle'] ?? []);

    // deposit and seat rules: one tab per round that has rules
    $ruleRounds = collect($rounds)->filter(fn ($r) => !empty($r['rules']))->values();
    $ruleDefault = $ruleRounds->firstWhere('id', $curId)['id'] ?? ($ruleRounds->first()['id'] ?? null);

    // domicile notice for state counsellings
    $dom = collect($page['eligibility'] ?? [])->first(fn ($e) => ($e['domicile']['rule'] ?? 'none') !== 'none');
    $domStates = $dom ? ($dom['domicile']['states'] ?: ($c['states'] ?? [])) : [];
@endphp
@section('meta_title', $page['seo']['title'] ?? $c['name'])
@section('meta_description', $page['seo']['description'] ?? '')

@section('content')
@include('counselling._assets', ['canonical' => $page['seo']['canonical'] ?? null])
<main class="cz" data-cz-reload-on-profile>
    <div class="cz-hero cz-gutter">
        <div class="cz-container">
            <div class="cz-hero-main">
                <div class="cz-logo" aria-hidden="true">
                    @if($c['logo_url'])<img src="{{ $c['logo_url'] }}" alt="">@else{{ Ui::initials($c) }}@endif
                </div>
                <div class="cz-hero-text">
                    <h1>{{ $c['name'] }} {{ $cycle['year'] ?? '' }}{{ !empty($cycle['session_label']) ? ' ' . $cycle['session_label'] : '' }}</h1>
                    @if($c['conducting_body'])<div class="full">{{ $c['conducting_body']['name'] }}</div>@endif
                    <div class="cz-tags">
                        <span class="cz-tag blue">{{ Ui::LEVELS[$c['level']] ?? ucfirst($c['level']) }}</span>
                        @foreach(array_merge($c['course_categories'] ?? [], $c['program_levels'] ?? []) as $t)<span class="cz-tag">{{ $t }}</span>@endforeach
                        @if($examShort)<span class="cz-tag">Uses {{ $examShort }} {{ $examYear }}</span>@endif
                    </div>
                    <div class="cz-hero-meta">
                        @if(!empty($page['last_updated_at']))<span>Last updated <b>{{ Ui::date($page['last_updated_at']) }}</b></span>@endif
                        @if(!empty($cycle['last_verified_at']))<span>Verified {{ Ui::date($cycle['last_verified_at']) }}</span>@endif
                        @if(!empty($c['helpline']))<span>Helpline <b>{{ $c['helpline'] }}</b></span>@endif
                    </div>
                </div>
                <div class="cz-hero-actions">
                    <button type="button" class="cz-btn cz-btn-orange" data-cz-soon="Round alerts">Get round alerts</button>
                    @if($portal)<a class="cz-btn cz-btn-outline" href="{{ $portal }}" target="_blank" rel="noopener">Official portal ↗</a>@endif
                </div>
            </div>

            @if(count($page['available_years'] ?? []) > 1)
                <div class="cz-years">Year:
                    @foreach($page['available_years'] as $y)
                        @if(($cycle['year'] ?? null) === $y)<span class="cz-tag blue">{{ $y }}</span>
                        @else<a class="cz-tag" href="{{ $loop->first ? route('counselling.show', $slug) : route('counselling.show', ['slug' => $slug, 'year' => $y]) }}">{{ $y }}</a>@endif
                    @endforeach
                </div>
            @endif
            @if($isPast)
                <div class="cz-notice"><b>You are viewing {{ $cycle['year'] }}.</b> Dates and rules may have changed since. <a href="{{ route('counselling.show', $slug) }}">See the latest year</a></div>
            @endif
            @if(($page['marked'] ?? null) === 'archived')
                <div class="cz-notice warn"><b>Archived.</b> This counselling is no longer conducted. The page is kept for reference.</div>
            @elseif(($page['marked'] ?? null) === 'cancelled')
                <div class="cz-notice bad"><b>Cancelled.</b> {{ $cycle['status_note'] ?? 'This year\'s counselling has been cancelled.' }}</div>
            @endif
            @if($dom && ($c['level'] ?? null) === 'state')
                <div class="cz-notice warn">
                    @if($profile['state'] && in_array($profile['state'], $domStates, true))
                        <b>Your home state.</b> State quota seats need {{ implode(', ', $domStates) }} domicile ({{ strtolower($dom['domicile']['label'] ?? 'domicile') }}).
                    @else
                        <b>Domicile needed.</b> State quota seats are only for {{ implode(', ', $domStates) ?: 'this state\'s' }} domicile holders.
                        {{ $profile['state'] ? 'Your home state is set to ' . $profile['state'] . '.' : 'Set your home state on the counselling list to check.' }}
                    @endif
                    {{ $dom['domicile']['notes'] ?? '' }}
                </div>
            @endif

            <div class="cz-now">
                {{ Ui::pillHtml($now['state'], $now['label'] ?? null) }}
                <div class="t"><b>{{ $now['step'] }}</b><span>{{ $now['when'] }}</span></div>
                @if($now['state'] === 'open' && $portal)<a class="cz-btn cz-btn-orange" href="{{ $portal }}" target="_blank" rel="noopener">Go to portal ↗</a>@endif
            </div>

            @if(count($rounds))
                <div class="cz-rounds" style="--cz-cols: {{ min(count($rounds), 5) }}">
                    @foreach($rounds as $i => $r)
                        @php
                            $first = collect($roundDates[$r['id']]['events'] ?? [])->first(fn ($e) => !empty($e['start_at']));
                            $isNow = $curIdx !== false && $i === $curIdx;
                            $openE = collect($roundDates[$r['id']]['events'] ?? [])->first(fn ($e) => ($e['status'] ?? null) === 'open');
                            if (in_array($r['status'], ['cancelled', 'postponed'])) { $pill = Ui::pillHtml($r['status']); $rd = $r['status_note'] ?: ucfirst($r['status']); }
                            elseif ($curIdx === false) { $pill = Ui::pillHtml('tba'); $rd = $first ? 'From ' . Ui::date($first['start_at'], 'j M') : 'Dates later'; }
                            elseif ($i < $curIdx) { $pill = Ui::pillHtml('declared', 'Done'); $rd = 'Completed'; }
                            elseif ($isNow) { $pill = Ui::pillHtml($now['state'], $now['label'] ?? null); $rd = $now['when']; }
                            elseif ($openE) { $pill = Ui::pillHtml('open'); $rd = ($openE['label'] ?: $openE['type']['name']) . ': ' . \Illuminate\Support\Str::lcfirst($openE['status_text']); }
                            else { $pill = $first ? Ui::pillHtml('upcoming') : Ui::pillHtml('tba'); $rd = $first ? 'From ' . Ui::date($first['start_at'], 'j M') : 'Dates later'; }
                        @endphp
                        <div class="cz-rt{{ $isNow ? ' now' : '' }}">
                            <span class="rn">{{ $r['name'] }}</span>
                            <span class="rd">{{ $rd }}</span>
                            {{ $pill }}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @include('counselling._ctx')

    <div class="cz-page cz-gutter">
        <div class="cz-container cz-grid2">
            <div class="cz-stack">
                @if(!$cycle)
                    <div class="cz-card cz-empty"><b>Schedule to be announced</b>Dates, seats and rules appear here as soon as they are published.</div>
                @endif

                <div class="cz-jumps">
                    <a class="cz-jump" href="{{ route('counselling.cutoffs', ['slug' => $slug] + $yq) }}">
                        <span class="k">Cutoffs</span>
                        <span class="v cz-num">{{ ($page['cutoffs']['count'] ?? 0) ? Ui::num($page['cutoffs']['count']) : ($source ? Ui::num($source['total']) : '–') }}</span>
                        <span class="m">
                            @if($source){{ ($page['cutoffs']['count'] ?? 0) ? 'Closing ranks, ' . count($source['rounds']) . ' ' . \Illuminate\Support\Str::plural('round', count($source['rounds'])) : 'Last year: ' . $source['label_year'] }}
                            @else Not published yet @endif
                        </span>
                        <span class="go">Check your chances →</span>
                    </a>
                    <a class="cz-jump" href="{{ route('counselling.seats', ['slug' => $slug] + $yq) }}">
                        <span class="k">Seat matrix</span>
                        <span class="v cz-num">{{ $seatRound ? Ui::num($seatRound['seat_matrix']['live']['total_seats']) : '–' }}</span>
                        <span class="m">
                            @if($seatRound)
                                {{ $seatRound['name'] }}{{ !empty($seatRound['seat_matrix']['live']['published_on']) ? ' · ' . ($seatRound['seat_matrix']['live']['version_no'] > 1 ? 'Revised ' : '') . Ui::date($seatRound['seat_matrix']['live']['published_on'], 'j M') : '' }}{{ !empty($seatRound['seat_matrix']['changes_since_previous']['changed']) ? ' · ' . $seatRound['seat_matrix']['changes_since_previous']['changed'] . ' rows changed' : '' }}
                            @else Not published yet @endif
                        </span>
                        <span class="go">See seats →</span>
                    </a>
                    <a class="cz-jump" href="{{ route('counselling.colleges', ['slug' => $slug] + $yq) }}">
                        <span class="k">Colleges</span>
                        <span class="v cz-num">{{ ($page['institutes']['colleges'] ?? 0) ? Ui::num($page['institutes']['colleges']) : '–' }}</span>
                        <span class="m">Fees, type and location</span>
                        <span class="go">Browse colleges →</span>
                    </a>
                </div>

                <div class="cz-card">
                    <div class="cz-head-row"><h2>Colleges you can likely get</h2>@if($source)<a class="cz-link" href="{{ route('counselling.cutoffs', ['slug' => $slug] + $yq + ($profile['rank'] ? ['within' => 1] : [])) }}">See all →</a>@endif</div>
                    @if(!$source)
                        <p class="sub">Cutoffs are not published yet. This list fills in from the closing ranks once they are out.</p>
                    @elseif(!$profile['rank'])
                        <p class="sub">Enter your rank and we will list colleges where the closing rank in {{ $source['round']['name'] }}{{ $source['year'] ? ' ' . $source['label_year'] : '' }} was above it.</p>
                        @include('counselling._profile', ['fields' => ['rank', 'cat'], 'idp' => 'p-fit', 'label' => 'Your details', 'flat' => true, 'rankLabel' => ($examShort ? "$examShort rank (AIR)" : 'Your rank (AIR)')])
                    @else
                        <p class="sub">Rank {{ Ui::num($profile['rank']) }}, {{ $catName }}. Based on {{ $source['round']['name'] }}{{ $source['year'] ? ' ' . $source['label_year'] : '' }} closing ranks. {{ Ui::num($fit['meta']['total'] ?? 0) }} options in total.</p>
                        @if(!empty($fit['data']))
                            <div class="cz-preview">
                                @foreach($fit['data'] as $r)
                                    <div>
                                        <span>
                                            <a href="{{ route('counselling.colleges', ['slug' => $slug, 'q' => $r['college']['name']] + $yq) }}">{{ $r['college']['name'] }}</a>
                                            <span class="small">{{ implode(', ', array_filter([$r['college']['city'] ?? null, $r['college']['state'] ?? null])) }} · {{ $r['quota'] }} · {{ $r['course']['name'] }}</span>
                                        </span>
                                        <span class="cz-num" style="text-align:right">Closed at <b>{{ Ui::num($r['closing_value']) }}</b><br>{{ Ui::chanceHtml($r['closing_value'], $profile['rank'], $r['higher_is_worse'] ?? true) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="cz-empty"><b>No college closed above this rank</b>Check later rounds on the cutoffs page, or try another counselling.</div>
                        @endif
                    @endif
                </div>

                <div class="cz-card">
                    <h2>{{ $curId ? ($page['status_bar']['current_round']['name'] . ' dates') : 'Current dates' }}</h2>
                    <div class="cz-tbl-wrap" style="margin-top:10px">
                        <table>
                            <thead><tr><th>Step</th><th>Date</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($currentEvents as $e)
                                    <tr>
                                        <td>{{ $e['label'] ?: $e['type']['name'] }}@if($e['quota'])<span class="small">{{ $e['quota'] }}</span>@endif</td>
                                        <td class="cz-num">{{ $e['date_text'] }}@if($e['extended_end_at'])<span class="small">Extended</span>@endif</td>
                                        <td>{{ Ui::eventPillHtml($e) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3">Dates not announced yet. They appear here the day they are published.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @php $otherRounds = collect($page['dates']['rounds'] ?? [])->filter(fn ($r) => count($r['events']) && $r['round_id'] !== $curId); @endphp
                    @if($otherRounds->count() || ($curId && count($page['dates']['cycle'] ?? [])))
                        <details class="cz-acc" style="margin-top:10px">
                            <summary>All rounds' dates</summary>
                            <div class="cz-acc-body">
                                @if($curId && count($page['dates']['cycle'] ?? []))
                                    @include('counselling._dates_table', ['title' => 'Before the rounds', 'events' => $page['dates']['cycle']])
                                @endif
                                @foreach($page['dates']['rounds'] ?? [] as $r)
                                    @if(count($r['events']))
                                        @include('counselling._dates_table', ['title' => $r['name'], 'events' => $r['events']])
                                    @endif
                                @endforeach
                            </div>
                        </details>
                    @endif
                    @if(!empty($cycle['source_url']))<p class="cz-source">Source: <a href="{{ $cycle['source_url'] }}" target="_blank" rel="noopener">official notice</a>@if(!empty($cycle['last_verified_at'])) · verified {{ Ui::date($cycle['last_verified_at']) }}@endif</p>@endif
                </div>

                @if($ruleRounds->count())
                    <div class="cz-card">
                        <h2>Deposit and seat rules</h2>
                        <p class="sub">Rules change between rounds. Pick one.</p>
                        <div class="cz-chips" role="group" aria-label="Round" style="margin-bottom:10px">
                            @foreach($ruleRounds as $r)
                                <button type="button" class="cz-chip" aria-pressed="{{ $r['id'] === $ruleDefault ? 'true' : 'false' }}" data-cz-rule="{{ $r['id'] }}">{{ $r['name'] }}</button>
                            @endforeach
                        </div>
                        <div class="cz-tbl-wrap">
                            <table>
                                <thead><tr><th>If you…</th><th>Deposit</th><th>Seat</th><th>Next round</th></tr></thead>
                                @foreach($ruleRounds as $r)
                                    @php
                                        $idx = collect($rounds)->search(fn ($x) => $x['id'] === $r['id']);
                                        $next = $rounds[$idx + 1]['name'] ?? null;
                                    @endphp
                                    <tbody data-cz-rules="{{ $r['id'] }}" @if($r['id'] !== $ruleDefault) hidden @endif>
                                        @foreach($r['rules'] as $rule)
                                            @php
                                                $d = $rule['deposit'];
                                                $depCls = match ($d['outcome']) { 'refunded' => 'ok', 'forfeited' => 'bad', 'partly_refunded' => 'part', default => '' };
                                                $depText = $d['outcome'] === 'partly_refunded' && $d['refund_percent'] !== null ? rtrim(rtrim(number_format($d['refund_percent'], 1), '0'), '.') . '% refunded' : ($d['label'] ?? '–');
                                                $changed = $idx > 0 && in_array($rule['source'] ?? '', ['overridden', 'round'], true);
                                            @endphp
                                            <tr>
                                                <td>{{ $rule['action'] }}
                                                    @if($rule['quota'] || $rule['institute_type'])<span class="small">{{ implode(' · ', array_filter([$rule['quota'], $rule['institute_type']])) }} only</span>@endif
                                                    @if($rule['penalty_note'])<span class="small">{{ $rule['penalty_note'] }}</span>@endif
                                                </td>
                                                <td><span class="{{ $depCls }}">{{ $depText }}</span>@if($changed)<span class="cz-chg">Changed</span>@endif</td>
                                                <td>{{ $rule['seat_outcome'] ? ucfirst($rule['seat_outcome']) : '–' }}</td>
                                                <td>@if($rule['eligible_for_next_round'])<span class="ok">{{ $next ? 'Can join ' . $next : 'Eligible' }}</span>@else<span class="bad">Not eligible</span>@endif</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif

                @php
                    $hasDetails = count($page['eligibility'] ?? []) || count($page['process'] ?? []) || count($page['fees'] ?? []) || count($page['documents'] ?? []);
                @endphp
                <div class="cz-card">
                    <h2>Eligibility, process, fees and documents</h2>
                    @if(!$hasDetails)
                        <p class="sub">These appear once the information bulletin is out.</p>
                    @endif
                    @if(count($page['eligibility'] ?? []))
                        <details class="cz-acc" style="margin-top:12px">
                            <summary>Who can apply</summary>
                            <div class="cz-acc-body">
                                @foreach($page['eligibility'] as $el)
                                    @if(count($page['eligibility']) > 1)<p style="margin:6px 0 4px"><b>{{ $el['quota'] ?? 'All quotas' }}</b></p>@endif
                                    <ul>
                                        @if($el['qualifying_class'])<li>{{ $el['qualifying_class'] }}{{ $el['qualifying_subjects'] ? ' with ' . implode(', ', $el['qualifying_subjects']) : '' }}</li>@endif
                                        @if($el['nationality_allowed'])<li>Nationality: {{ implode(', ', $el['nationality_allowed']) }}</li>@endif
                                        @if($el['age']['min'] || $el['age']['max'])<li>Age: {{ $el['age']['min'] ? 'at least ' . $el['age']['min'] : '' }}{{ $el['age']['min'] && $el['age']['max'] ? ', ' : '' }}{{ $el['age']['max'] ? 'at most ' . $el['age']['max'] : '' }}{{ $el['age']['as_of'] ? ' (as of ' . Ui::date($el['age']['as_of']) . ')' : '' }}</li>@endif
                                        @if(($el['domicile']['rule'] ?? 'none') !== 'none')
                                            <li>Domicile: {{ $el['domicile']['label'] }}{{ $el['domicile']['states'] ? ' (' . implode(', ', $el['domicile']['states']) . ')' : '' }}{{ $el['domicile']['study_years_required'] ? ', ' . $el['domicile']['study_years_required'] . ' years of study' : '' }}</li>
                                            @if($el['domicile']['notes'])<li>{{ $el['domicile']['notes'] }}</li>@endif
                                        @else
                                            <li>No domicile needed</li>
                                        @endif
                                        @foreach($el['minimum_scores'] ?? [] as $s)
                                            <li>{{ $s['category'] }}: {{ collect([$s['min_percentile'] !== null ? 'minimum ' . $s['min_percentile'] . ' percentile' : null, $s['min_score'] !== null ? 'minimum score ' . $s['min_score'] : null, $s['max_rank'] ? 'rank up to ' . Ui::num($s['max_rank']) : null, $s['min_qualifying_percent'] !== null ? $s['min_qualifying_percent'] . '% in qualifying exam' : null])->filter()->implode(', ') }}{{ $s['exam'] ? ' in ' . $s['exam'] : '' }}</li>
                                        @endforeach
                                        @if($el['other_conditions'])<li>{{ $el['other_conditions'] }}</li>@endif
                                    </ul>
                                @endforeach
                            </div>
                        </details>
                    @endif
                    @if(count($page['process'] ?? []))
                        <details class="cz-acc">
                            <summary>Step-by-step process</summary>
                            <div class="cz-acc-body">
                                <ol>
                                    @foreach($page['process'] as $s)
                                        <li><b>{{ $s['title'] }}</b>@if($s['date']) <span class="cz-muted">· {{ $s['date']['text'] }}</span>@endif
                                            @if($s['description'])<br>{{ $s['description'] }}@endif
                                            @if($s['link_url'])<br><a href="{{ $s['link_url'] }}" target="_blank" rel="noopener">Open ↗</a>@endif
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </details>
                    @endif
                    @if(count($page['fees'] ?? []))
                        <details class="cz-acc">
                            <summary>Fees and security deposit</summary>
                            <div class="cz-acc-body">
                                <ul>
                                    @foreach($page['fees'] as $fee)
                                        <li>{{ $fee['fee_type_label'] }}{{ ($q = implode(', ', array_filter([$fee['category'], $fee['quota'], $fee['institute_type']]))) ? ' (' . $q . ')' : '' }}:
                                            <b>{{ $fee['currency'] === 'INR' ? Ui::inr($fee['amount']) : $fee['currency'] . ' ' . Ui::num($fee['amount']) }}</b>
                                            {{ $fee['is_refundable'] ? '· refundable (see rules)' : '· non-refundable' }}{{ $fee['note'] ? ' · ' . $fee['note'] : '' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </details>
                    @endif
                    @if(count($page['documents'] ?? []))
                        <details class="cz-acc">
                            <summary>Documents to carry</summary>
                            <div class="cz-acc-body">
                                <ul>
                                    @foreach($page['documents'] as $d)
                                        <li>{{ $d['name'] }} <span class="cz-muted">· {{ $d['needed_at'] }}{{ $d['is_mandatory'] ? '' : ' · optional' }}{{ ($q = implode(', ', array_filter([$d['quota'], $d['category']]))) ? ' · only ' . $q : '' }}</span>
                                            @if($d['format_notes'])<br><span class="cz-muted">{{ $d['format_notes'] }}</span>@endif
                                            @if($d['template_url'])<a href="{{ $d['template_url'] }}" target="_blank" rel="noopener">Format ↓</a>@endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </details>
                    @endif
                    @if(!empty($c['about']))
                        <details class="cz-acc">
                            <summary>About this counselling</summary>
                            <div class="cz-acc-body">{!! nl2br(e(strip_tags($c['about']))) !!}</div>
                        </details>
                    @endif
                </div>
            </div>

            <aside class="cz-aside">
                <div class="cz-side-card cta">
                    <h3>Alerts for every round</h3>
                    <p>Deadlines, result day, seat matrix changes.</p>
                    <label class="cz-check"><input type="checkbox" checked> Also on WhatsApp</label>
                    <button type="button" class="cz-btn cz-btn-orange" data-cz-soon="Round alerts">Follow</button>
                </div>
                <div class="cz-side-card">
                    <h3>Also applying elsewhere?</h3>
                    @if(count($also))
                        <div class="cz-also">
                            @foreach($also as $a)
                                <div><a href="{{ route('counselling.show', $a['slug']) }}">{{ $a['name'] }}</a> {{ Ui::pillHtml($a['now']['state'] ?? 'tba', $a['now']['label'] ?? null) }}</div>
                            @endforeach
                        </div>
                    @else
                        <p>{{ $profile['state'] ? 'No other counselling for your state yet.' : 'Set your home state on the counselling list to see yours.' }}</p>
                    @endif
                    <a class="cz-link" href="{{ route('counselling.index', $primary && $primary['slug'] ? ['exam' => $primary['slug']] : []) }}">All counsellings →</a>
                </div>
                @if(!empty($cycle['information_bulletin']['url']) || !empty($cycle['information_bulletin']['pdf_url']) || $c['official_website'])
                    <div class="cz-side-card">
                        <h3>Official links</h3>
                        @if(!empty($cycle['information_bulletin']['pdf_url']))<a href="{{ $cycle['information_bulletin']['pdf_url'] }}" target="_blank" rel="noopener">Information bulletin (PDF) ↗</a>
                        @elseif(!empty($cycle['information_bulletin']['url']))<a href="{{ $cycle['information_bulletin']['url'] }}" target="_blank" rel="noopener">Information bulletin ↗</a>@endif
                        @if($c['official_website'])<a href="{{ $c['official_website'] }}" target="_blank" rel="noopener">Official website ↗</a>@endif
                        <p class="cz-small cz-muted">Always confirm on the official portal before you pay or report.</p>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</main>
@endsection
