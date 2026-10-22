{{-- Explorer results: active filters, count + sort, table (desktop) / cards (mobile), pager. Re-rendered on every filter change. --}}
@php
    use App\Support\CounsellingUi as Ui;
    $rows = $data['data'] ?? [];
    $meta = $data['meta'] ?? [];
    $filt = $data['filters'] ?? [];
    $total = (int) ($meta['total'] ?? 0);
    $pageNo = (int) ($meta['page'] ?? 1);
    $last = max(1, (int) ($meta['last_page'] ?? 1));
    $per = (int) ($meta['per_page'] ?? $f['per_page']);
    $from = $total ? ($pageNo - 1) * $per + 1 : 0;
    $to = $total ? $from + count($rows) - 1 : 0;
    $rank = $f['rank'] ?? null;
    $catShort = collect($filt['categories'] ?? [])->firstWhere('id', $f['category'] ?? null);
    $catShort = $catShort['short_name'] ?? ($catShort['name'] ?? null);

    // active filter chips (category, round and rank are "your details", not filters to clear)
    $active = [];
    if ($f['q']) $active['q'] = '“' . $f['q'] . '”';
    if ($f['quota'] ?? null) $active['quota'] = collect($filt['quotas'] ?? [])->firstWhere('id', $f['quota'])['name'] ?? 'Quota';
    if ($f['state'] ?? null) $active['state'] = $f['state'];
    if ($f['type'] ?? null) $active['type'] = collect($filt['institute_types'] ?? [])->firstWhere('value', $f['type'])['label'] ?? $f['type'];
    if ($f['fee'] ?? null) $active['fee'] = \App\Http\Controllers\CounsellingController::FEES[$f['fee']] ?? 'Fee';
    if ($f['within'] ?? false) $active['within'] = 'Within my rank';
    if ($f['changed'] ?? false) $active['changed'] = 'Changed rows';

    $sortTh = function (string $key, string $label, string $cls = '', ?string $alt = null) use ($f) {
        $isOn = $f['sort'] === $key || ($alt && $f['sort'] === $alt);
        $dir = $f['sort'] === $alt ? 'descending' : (str_ends_with($key, '_desc') ? 'descending' : 'ascending');
        $next = $alt && $f['sort'] === $key ? $alt : $key;
        return new \Illuminate\Support\HtmlString('<th class="' . $cls . '"' . ($isOn ? ' aria-sort="' . $dir . '"' : '') . '><button type="button" data-cz-sort="' . e($next) . '">' . e($label) . '</button></th>');
    };
    $where = fn ($col) => implode(', ', array_filter([$col['city'] ?? null, $col['state'] ?? null]));
    $collegeUrl = fn ($name) => route('counselling.colleges', ['slug' => $slug, 'q' => $name] + ($year ? ['year' => $year] : []));
    $empty = '<div class="cz-empty"><b>Nothing matches these filters</b>' . ($active ? 'Remove a filter above to see more.' : ($page['cycle'] ? 'No data published for this counselling yet.' : 'This counselling has no published schedule yet.')) . '</div>';
@endphp

<div class="cz-active" data-cz-active="{{ count($active) }}" @if(!$active) hidden @endif>
    Filters:
    @foreach($active as $k => $label)
        <button type="button" data-cz-clear="{{ $k }}" aria-label="Remove {{ $label }}">{{ $label }} ✕</button>
    @endforeach
</div>

<div class="cz-result-meta">
    <span>@if($total)Showing <b class="cz-num">{{ Ui::num($from) }}–{{ Ui::num($to) }}</b> of <b class="cz-num">{{ Ui::num($total) }}</b>@endif</span>
    <label class="cz-field" for="f-sort">Sort
        <select id="f-sort" name="sort" form="cz-filters">
            @foreach($sorts as $v => $l)
                @if(($v !== 'fit' || $rank) && ($v !== 'closing_asc' || $kind !== 'colleges' || !empty($meta['closing_round'])))<option value="{{ $v }}" @selected($f['sort'] === $v)>{{ $l }}</option>@endif
            @endforeach
        </select>
    </label>
</div>

@if($kind === 'cutoffs')
    <div class="cz-tbl-wrap">
        <table>
            <thead><tr>
                {{ $sortTh('college', 'College') }}<th>Quota</th><th class="r">Opening</th>{{ $sortTh('closing_asc', 'Closing', 'r', 'closing_desc') }}{{ $sortTh('fee_asc', 'Fee / year', 'r') }}@if($rank)<th>Your chance</th>@endif
            </tr></thead>
            <tbody>
                @forelse($rows as $r)
                    <tr>
                        <td><a class="rowlink" href="{{ $collegeUrl($r['college']['name']) }}">{{ $r['college']['name'] }}</a>
                            <span class="small">{{ $r['course']['name'] }} · {{ $where($r['college']) }}{{ $r['institute_type'] ? ' · ' . $r['institute_type'] : '' }}</span></td>
                        <td>{{ $r['quota'] }}@if($r['gender'] !== 'neutral' || $r['pwd'])<span class="small">{{ implode(' · ', array_filter([$r['gender'] !== 'neutral' ? ucfirst($r['gender']) : null, $r['pwd'] ? 'PwD' : null])) }}</span>@endif</td>
                        <td class="r cz-num">{{ Ui::num($r['opening_value']) }}</td>
                        <td class="r cz-num"><b>{{ Ui::num($r['closing_value']) }}</b>@if($r['rank_type'] !== 'air')<span class="small">{{ $r['rank_type_label'] }}</span>@endif</td>
                        <td class="r cz-num">{{ Ui::inr($r['annual_tuition_fee'] ?? null) }}</td>
                        @if($rank)<td>{{ Ui::chanceHtml($r['closing_value'], $rank, $r['higher_is_worse'] ?? true) }}</td>@endif
                    </tr>
                @empty
                    <tr><td colspan="6">{!! $empty !!}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <ul class="cz-rcards">
        @forelse($rows as $r)
            <li class="cz-rcard">
                <span class="t"><a href="{{ $collegeUrl($r['college']['name']) }}">{{ $r['college']['name'] }}</a></span>
                <span class="m">{{ $r['course']['name'] }} · {{ $where($r['college']) }}{{ $r['institute_type'] ? ' · ' . $r['institute_type'] : '' }} · {{ $r['quota'] }}</span>
                <span class="nums"><span>Closing <b>{{ Ui::num($r['closing_value']) }}</b></span><span>Opening <b>{{ Ui::num($r['opening_value']) }}</b></span>@if($r['annual_tuition_fee'] ?? null)<span>Fee <b>{{ Ui::inr($r['annual_tuition_fee']) }}</b></span>@endif {{ Ui::chanceHtml($r['closing_value'], $rank, $r['higher_is_worse'] ?? true) }}</span>
            </li>
        @empty
            <li>{!! $empty !!}</li>
        @endforelse
    </ul>
@elseif($kind === 'seats')
    @php $cols = $data['categories'] ?? []; @endphp
    <div class="cz-tbl-wrap">
        <table>
            <thead><tr>
                {{ $sortTh('college', 'College') }}<th>Quota</th>
                @foreach($cols as $col)<th class="r">{{ $col['short_name'] }}</th>@endforeach
                {{ $sortTh('total_desc', 'Total', 'r', 'total_asc') }}
            </tr></thead>
            <tbody>
                @forelse($rows as $r)
                    <tr @if($r['changed']) class="changed" @endif>
                        <td><a class="rowlink" href="{{ $collegeUrl($r['college']['name']) }}">{{ $r['college']['name'] }}</a>
                            <span class="small">{{ $r['course']['name'] }} · {{ $where($r['college']) }}{{ $r['institute_type'] ? ' · ' . $r['institute_type'] : '' }}</span>
                            @if($r['changed'])<span class="cz-chg" style="margin:4px 0 0">Changed</span>@endif</td>
                        <td>{{ $r['quota'] }}</td>
                        @foreach($cols as $col)<td class="r cz-num">{{ Ui::num($r['seats'][$col['id']] ?? 0) }}</td>@endforeach
                        <td class="r cz-num"><b>{{ Ui::num($r['total']) }}</b></td>
                    </tr>
                @empty
                    <tr><td colspan="{{ count($cols) + 3 }}">{!! $empty !!}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <ul class="cz-rcards">
        @forelse($rows as $r)
            <li class="cz-rcard{{ $r['changed'] ? ' changed' : '' }}">
                <span class="t"><a href="{{ $collegeUrl($r['college']['name']) }}">{{ $r['college']['name'] }}</a> @if($r['changed'])<span class="cz-chg">Changed</span>@endif</span>
                <span class="m">{{ $r['course']['name'] }} · {{ $where($r['college']) }} · {{ $r['quota'] }}</span>
                <span class="nums">@foreach($cols as $col){{ $col['short_name'] }} <b>{{ Ui::num($r['seats'][$col['id']] ?? 0) }}</b> · @endforeach Total <b>{{ Ui::num($r['total']) }}</b></span>
            </li>
        @empty
            <li>{!! $empty !!}</li>
        @endforelse
    </ul>
@else
    @php $roundLabel = $meta['closing_round']['name'] ?? null; @endphp
    <div class="cz-tbl-wrap">
        <table>
            <thead><tr>
                {{ $sortTh('college', 'College') }}<th>Quotas</th>{{ $sortTh('fee_asc', 'Fee / year', 'r') }}{{ $sortTh('seats_desc', 'Seats', 'r') }}
                @if($roundLabel){{ $sortTh('closing_asc', 'Closing rank (' . ($catShort ?: 'All') . ', ' . $roundLabel . ')', 'r') }}@endif
            </tr></thead>
            <tbody>
                @forelse($rows as $r)
                    <tr>
                        <td><span class="rowlink" style="font-weight:600">{{ $r['college']['name'] }}</span>
                            <span class="small">{{ $where($r['college']) }}{{ $r['institute_types'] ? ' · ' . implode(', ', $r['institute_types']) : '' }}{{ $r['courses'] ? ' · ' . implode(', ', $r['courses']) : '' }}</span></td>
                        <td>{{ implode(', ', $r['quotas']) }}</td>
                        <td class="r cz-num">@if($r['fee']['min'] !== null){{ Ui::inr($r['fee']['min']) }}@if($r['fee']['max'] && $r['fee']['max'] != $r['fee']['min'])<span class="small">to {{ Ui::inr($r['fee']['max']) }}</span>@endif @else – @endif</td>
                        <td class="r cz-num">{{ $r['seats'] !== null ? Ui::num($r['seats']) : '–' }}</td>
                        @if($roundLabel)<td class="r cz-num">{{ $r['closing_value'] !== null ? Ui::num($r['closing_value']) : '–' }}@if($r['closing_value'] !== null && $rank)<br>{{ Ui::chanceHtml($r['closing_value'], $rank) }}@endif</td>@endif
                    </tr>
                @empty
                    <tr><td colspan="5">{!! $empty !!}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <ul class="cz-rcards">
        @forelse($rows as $r)
            <li class="cz-rcard">
                <span class="t">{{ $r['college']['name'] }}</span>
                <span class="m">{{ $where($r['college']) }}{{ $r['institute_types'] ? ' · ' . implode(', ', $r['institute_types']) : '' }} · {{ implode(', ', $r['quotas']) }}</span>
                <span class="nums">Fee <b>{{ Ui::inr($r['fee']['min']) }}</b> · Seats <b>{{ $r['seats'] !== null ? Ui::num($r['seats']) : '–' }}</b>@if($roundLabel) · Closed at <b>{{ $r['closing_value'] !== null ? Ui::num($r['closing_value']) : '–' }}</b> {{ Ui::chanceHtml($r['closing_value'], $rank) }}@endif</span>
            </li>
        @empty
            <li>{!! $empty !!}</li>
        @endforelse
    </ul>
@endif

@if($total)
    @php
        $nums = [];
        for ($i = 1; $i <= $last; $i++) {
            if ($i === 1 || $i === $last || abs($i - $pageNo) <= 1) $nums[] = $i;
            elseif (end($nums) !== '…') $nums[] = '…';
        }
        $pageUrl = fn ($n) => request()->fullUrlWithQuery(['page' => $n > 1 ? $n : null]);
    @endphp
    <nav class="cz-pager" aria-label="Pages">
        <div class="pages">
            @if($pageNo > 1)<a href="{{ $pageUrl($pageNo - 1) }}" data-cz-page="{{ $pageNo - 1 }}" aria-label="Previous page">‹</a>@else<span class="dis" aria-hidden="true">‹</span>@endif
            @foreach($nums as $n)
                @if($n === '…')<span class="gap">…</span>
                @else<a href="{{ $pageUrl($n) }}" data-cz-page="{{ $n }}" @if($n === $pageNo) aria-current="page" @endif>{{ $n }}</a>@endif
            @endforeach
            @if($pageNo < $last)<a href="{{ $pageUrl($pageNo + 1) }}" data-cz-page="{{ $pageNo + 1 }}" aria-label="Next page">›</a>@else<span class="dis" aria-hidden="true">›</span>@endif
        </div>
        <div class="pages" role="group" aria-label="Rows per page">
            <span class="gap">Per page</span>
            @foreach($perPages as $n)
                <a href="{{ request()->fullUrlWithQuery(['per_page' => $n === 25 ? null : $n, 'page' => null]) }}" data-cz-size="{{ $n }}" @if($n === (int) $f['per_page']) aria-current="page" @endif>{{ $n }}</a>
            @endforeach
        </div>
    </nav>
@endif
