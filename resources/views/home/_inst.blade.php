{{-- One school / coaching card on the homepage. $x from HomeData (name, logo, initials, place, boards, classes, types, url). --}}
<article class="hz-icard">
    <div class="hz-ilogo" data-i="{{ $x['initials'] }}">@if($x['logo'])<img src="{{ $x['logo'] }}" alt="" loading="lazy" onerror="this.parentNode.textContent=this.parentNode.dataset.i">@else{{ $x['initials'] }}@endif</div>
    <div class="hz-ibody">
        <h3>{{ $x['name'] }}</h3>
        @if($x['place'])<span class="hz-iloc">{{ $x['place'] }}</span>@endif
        @if($x['boards'] || $x['classes'])<div class="hz-imeta">@if($x['boards'])<span>{{ implode(', ', array_slice($x['boards'], 0, 2)) }}</span>@endif @if($x['classes'])<span>{{ $x['classes'] }}</span>@endif</div>@endif
        @if(!empty($x['types']))<div class="hz-itypes">@foreach($x['types'] as $t)<span>{{ $t }}</span>@endforeach</div>@endif
    </div>
    <div class="hz-iact"><a class="hz-btn hz-btn-ghost hz-btn-sm" href="{{ $x['url'] }}">View details</a><a class="hz-btn hz-btn-blue hz-btn-sm" href="#enquire" data-hz-enquire="Admission enquiry" data-hz-about="{{ $x['name'] }}">Apply now</a></div>
</article>
