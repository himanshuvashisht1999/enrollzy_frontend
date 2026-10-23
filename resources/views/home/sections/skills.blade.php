{{-- In-demand programmes and skills (admin: Homepage Sections → Noteworthy Mentions for the words; Noteworthy
     Categories / Mentions for the tabs and cards). --}}
@if($h['skills'])
<section class="hz-sec white hz-gutter" id="skills">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        @if(count($h['skills']) > 1)
            <div class="hz-segrow"><div class="hz-seg" role="tablist" aria-label="Programme type" data-hz-tabs="skill">
                @foreach($h['skills'] as $cat)<button type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-hz-tab="{{ $cat['key'] }}">{{ $cat['label'] }}</button>@endforeach
            </div></div>
        @endif
        <div>
            @foreach($h['skills'] as $cat)
                <div class="hz-skgrid" data-hz-pane="skill" data-hz-key="{{ $cat['key'] }}" @unless($loop->first) hidden @endunless>
                    @foreach($cat['items'] as $m)
                        @php($tag = $m['tag'] ?: null)
                        <{{ $m['url'] ? 'a' : 'div' }} class="hz-skcard" @if($m['url']) href="{{ $link($m['url']) }}" @endif>
                            <span class="hz-skic">{!! $ico($m['icon'], 1.8) !!}</span>
                            <span class="hz-sktx"><b>{{ $m['title'] }}</b>@if($m['text'])<small>{{ $m['text'] }}</small>@endif</span>
                            @if($tag)<span class="hz-sktag {{ \Illuminate\Support\Str::contains(strtolower($tag), 'free') ? 'free' : (\Illuminate\Support\Str::contains(strtolower($tag), ['degree', 'programme', 'program']) ? 'degree' : '') }}">{{ $tag }}</span>@endif
                        </{{ $m['url'] ? 'a' : 'div' }}>
                    @endforeach
                </div>
            @endforeach
        </div>
        @if($s['cta_title'] && $s['cta_url'])<div class="hz-more"><a class="hz-pillbtn" href="{{ $link($s['cta_url']) }}">{{ $s['cta_title'] }} <span aria-hidden="true">→</span></a></div>@endif
    </div>
</section>
@endif
