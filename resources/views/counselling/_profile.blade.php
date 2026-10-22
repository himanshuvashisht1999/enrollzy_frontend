{{--
    "Your details": home state, category and rank, kept in the ez_profile cookie by counselling.js and used on every page.
    $fields: which of state / cat / rank to show. $idp: id prefix. $rankLabel, $label, $sub, $flat optional.
--}}
@php
    $fields = $fields ?? ['state', 'cat', 'rank'];
    $idp = $idp ?? 'p';
@endphp
<div class="cz-profile{{ !empty($flat) ? ' flat' : '' }}">
    <span class="lbl">{{ $label ?? 'Your details' }}@if(!empty($sub))<small>{{ $sub }}</small>@endif</span>
    @if(in_array('state', $fields))
        <label class="cz-field" for="{{ $idp }}-state">Home state{{ !empty($domicileHint) ? ' (domicile)' : '' }}
            <select id="{{ $idp }}-state" data-p="state">
                <option value="">Select state</option>
                @foreach($masters['states'] as $s)
                    <option value="{{ $s }}" @selected($profile['state'] === $s)>{{ $s }}</option>
                @endforeach
            </select>
        </label>
    @endif
    @if(in_array('cat', $fields))
        <label class="cz-field" for="{{ $idp }}-cat">Category
            <select id="{{ $idp }}-cat" data-p="cat">
                @foreach($masters['categories'] as $c)
                    <option value="{{ $c['id'] }}" @selected((int) ($profile['cat'] ?? 0) === (int) $c['id'])>{{ $c['name'] }}</option>
                @endforeach
            </select>
        </label>
    @endif
    @if(in_array('rank', $fields))
        <label class="cz-field" for="{{ $idp }}-rank">{{ $rankLabel ?? 'Your rank (AIR)' }}
            <input id="{{ $idp }}-rank" type="number" min="1" inputmode="numeric" placeholder="e.g. 12500" data-p="rank" value="{{ $profile['rank'] }}">
        </label>
    @endif
</div>
