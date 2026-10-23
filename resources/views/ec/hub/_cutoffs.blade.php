{{-- Hub: cutoff finder. $examOpts, $exam, $counOpts, $coun, $cut (from ExamHubController::cutoffView) --}}
@php
    use App\Support\Ec\Ec;
    $H = fn ($id, $t, $s = null) => '<div class="ec-ihead" id="sec-' . $id . '"><h2>' . e($t) . '</h2>' . ($s ? '<p>' . e($s) . '</p>' : '') . '</div>';
    $counLabel = fn ($c) => $c['level'] === 'state' && !empty($c['states']) ? $c['states'][0] : ($c['short_name'] ?: $c['name']);
@endphp
@if(!$exam)
    <div class="ec-note"><b>No central cutoffs in this category</b>Admissions here are college-wise, so each college publishes its own cutoff on its page.</div>
@else
    @php
        $rows = collect($cut['table']['data'] ?? []);
        $first = $rows->first();
        $isRank = $first ? $first['higher_is_worse'] : true;
        $unit = $first ? ($isRank ? 'rank' : mb_strtolower($first['rank_type_label'])) : 'rank';
        $rank = $cut['rank'] ?? null;
        $chance = function ($r) use ($rank) {
            if (!$rank || !$r['higher_is_worse'] || $r['closing_value'] === null) return '<span class="ec-none">–</span>';
            $c = $r['closing_value'];
            return $rank <= $c * 0.85 ? '<span class="ec-chance good">Good chance</span>' : ($rank <= $c * 1.1 ? '<span class="ec-chance maybe">Borderline</span>' : '<span class="ec-chance low">Unlikely</span>');
        };
        // ▲ the cutoff moved in the student's favour (a higher closing rank, or a lower score), ▼ against
        $move = function ($r) {
            if (!isset($r['previous_closing']) || $r['previous_closing'] === null || $r['closing_value'] === null) return '';
            $d = $r['closing_value'] - $r['previous_closing'];
            if (!$d) return '<span class="ec-trend" style="color:var(--muted)">=</span>';
            $easier = $r['higher_is_worse'] ? $d > 0 : $d < 0;
            return '<span class="ec-trend ' . ($easier ? 'down' : 'up') . '" title="Compared with the previous year">' . ($d > 0 ? '▲' : '▼') . ' ' . Ec::num(abs($d)) . '</span>';
        };
        $optUrl = fn ($c) => route('cutoffs.index', array_filter(['exam' => $exam['slug'], 'counselling' => $c['slug'], 'stream' => request('stream')]));
        $ai = $counOpts->filter(fn ($c) => $c['level'] !== 'state'); $st = $counOpts->filter(fn ($c) => $c['level'] === 'state');
        $seat = $cut['seat'] ?? null;
        $seatKey = fn ($r) => $r['college']['id'] . '-' . $r['course']['id'] . '-' . ($r['quota_id'] ?? 0);
    @endphp

    @if(!empty($cut['round']))
        <div class="ec-cuthead">
            <div><h2>{{ preg_replace('/\s\d{4}$/', '', $coun['name']) }} cutoff {{ $cut['year'] }}</h2>
                <p>{{ implode(' · ', array_filter([($exam['short_name'] ?: $exam['name']) . ' ' . $unit . 's', $cut['round']['name'], $cut['cat']['name'] ?? null, Ec::LEVEL[$coun['level']] ?? null, $coun['level'] === 'state' ? implode(', ', $coun['states'] ?? []) : null])) }}</p></div>
            <div class="ec-qlinks">@foreach([['ctable', 'Cutoff table'], ['ctrend', 'Round-wise trend'], ['cyear', 'Year comparison'], ['ccat', 'Category-wise'], ['cpdf', 'Official PDFs'], ['cread', 'How to read']] as [$k, $l])@if(in_array($k, ['ctable', 'cread']) || ($k === 'ctrend' && $seat) || ($k === 'cyear' && !empty($cut['prevYear'])) || ($k === 'ccat' && $seat && count($cut['trend']['categories'] ?? []) > 1) || ($k === 'cpdf' && !empty($cut['pdfs']) && count($cut['pdfs'])))<a href="#sec-{{ $k }}">{{ $l }}</a>@endif @endforeach</div>
        </div>
    @endif

    <form class="ec-finder" method="get" action="{{ route('cutoffs.index') }}" data-ec-autosubmit>
        @if(request('stream'))<input type="hidden" name="stream" value="{{ request('stream') }}">@endif
        <label>Exam<select name="exam" data-ec-reset="counselling,year,round,seat">@foreach($examOpts as $x)<option value="{{ $x['slug'] }}" @selected($x['slug'] === $exam['slug'])>{{ $x['short_name'] ?: $x['name'] }}</option>@endforeach</select></label>
        <label>Counselling<select name="counselling" data-ec-reset="year,round,seat">
            @if($ai->isNotEmpty() && $st->isNotEmpty())
                <optgroup label="All India ({{ $ai->count() }})">@foreach($ai as $c)<option value="{{ $c['slug'] }}" @selected($c['slug'] === $coun['slug'])>{{ $counLabel($c) }}</option>@endforeach</optgroup>
                <optgroup label="State counselling ({{ $st->count() }})">@foreach($st as $c)<option value="{{ $c['slug'] }}" @selected($c['slug'] === $coun['slug'])>{{ $counLabel($c) }}</option>@endforeach</optgroup>
            @else
                @foreach($counOpts as $c)<option value="{{ $c['slug'] }}" @selected($c['slug'] === $coun['slug'])>{{ $counLabel($c) }}</option>@endforeach
            @endif
        </select></label>
        <label>Year<select name="year" data-ec-reset="round,seat" @disabled(empty($cut['years']))>@foreach($cut['years'] ?? [] as $y)<option @selected((int) $y === (int) ($cut['year'] ?? 0))>{{ $y }}</option>@endforeach</select></label>
        <label>Round<select name="round" data-ec-reset="seat" @disabled(empty($cut['rounds']))>@foreach($cut['rounds'] ?? [] as $r)<option value="{{ $r['id'] }}" @selected($r['id'] === ($cut['round']['id'] ?? null))>{{ $r['name'] }}</option>@endforeach</select></label>
        <label>Category<select name="category" data-ec-remember="cat" @disabled(empty($cut['categories']))>@foreach($cut['categories'] ?? [] as $k)<option value="{{ $k['id'] }}" @selected($k['id'] === ($cut['cat']['id'] ?? null))>{{ $k['name'] }}</option>@endforeach</select></label>
        <label class="myrank">Your rank (optional)<input name="rank" type="number" min="1" inputmode="numeric" placeholder="e.g. 12000" value="{{ $rank }}" data-ec-remember="rank" data-ec-debounce></label>
    </form>

    @include('ec._relbar', ['rel' => ['exam' => $exam, 'couns' => $counOpts, 'coun' => $coun['slug'], 'at' => 'cut', 'year' => $cut['year'] ?? null]])

    @if(!empty($cut['empty']))
        <div class="ec-note" style="margin-top:22px"><b>{{ $cut['empty'] }}</b>Cutoffs appear here round by round as the counselling body publishes them. <a href="{{ route('counselling.show', $coun['slug']) }}">See the counselling</a>.</div>
    @else
        {!! $H('ctable', 'Cutoff table') !!}
        <form class="ec-ctx" method="get" action="{{ route('cutoffs.index') }}#sec-ctable" data-ec-autosubmit>
            Showing <b>{{ preg_replace('/\s\d{4}$/', '', $coun['name']) }} {{ $cut['year'] }}</b>, {{ $cut['round']['name'] }}{{ !empty($cut['cat']) ? ', ' . $cut['cat']['name'] : '' }} ·
            @foreach(request()->except(['q', 'page']) as $k => $v)@if(is_string($v))<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif @endforeach
            <input name="q" type="search" placeholder="Filter colleges" aria-label="Filter colleges" value="{{ request('q') }}" data-ec-debounce>
        </form>
        <div class="ec-tcard"><table class="ec-t">
            @if($rank)<colgroup><col style="width:40%"><col style="width:14%"><col style="width:18%"><col style="width:13%"><col style="width:15%"></colgroup>@else<colgroup><col style="width:46%"><col style="width:16%"><col style="width:20%"><col style="width:18%"></colgroup>@endif
            <thead><tr><th>College and course</th><th class="num">Opening {{ $unit }}</th><th class="num">Closing {{ $unit }}</th>@if($rank)<th class="c">Your chance</th>@endif<th class="r">College</th></tr></thead>
            <tbody>
            @forelse($rows as $r)
                <tr class="ec-row">
                    <td class="nmc"><div class="ec-nm"><span><b>{{ $r['college']['name'] }}</b><small>{{ implode(' · ', array_filter([$r['course']['name'], $r['quota'], $r['gender'] !== 'neutral' ? ucfirst($r['gender']) . ' only' : null, $r['pwd'] ? 'PwD' : null, $r['college']['city'] ?? null])) }}</small></span></div></td>
                    <td class="num numc" data-l="Opening {{ $unit }}">{{ Ec::num($r['opening_value']) }}</td>
                    <td class="num numc" data-l="Closing {{ $unit }}"><b>{{ Ec::num($r['closing_value']) }}</b>{!! $move($r) !!}</td>
                    @if($rank)<td class="c stc">{!! $chance($r) !!}</td>@endif
                    <td class="r act">@if(!empty($r['college']['slug']))<a class="ec-see" href="{{ route('university.detail', $r['college']['slug']) }}">College page <span aria-hidden="true">→</span></a>@endif</td>
                </tr>
            @empty
                <tr><td colspan="5"><div class="ec-empty"><b>No college matches</b>Clear the college filter or pick another round.</div></td></tr>
            @endforelse
            </tbody>
        </table>
        @if($cut['pager']['total'])@include('ec._pager', ['p' => $cut['pager'], 'noun' => 'college-course rows · sorted by closing ' . $unit, 'anchor' => '#sec-ctable'])@endif
        @if(!empty($cut['prevYear']))<div class="ec-tfoot"><span>▲ / ▼ change against {{ $cut['prevYear'] }}: <span class="ec-trend down">green</span> = easier this year, <span class="ec-trend up">red</span> = harder</span></div>@endif
        </div>
        @if($rank)<p class="ec-legend">"Your chance" only compares your rank with this closing rank. It is a guide, not a prediction.</p>@endif

        {{-- round-wise trend for one seat --}}
        @if($seat && !empty($cut['trend']))
            @php
                $tr = $cut['trend'];
                $prevByOrder = collect($tr['previous_rounds'] ?? [])->keyBy('order');
                $vals = collect($tr['rounds'])->pluck('closing')->merge(collect($tr['previous_rounds'] ?? [])->pluck('closing'))->filter();
                $mx = max(1, (float) $vals->max());
            @endphp
            {!! $H('ctrend', 'Round-wise trend', $isRank ? 'The closing rank usually rises in later rounds as seats free up.' : 'How the closing value moved from round to round.') !!}
            <div class="ec-cardx">
                @if(!empty($cut['seatList']['data']))
                    <label class="ec-ccsel">College<select data-ec-nav aria-label="College and course">
                        @foreach(collect($cut['seatList']['data'])->unique($seatKey) as $r)<option value="{{ Ec::url(request(), ['seat' => $seatKey($r)]) }}#sec-ctrend" @selected($seatKey($r) === $seatKey($seat))>{{ $r['college']['name'] }} · {{ $r['course']['name'] }} · {{ $r['quota'] }}</option>@endforeach
                    </select></label>
                @endif
                <div class="ec-tbars">
                    @foreach($tr['rounds'] as $r)
                        @php $p = $prevByOrder[$r['order']] ?? null; @endphp
                        <div class="ec-tb"><span class="tl">{{ $r['name'] }}</span>
                            <div class="ec-tw"><i class="cur" style="--w:{{ $r['closing'] ? round($r['closing'] / $mx * 100, 1) : 0 }}%"></i>@if($r['closing'] !== null)<b>{{ Ec::num($r['closing']) }}</b>@else<b class="ec-none">Not yet</b>@endif</div>
                            @if(!empty($tr['previous_year']))<div class="ec-tw"><i class="prv" style="--w:{{ $p && $p['closing'] ? round($p['closing'] / $mx * 100, 1) : 0 }}%"></i><b class="ec-none">{{ $p && $p['closing'] !== null ? Ec::num($p['closing']) : '–' }}</b></div>@endif
                        </div>
                    @endforeach
                </div>
                <div class="ec-tleg"><span><i class="cur"></i>{{ $tr['year'] }}</span>@if(!empty($tr['previous_year']))<span><i class="prv"></i>{{ $tr['previous_year'] }}</span>@endif</div>
            </div>
        @endif

        {{-- year comparison --}}
        @if(!empty($cut['prevYear']) && $rows->isNotEmpty())
            {!! $H('cyear', 'Year comparison', $cut['round']['name'] . ' closing ' . $unit . 's, ' . $cut['year'] . ' vs ' . $cut['prevYear'] . (!empty($cut['cat']) ? ', ' . $cut['cat']['name'] : '') . '.') !!}
            <div class="ec-tcard"><table class="ec-t">
                <colgroup><col style="width:46%"><col style="width:18%"><col style="width:18%"><col style="width:18%"></colgroup>
                <thead><tr><th>College and course</th><th class="num">{{ $cut['year'] }}</th><th class="num">{{ $cut['prevYear'] }}</th><th class="num">Change</th></tr></thead>
                <tbody>
                @foreach($rows->take(8) as $r)
                    <tr class="ec-row"><td class="nmc"><div class="ec-nm"><span><b>{{ $r['college']['name'] }}</b><small>{{ $r['course']['name'] }}</small></span></div></td>
                        <td class="num numc" data-l="{{ $cut['year'] }}"><b>{{ Ec::num($r['closing_value']) }}</b></td>
                        <td class="num numc" data-l="{{ $cut['prevYear'] }}">{{ Ec::num($r['previous_closing'] ?? null) }}</td>
                        <td class="num numc" data-l="Change">{!! $move($r) ?: '<span class="ec-none">New</span>' !!}</td></tr>
                @endforeach
                </tbody>
            </table></div>
        @endif

        {{-- category-wise --}}
        @if($seat && !empty($cut['trend']['categories']) && count($cut['trend']['categories']) > 1)
            @php $cm = max(1, (float) collect($cut['trend']['categories'])->pluck('closing')->filter()->max()); @endphp
            {!! $H('ccat', 'Category-wise closing ' . $unit . 's', $seat['college']['name'] . ', ' . $seat['course']['name'] . ', ' . $cut['round']['name'] . ' ' . $cut['year'] . '.') !!}
            <div class="ec-cardx"><div class="ec-bars">
                @foreach($cut['trend']['categories'] as $k)<div class="ec-bar{{ $k['id'] === ($cut['cat']['id'] ?? null) ? ' on' : '' }}"><span title="{{ $k['name'] }}">{{ $k['name'] }}</span><i style="--w:{{ $k['closing'] ? round($k['closing'] / $cm * 100, 1) : 0 }}%"></i><b>{{ Ec::num($k['closing']) }}</b></div>@endforeach
            </div></div>
        @endif

        {{-- official files --}}
        @if(!empty($cut['pdfs']) && count($cut['pdfs']))
            {!! $H('cpdf', 'Official cutoff and allotment files', 'Round-wise allotment and closing rank files published by the counselling body.') !!}
            <div class="ec-cardx"><div class="ec-papers">
                @foreach(collect($cut['pdfs'])->take(8) as $f)<a href="{{ $f['url'] }}" target="_blank" rel="noopener"><b style="font-size:13px">{{ $f['round'] }}</b><span>{{ $f['title'] ?: 'Allotment result' }}{{ !empty($f['published_at']) ? ' · ' . Ec::fmt(Ec::d($f['published_at'])) : '' }}</span><em>{{ str_ends_with(strtolower(parse_url($f['url'], PHP_URL_PATH) ?? ''), '.pdf') ? 'PDF' : 'Link' }}</em></a>@endforeach
            </div></div>
        @endif

        {!! $H('cread', 'How to read these cutoffs') !!}
        <div class="ec-grid3">
            <div class="ec-cardx"><h3>Opening and closing {{ $unit }}</h3><p>The best and the last {{ $unit }} that got a seat in that college, course, category and round.</p></div>
            <div class="ec-cardx"><h3>Compare like with like</h3><p>Use the same counselling, quota, category and round. A state quota rank is not comparable with All India.</p></div>
            <div class="ec-cardx"><h3>Cutoffs move every year</h3><p>Seats, difficulty and applicants change. Treat last year's numbers as a guide, with a safety margin.</p></div>
        </div>
    @endif
@endif
