<?php

namespace App\Support\Home;

use App\Models\Organisation;
use App\Support\ApiUnavailable;
use App\Support\EnrollzyApi as Api;
use App\Support\ExamCatalog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Everything the homepage (client design "Home page v11") shows, from real data only. A section with nothing to show
 * is left out; counts below a minimum are hidden (no padded numbers).
 *
 * The database parts are cached for 10 minutes. Exam and counselling dates come from the backend API (cached there
 * for 60 seconds by EnrollzyApi), so "Happening now" stays current.
 */
class HomeData
{
    private const MONTHS = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];

    public static function build(): array
    {
        // words, order and visibility from the admin "Homepage Sections"; the cache key changes whenever the admin saves
        $content = HomeContent::load();
        $c = $content['c'];
        $db = Cache::remember('home-page:v3:' . HomeContent::stamp(), 600, fn () => self::fromDatabase($c));
        $now = in_array('happening_now', $content['order'], true) || $c['hero_banner']['show_live'] ? self::happeningNow($c['happening_now']) : [];
        // hero cards: what is open right now, one per kind first
        $live = collect($now)->flatMap(fn ($t, $k) => collect($t['rows'])->where('state', 'open')->take(2)->map(fn ($r) => $r + ['kind' => $k]))
            ->sortBy(fn ($r) => array_search($r['kind'], ['exams', 'coun', 'sch']))->groupBy('kind')->map->first()->values()->take(3);
        return $db + ['now' => $now, 'live' => $c['hero_banner']['show_live'] ? $live->all() : [], 'order' => $content['order'], 'c' => $c, 'seo' => self::seo()];
    }

    // ------------------------------------------------------------------ live: exams, counselling, scholarship deadlines

    private static function happeningNow(array $cfg): array
    {
        $tabs = [];
        $max = max(1, (int) $cfg['rows']);
        try {
            $exams = collect((Api::get('exams', ['per_page' => 100, 'sort' => 'featured']) ?? [])['data'] ?? []);
            $rows = $exams->map(function ($e) {
                // the step that matters now: registration if it is open or coming, else the exam date, else the result
                foreach (['registration', 'exam-date', 'result'] as $k) {
                    $s = $e['status'][$k] ?? null;
                    if ($s && in_array($s['state'], ['open', 'upcoming', 'declared'], true)) {
                        return ['name' => $e['name'], 'meta' => implode(' · ', array_filter([$e['type_label'] ?? null, $e['categories'][0] ?? null])),
                            'step' => $s['label'], 'state' => $s['state'] === 'declared' ? 'open' : $s['state'], 'when' => $s['text'], 'url' => $e['url'] ?? route('exam.detail', $e['slug'])];
                    }
                }
                return null;
            })->filter();
            if ($rows->isNotEmpty()) $tabs['exams'] = ['label' => $cfg['exams_label'], 'all' => route('top-exams'), 'rows' => self::order($rows, $max)];

            $couns = collect((Api::get('counselling', ['per_page' => 100]) ?? [])['data'] ?? []);
            $rows = $couns->map(function ($c) {
                $n = $c['now'] ?? [];
                if (!in_array($n['state'] ?? null, ['open', 'upcoming', 'declared'], true)) return null;
                return ['name' => $c['name'], 'meta' => implode(' · ', array_filter([ucfirst((string) $c['level']), $c['states'] ? implode(', ', array_slice($c['states'], 0, 2)) : null])),
                    'step' => $n['step'] ?? null, 'state' => $n['state'] === 'declared' ? 'open' : $n['state'], 'when' => $n['when'] ?? null, 'url' => $c['url'] ?? route('counselling.index')];
            })->filter();
            if ($rows->isNotEmpty()) $tabs['coun'] = ['label' => $cfg['coun_label'], 'all' => route('counselling.index'), 'rows' => self::order($rows, $max)];
        } catch (ApiUnavailable $e) {
            // the API is not reachable: the board shows scholarships only, or hides
        }

        $today = now()->toDateString();
        $rows = DB::table('scholarship_dates as d')->join('scholarships as s', 's.id', '=', 'd.scholarship_id')
            ->where('s.status', 1)->whereNull('s.deleted_at')->whereNotNull('d.application_end_date')->where('d.application_end_date', '>=', $today)
            ->orderBy('d.application_end_date')->limit($max)->get(['s.id', 's.slug', 's.title', 's.provider_name', 'd.application_start_date', 'd.application_end_date'])
            ->map(function ($r) use ($today) {
                $open = !$r->application_start_date || $r->application_start_date <= $today;
                $end = \Carbon\Carbon::parse($r->application_end_date);
                return ['name' => $r->title, 'meta' => (string) $r->provider_name, 'step' => 'Applications', 'state' => $open ? 'open' : 'upcoming',
                    'when' => $open ? 'Apply by ' . $end->format('j M Y') : 'Opens ' . \Carbon\Carbon::parse($r->application_start_date)->format('j M Y'),
                    'url' => route('scholarship.detail', $r->slug ?: $r->id)];
            });
        if ($rows->isNotEmpty()) $tabs['sch'] = ['label' => $cfg['sch_label'], 'all' => route('scholarships'), 'rows' => self::order($rows, $max)];

        return $tabs;
    }

    /** Open first, then upcoming; a calendar tile (month + day) taken from the date in the text when there is one. */
    private static function order(Collection $rows, int $max): array
    {
        return $rows->sortBy(fn ($r) => $r['state'] === 'open' ? 0 : 1)->take($max)->map(function ($r) {
            $r['mo'] = $r['dy'] = null;
            if (preg_match('/\b(\d{1,2})\s+(' . implode('|', self::MONTHS) . ')[a-z]*/i', (string) $r['when'], $m)) {
                $r['dy'] = (int) $m[1];
                $r['mo'] = strtoupper(substr($m[2], 0, 3));
            }
            return $r;
        })->values()->all();
    }

    // ------------------------------------------------------------------ database (cached)

    private static function fromDatabase(array $c): array
    {
        $file = fn ($p, $fallback = null) => $p ? (Str::startsWith($p, 'http') ? $p : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($p, '/')) : $fallback;
        $initials = fn ($name) => collect(preg_split('/\s+/', trim(preg_replace('/^(dr|prof|mr|mrs|ms)\.?\s+/i', '', (string) $name))))->filter()->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->take(2)->implode('');
        $json = fn ($v) => is_array($v) ? $v : (json_decode((string) $v, true) ?: []);

        // ---- streams (admin "Homepage stream tabs"): featured universities, exams, courses
        $tabs = \App\Models\HomepageStreamTab::where('status', 1)->orderBy('sort_order')->get();
        $tabExams = ExamCatalog::resolveGroups($tabs->mapWithKeys(fn ($t) => [$t->id => $json($t->default_exams)])->all(), false);
        $unis = Organisation::where('organisation_type_id', 1)->where('status', 1)->get(['id', 'name', 'slug', 'short_name', 'head_office_location'])->keyBy('id');
        $streams = $tabs->map(function ($t) use ($json, $tabExams, $unis) {
            $colleges = collect($json($t->feature_colleges))->map(fn ($id) => $unis->get((int) $id))->filter()->take(5)
                ->map(fn ($u) => ['name' => $u->name, 'meta' => Str::before((string) $u->head_office_location, ','), 'url' => route('university.detail', $u->slug)])->values();
            $exams = ($tabExams[$t->id] ?? collect())->take(5)->map(fn ($e) => ['name' => $e->short_name ?: $e->name, 'meta' => $e->registration_status ?: $e->exam_type, 'url' => route('exam.detail', $e->slug)])->values();
            $courses = \App\Models\Course::whereIn('id', $json($t->default_courses))->orderBy('sort_order')->orderBy('name')->take(5)->get(['name', 'slug', 'duration'])
                ->map(fn ($c) => ['name' => $c->name, 'meta' => $c->duration ? (is_numeric($c->duration) ? $c->duration . ' years' : $c->duration) : null, 'url' => route('course.detail', $c->slug)])->values();
            if ($colleges->isEmpty() && $exams->isEmpty() && $courses->isEmpty()) return null;
            return ['key' => $t->key, 'name' => $t->name, 'icon' => self::streamIcon($t->key . ' ' . $t->name), 'colleges' => $colleges->all(), 'exams' => $exams->all(), 'courses' => $courses->all()];
        })->filter()->values()->all();

        // ---- compare box: universities and the courses most universities teach
        // (filtering by the id list is much faster than joining organisations)
        $uniIds = $unis->keys()->all();
        // (and the course names are fetched afterwards: joining courses here makes the query five times slower)
        $popular = DB::table('organisation_courses')->whereIn('organisation_id', $uniIds)->whereNotNull('campus_id')->whereIn('status', ['1', 'Active', 'active'])
            ->groupBy('course_id')->selectRaw('course_id, count(distinct organisation_id) as n')->having('n', '>=', 2)->orderByDesc('n')->limit(40)->pluck('n', 'course_id');
        $popularNames = DB::table('courses')->whereIn('id', $popular->keys())->pluck('name', 'id');
        $popularCourses = $popular->map(fn ($cnt, $id) => ['id' => (int) $id, 'name' => trim((string) ($popularNames[$id] ?? '')), 'n' => $cnt])
            ->filter(fn ($c) => $c['name'] !== '')->sortBy('name')->values()->all();

        // ---- online programmes across universities (grouped by name: "MBA (Online)" = "Online MBA")
        $onlineCourseIds = DB::table('courses')->whereRaw("name regexp 'online|distance|odl'")->pluck('id')->all();
        $onlineRows = DB::table('organisation_courses')->whereIn('organisation_id', $uniIds)->whereIn('status', ['1', 'Active', 'active'])
            ->where(fn ($q) => $q->whereRaw("concat_ws(' ', mode, delivery_mode) regexp 'online|distance|odl'")->orWhereIn('course_id', $onlineCourseIds ?: [0]))
            ->get(['course_id', 'fees', 'total_fees', 'duration', 'organisation_id']);
        $onlineCourses = DB::table('courses')->whereIn('id', $onlineRows->pluck('course_id')->unique())->get(['id', 'name', 'duration'])->keyBy('id');
        $onlineRows = $onlineRows->filter(fn ($r) => $onlineCourses->has($r->course_id))
            ->each(function ($r) use ($onlineCourses) { $r->name = $onlineCourses[$r->course_id]->name; $r->cdur = $onlineCourses[$r->course_id]->duration; });
        $onlineUnis = $onlineRows->pluck('organisation_id')->unique()->count();
        $online = $onlineRows
            ->map(function ($r) use ($unis) {
                $r->slug = $unis->get($r->organisation_id)->slug;
                $years = \App\Support\University\UniversityData::years($r->duration ?: $r->cdur);
                $annual = \App\Support\University\UniversityData::annualFee($r->fees, $r->total_fees, $years);
                $total = (float) $r->total_fees > 0 ? (float) $r->total_fees : ($annual && $years ? $annual * $years : null);
                $base = trim(preg_replace('/\s+/', ' ', preg_replace('/\b(online|distance|odl)\b|[()\-–]/i', ' ', $r->name)));
                return ['key' => Str::lower($base), 'name' => 'Online ' . $base, 'years' => $years, 'total' => $total, 'slug' => $r->slug];
            })
            ->filter(fn ($r) => mb_strlen($r['key']) >= 2 && mb_strlen($r['key']) <= 40)
            ->groupBy('key')->map(function ($g) {
                $cheapest = $g->filter(fn ($r) => $r['total'])->sortBy('total')->first();
                return ['name' => $g->first()['name'], 'years' => $g->pluck('years')->filter()->mode()[0] ?? null, 'unis' => $g->pluck('slug')->unique()->count(),
                    'from' => $cheapest['total'] ?? null, 'url' => route('university.online', ($cheapest ?? $g->first())['slug'])];
            })->sortByDesc('unis')->take(max(1, $c['online_degrees']['items']))->values()->all();

        // ---- in-demand programmes and skills (admin "Noteworthy mentions")
        $skills = \App\Models\NoteworthyCategory::with(['mentions' => fn ($q) => $q->where('status', 1)->orderBy('sort_order')])->where('status', 1)->orderBy('sort_order')->get()
            ->filter(fn ($c) => $c->mentions->isNotEmpty())
            ->map(fn ($c) => ['key' => 'k' . $c->id, 'label' => $c->name, 'items' => $c->mentions->take(6)->map(fn ($m) => [
                'title' => $m->title, 'text' => Str::limit(trim(strip_tags((string) ($m->subtitle ?: $m->description))), 110), 'tag' => $m->badge_text,
                'url' => $m->url ?: null, 'icon' => self::skillIcon($m->title)])->values()->all()])->values()->all();

        // ---- scholarships featured on the homepage, with level / category tags for the two filters
        $scholarships = \App\Models\Scholarship::where('featured_on_homepage', 1)->where('status', 1)->orderBy('sort_order')->orderByDesc('id')->get()
            ->map(function ($s) {
                $e = DB::table('scholarship_eligibilities')->where('scholarship_id', $s->id)->first();
                $text = Str::lower(implode(' ', [$s->category, $s->scholarship_type, $s->title, $e->course_level ?? '', $e->category ?? '', $e->gender ?? '']));
                $levels = array_keys(array_filter([
                    'School' => Str::contains($text, ['school', 'class ', 'class 9', 'class 10', 'class 11', 'navodaya', 'nmms', 'means-cum-merit']),
                    'UG' => Str::contains($text, ['undergrad', 'ug ', 'graduat', 'higher education', 'degree', 'college']),
                    'PG' => Str::contains($text, ['postgrad', 'pg ', '(pg)', 'master', 'research', 'phd']),
                ]));
                $cats = array_keys(array_filter([
                    'Merit' => Str::contains($text, 'merit'),
                    'Girls' => Str::contains($text, ['girl', 'female', 'women']),
                    'SC / ST / OBC' => Str::contains($text, ['sc ', 'sc/', 'scheduled', 'obc', 'st ', 'ebc', 'dnt', '(sc)', '(st)']),
                    'Minority' => Str::contains($text, 'minority'),
                    'Income-based' => Str::contains($text, ['income', 'low income', 'economically', 'means']),
                ]));
                return ['name' => $s->display_title ?: $s->title, 'by' => $s->provider_name, 'amount' => (float) $s->max_amount > 0 ? \App\Support\University\UniversityData::inr($s->max_amount) : null,
                    'per' => trim((string) $s->amount_suffix) ?: null, 'levels' => $levels, 'cats' => $cats,
                    'type' => $s->scholarship_type ? trim(explode(',', $s->scholarship_type)[0]) : null, 'url' => route('scholarship.detail', $s->slug ?: $s->id)];
            })->values();
        $schLevels = collect(['School', 'UG', 'PG'])->filter(fn ($l) => $scholarships->contains(fn ($s) => in_array($l, $s['levels'], true)))->values()->all();
        $schCats = collect(['Merit', 'Girls', 'SC / ST / OBC', 'Minority', 'Income-based'])->filter(fn ($c) => $scholarships->contains(fn ($s) => in_array($c, $s['cats'], true)))->values()->all();

        // ---- boarding schools and coaching institutes, by board / by nothing (no type data yet)
        $inst = function (Organisation $o, string $route) use ($file, $initials, $json) {
            $c = DB::table('campuses')->where('organisation_id', $o->id)->whereNull('deleted_at')->orderBy('sort_order')->first(['city', 'state', 'target_classes']);
            $classes = collect($json($c->target_classes ?? null))->map(fn ($x) => (int) preg_replace('/\D/', '', $x))->filter();
            return ['name' => $o->name, 'logo' => $file($o->logo_url), 'initials' => $initials($o->short_name ?: $o->name),
                'place' => implode(', ', array_filter([trim((string) ($c->city ?? '')), trim((string) ($c->state ?? ''))])) ?: Str::limit((string) $o->head_office_location, 40),
                'boards' => array_values(array_filter($json($o->education_boards_supported))), 'classes' => $classes->isNotEmpty() ? 'Class ' . $classes->min() . '–' . $classes->max() : null,
                'url' => route($route, $o->slug ?: $o->id)];
        };
        $schools = Organisation::where('organisation_type_id', 4)->where('status', 1)->orderBy('sort_order')->orderBy('name')->get();
        $boardTabs = collect(['CBSE', 'ICSE', 'IB', 'IGCSE', 'State Board'])->mapWithKeys(fn ($b) => [$b => $schools->filter(fn ($s) => in_array($b, $json($s->education_boards_supported), true))])
            ->filter(fn ($l) => $l->count() >= 2);
        $boarding = $schools->isEmpty() ? [] : collect(['all' => ['label' => 'All', 'items' => $schools->take(4), 'more' => route('all-schools')]])
            ->merge($boardTabs->map(fn ($l, $b) => ['label' => $b, 'items' => $l->take(4), 'more' => route('all-schools', ['board' => $b])]))
            ->map(fn ($t) => ['label' => $t['label'], 'more' => $t['more'], 'items' => $t['items']->map(fn ($o) => $inst($o, 'school.detail'))->values()->all()])->all();
        $coaching = Organisation::where('organisation_type_id', 3)->where('status', 1)->orderBy('sort_order')->orderBy('name')->take(4)->get()->map(fn ($o) => $inst($o, 'coaching.detail'))->all();

        // ---- experts (featured first)
        $experts = DB::table('experts')->where(fn ($q) => $q->where('status', 'Active')->orWhere('status', '1'))->orderByDesc('is_featured')->orderByDesc('id')->limit(max(1, $c['expert_carousel']['items']))->get()
            ->map(function ($x) use ($file, $initials) {
                $photo = $x->profile_photo_url && Str::startsWith($x->profile_photo_url, 'http') ? $x->profile_photo_url : $file($x->img);
                $tags = collect([$x->expert_category_id ? DB::table('expert_categories')->where('id', $x->expert_category_id)->value('name') : null])
                    ->merge(collect([$x->counseling_specialization, $x->subject_specialization])->flatMap(fn ($v) => is_array(json_decode((string) $v, true)) ? json_decode((string) $v, true) : explode(',', (string) $v)))
                    ->map(fn ($t) => is_string($t) ? trim($t) : null)->filter()->unique()->take(3)->values()->all();
                return ['name' => $x->name, 'role' => $x->designation ?: 'Education expert', 'photo' => $photo, 'initials' => $initials($x->name), 'tags' => $tags,
                    'years' => (int) ($x->years_of_experience_total ?: $x->exp) ?: null, 'rating' => (float) $x->rating > 0 ? round((float) $x->rating, 1) : null,
                    'reviews' => (int) $x->total_reviews ?: null, 'price' => (float) $x->price_per_min > 0 ? (float) $x->price_per_min : null, 'url' => route('expert.detail', $x->id)];
            })->all();

        // ---- trust: student feedback and honest counts (hidden below 50)
        $reviews = DB::table('testimonials')->orderByDesc('id')->limit(3)->get()
            ->map(fn ($t) => ['name' => $t->name, 'role' => $t->role, 'text' => Str::limit(trim(strip_tags((string) $t->content)), 260), 'rating' => (int) $t->rating])->all();
        $counts = collect([
            ['Universities', Organisation::where('organisation_type_id', 1)->where('status', 1)->count(), route('university')],
            ['Schools', $schools->count(), route('all-schools')],
            ['Scholarships', \App\Models\Scholarship::where('status', 1)->count(), route('scholarships')],
            ['Coaching institutes', Organisation::where('organisation_type_id', 3)->where('status', 1)->count(), route('all.coaching')],
            ['Courses', DB::table('courses')->count(), route('courses.index')],
        ])->filter(fn ($c) => $c[1] >= 50)->take(3)->map(fn ($c) => ['label' => $c[0], 'n' => $c[1], 'url' => $c[2]])->values()->all();

        $blogs = \App\Models\Blog::with('category')->whereNotNull('published_at')->orderByDesc('published_at')->take(max(1, $c['blogs']['items']))->get()
            ->map(fn ($b) => ['title' => $b->title, 'cat' => $b->category->name ?? null, 'img' => $file($b->image), 'url' => route('blog.detail', $b->slug)])->all();
        $faqs = DB::table('faqs')->orderBy('sort_order')->limit(max(1, $c['faq']['items']))->get(['question', 'answer'])->map(fn ($f) => ['q' => $f->question, 'a' => trim(strip_tags((string) $f->answer))])->all();

        return [
            'streams' => $streams,
            'popularCourses' => $popularCourses,
            'universities' => $unis->sortBy('name')->map(fn ($u) => ['slug' => $u->slug, 'name' => $u->name])->values()->all(),
            'online' => $online, 'onlineUnis' => $onlineUnis,
            'skills' => $skills,
            'scholarships' => $scholarships->take(9)->all(), 'schLevels' => $schLevels, 'schCats' => $schCats, 'schTotal' => \App\Models\Scholarship::where('status', 1)->count(),
            'boarding' => $boarding, 'coaching' => $coaching,
            'experts' => $experts, 'reviews' => $reviews, 'counts' => $counts, 'blogs' => $blogs, 'faqs' => $faqs,
        ];
    }

    /** Admin "Homepage SEO" (seo_homepage): title, description, keywords, canonical, robots and social tags, when filled in. */
    private static function seo(): array
    {
        $r = rescue(fn () => DB::table('seo_homepage')->first(), null, false);
        if (!$r) return [];
        $img = fn ($p) => $p ? (Str::startsWith($p, 'http') ? $p : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($p, '/')) : null;
        $kw = array_filter(array_merge([$r->focus_keyword], is_array($k = json_decode((string) $r->secondary_keywords, true)) ? $k : []));
        return array_filter([
            'title' => $r->meta_title, 'description' => $r->meta_description, 'keywords' => $kw ? implode(', ', $kw) : null,
            'canonical' => $r->canonical_url, 'robots' => $r->allow_index === 0 || $r->allow_index === '0' ? 'noindex' : ($r->robots ?: null),
            'og_title' => $r->og_title ?: $r->meta_title, 'og_description' => $r->og_description ?: $r->meta_description, 'og_image' => $img($r->og_image),
            'twitter_title' => $r->twitter_title, 'twitter_description' => $r->twitter_description, 'twitter_image' => $img($r->twitter_image),
            'schema' => $r->custom_schema_json,
        ], fn ($v) => $v !== null && $v !== '');
    }

    // ------------------------------------------------------------------ icons (inline SVG paths, 24x24, stroke)

    public static function streamIcon(string $key): string
    {
        $k = Str::lower($key);
        return match (true) {
            Str::contains($k, ['medic', 'nurs', 'health']) => '<path d="M10 3h4v7h7v4h-7v7h-4v-7H3v-4h7z"/>',
            Str::contains($k, ['engineer', 'tech']) && !Str::contains($k, 'information') => '<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M4.2 4.2l2.1 2.1M17.7 17.7l2.1 2.1M2 12h3M19 12h3M4.2 19.8l2.1-2.1M17.7 6.3l2.1-2.1"/>',
            Str::contains($k, ['manag', 'mba', 'business', 'commerce']) => '<path d="M4 20V10M10 20V4M16 20v-8M22 20H2"/>',
            Str::contains($k, 'law') => '<path d="M12 3v18M5 7h14M5 7l-3 7a4 4 0 006 0zM19 7l-3 7a4 4 0 006 0zM8 21h8"/>',
            Str::contains($k, ['it', 'information', 'computer']) => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M8 20h8M10 9l-2 2 2 2M14 9l2 2-2 2"/>',
            Str::contains($k, ['pharm']) => '<rect x="3" y="9" width="18" height="6" rx="3" transform="rotate(-45 12 12)"/><path d="M9.2 9.2l5.6 5.6"/>',
            Str::contains($k, ['design', 'arts', 'human']) => '<path d="M12 3a9 9 0 100 18c1 0 1.5-.8 1.5-1.6 0-1.4 1.2-2.4 2.6-2.4H18a3 3 0 003-3c0-6-4-11-9-11z"/><circle cx="7.5" cy="11" r="1"/><circle cx="10" cy="7" r="1"/><circle cx="15" cy="7.5" r="1"/>',
            Str::contains($k, ['agri']) => '<path d="M12 21V11M12 11c0-4 3-7 8-7 0 5-3 8-8 7zM12 14c0-3-2-6-7-6 0 4 2 7 7 6z"/>',
            Str::contains($k, ['hotel', 'hospitality']) => '<path d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-5h6v5"/>',
            Str::contains($k, ['science']) => '<path d="M9 3h6M10 3v6l-5 9a2 2 0 002 3h10a2 2 0 002-3l-5-9V3"/>',
            default => '<path d="M3 9l9-5 9 5-9 5z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/>',
        };
    }

    private static function skillIcon(string $title): string
    {
        $k = Str::lower($title);
        return match (true) {
            Str::contains($k, ['ai', 'artificial', 'machine']) => '<path d="M12 3v3M12 18v3M3 12h3M18 12h3M6 6l2 2M16 16l2 2M6 18l2-2M16 8l2-2"/><circle cx="12" cy="12" r="4"/>',
            Str::contains($k, ['data', 'analytic']) => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
            Str::contains($k, ['cyber', 'secur', 'hack']) => '<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/>',
            Str::contains($k, ['cloud', 'devops']) => '<path d="M7 18a5 5 0 010-10 6 6 0 0111.5 2A4 4 0 0118 18z"/>',
            Str::contains($k, ['market', 'seo', 'social']) => '<path d="M3 11v2a1 1 0 001 1h2l5 4V6L6 10H4a1 1 0 00-1 1zM16 8a5 5 0 010 8"/>',
            Str::contains($k, ['python', 'code', 'program', 'develop', 'software', 'web']) => '<path d="M8 8l-4 4 4 4M16 8l4 4-4 4M14 5l-4 14"/>',
            Str::contains($k, ['finance', 'account', 'bank']) => '<rect x="3" y="6" width="18" height="12" rx="2"/><circle cx="12" cy="12" r="2.5"/>',
            Str::contains($k, ['design', 'ui', 'ux']) => '<path d="M12 3a9 9 0 100 18c1 0 1.5-.8 1.5-1.6 0-1.4 1.2-2.4 2.6-2.4H18a3 3 0 003-3c0-6-4-11-9-11z"/>',
            default => '<path d="M3 9l9-5 9 5-9 5z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/>',
        };
    }
}
