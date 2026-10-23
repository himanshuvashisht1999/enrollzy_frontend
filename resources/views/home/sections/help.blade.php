{{-- Free counselling (admin: Homepage Sections → Free Counselling): words, points, steps; the button opens the call-back form. --}}
<section class="hz-duo help hz-gutter" id="help">
    <div class="hz-wrap hz-duo-grid">
        <div class="hz-duo-copy">
            @if(!empty($s['badge']))<span class="hz-duo-tag">{{ $s['badge'] }}</span>@endif
            <h2>{!! $lines($s['title']) !!}</h2>
            @if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif
            @if($s['points'])<ul class="hz-points">@foreach($s['points'] as $p)<li>{!! $check !!}{{ $p }}</li>@endforeach</ul>@endif
            @if($s['cta_title'])
                @if($s['cta_url'])<a class="hz-btn hz-btn-orange" href="{{ $link($s['cta_url']) }}">{{ $s['cta_title'] }}</a>
                @else<a class="hz-btn hz-btn-orange" href="#enquire" data-hz-enquire="Free counselling">{{ $s['cta_title'] }}</a>@endif
            @endif
        </div>
        @if($s['steps'])
            <div class="hz-panel">
                <div class="hz-panel-head"><b>{{ $s['panel_title'] }}</b><span>{{ count($s['steps']) }} {{ \Illuminate\Support\Str::plural('step', count($s['steps'])) }}</span></div>
                <ol class="hz-steps">@foreach($s['steps'] as $i => $st)<li><i>{{ $i + 1 }}</i><span><b>{{ $st['title'] ?? '' }}</b>@if(!empty($st['text']))<small>{{ $st['text'] }}</small>@endif</span></li>@endforeach</ol>
            </div>
        @endif
    </div>
</section>
