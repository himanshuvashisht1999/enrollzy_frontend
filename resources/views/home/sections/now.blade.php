{{-- "Happening now" (admin: Homepage Sections → Happening Now): exam and counselling steps from the Exam Module API,
     scholarship deadlines from the scholarship dates. Left out when nothing is open or coming. --}}
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
                        @foreach($t['rows'] as $r)
                            <div class="hz-brow {{ $r['state'] }}">
                                <div class="hz-cal" aria-hidden="true"><div class="mo">{{ $r['mo'] ?: ($r['state'] === 'open' ? 'OPEN' : 'SOON') }}</div><div class="dy hz-num">{{ $r['dy'] ?: '•' }}</div></div>
                                <div><b>{{ $r['name'] }}</b>@if($r['meta'])<span class="m">{{ $r['meta'] }}</span>@endif</div>
                                <div class="when"><span class="hz-pill {{ $r['state'] }}">{{ $r['state'] === 'open' ? 'Open now' : 'Upcoming' }}</span>{{ trim(($r['step'] ? $r['step'] . ': ' : '') . $r['when']) }}</div>
                                <a class="hz-btn hz-btn-ghost hz-btn-sm" href="{{ $r['url'] }}">Details</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="hz-board-foot"><a class="hz-link" href="{{ $t['all'] }}">All {{ \Illuminate\Support\Str::lower($t['label']) }} →</a></div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
