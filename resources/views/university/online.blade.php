@extends('university.base')
@php
    use App\Support\University\UniversityData as U;
    $o = $u->org;
    $num = fn ($y) => $y ? rtrim(rtrim(number_format($y, 1), '0'), '.') : null;
    $vs = $rows->filter(fn ($r) => $r['total_fee'] && $r['campus_total']);
@endphp
@section('meta_title', 'Online courses - ' . $o['name'] . ' | Enrollzy')
@section('meta_description', 'Online programmes from ' . $o['name'] . ': fees, duration and how they compare with on-campus study.')

@section('uz')
<div class="cz-page cz-gutter">
    <div class="cz-container cz-stack">
        <div class="uz-backrow"><a class="uz-back" href="{{ $L->overview() }}"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M12 4l-6 6 6 6"/></svg>Back to {{ $o['name'] }}</a></div>
        <div class="uz-online-hero">
            <span class="cz-tag" style="width:fit-content">{{ $o['short'] ?: $o['name'] }} Online</span>
            <h1>Online degrees, same university</h1>
            <p>Study {{ $rows->count() }} {{ \Illuminate\Support\Str::plural('programme', $rows->count()) }} from anywhere. No relocation, no hostel cost.</p>
            <div class="cz-hero-actions"><a class="cz-btn cz-btn-orange" href="#enquire" data-uz-enquire="Online advisor">Talk to an online advisor</a></div>
        </div>

        @if($rows->isNotEmpty())
            <div class="uz-grid">
                @foreach($rows as $r)
                    <div class="uz-card online">
                        <span class="uz-online-badge">Online</span>
                        <b>{{ $r['name'] }}</b>
                        <span class="m">{{ implode(' · ', array_filter([$r['level'], $r['years'] ? $num($r['years']) . ' years' : null, $r['mode']])) }}</span>
                        <div class="row">
                            <span>{{ $r['total_fee'] && $r['years'] ? 'About ' . U::inr(round($r['total_fee'] / ($r['years'] * 12) / 100) * 100) . '/month' : ($r['annual_fee'] ? U::inr($r['annual_fee']) . '/yr' : 'Fee on request') }}</span>
                            @if($r['total_fee'])<span class="cz-num"><b>{{ U::inr($r['total_fee']) }}</b> total</span>@endif
                        </div>
                        <div class="acts">
                            <a class="go" href="#enquire" data-uz-enquire="Online advisor" data-uz-course="{{ $r['name'] }} (online)" style="color:var(--cz-online)">Talk to advisor →</a>
                            @if($r['campus_offering'])<a class="uz-cmp-btn" href="{{ $L->course($r['campus_offering']['slug']) }}" style="text-decoration:none">On-campus version</a>@endif
                        </div>
                    </div>
                @endforeach
            </div>
            @if($vs->isNotEmpty())
                <div class="cz-card">
                    <div class="cz-head-row"><h2>Online vs on campus</h2></div>
                    <div class="cz-tbl-wrap" style="margin-top:8px"><table><thead><tr><th>Course</th><th class="r">Online, total</th><th class="r">On campus, total<span class="small">lowest-fee campus</span></th><th class="r">Difference</th></tr></thead><tbody>
                        @foreach($vs as $r)<tr><td>{{ $r['name'] }}</td><td class="r cz-num">{{ U::inr($r['total_fee']) }}</td><td class="r cz-num">{{ U::inr($r['campus_total']) }}</td><td class="r cz-num"><b>{{ $r['campus_total'] > $r['total_fee'] ? 'Save ' . U::inr($r['campus_total'] - $r['total_fee']) : U::inr($r['total_fee'] - $r['campus_total']) . ' more' }}</b></td></tr>@endforeach
                    </tbody></table></div>
                    <p class="cz-source">On campus also adds hostel and living costs.</p>
                </div>
            @endif
        @else
            <div class="cz-card cz-empty"><b>No online programmes listed</b>This university has not listed online programmes yet.</div>
        @endif
        <div class="cz-side-card cta" id="enquire" style="max-width:520px">
            <h3>Talk to an online advisor</h3>
            <p>Fees, EMI, exams and how online classes work.</p>
            @include('university._enquiry', ['id' => 'enq-side', 'course' => 'Online programme'])
        </div>
    </div>
</div>
@endsection
