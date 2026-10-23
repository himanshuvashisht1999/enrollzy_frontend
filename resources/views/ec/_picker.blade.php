{{-- Searchable counselling picker (NEET UG has 30+): All India first, states in a grid; search and All / All India / State
     filter in the page (ec.js). Each choice is a link: the counselling page, or the cutoff finder for it. --}}
@php
    use App\Support\Ec\Ec;
    $ai = $pickCouns->filter(fn ($c) => $c['level'] !== 'state')->values();
    $st = $pickCouns->filter(fn ($c) => $c['level'] === 'state')->sortBy(fn ($c) => $c['states'][0] ?? $c['name'])->values();
    $href = fn ($c) => $pickMode === 'cut' ? route('cutoffs.index', ['exam' => $pickExam['slug'], 'counselling' => $c['slug']]) : route('counselling.show', $c['slug']);
    $item = function ($c) use ($href) {
        $s = $c['_s'] ?? Ec::counState($c);
        return '<a class="ec-pk" href="' . e($href($c)) . '" data-pk="' . ($c['level'] === 'state' ? 'state' : 'ai') . '" data-q="' . e(mb_strtolower($c['name'] . ' ' . implode(' ', $c['states'] ?? []))) . '">'
            . '<span><b>' . e($c['level'] === 'state' && !empty($c['states']) ? $c['states'][0] : $c['name']) . '</b><small>' . e($c['level'] === 'state' ? 'State counselling' : ($c['conducting_body'] ?? 'All India counselling')) . '</small></span>'
            . '<span class="ec-st ' . Ec::COUN_PILL[$s['state']] . '">' . Ec::COUN_LABEL[$s['state']] . '</span></a>';
    };
@endphp
<div data-ec-pickwrap hidden>
    <div class="ec-pk-bg" data-ec-pkclose></div>
    <div class="ec-pk-panel" role="dialog" aria-modal="true" aria-label="Choose a counselling">
        <div class="ec-pk-head"><div><b>Choose a counselling</b><small>{{ $pickCouns->count() }} counsellings use {{ $pickExam['short_name'] ?: $pickExam['name'] }}</small></div><button type="button" class="ec-pk-x" data-ec-pkclose aria-label="Close">×</button></div>
        <div class="ec-pk-tools">
            <input type="search" placeholder="Type your state, e.g. Punjab" aria-label="Search counselling" data-ec-pkq>
            <div class="ec-pk-seg">@foreach([['all', 'All', $pickCouns->count()], ['ai', 'All India', $ai->count()], ['state', 'State', $st->count()]] as [$k, $l, $n])<button type="button" data-ec-pktype="{{ $k }}" aria-pressed="{{ $k === 'all' ? 'true' : 'false' }}">{{ $l }} <small>{{ $n }}</small></button>@endforeach</div>
        </div>
        <div class="ec-pk-list">
            @if($ai->isNotEmpty())<h4 data-ec-pkh="ai">All India</h4>{!! $ai->map($item)->implode('') !!}@endif
            @if($st->isNotEmpty())<h4 data-ec-pkh="state">State counselling</h4><div class="ec-pk-grid">{!! $st->map($item)->implode('') !!}</div>@endif
            <p class="ec-empty" data-ec-pknone hidden>No counselling matches.</p>
        </div>
    </div>
</div>
