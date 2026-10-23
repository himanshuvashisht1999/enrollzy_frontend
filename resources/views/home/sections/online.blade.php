{{-- Online degrees (admin: Homepage Sections → Online Degrees). Programmes and fees from the universities' online courses. --}}
@if($h['online'])
<section class="hz-duo online hz-gutter" id="online">
    <div class="hz-wrap hz-duo-grid">
        <div class="hz-duo-copy">
            @if(!empty($s['badge']))<span class="hz-duo-tag">{{ $s['badge'] }}</span>@endif
            <h2>{!! $lines($s['title']) !!}</h2>
            @if($s['subtitle'])<p>{{ \App\Support\Home\HomeContent::fill($s['subtitle'], $h['onlineUnis']) }}</p>@endif
            @if($s['points'])<ul class="hz-points">@foreach($s['points'] as $p)<li>{!! $check !!}{{ $p }}</li>@endforeach</ul>@endif
            @if($s['cta_title'])
                @if($s['cta_url'])<a class="hz-btn hz-btn-orange" href="{{ $link($s['cta_url']) }}">{{ $s['cta_title'] }}</a>
                @else<a class="hz-btn hz-btn-orange" href="#enquire" data-hz-enquire="Online advisor">{{ $s['cta_title'] }}</a>@endif
            @endif
        </div>
        <div class="hz-panel">
            <div class="hz-panel-head"><b>{{ $s['panel_title'] }}</b><span>{{ $h['onlineUnis'] }} universities</span></div>
            @foreach($h['online'] as $p)
                <a class="hz-prow" href="{{ $p['url'] }}"><span class="pn"><b>{{ $p['name'] }}</b><small>{{ implode(' · ', array_filter([$p['years'] ? rtrim(rtrim(number_format($p['years'], 1), '0'), '.') . ' years' : null, $p['unis'] . ' ' . \Illuminate\Support\Str::plural('university', $p['unis'])])) }}</small></span><span class="pf">@if($p['from'])<small>from</small><b>{{ \App\Support\University\UniversityData::lakh($p['from']) }}</b>@else<small>Fee on request</small>@endif</span><span>{!! $arrow !!}</span></a>
            @endforeach
        </div>
    </div>
</section>
@endif
