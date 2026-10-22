{{-- Sticky context bar on every counselling page: breadcrumb, counselling switcher and the four sections. --}}
@php
    $yq = $year ? ['year' => $year] : [];
    $tabUrl = fn ($t, $s) => match ($t) {
        'cutoffs' => route('counselling.cutoffs', ['slug' => $s] + $yq),
        'seats' => route('counselling.seats', ['slug' => $s] + $yq),
        'colleges' => route('counselling.colleges', ['slug' => $s] + $yq),
        default => $year ? route('counselling.show', ['slug' => $s, 'year' => $year]) : route('counselling.show', $s),
    };
    $examYear = collect($page['cycle']['exam_cycles'] ?? [])->first()['year'] ?? ($page['cycle']['year'] ?? null);
    $mineList = collect($list)->where('mine', true);
    $restList = collect($list)->where('mine', false);
    if (!collect($list)->firstWhere('slug', $slug)) {
        $restList->prepend(['slug' => $slug, 'name' => $page['counselling']['name']]);
    }
@endphp
<div class="cz-ctx cz-gutter">
    <div class="cz-container">
        <div class="cz-ctx-path">
            @if($primary && $primary['slug'])
                <a href="{{ route('exams.show', $primary['slug']) }}">{{ $primary['short_name'] ?: $primary['name'] }} {{ $examYear }}</a><span aria-hidden="true">›</span>
            @endif
            <a href="{{ route('counselling.index', $primary && $primary['slug'] ? ['exam' => $primary['slug']] : []) }}">Counselling</a><span aria-hidden="true">›</span>
            <label for="cz-switch" class="cz-sr">Switch counselling</label>
            <select id="cz-switch" data-cz-switch>
                @foreach([['For you', $mineList], ['Other counsellings', $restList]] as [$glabel, $group])
                    @if($group->count())
                        <optgroup label="{{ $glabel }}">
                            @foreach($group as $c)
                                <option value="{{ $c['slug'] }}" data-url="{{ $tabUrl($tab, $c['slug']) }}" @selected($c['slug'] === $slug)>{{ $c['name'] }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                @endforeach
            </select>
        </div>
        <nav class="cz-subtabs" aria-label="Counselling sections">
            <a href="{{ $tabUrl('overview', $slug) }}" class="{{ $tab === 'overview' ? 'on' : '' }}" @if($tab === 'overview') aria-current="page" @endif>Overview</a>
            <a href="{{ $tabUrl('cutoffs', $slug) }}" class="{{ $tab === 'cutoffs' ? 'on' : '' }}" @if($tab === 'cutoffs') aria-current="page" @endif>Cutoffs @if(($page['cutoffs']['count'] ?? 0) > 0)<span class="count">{{ \App\Support\CounsellingUi::num($page['cutoffs']['count']) }}</span>@endif</a>
            <a href="{{ $tabUrl('seats', $slug) }}" class="{{ $tab === 'seats' ? 'on' : '' }}" @if($tab === 'seats') aria-current="page" @endif>Seat matrix</a>
            <a href="{{ $tabUrl('colleges', $slug) }}" class="{{ $tab === 'colleges' ? 'on' : '' }}" @if($tab === 'colleges') aria-current="page" @endif>Colleges @if(($page['institutes']['colleges'] ?? 0) > 0)<span class="count">{{ \App\Support\CounsellingUi::num($page['institutes']['colleges']) }}</span>@endif</a>
        </nav>
    </div>
</div>
