{{-- Quick links in the hero: jump to a section of "Exam details" (works from any tab). --}}
@php $ql = array_intersect_key(['dates' => 'Dates', 'eligibility' => 'Eligibility', 'apply' => 'Apply', 'pattern' => 'Pattern', 'syllabus' => 'Syllabus', 'centres' => 'Centres', 'result' => 'Result', 'faq' => 'FAQs'], $secs); @endphp
@if($ql)
    <div class="ec-qlinks">@foreach($ql as $k => $l)<a href="{{ route('exam.detail', $slug) }}#sec-{{ $k }}" data-ec-toc="{{ $k }}">{{ $l }}</a>@endforeach</div>
@endif
