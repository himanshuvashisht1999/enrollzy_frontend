{{-- FAQ (admin: Homepage Sections → FAQ for the words and how many; FAQs in their admin order). --}}
@if($h['faqs'])
<section class="hz-sec white hz-gutter" id="faq">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        <div class="hz-fqlist">@foreach($h['faqs'] as $fq)<details class="hz-fq" @if($loop->first) open @endif><summary>{{ $fq['q'] }}</summary><p>{{ $fq['a'] }}</p></details>@endforeach</div>
        @if($s['cta_title'])<div class="hz-more"><a class="hz-pillbtn" href="{{ $link($s['cta_url'], route('faq')) }}">{{ $s['cta_title'] }} <span aria-hidden="true">→</span></a></div>@endif
    </div>
</section>
@endif
