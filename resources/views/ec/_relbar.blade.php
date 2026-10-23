{{-- How this connects: Exam → Counselling → Cutoffs, from the exam ⟷ counselling mapping (never hard-coded).
     $rel = ['exam' => [slug, name, short_name], 'couns' => list of counsellings, 'coun' => current slug|null, 'at' => exam|coun|cut, 'year' => cutoff year|null] --}}
@php
    use App\Support\Ec\Ec;
    $e = $rel['exam'];
    $couns = collect($rel['couns'] ?? []);
    $cur = $rel['coun'] ? $couns->firstWhere('slug', $rel['coun']) : null;
    $c = $cur ?? $couns->first();
    $short = fn ($x) => $x['level'] === 'state' && !empty($x['states']) ? $x['states'][0] : ($x['short_name'] ?: $x['name']);
    $cutHref = $c ? route('cutoffs.index', ['exam' => $e['slug'], 'counselling' => $c['slug']]) : null;
@endphp
<div class="ec-rel" aria-label="How this connects">
    @if($rel['at'] !== 'exam')
        <a class="ec-rstep exam" href="{{ route('exam.detail', $e['slug']) }}"><span class="n">1</span><small>Exam</small><b>{{ $e['short_name'] ?: $e['name'] }}</b></a>
    @else
        <div class="ec-rstep exam cur"><span class="n">1</span><small>Exam</small><b>{{ $e['short_name'] ?: $e['name'] }}</b></div>
    @endif
    <span class="arr" aria-hidden="true">→</span>
    @if($couns->isEmpty())
        <div class="ec-rstep coun off"><span class="n">2</span><small>Counselling</small><b>No central counselling</b></div>
    @elseif($couns->count() > 1)
        <button type="button" class="ec-rstep coun{{ $rel['at'] === 'coun' ? ' cur' : '' }}" data-ec-picker="{{ $rel['at'] === 'cut' ? 'cut' : 'nav' }}">
            <span class="n">2</span><small>Counselling · {{ $couns->count() }} use this exam</small>
            <b>{{ $cur ? $cur['name'] : $short($couns->first()) . ' + ' . ($couns->count() - 1) . ' more' }}</b><span class="chg">{{ $cur ? 'Change' : 'Choose' }} ▾</span>
        </button>
    @elseif($rel['at'] === 'coun')
        <div class="ec-rstep coun cur"><span class="n">2</span><small>Counselling</small><b>{{ $c['name'] }}</b></div>
    @else
        <a class="ec-rstep coun" href="{{ route('counselling.show', $c['slug']) }}"><span class="n">2</span><small>Counselling</small><b>{{ $c['name'] }}</b></a>
    @endif
    <span class="arr" aria-hidden="true">→</span>
    @if(!$c)
        <div class="ec-rstep cut off"><span class="n">3</span><small>Cutoffs</small><b>College-wise only</b></div>
    @elseif($rel['at'] === 'cut')
        <div class="ec-rstep cut cur"><span class="n">3</span><small>Cutoffs</small><b>{{ !empty($rel['year']) ? $rel['year'] . ' closing ranks' : 'Closing ranks' }}</b></div>
    @else
        <a class="ec-rstep cut" href="{{ $cutHref }}"><span class="n">3</span><small>Cutoffs</small><b>{{ !empty($rel['year']) ? $rel['year'] . ' closing ranks' : 'Opening and closing ranks' }}</b></a>
    @endif
</div>
@if($couns->count() > 1)
    @include('ec._picker', ['pickExam' => $e, 'pickCouns' => $couns, 'pickMode' => $rel['at'] === 'cut' ? 'cut' : 'nav'])
@endif
