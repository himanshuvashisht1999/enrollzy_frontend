@extends('layouts.app')
@php
    use App\Support\CounsellingUi as Ui;
    $examName = $exam ? ($exam['exam']['short_name'] ?: $exam['exam']['name']) : null;
    $examYear = $exam['cycle']['year'] ?? null;
    $title = $exam ? trim("$examName counselling $examYear") : 'Counselling';
    $mineCount = collect($items)->where('mine', true)->count();
@endphp
@section('meta_title', $title . ' - All counsellings, dates and status | Enrollzy')
@section('meta_description', 'Every counselling ' . ($exam ? "that uses $examName" : 'on Enrollzy') . ': which are open now, upcoming or awaited, with dates, quotas and colleges.')

@section('content')
@include('counselling._assets', ['canonical' => url()->current() . ($exam ? '?exam=' . urlencode($exam['exam']['slug']) : '')])
<main class="cz" data-cz-reload-on-profile>
    <div class="cz-hero cz-gutter">
        <div class="cz-container">
            <nav class="cz-crumbs" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Home</a>›
                @if($exam)<a href="{{ route('exam.detail', $exam['exam']['slug']) }}">{{ $examName }} {{ $examYear }}</a>›@endif
                <span>Counselling</span>
            </nav>
            <div class="cz-hero-text">
                <h1>{{ $title }}</h1>
                <div class="full">
                    {{ count($items) }} {{ \Illuminate\Support\Str::plural('counselling', count($items)) }}{{ $exam ? " use your $examName rank" : '' }}. Open ones are shown first.
                </div>
            </div>
            @include('counselling._profile', ['idp' => 'p-hub', 'sub' => 'Used on every page', 'rankLabel' => ($examName ? "$examName rank (AIR)" : 'Your rank (AIR)')])
        </div>
    </div>

    <div class="cz-page cz-gutter">
        <div class="cz-container cz-stack">
            <div class="cz-fbar" data-cz-hub-filters>
                <label class="cz-field grow" for="hub-q">Search
                    <input id="hub-q" type="search" placeholder="State or counselling name" value="{{ request('q') }}" data-cz-hub="q" autocomplete="off">
                </label>
                {{-- Always offered (as in the design): National and State, plus any other level that has counsellings. --}}
                <div class="cz-field">Type
                    <div class="cz-chips" role="group" aria-label="Type" data-cz-hub="type">
                        <button type="button" class="cz-chip" aria-pressed="true" data-v="all">All</button>
                        @foreach(array_values(array_unique(array_merge(['national', 'state'], $levels))) as $l)
                            <button type="button" class="cz-chip" aria-pressed="false" data-v="{{ $l }}">{{ Ui::LEVELS[$l] ?? ucfirst($l) }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="cz-field">Status
                    <div class="cz-chips" role="group" aria-label="Status" data-cz-hub="status">
                        <button type="button" class="cz-chip" aria-pressed="true" data-v="all">All</button>
                        <button type="button" class="cz-chip" aria-pressed="false" data-v="open">Open now</button>
                        <button type="button" class="cz-chip" aria-pressed="false" data-v="upcoming">Upcoming</button>
                        <button type="button" class="cz-chip" aria-pressed="false" data-v="declared">Result out</button>
                    </div>
                </div>
            </div>

            <div class="cz-hub-list" id="cz-hub-list">
                @if(!$profile['state'])
                    <div class="cz-notice"><b>Tip:</b> set your home state above to pin your state's counselling to the top.</div>
                @endif
                <p class="cz-group-h" data-cz-group="mine" @if(!$mineCount) hidden @endif>For you (<span>{{ $mineCount }}</span>)</p>
                @foreach($items as $c)
                    @if(!$c['mine'] && ($loop->first || $items[$loop->index - 1]['mine']))
                        <p class="cz-group-h" data-cz-group="rest">Other counsellings (<span>{{ count($items) - $mineCount }}</span>)</p>
                    @endif
                    @php
                        $now = $c['now'] ?? ['state' => 'tba', 'step' => 'Schedule awaited', 'when' => 'No dates yet'];
                        $search = mb_strtolower($c['name'] . ' ' . ($c['short_name'] ?? '') . ' ' . implode(' ', $c['states'] ?? []));
                    @endphp
                    <div class="cz-hub-item{{ $c['mine'] ? ' mine' : '' }}" data-cz-item data-mine="{{ $c['mine'] ? 1 : 0 }}" data-level="{{ $c['level'] }}" data-status="{{ $now['state'] }}" data-search="{{ $search }}">
                        <div class="nm">
                            @if($c['mine'])<span class="cz-tag orange" style="width:fit-content">For you</span>@endif
                            <a href="{{ route('counselling.show', $c['slug']) }}">{{ $c['name'] }}</a>
                            <span class="m">{{ Ui::LEVELS[$c['level']] ?? ucfirst($c['level']) }}@if(!empty($c['quotas'])) · {{ implode(', ', $c['quotas']) }}@endif</span>
                        </div>
                        <div class="st">
                            {{ Ui::pillHtml($now['state'], $now['label'] ?? null) }}
                            <span>{{ $now['step'] }} · <b>{{ $now['when'] }}</b></span>
                            @if(($c['colleges_count'] ?? 0) > 0)<span class="m cz-muted">{{ Ui::num($c['colleges_count']) }} colleges</span>@endif
                        </div>
                        <a class="cz-btn cz-btn-outline cz-btn-sm" href="{{ route('counselling.show', $c['slug']) }}" aria-label="Open {{ $c['name'] }}">Open</a>
                    </div>
                @endforeach
                <div class="cz-card cz-empty" data-cz-empty @if(count($items)) hidden @endif>
                    <b>No counselling matches</b>{{ count($items) ? 'Clear the search or change the filters.' : 'Counselling pages will appear here once they are published.' }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
