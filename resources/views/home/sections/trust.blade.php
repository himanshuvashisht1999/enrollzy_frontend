{{-- "Why students trust Enrollzy" (admin: Homepage Sections → Testimonials): words and pillars there; student
     feedback from Testimonials; counts of what is listed (only numbers of 50 or more are shown). --}}
@php
    $reviews = $s['show_reviews'] ? $h['reviews'] : [];
    $counts = $s['show_counts'] ? $h['counts'] : [];
@endphp
@if($s['pillars'] || $reviews || $counts)
<section class="hz-sec white hz-gutter" id="trust">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        @if($s['pillars'])
            <div class="hz-pillars n{{ min(3, count($s['pillars'])) }}">
                @foreach($s['pillars'] as $p)
                    <div class="hz-pillar"><span class="ic">{!! $ico(\App\Support\Home\HomeContent::icon($p['icon'] ?? 'shield')) !!}</span><div><b>{{ $p['title'] ?? '' }}</b>@if(!empty($p['text']))<p>{{ $p['text'] }}</p>@endif</div></div>
                @endforeach
            </div>
        @endif
        @if($reviews)
            <div class="hz-reviews">
                @foreach($reviews as $r)
                    <div class="hz-rev">@if($r['rating'])<span class="st" aria-label="{{ $r['rating'] }} out of 5">{{ str_repeat('★', min(5, $r['rating'])) }}{{ str_repeat('☆', max(0, 5 - $r['rating'])) }}</span>@endif<p>{{ $r['text'] }}</p><span class="who">{{ implode(' · ', array_filter([$r['name'], $r['role']])) }}</span></div>
                @endforeach
            </div>
        @endif
        @if($counts)
            <div class="hz-counts">@foreach($counts as $n)<a class="hz-count" href="{{ $n['url'] }}"><span class="v hz-num">{{ number_format($n['n']) }}</span><span class="k">{{ $n['label'] }} listed</span></a>@endforeach</div>
        @endif
        @if($s['cta_title'] && $s['cta_url'])<div class="hz-more"><a class="hz-pillbtn" href="{{ $link($s['cta_url']) }}">{{ $s['cta_title'] }} <span aria-hidden="true">→</span></a></div>@endif
    </div>
</section>
@endif
