{{-- Career roadmap page (client design "Career roadmap redesign") on the Career Roadmap module: stage groups ($d['cats']),
     classes, groups and their roadmaps (CareerData); fixed texts in CareerContent ($c). The wizard and the lead forms are
     drawn by career.js from #cr-data; everything else is here. --}}
@extends('layouts.app')
@php
    use App\Support\Career\CareerData;
    use App\Http\Controllers\CareerController;
    $groups = collect($d['groups']);
    $classes = $d['classes'];
    // popular: one group for each of these words, Class 10 and 12 first
    $popular = collect(['stream', 'career', 'medical', 'engineering', 'commerce', 'law', 'scholarship'])->map(fn ($w) => $groups->sortBy(fn ($g) => in_array($classes[$g['cls']]['slug'], ['class-10', 'class-12'], true) ? 0 : 1)
        ->first(fn ($g) => stripos($g['title'], $w) !== false))->filter()->unique('id')->take(6);
    $dl = '<svg class="cr-dl" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12M7 10l5 5 5-5M4 21h16"/></svg>';
    $first = $groups->firstWhere('id', $state['group']);
    $catOf = collect($d['cats'])->flatMap(fn ($c) => array_fill_keys($c['classes'], $c['name']))->all();
    $hasLearn = $d['blogs'] || $d['threads'];
    $quiz = collect($c['quiz'])->filter(fn ($q) => !empty($q['question']) && count($q['options'] ?? []) >= 2)->values();
    $jsData = [
        'cats' => $d['cats'], 'classes' => $classes, 'groups' => $d['groups'], 'tree' => $tree,
        'icons' => CareerData::ICONS, 'state' => $state, 'lead' => $lead,
        'classList' => CareerController::CLASSES, 'states' => CareerController::STATES,
        'quiz' => $quiz,
        'streams' => collect($c['streams'])->mapWithKeys(fn ($s) => [$s['name'] ?? '' => implode(', ', array_slice($s['opens'] ?? [], 0, 5))]),
        'cta' => ['title' => $c['roadmap_cta_title'], 'text' => $c['roadmap_cta_text']],
        'urls' => ['lead' => route('career.lead'), 'group' => url('/career-roadmap/group/__ID__'), 'page' => route('career-roadmap.index')],
    ];
@endphp
@section('meta_title', $c['meta_title'])
@section('meta_description', $c['meta_description'])

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/career.css') }}?v={{ @filemtime(public_path('assets/css/career.css')) }}">
    <link rel="canonical" href="{{ route('career-roadmap.index') }}">
    @if($c['faqs'])
        <script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => collect($c['faqs'])->filter(fn ($f) => !empty($f['q']) && !empty($f['a']))->map(fn ($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]])->values()], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endif
@endpush
@push('scripts')
    <script type="application/json" id="cr-data">{!! json_encode($jsData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
    <script src="{{ asset('assets/js/career.js') }}?v={{ @filemtime(public_path('assets/js/career.js')) }}"></script>
@endpush

@section('content')
<main class="cr" id="cr-top">
    {{-- ======== hero ======== --}}
    <section class="cr-hero cr-gutter">
        <div class="cr-wrap">
            <div>
                <span class="cr-kicker">@if($c['kicker_badge'])<b>{{ $c['kicker_badge'] }}</b>@endif{{ $c['kicker'] }}</span>
                <h1>{{ $c['title'] }}@if($c['title_em'])<br><em>{{ $c['title_em'] }}</em>@endif</h1>
                @if($c['lede'])<p class="cr-lede">{{ $c['lede'] }}</p>@endif
                @if($groups->isNotEmpty())
                    <div class="cr-csearch" data-cr-search>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg>
                        <input type="search" placeholder="{{ $c['search_placeholder'] }}" aria-label="Search the roadmaps" autocomplete="off" data-cr-q>
                        <div class="cr-sugg" data-cr-sugg hidden></div>
                    </div>
                    @if($popular->isNotEmpty())<div class="cr-pop">Popular @foreach($popular as $p)<button type="button" data-cr-open="{{ $p['id'] }}">{{ $p['title'] }}</button>@endforeach</div>@endif
                @endif
                @if($c['trust'])<div class="cr-trust">@foreach($c['trust'] as $t)<span>✓ {{ $t }}</span>@endforeach</div>@endif
                @if($c['how'])<div class="cr-how">@foreach($c['how'] as $h)@if(!$loop->first)<em>→</em>@endif<span><i>{{ $loop->iteration }}</i>{{ $h }}</span>@endforeach</div>@endif
            </div>
            <aside class="cr-hlead">
                <div>@if($c['lead_badge'])<span class="cr-hl-badge">{{ $c['lead_badge'] }}</span>@endif<h2>{{ $c['lead_title'] }}</h2>@if($c['lead_text'])<p>{{ $c['lead_text'] }}</p>@endif</div>
                <div data-cr-form="hero"></div>
            </aside>
        </div>
    </section>

    @if($groups->isNotEmpty())
    {{-- ======== build your roadmap (career.js) ======== --}}
    <section class="cr-sec white cr-gutter" id="build">
        <div class="cr-wrap">
            <div class="cr-lhead"><h2>{{ $c['build_title'] }}</h2>@if($c['build_sub'])<p>{{ $c['build_sub'] }}</p>@endif</div>
            <div class="cr-wiz">
                <div class="cr-wstep"><div class="cr-wlabel"><i>1</i><b>Where are you now?</b><span>Pick your stage, then your class.</span></div><div class="cr-stages" data-cr-stages></div><div class="cr-cls" data-cr-cls></div></div>
                <div class="cr-wstep"><div class="cr-wlabel"><i>2</i><b>What interests you?</b><span data-cr-l2>Paths for your class.</span></div><div class="cr-ints" data-cr-ints></div></div>
                <div class="cr-wstep" data-cr-out>
                    <noscript><div class="cr-empty"><b>Turn on JavaScript to build your roadmap</b>Or open a roadmap below.</div></noscript>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== explore: every group of every class ======== --}}
    <section class="cr-sec ice cr-gutter" id="explore">
        <div class="cr-wrap">
            <div class="cr-lhead"><h2>{{ $c['explore_title'] }}</h2>@if($c['explore_sub'])<p>{{ $c['explore_sub'] }}</p>@endif</div>
            @if($c['pdf_title'] && $first)
                <div class="cr-pdfpromo"><span class="ic">PDF</span><div><b>{{ $c['pdf_title'] }}</b>@if($c['pdf_text'])<span>{{ $c['pdf_text'] }}</span>@endif</div><button type="button" class="cr-btn cr-btn-orange" data-cr-pdf="{{ $first['id'] }}">{!! $dl !!} Get the {{ $classes[$first['cls']]['title'] }} {{ $first['title'] }} PDF</button></div>
            @endif
            @if(count($d['cats']) > 1)
                <div class="cr-tabs-row"><div class="cr-tabs" role="tablist" aria-label="Stage">
                    <button role="tab" type="button" data-cr-cat="" aria-selected="true">All<small>{{ $groups->count() }}</small></button>
                    @foreach($d['cats'] as $cat)<button role="tab" type="button" data-cr-cat="{{ $cat['id'] }}" aria-selected="false">{{ $cat['name'] }}<small>{{ $groups->whereIn('cls', $cat['classes'])->count() }}</small></button>@endforeach
                </div></div>
            @endif
            <div class="cr-cgrid" data-cr-cgrid>
                @foreach($groups as $g)
                    @php
                        $catId = collect($d['cats'])->first(fn ($cat) => in_array($g['cls'], $cat['classes'], true))['id'] ?? '';
                    @endphp
                    <article class="cr-ccard" data-cat="{{ $catId }}">
                        <div class="top"><span class="ic">{!! CareerData::icon($g['ic']) !!}</span><div><h3>{{ $g['title'] }}</h3><span class="sub">{{ $classes[$g['cls']]['title'] }} · {{ $catOf[$g['cls']] ?? '' }}</span></div></div>
                        @if($g['items'])<div class="cr-chain">@foreach(array_slice($g['items'], 0, 5) as $s)@if(!$loop->first)<i>·</i>@endif<span>{{ $s }}</span>@endforeach @if(count($g['items']) > 5)<small>+{{ count($g['items']) - 5 }} more</small>@endif</div>@endif
                        <dl class="cr-cmeta"><div><dt>Class</dt><dd>{{ $classes[$g['cls']]['title'] }}</dd></div><div><dt>Options</dt><dd>{{ $g['count'] }}</dd></div></dl>
                        <div class="cr-ccta"><a class="cr-btn cr-btn-ghost cr-btn-sm" href="{{ route('career-roadmap.index', ['group' => $g['id']]) }}#build" data-cr-open="{{ $g['id'] }}">See roadmap</a><button type="button" class="cr-btn cr-btn-orange cr-btn-sm" data-cr-lead="card" data-group="{{ $g['id'] }}">Get it free</button></div>
                        <button type="button" class="cr-pdfl" data-cr-pdf="{{ $g['id'] }}">{!! $dl !!} Download PDF roadmap</button>
                    </article>
                @endforeach
            </div>
            <div class="cr-moreb"><button type="button" class="cr-btn cr-btn-ghost" data-cr-cmore hidden>Show all</button></div>
        </div>
    </section>
    @endif

    {{-- ======== streams ======== --}}
    @if($c['streams'])
    <section class="cr-sec white cr-gutter" id="streams">
        <div class="cr-wrap">
            <div class="cr-lhead"><h2>{{ $c['streams_title'] }}</h2>@if($c['streams_sub'])<p>{{ $c['streams_sub'] }}</p>@endif</div>
            <div class="cr-sgrid">
                @foreach($c['streams'] as $s)
                    <article class="cr-scard">
                        <div class="sh"><b>{{ $s['name'] }}</b>@if(!empty($s['subjects']))<small>{{ $s['subjects'] }}</small>@endif</div>
                        @if(!empty($s['opens']))<div class="sb open"><h4><span>✓</span>Opens the door to</h4><ul>@foreach($s['opens'] as $o)<li>{{ $o }}</li>@endforeach</ul></div>@endif
                        @if(!empty($s['closes']))<div class="sb close"><h4><span>✕</span>Closes</h4><ul>@foreach($s['closes'] as $o)<li>{{ $o }}</li>@endforeach</ul></div>@endif
                        @if(!empty($s['exams']))<div class="sb exams"><h4><span>✎</span>Main exams after Class 12</h4><div class="cr-echips">@foreach($s['exams'] as $o)<i>{{ $o }}</i>@endforeach</div></div>@endif
                    </article>
                @endforeach
            </div>
            @if($quiz->isNotEmpty())
                <div class="cr-quizcta"><div><b>{{ $c['quiz_title'] }}</b>@if($c['quiz_text'])<span>{{ $c['quiz_text'] }}</span>@endif</div><button type="button" class="cr-btn cr-btn-blue" data-cr-quiz>{{ $c['quiz_button'] }}</button></div>
            @endif
        </div>
    </section>
    @endif

    {{-- ======== free counselling ======== --}}
    <section class="cr-duo cr-gutter" id="help">
        <div class="cr-wrap">
            <div>
                @if($c['help_tag'])<span class="cr-tag">{{ $c['help_tag'] }}</span>@endif
                <h2>{!! collect(explode('|', $c['help_title']))->map(fn ($l) => e(trim($l)))->implode('<br>') !!}</h2>
                @if($c['help_text'])<p>{{ $c['help_text'] }}</p>@endif
                @if($c['help_steps'])<ul class="cr-mini-steps">@foreach($c['help_steps'] as $s)<li>{{ $s }}</li>@endforeach</ul>@endif
            </div>
            <div class="cr-panel cr-formpanel"><h3>{{ $c['help_form_title'] }}</h3><div data-cr-form="band"></div></div>
        </div>
    </section>

    {{-- ======== FAQs ======== --}}
    @if($c['faqs'])
    <section class="cr-sec white cr-gutter" id="faq">
        <div class="cr-wrap">
            <div class="cr-lhead"><h2>{{ $c['faq_title'] }}</h2></div>
            <div class="cr-fqlist">
                @foreach($c['faqs'] as $f)
                    <details class="cr-fq" @if($loop->first) open @endif><summary>{{ $f['q'] }}</summary><p>{!! nl2br(e($f['a'])) !!}</p></details>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ======== read, ask and discuss ======== --}}
    @if($hasLearn)
    <section class="cr-sec ice cr-gutter" id="learn">
        <div class="cr-wrap">
            <div class="cr-lhead"><h2>{{ $c['learn_title'] }}</h2>@if($c['learn_sub'])<p>{{ $c['learn_sub'] }}</p>@endif</div>
            @if($d['topics'])
                <div class="cr-topics" role="group" aria-label="Topic"><button type="button" data-cr-topic="" aria-pressed="true">All</button>@foreach($d['topics'] as $t)<button type="button" data-cr-topic="{{ $t }}" aria-pressed="false">{{ $t }}</button>@endforeach</div>
            @endif
            <div class="cr-learn">
                <div>
                    <div class="cr-lh"><b>Career guides</b><a href="{{ route('blogs') }}">All guides →</a></div>
                    <div class="cr-blogs" data-cr-list="blogs">
                        @foreach($d['blogs'] as $i => $b)
                            <a class="cr-blog" href="{{ $b['url'] }}" data-topics="{{ json_encode($b['topics']) }}" @if($i >= 4) hidden @endif>
                                <span class="bi" @if($b['img']) style="background-image:url('{{ $b['img'] }}')" @endif>@unless($b['img']){{ $b['topics'][0] ?? 'Guide' }}@endunless</span>
                                <span class="bb">@if($b['topics'])<span class="bt">{{ $b['topics'][0] }}</span>@endif<b>{{ $b['title'] }}</b><small>{{ $b['read'] }}</small></span>
                            </a>
                        @endforeach
                        <p class="cr-none" data-cr-none hidden>No guides on this topic yet.</p>
                    </div>
                </div>
                <div>
                    <div class="cr-lh"><b>From Ask Enrollzy</b><a href="{{ route('ask.enrollzy') }}">All discussions →</a></div>
                    <div class="cr-threads" data-cr-list="threads">
                        @foreach($d['threads'] as $i => $t)
                            <a class="cr-thread" href="{{ $t['url'] }}" data-topics="{{ json_encode($t['topics']) }}" @if($i >= 5) hidden @endif>
                                <span class="ac"><b>{{ $t['answers'] }}</b><small>{{ $t['answers'] === 1 ? 'answer' : 'answers' }}</small></span>
                                <span><span class="tq">{{ $t['q'] }}</span><span class="tm">@if($t['topics'])<em>{{ $t['topics'][0] }}</em>@endif{{ $t['ago'] }}</span></span>
                            </a>
                        @endforeach
                        <p class="cr-none" data-cr-none hidden>No discussions on this topic yet.</p>
                    </div>
                    <form class="cr-ask" data-cr-ask><label for="cr-askq">{{ $c['ask_label'] }}</label><div><input id="cr-askq" maxlength="500" placeholder="{{ $c['ask_placeholder'] }}" autocomplete="off"><button class="cr-btn cr-btn-orange cr-btn-sm" type="submit">Ask</button></div>@if($c['ask_note'])<small>{{ $c['ask_note'] }}</small>@endif</form>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ======== phone bar, save-roadmap prompt, modal, toast ======== --}}
    <div class="cr-mbar"><button type="button" class="cr-btn cr-btn-orange" data-cr-lead="sticky">Free career call</button>@if($c['whatsapp'])<a class="cr-btn cr-btn-ghost" href="https://wa.me/{{ $c['whatsapp'] }}?text={{ rawurlencode('Hi, I need help with my career roadmap.') }}" target="_blank" rel="noopener">WhatsApp us</a>@endif</div>
    <div class="cr-nudge" data-cr-nudge hidden><button type="button" class="cr-nx" data-cr-nudgex aria-label="Close">×</button><b>Save your roadmap?</b><span data-cr-nudget>We can send it to your WhatsApp, free.</span><button type="button" class="cr-btn cr-btn-orange cr-btn-sm" data-cr-lead="nudge">Send it to me</button></div>
    <div class="cr-modal" data-cr-modal hidden><div class="cr-mbg" data-cr-close></div><div class="cr-mpanel" role="dialog" aria-modal="true" aria-label="Form"><button type="button" class="cr-nx" data-cr-close aria-label="Close">×</button><div data-cr-mbody></div></div></div>
    <div class="cr-toast" data-cr-toast role="status" hidden></div>
</main>
@endsection
