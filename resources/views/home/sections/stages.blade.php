{{-- "Where are you on the road?" (admin: Homepage Sections → Journey Stages): stages, each with its cards. --}}
@php
    $stages = collect($s['stages'])->filter(fn ($st) => !empty($st['name']) && !empty($st['cards']))->values();
    $first = max(0, min($stages->count() - 1, (int) $s['default_stage'] - 1));
@endphp
@if($stages->isNotEmpty())
<section class="hz-sec white hz-split hz-gutter" id="stages">
    <div class="hz-wrap">
        <div class="hz-head"><div>@if(!empty($s['badge']))<div class="eyebrow">{{ $s['badge'] }}</div>@endif<h2>{!! $lines($s['title']) !!}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>@include('home._art', ['art' => 'stages'])</div>
        @if($stages->count() > 1)
            <div class="hz-stepper" role="tablist" aria-label="Your stage" data-hz-tabs="stage" style="grid-template-columns:repeat({{ $stages->count() }}, minmax(64px, 1fr))">
                @foreach($stages as $i => $st)
                    <button class="hz-stage" type="button" role="tab" aria-selected="{{ $i === $first ? 'true' : 'false' }}" data-hz-tab="{{ $i }}"><span class="ic">{!! $ico(\App\Support\Home\HomeContent::icon($st['icon'] ?? null)) !!}</span>{{ $st['name'] }}</button>
                @endforeach
            </div>
        @endif
        <div>
            @foreach($stages as $i => $st)
                <div class="hz-pgrid" data-hz-pane="stage" data-hz-key="{{ $i }}" @if($i !== $first) hidden @endif>
                    @foreach($st['cards'] as $j => $card)
                        <a class="hz-pcard" href="{{ $link($card['url'] ?? null, '#') }}"><span class="n">{{ str_pad($j + 1, 2, '0', STR_PAD_LEFT) }}</span><b>{{ $card['title'] ?? '' }}</b>@if(!empty($card['text']))<span>{{ $card['text'] }}</span>@endif<span class="go">Start here →</span></a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
