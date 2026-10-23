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
        $db = Cache::remember('home-page:v5:' . HomeContent::stamp(), 600, fn () => self::fromDatabase($c));
        $now = in_array('happening_now', $content['order'], true) || $c['hero_banner']['show_live'] ? self::happeningNow($c['happening_now']) : [];
        return $db + ['now' => $now, 'live' => $c['hero_banner']['show_live'] ? self::heroCards($c['hero_banner']['live_cards'], $now) : [], 'order' => $content['order'], 'c' => $c, 'seo' => self::seo()];
    }

    /**
     * The hero's "open right now" cards (up to 3), as the admin set them: each card is automatic (an exam, a counselling
     * round, a scholarship, or anything) or the admin's own text. An automatic card takes what is open now, else the next
     * one opening; when its kind has nothing it falls back to its own text, else to the next item of any kind.
     * No cards set = exam, counselling, scholarship.
     */
    private static function heroCards(array $slots, array $now): array
    {
        $slots = collect($slots)->filter(fn ($s) => is_array($s))->take(3)->values();
        if ($slots->isEmpty()) $slots = collect([['source' => 'exams'], ['source' => 'coun'], ['source' => 'sch']]);
        $all = ['exams', 'coun', 'sch'];
        $used = [];
        $take = function (array $kinds) use ($now, &$used) {
            foreach (['open', 'upcoming'] as $state) {
                foreach ($kinds as $k) {
                    foreach ($now[$k]['rows'] ?? [] as $r) {
                        if ($r['state'] === $state && !in_array($r['url'], $used, true)) { $used[] = $r['url']; return $r + ['kind' => $k]; }
                    }
                }
            }
            return null;
        };
        $own = fn ($s) => trim((string) ($s['title'] ?? '')) === '' ? null
            : ['name' => trim($s['title']), 'step' => trim((string) ($s['pill'] ?? '')), 'when' => trim((string) ($s['text'] ?? '')), 'url' => HomeContent::url($s['url'] ?? null) ?? '#', 'state' => 'open', 'kind' => 'custom'];

        // own cards and cards of one kind first, so "whatever is open" and fallbacks never take what a later card is for
        $cards = $slots->map(function ($s) use ($take, $own) {
            $src = $s['source'] ?? 'any';
            if ($src === 'custom') return $own($s);
            return in_array($src, ['exams', 'coun', 'sch'], true) ? ($take([$src]) ?? $own($s)) : null;
        })->all();
        foreach ($slots as $i => $s) {
            if ($cards[$i] === null && ($s['source'] ?? 'any') !== 'custom') $cards[$i] = $take($all);
        }
        return array_values(array_filter($cards));
    }

    // ------------------------------------------------------------------ live: exams, counselling, scholarship deadlines

    private static function happeningNow(array $cfg): array
    {
        $tabs = [];
        $max = max(1, (int) $cfg['rows']);
        try {
            $exams = collect((Api::get('exams', ['per_page' => 100, 'sort' => 'featured']) ?? [])['data'] ?? []);
            $rows = $exams->map(function ($e) {
                // registration first (open, then coming); once it has closed, the exam date, then the result (as in the design:
                // "Closes 7 Mar 2027", "Opens Feb 2027", "Closed · exam 7 Dec"). [state, hero label, short date text, date, precision, pill]
                $st = $e['status'] ?? [];
                $is = fn ($k, ...$states) => in_array($st[$k]['state'] ?? null, $states, true);
                $reg = $e['key_dates']['registration'] ?? null;
                $ex = $e['key_dates']['exam'] ?? null;
                $res = $e['key_dates']['result'] ?? null;
                if ($is('registration', 'open')) $r = ['open', 'Registration open', $reg && $reg['end'] ? 'Closes ' . self::short($reg['end']) : 'Open now', $reg['end'] ?? null, null, null];
                elseif ($is('registration', 'upcoming', 'expected') && $reg) $r = ['upcoming', 'Registration opens', 'Opens ' . self::short($reg['start'], $reg['precision']), $reg['start'], $reg['precision'], null];
                elseif ($is('exam-date', 'open')) $r = ['open', 'Exam on', $ex && $ex['end'] ? 'Exam until ' . self::short($ex['end']) : 'Exam today', $ex['end'] ?? null, null, 'Exam on'];
                // "Closed" only when registration really closed; dates not announced yet just show the exam / result date
                elseif ($is('exam-date', 'upcoming', 'expected') && $ex) $r = $is('registration', 'closed')
                    ? ['closed', 'Exam coming up', 'Closed · exam ' . self::short($ex['start'], $ex['precision']), $ex['start'], $ex['precision'], null]
                    : ['upcoming', 'Exam coming up', 'Exam ' . self::short($ex['start'], $ex['precision']), $ex['start'], $ex['precision'], null];
                elseif ($is('result', 'upcoming', 'expected') && $res) $r = [$is('registration', 'closed') ? 'closed' : 'upcoming', 'Result awaited',
                    ($is('registration', 'closed') ? 'Closed · result ' : 'Result ') . self::short($res['start'], $res['precision']), $res['start'], $res['precision'], null];
                elseif ($is('result', 'declared') && $ex && ($ex['end'] ?? $ex['start']) >= now()->subDays(45)->toDateString()) $r = ['open', 'Result out', 'Result declared', $res['start'] ?? null, null, 'Result out'];
                else return null;
                $name = $e['short_name'] ?: $e['name'];
                $year = $e['cycle']['year'] ?? null;
                if ($year && !str_contains($name, (string) $year)) $name .= ' ' . $year;
                if (!empty($e['cycle']['session_label'])) $name .= ' · ' . $e['cycle']['session_label'];
                return ['name' => $name, 'meta' => implode(' · ', array_filter([$e['type_label'] ?? null, $e['categories'][0] ?? null])),
                    'state' => $r[0], 'step' => $r[1], 'when' => $r[2], 'date' => $r[3], 'precision' => $r[4], 'pill' => $r[5], 'url' => $e['url'] ?? route('exam.detail', $e['slug'])];
            })->filter();
            $tabs['exams'] = ['label' => $cfg['exams_label'], 'all' => route('top-exams'), 'rows' => self::order($rows, $max), 'empty' => 'No exam registrations open right now.'];

            $couns = collect((Api::get('counselling', ['per_page' => 100]) ?? [])['data'] ?? []);
            $rows = $couns->map(function ($c) {
                $n = $c['now'] ?? [];
                if (!in_array($n['state'] ?? null, ['open', 'upcoming', 'declared'], true)) return null;
                return ['name' => $c['name'], 'meta' => implode(' · ', array_filter([$c['level'] === 'state' ? 'State' : 'National', $n['step'] ?? null])),
                    'step' => $n['step'] ?? null, 'state' => $n['state'] === 'declared' ? 'open' : $n['state'], 'pill' => $n['state'] === 'declared' ? 'Result out' : null,
                    'when' => self::shortWhen($n['when'] ?? null), 'date' => self::dateIn($n['when'] ?? null), 'precision' => null, 'url' => $c['url'] ?? route('counselling.index')];
            })->filter();
            $tabs['coun'] = ['label' => $cfg['coun_label'], 'all' => route('counselling.index'), 'rows' => self::order($rows, $max), 'empty' => 'No counselling round open right now.'];
        } catch (ApiUnavailable $e) {
            // the API is not reachable: the board shows scholarships only, or hides
        }

        $today = now()->toDateString();
        // "live" as on the scholarships page: active and the application window not over (no end date = open, no deadline).
        // Deadlines first (soonest), then open without a deadline (homepage-featured, featured, admin order), then not open yet.
        $rows = DB::table('scholarships as s')->leftJoin('scholarship_dates as d', 'd.scholarship_id', '=', 's.id')
            ->where('s.status', 1)->whereNull('s.deleted_at')
            ->where(fn ($q) => $q->whereNull('d.application_end_date')->orWhere('d.application_end_date', '>=', $today))
            ->orderByRaw('case when d.application_start_date > ? then 2 when d.application_end_date is not null then 0 else 1 end', [$today])
            ->orderBy('d.application_end_date')->orderBy('d.application_start_date')
            ->orderByDesc('s.featured_on_homepage')->orderByDesc('s.featured')->orderBy('s.sort_order')->orderByDesc('s.id')
            ->limit($max)->get(['s.id', 's.slug', 's.title', 's.provider_name', 'd.application_start_date', 'd.application_end_date'])
            ->map(function ($r) use ($today) {
                $open = !$r->application_start_date || $r->application_start_date <= $today;
                $date = $open ? $r->application_end_date : $r->application_start_date;
                return ['name' => $r->title, 'meta' => (string) $r->provider_name, 'step' => $open ? 'Applications open' : 'Applications open soon', 'state' => $open ? 'open' : 'upcoming',
                    'when' => $date ? ($open ? 'Apply by ' : 'Opens ') . self::short($date) : 'No closing date yet',
                    'date' => $date ? \Carbon\Carbon::parse($date)->toDateString() : null, 'precision' => null, 'pill' => null,
                    'url' => route('scholarship.detail', $r->slug ?: $r->id)];
            });
        $tabs['sch'] = ['label' => $cfg['sch_label'], 'all' => route('scholarships'), 'rows' => self::order($rows, $max), 'empty' => 'No scholarship open right now.'];

        // the three tabs always show (an empty one says so), unless nothing at all is open or coming
        return collect($tabs)->contains(fn ($t) => $t['rows']) ? $tabs : [];
    }

    /** Open, then upcoming, then closed (registration over, exam ahead); soonest first. The calendar tile shows the row's date. */
    private static function order(Collection $rows, int $max): array
    {
        return $rows->sortBy(fn ($r) => [['open' => 0, 'upcoming' => 1][$r['state']] ?? 2, $r['date'] ?: '9999'])->take($max)->map(function ($r) {
            $d = $r['date'] ? rescue(fn () => \Carbon\Carbon::parse($r['date']), null, false) : null;
            $r['mo'] = $d ? strtoupper($d->format('M')) : null;
            $r['dy'] = $d && $r['precision'] !== 'month_only' ? $d->day : null;
            return $r;
        })->values()->all();
    }

    /** "31 Oct" this year, "7 Mar 2027" otherwise; "Feb 2027" when only the month is known. */
    private static function short(?string $date, ?string $precision = null): string
    {
        $d = $date ? rescue(fn () => \Carbon\Carbon::parse($date), null, false) : null;
        if (!$d) return 'soon';
        if ($precision === 'month_only') return $d->format('M Y');
        return $d->format($d->year === now()->year ? 'j M' : 'j M Y');
    }

    /** The counselling API's step text, shortened like the design: "Open, closes 30 Oct 2026" -> "Closes 30 Oct". */
    private static function shortWhen(?string $t): string
    {
        $t = trim((string) $t);
        if (preg_match('/^Open, closes (.+)$/i', $t, $m)) return 'Closes ' . self::short(self::dateIn($m[1]) ?? $m[1]);
        if (preg_match('/^Starts on (.+)$/i', $t, $m)) return 'Opens ' . self::short(self::dateIn($m[1]) ?? $m[1]);
        if ($t === 'Open today') return 'Closes today';
        return $t;
    }

    /** The first "30 Oct 2026" style date in a text, as Y-m-d. */
    private static function dateIn(?string $t): ?string
    {
        if (!preg_match('/\b(\d{1,2})\s+(' . implode('|', self::MONTHS) . ')[a-z]*\.?\s*(\d{4})?/i', (string) $t, $m)) return null;
        return rescue(fn () => \Carbon\Carbon::parse($m[1] . ' ' . $m[2] . ' ' . ($m[3] ?? now()->year))->toDateString(), null, false);
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

        // ---- boarding schools and coaching institutes
        $inst = function (Organisation $o, string $route, array $types = []) use ($file, $initials, $json) {
            $c = DB::table('campuses')->where('organisation_id', $o->id)->whereNull('deleted_at')->orderBy('sort_order')->first(['city', 'state', 'target_classes']);
            $classes = collect($json($c->target_classes ?? null))->map(fn ($x) => (int) preg_replace('/\D/', '', $x))->filter();
            return ['name' => $o->name, 'logo' => $file($o->logo_url), 'initials' => $initials($o->short_name ?: $o->name),
                'place' => implode(', ', array_filter([trim((string) ($c->city ?? '')), trim((string) ($c->state ?? ''))])) ?: Str::limit((string) $o->head_office_location, 40),
                'boards' => array_values(array_filter($json($o->education_boards_supported))), 'classes' => $classes->isNotEmpty() ? 'Class ' . $classes->min() . '–' . $classes->max() : null,
                'types' => $types, 'url' => route($route, $o->slug ?: $o->id)];
        };
        // tabs by type of boarding (design: Fully / Day / Weekly / Girls / Boys / Co-ed boarding) from the CRM's school types
        // (Campus Types; a school's campuses list them). Matched by title, so the ids may differ between databases.
        $schools = Organisation::where('organisation_type_id', 4)->where('status', 1)->orderBy('sort_order')->orderBy('name')->get();
        $typeTitles = DB::table('campus_type_news')->where('status', 1)->pluck('title', 'id');
        $tabType = collect(['full' => ['Fully boarding', '/fully\s*boarding/i'], 'day' => ['Day boarding', '/^day\s*boarding/i'], 'weekly' => ['Weekly boarding', '/weekly/i'],
                'girls' => ['Girls boarding', '/girl.*boarding/i'], 'boys' => ['Boys boarding', '/boy.*boarding/i'], 'coed' => ['Co-ed boarding', '/co-?ed.*boarding/i']])
            ->map(fn ($d) => ['label' => $d[0], 'id' => $typeTitles->search(fn ($t) => preg_match($d[1], (string) $t))])->filter(fn ($d) => $d['id']);
        $schoolTypes = DB::table('campuses')->whereIn('organisation_id', $schools->pluck('id'))->whereNull('deleted_at')->get(['organisation_id', 'campus_type_new_id'])
            ->groupBy('organisation_id')->map(fn ($g) => $g->flatMap(fn ($c) => array_map('intval', (array) $json($c->campus_type_new_id)))->unique()->all());
        $typesOf = fn ($o) => $tabType->filter(fn ($d) => in_array((int) $d['id'], $schoolTypes[$o->id] ?? [], true))->pluck('label')->take(3)->values()->all();
        $boardingIds = $tabType->pluck('id')->map(fn ($id) => (int) $id)->values()->all();
        $anyBoarding = $schools->filter(fn ($o) => array_intersect($boardingIds, $schoolTypes[$o->id] ?? []));
        $tabs = collect(['all' => ['label' => 'All', 'list' => $anyBoarding->isNotEmpty() ? $anyBoarding : $schools,
                'more' => $boardingIds ? route('all-schools', ['campus_type' => $boardingIds]) : route('all-schools')]])
            ->merge($tabType->map(fn ($d) => ['label' => $d['label'], 'list' => $schools->filter(fn ($o) => in_array((int) $d['id'], $schoolTypes[$o->id] ?? [], true)),
                'more' => route('all-schools', ['campus_type' => [(int) $d['id']]])])->filter(fn ($t) => $t['list']->isNotEmpty()));
        $boarding = $schools->isEmpty() ? [] : $tabs->map(fn ($t) => ['label' => $t['label'], 'more' => $t['more'],
            'items' => $t['list']->take(4)->map(fn ($o) => $inst($o, 'school.detail', $typesOf($o)))->values()->all()])->all();
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
