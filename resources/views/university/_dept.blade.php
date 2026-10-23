{{-- One department: faculty, PhD supervision, labs, research. $d (from UniversityData::departmentsFor), $where. --}}
<div class="uz-card">
    <b>{{ $d['name'] }}</b>
    @php($meta = implode(' · ', array_filter([$d['code'], $d['faculty'] ? number_format($d['faculty']) . ' faculty' : null, $d['phd'] ? 'PhD supervision' : null])))
    @if($meta)<span class="m">{{ $meta }}</span>@endif
    @if($d['labs'] || $d['pubs'])<div class="row">@if($d['labs'])<span>{{ number_format($d['labs']) }} labs</span>@endif @if($d['pubs'])<span>{{ number_format($d['pubs']) }} publications</span>@endif</div>@endif
    @if($d['patents'] || $d['projects'])<div class="row">@if($d['patents'])<span>{{ number_format($d['patents']) }} patents</span>@endif @if($d['projects'])<span>{{ number_format($d['projects']) }} funded projects</span>@endif</div>@endif
    @if($d['hod'])<span class="m">Head of department: {{ $d['hod'] }}</span>@endif
    @if(!empty($where))<span class="m">{{ $where }}</span>@endif
</div>
