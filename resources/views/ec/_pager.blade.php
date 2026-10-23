{{-- Pagination (server side: ?page=&per_page= in the URL, so pages can be shared and indexed). $p from Ec::page(), $noun, $anchor. --}}
@php
    use App\Support\Ec\Ec;
    $pre = $p['prefix'] ?? '';
    $go = fn ($n) => Ec::url(request(), [$pre . 'page' => $n > 1 ? $n : null]) . ($anchor ?? '');
    $nums = [];
    for ($i = 1; $i <= $p['pages']; $i++) {
        if ($i === 1 || $i === $p['pages'] || abs($i - $p['page']) <= 1) $nums[] = $i;
        elseif (end($nums) !== '…') $nums[] = '…';
    }
@endphp
<div class="ec-pager">
    <span class="pinfo">Showing <b>{{ $p['from'] }}–{{ $p['to'] }}</b> of <b>{{ number_format($p['total']) }}</b> {{ $noun }}</span>
    @if($p['pages'] > 1)
        <nav class="ec-pnums" aria-label="Pages">
            @if($p['page'] > 1)<a class="prev" href="{{ $go($p['page'] - 1) }}" rel="prev">‹ Prev</a>@else<span class="btn prev">‹ Prev</span>@endif
            @foreach($nums as $n)
                @if($n === '…')<span class="dots">…</span>@else<a href="{{ $go($n) }}" @if($n === $p['page']) aria-current="page" @endif>{{ $n }}</a>@endif
            @endforeach
            <span class="mob">Page {{ $p['page'] }} of {{ $p['pages'] }}</span>
            @if($p['page'] < $p['pages'])<a class="next" href="{{ $go($p['page'] + 1) }}" rel="next">Next ›</a>@else<span class="btn next">Next ›</span>@endif
        </nav>
    @endif
    <label class="ec-psize">Rows<select data-ec-nav aria-label="Rows per page">
        @foreach($p['sizes'] as $s)<option value="{{ Ec::url(request(), [$pre . 'per_page' => $s === $p['sizes'][0] ? null : $s, $pre . 'page' => null]) . ($anchor ?? '') }}" @selected($s === $p['size'])>{{ $s }}</option>@endforeach
    </select></label>
</div>
