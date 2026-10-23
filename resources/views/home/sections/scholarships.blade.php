{{-- Scholarships (admin: Homepage Sections → Specialized Courses for the words; scholarships marked "featured on
     homepage" for the cards). {count} in the text = number of active scholarships. --}}
@if($h['scholarships'])
<section class="hz-sec ice hz-split rev hz-gutter" id="sch">
    <div class="hz-wrap">
        <div class="hz-head"><div>@if(!empty($s['badge']))<div class="eyebrow">{{ $s['badge'] }}</div>@endif<h2>{!! $lines($s['title']) !!}</h2>@if($s['subtitle'])<p>{{ \App\Support\Home\HomeContent::fill($s['subtitle'], $h['schTotal']) }}</p>@endif
            @if($s['cta_title'])<a class="hz-link" href="{{ $link($s['cta_url'], route('scholarships')) }}">{{ $s['cta_title'] }} →</a>@endif</div>@include('home._art', ['art' => 'sch'])</div>
        <div data-hz-sch>
            @if($h['schLevels'] || $h['schCats'])
                <div class="hz-sfilters">
                    @if($h['schLevels'])<label class="hz-field">I'm studying<select data-sch-level><option value="">Any level</option>@foreach($h['schLevels'] as $l)<option>{{ $l }}</option>@endforeach</select></label>@endif
                    @if($h['schCats'])<label class="hz-field">Category<select data-sch-cat><option value="">Any</option>@foreach($h['schCats'] as $cat)<option>{{ $cat }}</option>@endforeach</select></label>@endif
                </div>
            @endif
            <div class="hz-sgrid">
                @foreach($h['scholarships'] as $sc)
                    <div class="hz-scard" data-levels="{{ implode('|', $sc['levels']) }}" data-cats="{{ implode('|', $sc['cats']) }}" @if($loop->index >= 3) hidden @endif>
                        @if($sc['amount'])<div class="amt hz-num">{{ $sc['amount'] }} @if($sc['per'])<small>{{ \Illuminate\Support\Str::limit($sc['per'], 24) }}</small>@endif</div>@endif
                        <b>{{ $sc['name'] }}</b>
                        @if($sc['by'])<span class="by">{{ \Illuminate\Support\Str::limit($sc['by'], 70) }}</span>@endif
                        @if($sc['levels'] || $sc['cats'] || $sc['type'])<div class="hz-tags">@foreach(array_slice(array_unique(array_filter(array_merge($sc['levels'], $sc['cats'], [$sc['type']]))), 0, 3) as $t)<span>{{ $t }}</span>@endforeach</div>@endif
                        <a class="hz-btn hz-btn-ghost hz-btn-sm" href="{{ $sc['url'] }}">View details</a>
                    </div>
                @endforeach
                <div class="hz-scard none" data-sch-none hidden><b>No scholarship matches</b><span class="by">Choose "Any" in one of the filters.</span></div>
            </div>
        </div>
    </div>
</section>
@endif
