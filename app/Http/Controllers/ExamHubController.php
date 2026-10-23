<?php

namespace App\Http\Controllers;

use App\Support\ApiUnavailable;
use App\Support\CounsellingUi as Ui;
use App\Support\Ec\Ec;
use App\Support\EnrollzyApi as Api;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Exams, Counselling & Cutoffs (client design "enrollzy-exams-counselling-cutoffs"): one hub with three tabs and the
 * exam and counselling pages, linked both ways (exam → counselling → cutoffs).
 *
 *   /top-exams                         hub: exams (status groups, stream tabs, search, paging)
 *   /counselling                       hub: counselling (All India / state, my state, state counsellings grouped by exam)
 *   /cutoffs?exam=&counselling=&year=&round=&category=&rank=   hub: cutoff finder, table, trend, year and category views
 *   /exam/{slug}[/counselling|cutoffs|colleges]
 *   /counselling/{slug}[/{year}] and /counselling/{slug}/cutoffs|colleges
 *
 * All data comes from the backend's public API; lists are paged here (?page=&per_page=) after status ordering, so open
 * and live items are always on page 1. The visitor's state, category and rank live in the ez_profile cookie.
 */
class ExamHubController extends Controller
{
    private array $memo = [];

    // ------------------------------------------------------------------ hub

    public function exams(Request $request)
    {
        return $this->guard(function () use ($request) {
            $all = $this->examList();
            $q = Str::lower(trim((string) $request->query('q')));
            $stream = (string) $request->query('stream');
            $match = fn ($e) => !$q || Str::contains(Str::lower($e['name'] . ' ' . $e['short_name'] . ' ' . ($e['conducting_body']['name'] ?? '') . ' ' . ($e['conducting_body']['short_name'] ?? '')), $q);
            $streams = $this->streams($all->filter($match), fn ($e) => $e['categories'] ?? []);
            $list = Ec::sortExams($all->filter($match)->filter(fn ($e) => !$stream || in_array($stream, $e['categories'] ?? [], true)));
            $page = Ec::page($list, $request);
            return view('ec.hub', $this->hubBase('exams') + compact('list', 'page', 'streams', 'stream', 'q'));
        });
    }

    public function counsellings(Request $request)
    {
        return $this->guard(function () use ($request) {
            $all = $this->counList();
            $q = Str::lower(trim((string) $request->query('q')));
            $stream = (string) $request->query('stream');
            $level = in_array($request->query('level'), ['national', 'state'], true) ? $request->query('level') : '';
            $profile = $this->profile($request);
            $state = (string) ($request->query('state') ?? '');
            $match = fn ($c) => !$q || Str::contains(Str::lower($c['name'] . ' ' . ($c['conducting_body'] ?? '') . ' ' . collect($c['exams'] ?? [])->pluck('short_name')->implode(' ') . ' ' . implode(' ', $c['states'] ?? [])), $q);
            $inStream = fn ($c) => !$stream || in_array($stream, $c['course_categories'] ?? [], true);
            $streams = $this->streams($all->filter($match), fn ($c) => $c['course_categories'] ?? []);
            $list = Ec::sortCouns($all->filter($match)->filter($inStream)
                ->filter(fn ($c) => !$level || $c['level'] === $level || ($level === 'national' && $c['level'] !== 'state'))
                ->filter(fn ($c) => !$state || in_array($state, $c['states'] ?? [], true)));

            // With no filter, state counsellings that hang off one exam (NEET UG has 30+) become one row per exam.
            $rows = $list->map(fn ($c) => ['bundle' => false, 'c' => $c, 'grp' => $c['_s']['grp']]);
            $bundled = !$level && !$state && !$q;
            if ($bundled) {
                $groups = $list->filter(fn ($c) => $c['level'] === 'state' && count($c['exams'] ?? []) === 1)->groupBy(fn ($c) => $c['exams'][0]['slug'])->filter(fn ($g) => $g->count() >= 4);
                foreach ($groups as $examSlug => $g) {
                    $grp = $g->min(fn ($c) => $c['_s']['grp']);
                    $rows = $rows->reject(fn ($r) => !$r['bundle'] && $g->contains(fn ($c) => $c['slug'] === $r['c']['slug']))
                        ->push(['bundle' => true, 'exam' => $g->first()['exams'][0], 'list' => $g->values(), 'grp' => $grp]);
                }
            }
            // status groups in order; a bundle sits at the end of its group
            $rows = collect([0, 1, 2])->flatMap(fn ($g) => $rows->where('grp', $g))->values();
            $page = Ec::page($rows, $request);
            $states = $all->filter($inStream)->flatMap(fn ($c) => $c['states'] ?? [])->unique()->sort()->values();
            $levelCounts = ['' => $all->filter($inStream)->count(), 'national' => $all->filter($inStream)->where('level', '!=', 'state')->count(), 'state' => $all->filter($inStream)->where('level', 'state')->count()];
            return view('ec.hub', $this->hubBase('counselling') + compact('list', 'rows', 'page', 'streams', 'stream', 'q', 'level', 'state', 'states', 'levelCounts', 'bundled', 'profile'));
        });
    }

    public function cutoffs(Request $request)
    {
        return $this->guard(function () use ($request) {
            $exams = $this->examList()->filter(fn ($e) => !empty($e['counsellings']))->values();
            $stream = (string) $request->query('stream');
            $streams = $this->streams($exams, fn ($e) => $e['categories'] ?? []);
            $examOpts = $exams->filter(fn ($e) => !$stream || in_array($stream, $e['categories'] ?? [], true))->values();
            $profile = $this->profile($request);
            $exam = $examOpts->firstWhere('slug', (string) $request->query('exam')) ?? $examOpts->first();
            $base = $this->hubBase('cutoffs') + compact('streams', 'stream', 'examOpts', 'exam', 'profile');
            if (!$exam) return view('ec.hub', $base + ['cut' => null]);

            $counOpts = collect($exam['counsellings'])->sortBy(fn ($c) => Ec::counSort($c))->values();
            $coun = $counOpts->firstWhere('slug', (string) $request->query('counselling')) ?? $counOpts->first();
            $cut = $this->cutoffView($request, $exam, $coun, $profile);
            return view('ec.hub', $base + compact('counOpts', 'coun', 'cut'));
        });
    }

    // ------------------------------------------------------------------ exam page

    public function exam(Request $request, string $slug, string $tab = 'overview')
    {
        return $this->guard(function () use ($request, $slug, $tab) {
            $page = Api::get('exams/' . rawurlencode($slug));
            if (!$page) {
                // An old exam URL (Dynamic Exam slug, or a name-like slug): send it, permanently, to the exam it meant.
                if ($to = \App\Support\ExamCatalog::redirectFor($slug)) return redirect($to[0], $to[1]);
                abort(404);
            }
            $item = $this->examList()->firstWhere('slug', $slug) ?? ($page['exam'] + ['key_dates' => [], 'counsellings' => [], 'status' => []]);
            $item['_s'] ??= Ec::examState($item);
            $couns = $this->counList()->keyBy('slug');
            // the exam's counsellings with their list details (rounds, seats), All India first
            $counsellings = collect($page['counsellings'] ?? [])->map(fn ($c) => ($couns[$c['slug']] ?? $c) + ['role' => $c['role'] ?? null, 'seat_scope_note' => $c['seat_scope_note'] ?? null])
                ->map(fn ($c) => $c + ['_s' => $c['_s'] ?? Ec::counState($c)])->sortBy(fn ($c) => Ec::counSort($c))->values();
            $profile = $this->profile($request);
            $colleges = $this->examColleges($page['exam']);
            $data = compact('page', 'item', 'counsellings', 'profile', 'colleges', 'tab') + ['e' => $page['exam'], 'slug' => $slug];

            if ($tab === 'counselling') {
                $type = in_array($request->query('type'), ['national', 'state'], true) ? $request->query('type') : '';
                $st = in_array($request->query('status'), ['live', 'upcoming', 'completed'], true) ? $request->query('status') : '';
                $q = Str::lower(trim((string) $request->query('q')));
                $my = (string) ($request->query('my') ?? $profile['state'] ?? '');
                $f = $counsellings->filter(fn ($c) => !$type || ($type === 'state' ? $c['level'] === 'state' : $c['level'] !== 'state'))
                    ->filter(fn ($c) => !$st || ($st === 'live' ? $c['_s']['grp'] === 0 : ($st === 'upcoming' ? in_array($c['_s']['state'], ['upcoming', 'tba']) : $c['_s']['state'] === 'completed')))
                    ->filter(fn ($c) => !$q || Str::contains(Str::lower($c['name'] . ' ' . implode(' ', $c['states'] ?? [])), $q));
                $mine = $my ? $f->first(fn ($c) => $c['level'] === 'state' && in_array($my, $c['states'] ?? [], true)) : null;
                $ord = fn ($l) => $l->sortBy(fn ($c) => [$c['_s']['grp'], Str::lower(($c['states'][0] ?? '') . $c['name'])])->values();
                $flat = collect($mine ? [['g' => 'm', 'c' => $mine]] : [])
                    ->merge($ord($f->filter(fn ($c) => $c['level'] !== 'state'))->map(fn ($c) => ['g' => 'a', 'c' => $c]))
                    ->merge($ord($f->filter(fn ($c) => $c['level'] === 'state' && (!$mine || $c['slug'] !== $mine['slug'])))->map(fn ($c) => ['g' => 's', 'c' => $c]));
                $data += ['flat' => $flat, 'pager' => Ec::page($flat, $request), 'type' => $type, 'st' => $st, 'q' => $q, 'my' => $my,
                    'myStates' => $counsellings->where('level', 'state')->flatMap(fn ($c) => $c['states'] ?? [])->unique()->sort()->values()];
            } elseif ($tab === 'cutoffs') {
                $coun = $counsellings->firstWhere('slug', (string) $request->query('counselling')) ?? $counsellings->first();
                $data += ['coun' => $coun, 'preview' => $coun ? $this->cutoffPreview($coun['slug']) : null];
            } elseif ($tab === 'colleges') {
                $data += ['pager' => Ec::page(collect($colleges), $request)];
            }
            return view('ec.exam', $data);
        });
    }

    // ------------------------------------------------------------------ counselling page

    public function counsellingCutoffs(Request $request, string $slug)
    {
        return $this->counselling($request, $slug, null, 'cutoffs');
    }

    public function counsellingColleges(Request $request, string $slug)
    {
        return $this->counselling($request, $slug, null, 'colleges');
    }

    public function counselling(Request $request, string $slug, $year = null, string $tab = 'overview')
    {
        $year = $year !== null && ctype_digit((string) $year) ? (int) $year : null;
        return $this->guard(function () use ($request, $slug, $year, $tab) {
            $year = $year ?? ($request->filled('year') ? (int) $request->query('year') : null);
            $page = Api::get('counselling/' . rawurlencode($slug), ['year' => $year]) ?? abort(404);
            $c = $page['counselling'];
            // rounds with their date spans, from the page's round events
            $rounds = collect($page['dates']['rounds'] ?? [])->map(function ($r) {
                $ev = collect($r['events'])->filter(fn ($e) => $e['start_at'] && $e['date_precision'] !== 'tba');
                return ['id' => $r['round_id'], 'name' => $r['name'], 'start' => $ev->min('start_at') ? substr($ev->min('start_at'), 0, 10) : null,
                    'end' => $ev->isNotEmpty() ? substr($ev->map(fn ($e) => $e['extended_end_at'] ?? $e['end_at'] ?? $e['start_at'])->max(), 0, 10) : null];
            })->values()->all();
            $s = Ec::counState(['rounds' => $rounds]);
            $exams = collect($page['exams'] ?? []);
            $primary = $exams->firstWhere('role', 'primary') ?? $exams->first();
            $profile = $this->profile($request);
            // the relation bar: the other counsellings of the same exam, with where each stands
            $examItem = $primary ? $this->examList()->firstWhere('slug', $primary['slug']) : null;
            $bySlug = $this->counList()->keyBy('slug');
            $relCouns = collect($examItem['counsellings'] ?? [['slug' => $slug] + $c])->map(fn ($x) => $bySlug[$x['slug']] ?? $x)
                ->map(fn ($x) => $x + ['_s' => $x['_s'] ?? Ec::counState($x)])->sortBy(fn ($x) => Ec::counSort($x))->values();
            $data = compact('page', 'c', 's', 'rounds', 'exams', 'primary', 'profile', 'tab', 'slug', 'year', 'relCouns');

            if ($tab === 'overview') {
                $data['preview'] = $page['cycle'] ? $this->cutoffPreview($slug, $year) : null;
                $data['seats'] = $page['cycle'] ? (Api::get("counselling/$slug/seat-matrix", ['per_page' => 1, 'year' => $year]) ?? null) : null;
                $data['institutes'] = $page['cycle'] ? (Api::get("counselling/$slug/institutes", ['group' => 'college', 'per_page' => 6, 'sort' => 'college', 'year' => $year]) ?? null) : null;
            } elseif ($tab === 'cutoffs') {
                $data['preview'] = $page['cycle'] ? $this->cutoffPreview($slug, $year, 10) : null;
            } elseif ($tab === 'colleges') {
                $size = in_array((int) $request->query('per_page'), Ec::CUT_PER_PAGE, true) ? (int) $request->query('per_page') : 15;
                $res = $page['cycle'] ? (Api::get("counselling/$slug/institutes", ['group' => 'college', 'per_page' => $size, 'page' => max(1, (int) $request->query('page', 1)),
                    'q' => $request->query('q'), 'sort' => 'college', 'year' => $year]) ?? null) : null;
                $meta = $res['meta'] ?? ['page' => 1, 'last_page' => 1, 'total' => 0, 'per_page' => $size];
                $data['institutes'] = $res;
                $data['pager'] = ['page' => $meta['page'], 'pages' => $meta['last_page'], 'size' => $size, 'sizes' => Ec::CUT_PER_PAGE, 'total' => $meta['total'],
                    'from' => $meta['total'] ? ($meta['page'] - 1) * $size + 1 : 0, 'to' => min($meta['page'] * $size, $meta['total']), 'prefix' => ''];
            }
            return view('ec.counselling', $data);
        });
    }

    // ------------------------------------------------------------------ alerts (follow an exam or counselling)

    public function alerts(Request $request)
    {
        $data = $request->validate(['type' => 'required|in:exam,counselling', 'slug' => 'required|string|max:255', 'email' => 'required|email:rfc|max:190', 'website' => 'nullable|string']);
        try {
            [$status, $json] = Api::post('follow', ['type' => $data['type'], 'slug' => $data['slug'], 'email' => $data['email'], 'channels' => ['email'], 'website' => $data['website'] ?? null]);
        } catch (ApiUnavailable $e) {
            return response()->json(['message' => 'Alerts are not available right now. Please try again later.'], 503);
        }
        return response()->json(['message' => $json['message'] ?? ($status < 300 ? 'Check your email to confirm.' : 'Please check your email address.')], $status < 300 ? 200 : 422);
    }

    // ------------------------------------------------------------------ cutoffs

    /** Everything the cutoff finder shows for one exam + counselling. */
    private function cutoffView(Request $request, array $exam, ?array $coun, array $profile): ?array
    {
        if (!$coun) return null;
        $slug = $coun['slug'];
        $base = Api::get('counselling/' . rawurlencode($slug));
        if (!$base || !$base['cycle']) return ['coun' => $coun, 'empty' => 'This counselling has no published cycle yet.'];
        $years = collect($base['available_years'] ?? [$base['cycle']['year']])->values();
        // the year with cutoffs: asked for, else the current cycle, else the one before
        $year = (int) $request->query('year');
        $probe = null;
        foreach ($year && $years->contains($year) ? [$year] : $years->take(2)->all() as $y) {
            $p = Api::get("counselling/$slug/cutoffs", ['per_page' => 1, 'year' => $y]);
            if ($p && collect($p['filters']['rounds'] ?? [])->sum('cutoffs') > 0) { $probe = $p; $year = $y; break; }
            $probe ??= $p; $year = $year ?: $y;
        }
        $rounds = collect($probe['filters']['rounds'] ?? [])->filter(fn ($r) => ($r['cutoffs'] ?? 0) > 0)->values();
        $categories = collect($probe['filters']['categories'] ?? [])->values();
        if ($rounds->isEmpty()) {
            return ['coun' => $coun, 'base' => $base, 'years' => $years, 'year' => $year, 'empty' => 'No cutoffs have been published for this counselling yet.'];
        }
        $round = $rounds->firstWhere('id', (int) $request->query('round')) ?? $rounds->last();
        $cat = $categories->firstWhere('id', (int) $request->query('category'))
            ?? ($profile['cat'] ? $categories->firstWhere('id', $profile['cat']) : null) ?? $categories->first();
        $rank = filter_var($request->query('rank', $profile['rank']), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5000000]]) ?: null;
        $size = in_array((int) $request->query('per_page'), Ec::CUT_PER_PAGE, true) ? (int) $request->query('per_page') : 15;
        $table = Api::get("counselling/$slug/cutoffs", ['year' => $year, 'round' => $round['id'], 'category' => $cat['id'] ?? null, 'q' => $request->query('q'),
            'compare' => 1, 'sort' => 'closing_asc', 'per_page' => $size, 'page' => max(1, (int) $request->query('page', 1))]) ?? ['data' => [], 'meta' => []];
        $meta = $table['meta'] + ['page' => 1, 'last_page' => 1, 'total' => 0];
        $pager = ['page' => $meta['page'], 'pages' => $meta['last_page'], 'size' => $size, 'sizes' => Ec::CUT_PER_PAGE, 'total' => $meta['total'],
            'from' => $meta['total'] ? ($meta['page'] - 1) * $size + 1 : 0, 'to' => min($meta['page'] * $size, $meta['total']), 'prefix' => ''];

        // insights for one seat (?seat=organisation-course-quota), the first row by default
        $rows = collect($table['data']);
        [$so, $sc, $sq] = array_pad(array_map('intval', explode('-', (string) $request->query('seat'))), 3, 0);
        $isSeat = fn ($r) => $r['college']['id'] === $so && $r['course']['id'] === $sc && (!$sq || ($r['quota_id'] ?? 0) === $sq);
        $seat = $so ? $rows->first($isSeat) : $rows->first();
        if ($so && !$seat) {
            // a seat chosen in the picker that is not on this page of the table: fetch it on its own
            $one = Api::get("counselling/$slug/cutoffs", ['year' => $year, 'round' => $round['id'], 'category' => $cat['id'] ?? null, 'course' => $sc, 'per_page' => 100]);
            $seat = collect($one['data'] ?? [])->first($isSeat) ?? $rows->first();
        }
        $trend = $seat ? Api::get("counselling/$slug/cutoff-trend", ['year' => $year, 'organisation' => $seat['college']['id'], 'course' => $seat['course']['id'],
            'quota' => $seat['quota_id'] ?? null, 'category' => $cat['id'] ?? null, 'round' => $round['id'], 'gender' => $seat['gender'], 'pwd' => $seat['pwd'] ? 1 : 0, 'rank_type' => $seat['rank_type']]) : null;
        // the seat picker: the top 40 seats of this round and category
        $seatList = Api::get("counselling/$slug/cutoffs", ['year' => $year, 'round' => $round['id'], 'category' => $cat['id'] ?? null, 'sort' => 'closing_asc', 'per_page' => 40]);
        $pdfs = collect(Api::get('counselling/' . rawurlencode($slug), ['year' => $year])['rounds'] ?? [])->flatMap(fn ($r) => collect($r['results'])->map(fn ($x) => $x + ['round' => $r['name']]))
            ->filter(fn ($x) => $x['url'])->values();
        return compact('coun', 'base', 'years', 'year', 'rounds', 'round', 'categories', 'cat', 'rank', 'table', 'pager', 'seat', 'trend', 'seatList', 'pdfs')
            + ['prevYear' => $table['meta']['previous_year'] ?? null];
    }

    /** The first rows of a counselling's latest cutoffs (General, or the first category), for the page sections and tabs. */
    private function cutoffPreview(string $slug, ?int $year = null, int $n = 6): ?array
    {
        $page = Api::get('counselling/' . rawurlencode($slug), ['year' => $year]);
        if (!$page || !$page['cycle']) return null;
        $years = collect($page['available_years'] ?? [$page['cycle']['year']]);
        foreach (($year ? [$year] : $years->take(2)->all()) as $y) {
            $p = Api::get("counselling/$slug/cutoffs", ['per_page' => 1, 'year' => $y]);
            $round = collect($p['filters']['rounds'] ?? [])->filter(fn ($r) => ($r['cutoffs'] ?? 0) > 0)->last();
            if (!$round) continue;
            $cats = collect($p['filters']['categories'] ?? []);
            $cat = $cats->first(fn ($c) => Str::lower($c['name']) === 'general') ?? $cats->first();
            $rows = Api::get("counselling/$slug/cutoffs", ['year' => $y, 'round' => $round['id'], 'category' => $cat['id'] ?? null, 'sort' => 'closing_asc', 'per_page' => $n]);
            return ['year' => $y, 'round' => $round, 'category' => $cat, 'rows' => $rows['data'] ?? [], 'total' => $rows['meta']['total'] ?? 0, 'categories' => $cats->values()->all()];
        }
        return null;
    }

    // ------------------------------------------------------------------ lists

    private function examList(): Collection
    {
        return $this->memo['exams'] ??= collect(Api::all('exams', ['sort' => 'featured']))->map(fn ($e) => $e + ['_s' => Ec::examState($e)]);
    }

    private function counList(): Collection
    {
        return $this->memo['couns'] ??= collect(Api::all('counselling'))->map(fn ($c) => $c + ['_s' => Ec::counState($c)]);
    }

    /** Stream tabs: All + every category that has items, with counts (biggest first). */
    private function streams(Collection $items, \Closure $cats): array
    {
        $counts = $items->flatMap($cats)->countBy()->sortDesc();
        return ['' => $items->count()] + $counts->all();
    }

    private function hubBase(string $tab): array
    {
        return ['hubTab' => $tab, 'examCount' => $this->examList()->count(), 'counCount' => $this->counList()->count()];
    }

    private function profile(Request $request): array
    {
        $states = (Api::get('masters') ?? [])['states'] ?? [];
        return Ui::profile($request, $states) + ['states' => $states];
    }

    /**
     * Colleges and courses on Enrollzy that admit through this exam: courses whose entrance exams list the website's
     * exam of the same slug / name / short name. Name, course, campus city and the course page.
     */
    private function examColleges(array $e): array
    {
        $ids = DB::table('exams')->where(fn ($w) => $w->where('slug', $e['slug'])->orWhere('name', $e['name'])
            ->when($e['short_name'], fn ($w) => $w->orWhere('short_name', $e['short_name'])))->pluck('id')->map(fn ($v) => (string) $v)->all();
        if (!$ids) return [];
        $rows = DB::table('organisation_courses as oc')->join('organisations as o', 'o.id', '=', 'oc.organisation_id')->join('courses as c', 'c.id', '=', 'oc.course_id')
            ->where('o.status', 1)->whereIn('oc.status', ['1', 'Active', 'active'])
            ->where(function ($w) use ($ids) {
                $w->whereIn('oc.entrance_exam_id', $ids);
                foreach ($ids as $id) $w->orWhere('oc.entrance_exam_ids', 'like', '%"' . $id . '"%');
            })
            ->leftJoin('campuses as ca', 'ca.id', '=', 'oc.campus_id')
            ->orderBy('o.sort_order')->orderBy('o.name')->orderBy('c.name')
            ->get(['o.name as college', 'o.slug as org_slug', 'o.organisation_type_id as type', 'c.name as course', 'c.slug as course_slug', 'ca.city', 'ca.state', 'ca.slug as campus_slug']);
        return $rows->unique(fn ($r) => $r->org_slug . '|' . $r->course . '|' . $r->city)->map(fn ($r) => [
            'college' => $r->college, 'course' => trim($r->course), 'place' => implode(', ', array_filter([$r->city, $r->state])),
            'url' => (int) $r->type === 1 && $r->course_slug ? route('university.course', array_filter(['slug' => $r->org_slug, 'course' => $r->course_slug, 'campus' => $r->campus_slug]))
                : ((int) $r->type === 1 ? route('university.detail', $r->org_slug) : null),
        ])->values()->all();
    }

    /** The backend being down shows a friendly page (503) instead of an error. */
    private function guard(\Closure $page)
    {
        try {
            return $page();
        } catch (ApiUnavailable $e) {
            return response()->view('counselling.unavailable', [], 503);
        }
    }
}
