{{-- Ratings and the latest published reviews. $r from UniversityData::reviews(). --}}
@if($r['count'])
    <div class="uz-rating">
        <div><div class="big cz-num">{{ $r['rating'] ?? '–' }}</div><div class="cz-muted cz-small">out of 5 · {{ number_format($r['count']) }} {{ \Illuminate\Support\Str::plural('review', $r['count']) }}</div></div>
        @if($r['aspects'])
            <div class="uz-bars">@foreach($r['aspects'] as $label => $v)<div>{{ $label }}<i style="--w: {{ min(100, $v * 20) }}%"></i><span class="cz-num">{{ $v }}</span></div>@endforeach</div>
        @endif
    </div>
    @foreach($r['latest'] as $rv)
        <div class="uz-review">
            <b>{{ $rv['title'] ?: \Illuminate\Support\Str::limit($rv['comment'], 60) }}</b>
            <span class="m">{{ implode(' · ', array_filter([$rv['name'] ?: 'Student', $rv['type'] ? ucfirst($rv['type']) : null, $rv['year'], $rv['rating'] ? $rv['rating'] . ' / 5' : null])) }}@if($rv['verified'])<span class="uz-verified">Verified</span>@endif</span>
            @if($rv['comment'])<p style="margin:6px 0 0">{{ \Illuminate\Support\Str::limit($rv['comment'], 400) }}</p>@endif
        </div>
    @endforeach
@else
    <div class="cz-empty"><b>No reviews yet</b>Reviews from students appear here once they are published.</div>
@endif
