{{-- Hero (admin: Homepage Sections → Hero Banner). $s = content; the 3 "open right now" cards: HomeData::heroCards. --}}
@php
    $words = $s['rotating_words'];
    $popular = collect($s['popular'])->map(fn ($p) => [$p['label'] ?? '', $link($p['url'] ?? null, '#')])->filter(fn ($p) => $p[0] !== '');
    if ($s['popular_live_exam'] && !empty($h['now']['exams']['rows'][0])) $popular->prepend([$h['now']['exams']['rows'][0]['name'], $h['now']['exams']['rows'][0]['url']]);
    $liveSpots = ['left:0;top:34%', 'right:2%;top:50%', 'left:18%;top:4%'];
@endphp
<section class="hz-hero hz-gutter">
    <div class="hz-wrap">
        <div class="hz-hero-copy">
            @if(!empty($s['badge']))<span class="hz-kicker"><b>DPIIT</b>{{ $s['badge'] }}</span>@endif
            <h1>{{ $s['title'] }}@if($words) <span class="hz-rot"><span data-hz-rot data-words="{{ json_encode(array_values($words)) }}">{{ $words[0] }}</span><svg viewBox="0 0 200 20" preserveAspectRatio="none" aria-hidden="true"><path d="M2 14 C 50 4, 100 4, 198 12" fill="none" stroke="currentColor" stroke-width="6" stroke-linecap="round"/></svg></span>@endif @if($s['title_after'])<br>{{ $s['title_after'] }}@endif</h1>
            @if($s['subtitle'])<p class="hz-lede">{{ $s['subtitle'] }}</p>@endif
            <div class="hz-searchbox">
                <form class="hz-search" role="search" action="{{ route('search.results') }}" method="get" data-hz-search autocomplete="off">
                    <label for="hz-type" class="hz-sr">Search in</label>
                    <select id="hz-type" data-hz-type><option value="">Everything</option><option value="colleges">Colleges</option><option value="exams">Exams</option><option value="schools">Schools</option><option value="coaching">Coaching</option><option value="mentors">Experts</option></select>
                    <label for="hz-q" class="hz-sr">Search</label>
                    <input id="hz-q" name="q" type="search" placeholder="{{ $s['search_placeholder'] }}" data-hz-q>
                    <button class="hz-btn hz-btn-blue" type="submit">Search</button>
                    <div class="hz-suggest" data-hz-suggest hidden></div>
                </form>
            </div>
            @if($popular->isNotEmpty())
                <div class="hz-popular">Popular @foreach($popular->take(6) as [$t, $u])<a href="{{ $u }}">{{ $t }}</a>@endforeach</div>
            @endif
            @if($s['assurances'])
                <div class="hz-assure">@foreach($s['assurances'] as $a)<span><i>✓</i>{{ $a }}</span>@endforeach</div>
            @endif
        </div>

        <div class="hz-route{{ $h['live'] ? '' : ' none' }}" aria-label="Open right now">
            <svg class="path" viewBox="0 0 520 430" preserveAspectRatio="none" aria-hidden="true">
                <defs><linearGradient id="hz-rg" x1="0" x2="1"><stop offset="0" stop-color="#1f5fd8"/><stop offset="1" stop-color="#f5821f"/></linearGradient></defs>
                <path d="M30 400 C 120 380, 120 300, 220 290 S 380 250, 330 170 S 380 60, 490 40" fill="none" stroke="url(#hz-rg)" stroke-width="5" stroke-linecap="round" stroke-dasharray="2 12"/>
            </svg>
            <div class="hz-stop" style="left:2%;bottom:2%"><span class="dot">10</span>Class 10</div>
            <div class="hz-stop" style="left:36%;top:60%"><span class="dot">12</span>Class 12</div>
            <div class="hz-stop" style="left:56%;top:36%"><span class="dot">UG</span>College</div>
            <div class="hz-stop end" style="right:0;top:2%"><span class="dot">★</span>Career</div>
            @foreach($h['live'] as $i => $r)
                <a class="hz-live" href="{{ $r['url'] }}" style="{{ $liveSpots[$i] }}"><span class="hz-pill {{ $r['state'] === 'upcoming' ? 'upcoming' : 'open' }}">{{ $r['step'] ?: ($r['state'] === 'upcoming' ? 'Opening soon' : 'Open now') }}</span><b>{{ $r['name'] }}</b><span class="m">{{ $r['when'] }}</span></a>
            @endforeach
        </div>
    </div>
</section>
