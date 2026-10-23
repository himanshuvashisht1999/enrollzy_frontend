{{-- "Happening now" (admin: Homepage Sections → Happening Now): exam and counselling steps from the Exam Module API,
     scholarship deadlines from the scholarship dates (HomeData::happeningNow). The three tabs always show; left out when nothing is open or coming. --}}
@if($h['now'])
<section class="hz-sec ice hz-split hz-gutter" id="now">
    <div class="hz-wrap">
        <div class="hz-head"><div>@if(!empty($s['badge']))<div class="eyebrow">{{ $s['badge'] }}</div>@endif<h2>{!! $lines($s['title']) !!}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>@include('home._art', ['art' => 'now'])</div>
        <div class="hz-segrow"><div class="hz-seg" role="tablist" aria-label="Type" data-hz-tabs="now">
            @foreach($h['now'] as $k => $t)<button type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-hz-tab="{{ $k }}">{{ $t['label'] }}</button>@endforeach
        </div></div>
        <div>
            @foreach($h['now'] as $k => $t)
                <div data-hz-pane="now" data-hz-key="{{ $k }}" @unless($loop->first) hidden @endunless>
                    <div class="hz-board">
                        @forelse($t['rows'] as $r)
                            <div class="hz-brow {{ $r['state'] }}">
                                <div class="hz-cal" aria-hidden="true"><div class="mo">{{ $r['mo'] ?: (['open' => 'OPEN', 'upcoming' => 'SOON'][$r['state']] ?? 'DATE') }}</div><div class="dy hz-num">{{ $r['dy'] ?: ($r['state'] === 'open' && !$r['mo'] ? '✓' : '•') }}</div></div>
                                <div><b>{{ $r['name'] }}</b>@if($r['meta'])<span class="m">{{ $r['meta'] }}</span>@endif</div>
                                <div class="when"><span class="hz-pill {{ $r['state'] }}">{{ $r['pill'] ?? (['open' => 'Open now', 'upcoming' => 'Upcoming'][$r['state']] ?? 'Closed') }}</span><span>{{ $r['when'] }}</span></div>
                                <a class="hz-btn hz-btn-ghost hz-btn-sm" href="{{ $r['url'] }}">Details</a>
                            </div>
                        @empty
                            <div class="hz-board-empty">{{ $t['empty'] }} <a class="hz-link" href="{{ $t['all'] }}">See all →</a></div>
                        @endforelse
                    </div>
                    @if($t['rows'])<div class="hz-board-foot"><a class="hz-link" href="{{ $t['all'] }}">All {{ \Illuminate\Support\Str::lower($t['label']) }} →</a></div>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
