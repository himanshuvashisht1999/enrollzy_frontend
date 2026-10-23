{{-- "Compare before you decide" (admin: Homepage Sections → University Comparison). Opens the university compare page. --}}
@if(count($h['universities']) >= 2)
<section class="hz-sec ice hz-split hz-gutter" id="compare">
    <div class="hz-wrap">
        <div class="hz-head"><div>@if(!empty($s['badge']))<div class="eyebrow">{{ $s['badge'] }}</div>@endif<h2>{!! $lines($s['title']) !!}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif
            @if($s['cta_title'] && $s['cta_url'])<a class="hz-link" href="{{ $link($s['cta_url']) }}">{{ $s['cta_title'] }} →</a>@endif</div>@include('home._art', ['art' => 'compare'])</div>
        <div class="hz-cmp" data-hz-compare data-courses="{{ json_encode($h['popularCourses']) }}" data-universities="{{ json_encode($h['universities']) }}">
            <div class="hz-cmp-tabs" role="tablist" aria-label="Comparison type">
                <button type="button" role="tab" aria-selected="true" data-cm="course">Same course, other universities</button>
                <button type="button" role="tab" aria-selected="false" data-cm="custom">Different courses &amp; universities</button>
                <button type="button" role="tab" aria-selected="false" data-cm="uni">Within one university</button>
            </div>
            <p class="hz-cmp-desc" data-cmp-desc></p>
            <div class="hz-cmp-top" data-cmp-top></div>
            <div class="hz-cmp-slots" data-cmp-slots></div>
            <div class="hz-cmp-foot"><span data-cmp-hint></span><button class="hz-btn hz-btn-orange" type="button" data-cmp-go disabled>Compare now</button></div>
        </div>
    </div>
</section>
@endif
