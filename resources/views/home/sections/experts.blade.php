{{-- Experts (admin: Homepage Sections → Expert Carousel for the words and how many; Experts, featured first, for the cards). --}}
@if($h['experts'])
<section class="hz-sec ice hz-gutter" id="experts">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        <div class="hz-xgrid">
            @foreach($h['experts'] as $x)
                <article class="hz-xcard">
                    <div class="hz-xtop"><div class="hz-xph" data-i="{{ $x['initials'] }}">@if($x['photo'])<img src="{{ $x['photo'] }}" alt="" loading="lazy" onerror="this.parentNode.textContent=this.parentNode.dataset.i">@else{{ $x['initials'] }}@endif</div><div class="hz-xid"><h3>{{ $x['name'] }}</h3><span>{{ $x['role'] }}</span></div></div>
                    @if($x['tags'])<div class="hz-xtags">@foreach($x['tags'] as $t)<span>{{ $t }}</span>@endforeach</div>@endif
                    <dl class="hz-xstat" style="grid-template-columns:repeat({{ $x['years'] ? 3 : 2 }}, minmax(0, 1fr))">
                        <div><dt>Rating</dt><dd>@if($x['rating'])<span class="hz-xs">★</span> {{ $x['rating'] }}@if($x['reviews'])<small> ({{ $x['reviews'] }})</small>@endif @else<span class="hz-new">New</span>@endif</dd></div>
                        @if($x['years'])<div><dt>Experience</dt><dd>{{ $x['years'] }} yrs</dd></div>@endif
                        <div><dt>Session</dt><dd>{{ $x['price'] ? '₹' . rtrim(rtrim(number_format($x['price'], 2), '0'), '.') : 'Free' }}@if($x['price'])<small>/min</small>@endif</dd></div>
                    </dl>
                    <a class="hz-btn hz-btn-blue hz-btn-sm" href="{{ $x['url'] }}">Book a session</a>
                </article>
            @endforeach
        </div>
        @if($s['cta_title'])<div class="hz-more"><a class="hz-pillbtn" href="{{ $link($s['cta_url'], route('experts')) }}">{{ $s['cta_title'] }} <span aria-hidden="true">→</span></a></div>@endif
    </div>
</section>
@endif
