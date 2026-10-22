{{-- One campus as a card linking to its page. $cc (campus), $mine (highlight). --}}
@php $n = $u->programmes($u->onCampus([$cc['id']]))->count(); @endphp
<a class="uz-card{{ !empty($mine) ? ' mine' : '' }}" href="{{ $L->campus($cc['slug']) }}" data-uz-campus-card="{{ mb_strtolower($cc['name'] . ' ' . $cc['city'] . ' ' . $cc['state']) }}" data-uz-state="{{ $cc['state'] }}" data-uz-courses="{{ mb_strtolower($u->onCampus([$cc['id']])->pluck('name')->unique()->implode('|')) }}">
    <b>{{ $cc['name'] }}@if($cc['main']) <span class="cz-tag" style="font-size:12px">Main</span>@endif</b>
    <span class="m">{{ implode(' · ', array_filter([$cc['city'] !== '' && !str_contains(mb_strtolower($cc['name']), mb_strtolower($cc['city'])) ? $cc['city'] : null, $cc['state'], $cc['area'] ? rtrim(rtrim(number_format($cc['area'], 1), '0'), '.') . ' ' . $cc['area_unit'] : null, 'Hostel: ' . ($cc['hostel'] ? 'Yes' : 'No')])) }}</span>
    <div class="row"><span><span class="cz-num">{{ $n }}</span> {{ \Illuminate\Support\Str::plural('course', $n) }}</span>@if($cc['students'])<span class="cz-num">{{ number_format($cc['students']) }} students</span>@endif</div>
    <span class="go">Open campus →</span>
</a>
