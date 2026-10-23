{{-- Boarding schools (admin: Homepage Sections → Institute Marquee for the words; schools for the cards, tabbed by board). --}}
@if($h['boarding'])
<section class="hz-sec white hz-gutter" id="boarding">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        @if(count($h['boarding']) > 1)
            <div class="hz-segrow"><div class="hz-seg" role="tablist" aria-label="Board" data-hz-tabs="board">
                @foreach($h['boarding'] as $t)<button type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-hz-tab="b{{ $loop->index }}">{{ $t['label'] }}</button>@endforeach
            </div></div>
        @endif
        <div>
            @foreach($h['boarding'] as $t)
                <div data-hz-pane="board" data-hz-key="b{{ $loop->index }}" @unless($loop->first) hidden @endunless>
                    <div class="hz-instgrid{{ count($t['items']) < 4 ? ' few' : '' }}">@foreach($t['items'] as $x)@include('home._inst', ['x' => $x])@endforeach</div>
                    @if($s['cta_title'])
                        {{-- "All" uses the admin's button link; a board tab opens the school list for that board --}}
                        <div class="hz-more"><a class="hz-pillbtn" href="{{ $loop->first ? $link($s['cta_url'], $t['more']) : $t['more'] }}">{{ $loop->first ? $s['cta_title'] : $s['cta_title'] . ' (' . $t['label'] . ')' }} <span aria-hidden="true">→</span></a></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
