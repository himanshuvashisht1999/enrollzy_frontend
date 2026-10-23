{{-- Blogs (admin: Homepage Sections → Blogs for the words and how many; the latest published blogs). --}}
@if($h['blogs'])
<section class="hz-sec ice hz-gutter" id="guides">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        <div class="hz-bgrid">
            @foreach($h['blogs'] as $b)
                <article class="hz-bcard">
                    <div class="hz-bimg">@if($b['img'])<img src="{{ $b['img'] }}" alt="" loading="lazy" onerror="this.remove()">@endif</div>
                    @if($b['cat'])<span class="hz-bcat">{{ $b['cat'] }}</span>@endif
                    <h3>{{ $b['title'] }}</h3>
                    <a class="hz-pillbtn sm" href="{{ $b['url'] }}">Read more <span aria-hidden="true">→</span></a>
                </article>
            @endforeach
        </div>
        @if($s['cta_title'])<div class="hz-more"><a class="hz-pillbtn" href="{{ $link($s['cta_url'], route('blogs')) }}">{{ $s['cta_title'] }} <span aria-hidden="true">→</span></a></div>@endif
    </div>
</section>
@endif
