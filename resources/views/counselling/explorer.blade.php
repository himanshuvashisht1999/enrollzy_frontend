@extends('layouts.app')
@php
    use App\Support\CounsellingUi as Ui;
    $c = $page['counselling'];
    $cycle = $page['cycle'];
    $titles = ['cutoffs' => 'Cutoffs', 'seats' => 'Seat matrix', 'colleges' => 'Participating colleges'];
    $filt = $data['filters'] ?? [];
    $cats = $filt['categories'] ?? [];
    $catName = collect($cats)->firstWhere('id', $f['category'])['name'] ?? null;
    $shownYear = $kind === 'cutoffs' && $source ? $source['label_year'] : ($cycle['year'] ?? null);
    $examShort = $primary ? ($primary['short_name'] ?: $primary['name']) : null;
    $roundName = collect($filt['rounds'] ?? [])->firstWhere('id', $f['round'])['name'] ?? ($data['meta']['round']['name'] ?? null);
    $version = $data['meta']['version'] ?? null;
    $previous = $data['meta']['previous'] ?? null;
    $sub = match ($kind) {
        'cutoffs' => 'Closing rank of each seat' . ($roundName ? " in $roundName" : '') . ($shownYear ? " $shownYear" : '') . '.' . ($catName ? " $catName category" : '') . ($f['rank'] ? ', your rank ' . Ui::num($f['rank']) . '.' : '.'),
        'seats' => 'Seats per college, quota and category in the live version of the matrix' . ($roundName ? " ($roundName)" : '') . '.',
        default => 'Colleges whose seats are filled through ' . $c['name'] . '.',
    };
    $rankLabel = $examShort ? "Your $examShort rank" : 'Your rank';
@endphp
@section('meta_title', $titles[$kind] . ' - ' . $c['name'] . ' ' . ($shownYear ?? '') . ' | Enrollzy')
@section('meta_description', $titles[$kind] . ' for ' . $c['name'] . ': filter by state, quota, category and institute type.')

@section('content')
@include('counselling._assets', ['canonical' => url()->current()])
<main class="cz cz-explorer" data-cz-explorer="{{ $kind }}">
    @include('counselling._ctx')

    <div class="cz-page cz-gutter">
        <div class="cz-container cz-stack">
            <div class="cz-explorer-top">
                <div>
                    <h1>{{ $titles[$kind] }} · {{ $c['name'] }} {{ $shownYear }}</h1>
                    <p class="sub">{{ $sub }}</p>
                </div>
                @if($kind === 'seats' && $version)
                    <div class="cz-notice">
                        @if($previous)<b>Revised {{ Ui::date($version['published_on'], 'j M') }}.</b> Rows marked orange changed since the {{ $previous['label'] ?: 'previous' }} matrix.
                        @else<b>Published {{ Ui::date($version['published_on'], 'j M') }}.</b> {{ Ui::num($version['total_seats']) }} seats.@endif
                        @if($version['source_url'])<a href="{{ $version['source_url'] }}" target="_blank" rel="noopener">Source ↗</a>@endif
                    </div>
                @endif
            </div>
            @if($notice)<div class="cz-notice warn"><b>Note.</b> {{ $notice }}</div>@endif
            @if($isPast)<div class="cz-notice"><b>You are viewing {{ $year }}.</b> <a href="{{ url()->current() }}">See the latest year</a></div>@endif

            <form id="cz-filters" method="get" action="{{ url()->current() }}" data-cz-filters role="search" aria-label="Filters">
                <details class="cz-filters" data-cz-filters-wrap>
                    <summary>Filters <span data-cz-fcount></span></summary>
                    <div class="cz-fbar">
                        <label class="cz-field grow" for="f-q">Search college or course
                            <input id="f-q" type="search" name="q" value="{{ $f['q'] }}" placeholder="Type to search" autocomplete="off">
                        </label>
                        @if($kind !== 'colleges' && count($filt['rounds'] ?? []) > 0)
                            <label class="cz-field" for="f-round">Round
                                <select id="f-round" name="round" data-cz-full>
                                    @if($kind === 'cutoffs')
                                        @foreach($filt['rounds'] as $r)
                                            @if(($r['cutoffs'] ?? 0) > 0 || (int) $r['id'] === (int) $f['round'])<option value="{{ $r['id'] }}" @selected((int) $r['id'] === (int) $f['round'])>{{ $r['name'] }}</option>@endif
                                        @endforeach
                                    @else
                                        @foreach($filt['rounds'] as $r)
                                            <option value="{{ $r['id'] }}" @selected((int) $r['id'] === (int) ($f['round'] ?: ($data['meta']['round']['id'] ?? 0)))>{{ $r['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </label>
                        @endif
                        @if($kind !== 'seats' && count($cats))
                            <label class="cz-field" for="f-cat">Category
                                <select id="f-cat" name="category" data-p="cat">
                                    @foreach($cats as $cat)<option value="{{ $cat['id'] }}" @selected((int) $cat['id'] === (int) $f['category'])>{{ $cat['name'] }}</option>@endforeach
                                </select>
                            </label>
                        @endif
                        @if($kind !== 'seats')
                            <label class="cz-field" for="f-rank">{{ $rankLabel }}
                                <input id="f-rank" type="number" name="rank" min="1" inputmode="numeric" placeholder="e.g. 12500" value="{{ $f['rank'] }}" data-p="rank">
                            </label>
                        @endif
                        @if($kind === 'colleges')
                            <label class="cz-field" for="f-fee">Yearly fee
                                <select id="f-fee" name="fee">
                                    <option value="">Any</option>
                                    @foreach(\App\Http\Controllers\CounsellingController::FEES as $v => $l)<option value="{{ $v }}" @selected($f['fee'] === (string) $v)>{{ $l }}</option>@endforeach
                                </select>
                            </label>
                        @endif
                        <label class="cz-field" for="f-quota">Quota
                            <select id="f-quota" name="quota">
                                <option value="">All quotas</option>
                                @foreach($filt['quotas'] ?? [] as $q)<option value="{{ $q['id'] }}" @selected((int) $q['id'] === (int) $f['quota'])>{{ $q['name'] }}</option>@endforeach
                            </select>
                        </label>
                        <label class="cz-field" for="f-state">State
                            <select id="f-state" name="state" @disabled(count($filt['states'] ?? []) < 2 && !$f['state'])>
                                <option value="">All states</option>
                                @foreach($filt['states'] ?? [] as $s)<option value="{{ $s }}" @selected($s === $f['state'])>{{ $s }}</option>@endforeach
                            </select>
                        </label>
                        <label class="cz-field" for="f-type">Type
                            <select id="f-type" name="type">
                                <option value="">All types</option>
                                @foreach($filt['institute_types'] ?? [] as $t)<option value="{{ $t['value'] }}" @selected($t['value'] === $f['type'])>{{ $t['label'] }}</option>@endforeach
                            </select>
                        </label>
                        @if($kind === 'cutoffs')
                            <label class="cz-check"><input type="checkbox" name="within" value="1" @checked($f['within'])> Only colleges within my rank</label>
                        @endif
                        @if($kind === 'seats' && $previous)
                            <label class="cz-check"><input type="checkbox" name="changed" value="1" @checked($f['changed'])> Only rows changed in the latest revision</label>
                        @endif
                    </div>
                </details>
                <input type="hidden" name="page" value="{{ $f['page'] > 1 ? $f['page'] : '' }}">
                <input type="hidden" name="per_page" value="{{ $f['per_page'] !== 25 ? $f['per_page'] : '' }}">
                @if($year)<input type="hidden" name="year" value="{{ $year }}">@endif
                <noscript><button type="submit" class="cz-btn cz-btn-blue cz-btn-sm" style="margin-top:8px">Apply filters</button></noscript>
            </form>

            <div id="cz-results" aria-live="polite">
                @include('counselling._results')
            </div>
        </div>
    </div>
</main>
@endsection
