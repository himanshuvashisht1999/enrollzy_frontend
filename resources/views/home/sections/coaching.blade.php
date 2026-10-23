{{-- Coaching institutes (admin: Homepage Sections → School Marquee for the words; active coaching institutes for the cards). --}}
@if($h['coaching'])
<section class="hz-sec white hz-gutter" id="coaching">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        <div class="hz-instgrid{{ count($h['coaching']) < 4 ? ' few' : '' }}">@foreach($h['coaching'] as $x)@include('home._inst', ['x' => $x])@endforeach</div>
        @if($s['cta_title'])<div class="hz-more"><a class="hz-pillbtn" href="{{ $link($s['cta_url'], route('all.coaching')) }}">{{ $s['cta_title'] }} <span aria-hidden="true">→</span></a></div>@endif
    </div>
</section>
@endif
