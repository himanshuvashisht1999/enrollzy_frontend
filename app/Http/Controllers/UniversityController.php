<?php

namespace App\Http\Controllers;

use App\Support\ApiUnavailable;
use App\Support\EnrollzyApi as Api;
use App\Support\University\UniLinks;
use App\Support\University\UniversityData;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * University pages (client design "University page v2"): one university hub with child pages that share a sticky
 * university bar and a page-wide campus choice (?campus=slug):
 *   /university-detail/{slug}                       overview (every section summarised)
 *   /university-detail/{slug}/courses               courses and fees, filterable
 *   /university-detail/{slug}/courses/{course}      one programme across its campuses
 *   /university-detail/{slug}/campuses/{campus?}    campus finder + one campus
 *   /university-detail/{slug}/online                online programmes
 *   /university-detail/{slug}/compare               compare offerings (course x campus), any university
 */
class UniversityController extends Controller
{
    /** Sections of the overview that can use their own campus (multi = several campuses side by side). */
    public const SECTIONS = [
        'courses' => ['multi' => true, 'label' => 'Fees per year'],
        'placement' => ['multi' => true, 'label' => 'Placement record'],
        'admission' => ['multi' => false, 'label' => 'Admission is campus-wise'],
        'depts' => ['multi' => false, 'label' => 'Faculty, research and labs'],
        'reviews' => ['multi' => false, 'label' => 'Student ratings'],
        'contact' => ['multi' => false, 'label' => 'Admissions office'],
    ];

    // ------------------------------------------------------------------ pages

    public function overview(Request $request, string $slug)
    {
        $ctx = $this->context($request, $slug);
        $u = $ctx['u'];

        // each section: its own campus choice (?sc_courses=a,b / ?sc_admission=x / "all") or the page campus
        $sec = [];
        foreach (self::SECTIONS as $key => $cfg) {
            $raw = $request->query('sc_' . $key);
            if ($raw === 'all') {
                $ids = null;
                $own = (bool) $ctx['scope'];
            } elseif (is_string($raw) && $raw !== '') {
                $ids = collect(explode(',', $raw))->map(fn ($s) => $u->campusBySlug(trim($s))['id'] ?? null)->filter()->unique()->values()->all();
                if (!$cfg['multi']) $ids = array_slice($ids, 0, 1);
                $ids = $ids ?: ($ctx['scope'] ? [$ctx['scope']] : null);
                $own = $ids !== ($ctx['scope'] ? [$ctx['scope']] : null);
            } else {
                $ids = $ctx['scope'] ? [$ctx['scope']] : null;
                $own = false;
            }
            $sec[$key] = ['ids' => $ids, 'own' => $own, 'scope_label' => $ids ? (count($ids) === 1 ? $u->campus($ids[0])['name'] : count($ids) . ' campuses') : 'All campuses'] + $cfg;
        }

        $scoped = $u->onCampus($ctx['scopeIds']);
        $programmes = $u->programmes($scoped);
        $courseProgrammes = $u->programmes($u->onCampus($sec['courses']['ids']));

        // admission: course + campus picker for the exact procedure
        $admCampus = $sec['admission']['ids'] ? $u->campus($sec['admission']['ids'][0]) : null;
        $admCourse = $request->query('adm_course');
        $admOptions = $u->programmes($admCampus ? $u->onCampus([$admCampus['id']]) : $u->onCampus())->sortBy('name')->values();
        if ($admCourse && !$admOptions->contains('slug', $admCourse)) $admCourse = null;
        $admOffering = $admCampus && $admCourse ? $u->onCampus([$admCampus['id']])->firstWhere('slug', $admCourse) : null;
        $admCampusOptions = $admCourse ? $u->campuses->filter(fn ($c) => $u->onCampus([$c['id']])->contains('slug', $admCourse)) : $u->campuses;

        $placementIds = $sec['placement']['ids'];
        $placement = !$placementIds ? $u->universityPlacement() : (count($placementIds) === 1 ? $u->campusPlacement($placementIds[0]) : null);
        $placementRows = $placementIds && count($placementIds) > 1
            ? collect($placementIds)->map(fn ($id) => ['campus' => $u->campus($id), 'p' => $u->campusPlacement($id)])->filter(fn ($r) => $r['p'])->values() : collect();

        $deptCampus = $sec['depts']['ids'][0] ?? null;
        $departments = $u->departmentsFor($deptCampus);
        $reviews = $u->reviews($sec['reviews']['ids']);
        $contactCampus = $sec['contact']['ids'] ? $u->campus($sec['contact']['ids'][0]) : null;
        $cutoffs = $this->cutoffs($u);
        $topCampuses = $u->campuses->sortByDesc(fn ($c) => ($c['main'] ? 1e9 : 0) + ($c['students'] ?? 0) + $u->onCampus([$c['id']])->count())->take(6)->values();
        $exams = $u->onCampus()->flatMap(fn ($o) => collect($o['exams'])->map(fn ($e) => $e + ['course' => $o['name']]))->groupBy('slug')
            ->map(fn ($g) => ['name' => $g->first()['name'], 'slug' => $g->first()['slug'], 'n' => $g->pluck('course')->unique()->count()])->sortByDesc('n')->take(6)->values();

        return view('university.overview', $ctx + compact('sec', 'programmes', 'courseProgrammes', 'admCampus', 'admCourse', 'admOptions', 'admOffering', 'admCampusOptions',
            'placement', 'placementRows', 'departments', 'deptCampus', 'reviews', 'contactCampus', 'cutoffs', 'topCampuses', 'exams') + ['tab' => 'overview']);
    }

    public function courses(Request $request, string $slug)
    {
        $ctx = $this->context($request, $slug);
        $u = $ctx['u'];
        $f = [
            'q' => mb_substr(trim((string) $request->query('q', '')), 0, 80),
            'mode' => in_array($request->query('mode'), ['campus', 'online'], true) ? $request->query('mode') : 'all',
            'level' => (string) $request->query('level', ''),
            'stream' => (string) $request->query('stream', ''),
            'fee' => in_array($request->query('fee'), ['100000', '150000', '250000', '500000'], true) ? (int) $request->query('fee') : null,
            'sort' => in_array($request->query('sort'), ['fee', 'name'], true) ? $request->query('sort') : 'pop',
            'shown' => max(24, min(600, (int) $request->query('shown', 24))),
        ];

        $items = collect();
        if ($f['mode'] !== 'online') {
            foreach ($u->programmes($u->onCampus($ctx['scopeIds'])) as $p) $items->push(['kind' => 'campus', 'p' => $p, 'fee' => $p['fee_min']]);
        }
        if ($f['mode'] !== 'campus') {
            foreach ($u->online() as $o) $items->push(['kind' => 'online', 'p' => $o, 'fee' => $o['annual_fee']]);
        }
        $all = $items;
        $q = mb_strtolower($f['q']);
        $items = $items->filter(fn ($it) => (!$f['level'] || $it['p']['level'] === $f['level']) && (!$f['stream'] || $it['p']['stream'] === $f['stream'])
            && (!$f['fee'] || ($it['fee'] && $it['fee'] <= $f['fee'])) && (!$q || str_contains(mb_strtolower($it['p']['name']), $q)));
        $items = match ($f['sort']) {
            'fee' => $items->sortBy(fn ($it) => $it['fee'] ?: PHP_INT_MAX),
            'name' => $items->sortBy(fn ($it) => mb_strtolower($it['p']['name'])),
            default => $items->sortBy(fn ($it) => [-($it['p']['n'] ?? 0), $it['kind'] === 'online' ? 1 : 0, mb_strtolower($it['p']['name'])]),
        };
        $levels = $all->pluck('p.level')->filter()->unique()->sort()->values();
        $streams = $all->pluck('p.stream')->filter()->unique()->sort()->values();

        return view('university.courses', $ctx + ['items' => $items->values(), 'f' => $f, 'levels' => $levels, 'streams' => $streams, 'tab' => 'courses']);
    }

    public function course(Request $request, string $slug, string $course)
    {
        $ctx = $this->context($request, $slug);
        $u = $ctx['u'];
        $prog = $u->programmeBySlug($course) ?? abort(404);
        $offerings = $prog['campus']->map(fn ($o) => $o + ['campus' => $u->campus($o['campus_id'])])->values();
        $sel = $ctx['scope'] ? $offerings->firstWhere('campus_id', $ctx['scope']) : null;
        $ref = $sel ?? $offerings->filter(fn ($o) => $o['annual_fee'])->sortBy('annual_fee')->first() ?? $offerings->first() ?? $prog['online'];

        $placements = $offerings->map(fn ($o) => ['o' => $o, 'p' => $u->offeringPlacement($o)])->filter(fn ($r) => $r['p'])->values();
        $placementYears = $ref ? ($u->placementYears('course', $ref['id']) ?: ($ref['department_id'] ? collect($u->placementYears('department', $ref['department_id']))->where('scope', 'department')->values()->all() : [])) : [];
        $cutoffs = collect($this->cutoffs($u))->where('course_id', $prog['course_id'])->values();
        $dept = $ref && $ref['department_id'] ? $u->departments->get($ref['department_id']) : null;
        $reviews = $sel ? $u->reviews(null, (string) $sel['id']) : $u->reviews();

        return view('university.course', $ctx + compact('prog', 'offerings', 'sel', 'ref', 'placements', 'placementYears', 'cutoffs', 'dept', 'reviews') + ['tab' => 'courses']);
    }

    public function campus(Request $request, string $slug, ?string $campusSlug = null)
    {
        $u = UniversityData::load($slug) ?? abort(404);
        $c = $campusSlug ? ($u->campusBySlug($campusSlug) ?? abort(404)) : $u->mainCampus();
        abort_unless($c, 404);
        // the campus page sets the page-wide campus
        $request->query->set('campus', $c['slug']);
        $ctx = $this->context($request, $slug);
        $courses = $u->programmes($u->onCampus([$c['id']]))->sortBy('name')->values();
        $placements = $u->onCampus([$c['id']])->map(fn ($o) => ['o' => $o, 'p' => $u->offeringPlacement($o)])->filter(fn ($r) => $r['p'])->unique(fn ($r) => $r['o']['course_id'])->values();
        $campusPlacement = $u->campusPlacement($c['id']);
        $reviews = $u->reviews([$c['id']]);

        return view('university.campus', $ctx + compact('c', 'courses', 'placements', 'campusPlacement', 'reviews') + ['tab' => 'campus']);
    }

    public function online(Request $request, string $slug)
    {
        $ctx = $this->context($request, $slug);
        $u = $ctx['u'];
        $rows = $u->online()->map(function ($o) use ($u) {
            $campus = $u->onCampus()->where('course_id', $o['course_id'])->filter(fn ($x) => $x['annual_fee'])->sortBy('annual_fee')->first();
            $campusTotal = $campus ? ($campus['total_fee'] ?: ($campus['years'] ? $campus['annual_fee'] * $campus['years'] : null)) : null;
            return $o + ['campus_offering' => $campus, 'campus_total' => $campusTotal];
        })->values();

        return view('university.online', $ctx + compact('rows') + ['tab' => 'online']);
    }

    public function compare(Request $request, string $slug)
    {
        $ctx = $this->context($request, $slug);
        $u = $ctx['u'];
        $tab = in_array($request->query('tab'), ['same-course', 'custom'], true) ? $request->query('tab') : 'same-uni';
        $prog = $request->filled('course') ? $u->programmeBySlug((string) $request->query('course')) : null;
        $campusId = $ctx['scope'] ?? optional($u->mainCampus())['id'];
        $base = $prog ? ($prog['campus']->firstWhere('campus_id', $campusId) ?? $prog['campus']->first()) : null;
        $base ??= $u->programmes($u->onCampus([$campusId]))->sortByDesc('n')->first()['offerings'][0] ?? $u->onCampus()->first();

        $slots = [];
        if ($base && $tab === 'same-uni') {
            // the course and up to 3 related ones (same stream) at the same campus
            $related = $u->onCampus([$base['campus_id']])->where('stream', $base['stream'])->where('course_id', '!=', $base['course_id'])->unique('course_id')->take(3);
            $slots = collect([$base])->concat($related)->pluck('id')->all();
        } elseif ($base && $tab === 'same-course') {
            // the same course at up to 3 other active universities
            $others = DB::table('organisation_courses as oc')->join('organisations as o', 'o.id', '=', 'oc.organisation_id')
                ->where('oc.course_id', $base['course_id'])->where('o.id', '!=', $u->org['id'])->where('o.organisation_type_id', 1)->where('o.status', 1)
                ->whereNotNull('oc.campus_id')->whereIn('oc.status', [1, '1', 'Active', 'active'])->orderBy('o.sort_order')->orderBy('o.name')
                ->get(['oc.id', 'o.id as org_id'])->unique('org_id')->take(3)->pluck('id')->all();
            $slots = array_merge([$base['id']], $others);
        }
        $universities = DB::table('organisations')->where('organisation_type_id', 1)->where('status', 1)->orderBy('name')->get(['id', 'name', 'slug']);

        return view('university.compare', $ctx + compact('tab', 'slots', 'universities', 'base') + ['tab_name' => 'compare', 'tab' => 'compare', 'compareTab' => $tab]);
    }

    // ------------------------------------------------------------------ compare data (JSON)

    /** GET .../compare/data?ids=1,2 : one column per offering (any university). */
    public function compareData(Request $request)
    {
        $ids = collect(explode(',', (string) $request->query('ids')))->map(fn ($v) => (int) $v)->filter()->unique()->take(4)->values();
        $orgSlugs = DB::table('organisation_courses as oc')->join('organisations as o', 'o.id', '=', 'oc.organisation_id')
            ->whereIn('oc.id', $ids)->where('o.status', 1)->where('o.organisation_type_id', 1)->pluck('o.slug', 'oc.id');
        $cols = $ids->map(function ($id) use ($orgSlugs) {
            $slug = $orgSlugs[$id] ?? null;
            $u = $slug ? UniversityData::load($slug) : null;
            $o = $u ? $u->offerings->firstWhere('id', $id) : null;
            if (!$o) return ['id' => $id, 'missing' => true];
            $c = $u->campus($o['campus_id']);
            $p = $u->offeringPlacement($o);
            $nirf = collect($u->quality['rankings'])->firstWhere('category', 'Overall')['rank'] ?? null;
            $links = new UniLinks($u->org['slug'], $c['slug'] ?? null);
            return [
                'id' => $id, 'uni' => $u->org['name'], 'uni_slug' => $u->org['slug'], 'course' => $o['name'], 'course_id' => $o['course_id'],
                'campus' => $c ? $c['name'] : ($o['online'] ? 'Online' : null), 'city' => $c['city'] ?? null,
                'annual_fee' => $o['annual_fee'], 'total_fee' => $o['total_fee'], 'years' => $o['years'], 'exam' => collect($o['exams'])->pluck('name')->implode(' / ') ?: null,
                'seats' => $o['seats'], 'hostel' => $c ? ($c['hostel'] ? 'Yes' : 'No') : null, 'median' => $p['median'] ?? null, 'placed_pct' => $p['pct'] ?? null,
                'nirf' => $nirf ? (int) preg_replace('/\D.*/', '', ltrim($nirf, '#')) : null, 'online' => $u->online()->contains('course_id', $o['course_id']) ? 'Yes' : 'No',
                'url' => $links->course($o['slug']),
            ];
        })->values();
        return response()->json(['columns' => $cols]);
    }

    /** GET .../compare/options?uni=slug[&course=id] : a university's programmes, or the campuses offering one. */
    public function compareOptions(Request $request)
    {
        if ($request->filled('next_for')) {
            // "+ Add a column" on the same-course tab: the course at the next university not already shown
            $id = DB::table('organisation_courses as oc')->join('organisations as o', 'o.id', '=', 'oc.organisation_id')
                ->where('oc.course_id', (int) $request->query('next_for'))->whereNotIn('o.slug', explode(',', (string) $request->query('exclude')))
                ->where('o.organisation_type_id', 1)->where('o.status', 1)->whereNotNull('oc.campus_id')->whereIn('oc.status', [1, '1', 'Active', 'active'])
                ->orderBy('o.sort_order')->orderBy('o.name')->value('oc.id');
            return response()->json(['offering' => $id]);
        }
        $u = UniversityData::load((string) $request->query('uni')) ?? abort(404);
        if ($request->filled('course')) {
            $os = $u->onCampus()->where('course_id', (int) $request->query('course'))->map(fn ($o) => ['id' => $o['id'], 'label' => $u->campus($o['campus_id'])['name'] ?? 'Campus'])->values();
            return response()->json(['offerings' => $os]);
        }
        $ps = $u->programmes($u->onCampus())->sortBy('name')->map(fn ($p) => ['course_id' => $p['course_id'], 'label' => $p['name'], 'first' => $p['offerings'][0]['id']])->values();
        return response()->json(['programmes' => $ps]);
    }

    // ------------------------------------------------------------------ shared

    private function context(Request $request, string $slug): array
    {
        $u = UniversityData::load($slug) ?? abort(404);
        $scopeCampus = $u->campusBySlug($request->query('campus'));
        $scope = $scopeCampus['id'] ?? null;
        return [
            'u' => $u, 'scope' => $scope, 'scopeCampus' => $scopeCampus, 'scopeIds' => $scope ? [$scope] : null,
            'L' => new UniLinks($u->org['slug'], $scopeCampus['slug'] ?? null),
            'onlineCount' => $u->online()->count(),
            'statesByCampus' => $u->campuses->groupBy('state')->sortKeys(),
        ];
    }

    /** Published cutoffs for this university (from the counselling API), flattened: one row per course + counselling + category. */
    private function cutoffs(UniversityData $u): array
    {
        try {
            $res = Api::get('organisations/' . $u->org['id'] . '/admission-through') ?? ['counsellings' => []];
        } catch (ApiUnavailable $e) {
            return [];
        }
        $rows = [];
        foreach ($res['counsellings'] ?? [] as $b) {
            foreach ($b['courses'] ?? [] as $course) {
                foreach ($course['latest_cutoffs'] ?? [] as $x) {
                    if ($x['closing_value'] === null || $x['gender'] !== 'neutral' || $x['pwd']) continue;
                    $rows[] = ['course_id' => $course['course']['id'], 'course' => $course['course']['name'], 'counselling' => $b['counselling']['name'],
                        'counselling_url' => route('counselling.show', $b['counselling']['slug']), 'year' => $b['cycle']['year'] ?? null,
                        'round' => $x['round'], 'quota' => $x['quota'], 'category' => $x['category'], 'rank_type' => $x['rank_type'], 'closing' => $x['closing_value']];
                }
            }
        }
        return $rows;
    }
}
