{{-- "Pick a stream" (admin: Homepage Sections → University Grid for the words; Homepage Stream Tabs for the streams,
     their universities, exams and courses). --}}
@if($h['streams'])
<section class="hz-sec white hz-gutter" id="streams">
    <div class="hz-wrap">
        <div class="hz-lhead"><h2>{{ $s['title'] }}</h2>@if($s['subtitle'])<p>{{ $s['subtitle'] }}</p>@endif</div>
        <div class="hz-streams" role="tablist" aria-label="Stream" data-hz-tabs="stream">
            @foreach($h['streams'] as $st)
                <button class="hz-stile" type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-hz-tab="{{ $st['key'] }}"><span class="ic">{!! $ico($st['icon']) !!}</span><span><b>{{ $st['name'] }}</b><small>{{ implode(' · ', array_filter([count($st['colleges']) ? count($st['colleges']) . ' universities' : null, count($st['exams']) ? count($st['exams']) . ' exams' : null, count($st['courses']) ? count($st['courses']) . ' courses' : null])) }}</small></span></button>
            @endforeach
        </div>
        @foreach($h['streams'] as $st)
            <div class="hz-spanel" data-hz-pane="stream" data-hz-key="{{ $st['key'] }}" @unless($loop->first) hidden @endunless>
                @foreach([['Top universities', $st['colleges'], '<path d="M3 10l9-5 9 5-9 5z"/><path d="M7 12v5c3 2 7 2 10 0v-5"/>', route('university')], ['Entrance exams', $st['exams'], '<rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h4"/>', route('top-exams')], ['Courses', $st['courses'], '<path d="M4 5h6a2 2 0 0 1 2 2v13a2 2 0 0 0-2-2H4zM20 5h-6a2 2 0 0 0-2 2v13a2 2 0 0 1 2-2h6z"/>', route('courses.index')]] as [$title, $list, $icon, $all])
                    <div class="hz-lc">
                        <h3><span class="i">{!! $ico($icon) !!}</span><span class="t">{{ $title }}</span>@if($list)<a class="hz-link" href="{{ $all }}" style="font-size:13px">All</a>@endif</h3>
                        @if($list)
                            <ul>@foreach($list as $x)<li><a href="{{ $x['url'] }}">{{ $x['name'] }}</a>@if($x['meta'])<span>{{ \Illuminate\Support\Str::limit($x['meta'], 26) }}</span>@endif</li>@endforeach</ul>
                        @else
                            <div class="none">Coming soon for {{ $st['name'] }}.</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endif
