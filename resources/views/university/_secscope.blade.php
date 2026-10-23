{{-- A section's own campus choice: "Fees per year · [All campuses ▾]". Single-campus sections pick one campus;
     multi-campus sections tick several (shown side by side). An override is marked "This section only" with Reset.
     Needs: $key, $sec, $u, $statesByCampus. --}}
@php
    $s = $sec[$key];
    $param = 'sc_' . $key;
    $anchor = '#s-' . $key;
    $chosen = $s['ids'] ?? [];
    $resetUrl = request()->fullUrlWithoutQuery([$param]) . $anchor;
    $pick = fn ($v) => request()->fullUrlWithQuery([$param => $v]) . $anchor;
@endphp
<p class="uz-sub">
    <span>{{ $s['label'] }} ·</span>
    @if($u->campuses->count() > 1)
        <span class="uz-sec" data-uz-pop>
            <button type="button" class="uz-sec-btn{{ $s['own'] ? ' own' : '' }}" data-uz-pop-btn aria-expanded="false" aria-label="Change campus for this section">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 18s6-5.3 6-10a6 6 0 10-12 0c0 4.7 6 10 6 10z"/><circle cx="10" cy="8" r="2"/></svg>{{ $s['scope_label'] }} ▾
            </button>
            <span class="uz-pop" data-uz-pop-panel hidden @if($s['multi']) data-uz-multi="{{ $param }}" data-uz-base="{{ request()->fullUrlWithoutQuery([$param]) }}" data-uz-anchor="{{ $anchor }}" @endif>
                <input type="search" placeholder="Search campus" aria-label="Search campus" data-uz-filter autocomplete="off">
                <span class="uz-list">
                    @unless($s['multi'])<a href="{{ $pick('all') }}" aria-selected="{{ $chosen ? 'false' : 'true' }}" data-uz-item="all">All campuses</a>@endunless
                    @foreach($statesByCampus as $state => $cs)
                        <span class="grp" data-uz-grp>{{ $state ?: 'Other' }}</span>
                        @foreach($cs as $cc)
                            @if($s['multi'])
                                <label data-uz-item="{{ mb_strtolower($cc['name'] . ' ' . $cc['city'] . ' ' . $state) }}"><input type="checkbox" value="{{ $cc['slug'] }}" @checked(in_array($cc['id'], $chosen, true))> {{ $cc['name'] }}</label>
                            @else
                                <a href="{{ $pick($cc['slug']) }}" aria-selected="{{ in_array($cc['id'], $chosen, true) ? 'true' : 'false' }}" data-uz-item="{{ mb_strtolower($cc['name'] . ' ' . $cc['city'] . ' ' . $state) }}">{{ $cc['name'] }}</a>
                            @endif
                        @endforeach
                    @endforeach
                </span>
                <span class="uz-pop-acts">
                    @if($s['multi'])<button class="cz-btn cz-btn-blue cz-btn-sm" type="button" data-uz-multi-apply>Show selected</button>@endif
                    <a class="cz-link" href="{{ $resetUrl }}" style="font-size:14px">Use page setting ({{ $scopeCampus['name'] ?? 'All campuses' }})</a>
                </span>
            </span>
        </span>
        @if($s['own'])<span class="uz-own">This section only</span> <a class="cz-link" href="{{ $resetUrl }}" style="font-size:13.5px">Reset</a>@endif
    @endif
</p>
