<?php

namespace App\Http\Controllers;

use App\Support\ApiUnavailable;
use App\Support\CounsellingUi as Ui;
use App\Support\EnrollzyApi as Api;
use Illuminate\Http\Request;

/**
 * Student pages for exams and counselling (client design "Enrollzy Exam & Counselling Pages"):
 *   /exams/{slug}                          exam page with the "counselling after this exam" finder
 *   /counselling                           all counsellings (?exam= narrows to one exam's)
 *   /counselling/{slug}[/{year}]           counselling overview
 *   /counselling/{slug}/cutoffs | seat-matrix | colleges   explorers (filters, sort and page live in the URL)
 * All data comes from the backend's public API (App\Support\EnrollzyApi), which only returns published records.
 */
class CounsellingController extends Controller
{
    /** Explorer filters accepted in the URL, per explorer. */
    private const FILTERS = [
        'cutoffs' => ['q', 'round', 'category', 'rank', 'quota', 'state', 'type', 'within', 'sort', 'page', 'per_page', 'year'],
        'seats' => ['q', 'round', 'quota', 'state', 'type', 'changed', 'sort', 'page', 'per_page', 'year'],
        'colleges' => ['q', 'quota', 'state', 'type', 'fee', 'category', 'rank', 'sort', 'page', 'per_page', 'year'],
    ];
    private const SORTS = [
        'cutoffs' => ['fit' => 'Best for my rank', 'closing_asc' => 'Closing rank: low to high', 'closing_desc' => 'Closing rank: high to low', 'fee_asc' => 'Fee: low to high', 'college' => 'Name A–Z'],
        'seats' => ['total_desc' => 'Most seats first', 'total_asc' => 'Fewest seats first', 'college' => 'Name A–Z'],
        'colleges' => ['college' => 'Name A–Z', 'fee_asc' => 'Fee: low to high', 'closing_asc' => 'Hardest to get first', 'seats_desc' => 'Most seats first'],
    ];
    public const FEES = ['100000' => 'Under ₹1 lakh', '1000000' => 'Under ₹10 lakh', '2000000' => 'Under ₹20 lakh'];
    private const PER_PAGE = [25, 50, 100];

    // ------------------------------------------------------------------ pages

    public function exam(Request $request, string $slug)
    {
        return $this->guard(function () use ($request, $slug) {
            $exam = Api::get('exams/' . rawurlencode($slug));
            if (!$exam) {
                // An old exam URL (Dynamic Exam slug, or a name-like slug): send it, permanently, to the exam it meant.
                if ($to = \App\Support\ExamCatalog::redirectFor($slug)) {
                    return redirect($to[0], $to[1]);
                }
                abort(404);
            }
            $masters = $this->masters();
            $profile = Ui::profile($request, $masters['states']);
            $counsellings = $exam['counsellings'] ?? [];
            $mine = collect($counsellings)->filter(fn ($c) => Ui::isMine($c, $profile['state']))
                ->sortBy(fn ($c) => ($c['level'] === 'national' ? 0 : 1) . Ui::statusOrder($c['now']['state'] ?? null) . $c['name'])->values()->all();
            $others = collect($counsellings)->reject(fn ($c) => Ui::isMine($c, $profile['state']))->sortBy('name')->values()->all();
            return view('counselling.exam', compact('exam', 'masters', 'profile', 'counsellings', 'mine', 'others'));
        });
    }

    public function index(Request $request)
    {
        return $this->guard(function () use ($request) {
            $masters = $this->masters();
            $profile = Ui::profile($request, $masters['states']);
            $exam = null;
            if ($request->filled('exam')) {
                $exam = Api::get('exams/' . rawurlencode((string) $request->query('exam')));
            }
            $items = $exam ? $exam['counsellings'] : Api::all('counselling');
            $items = collect($items)->map(fn ($c) => $c + ['mine' => Ui::isMine($c, $profile['state'])])
                ->sortBy(fn ($c) => ($c['mine'] ? 0 : 1) . Ui::statusOrder($c['now']['state'] ?? null) . mb_strtolower($c['name']))->values()->all();
            $levels = collect($items)->pluck('level')->unique()->filter()->sortBy(fn ($l) => array_search($l, array_keys(Ui::LEVELS)))->values()->all();
            return view('counselling.index', compact('items', 'masters', 'profile', 'exam', 'levels'));
        });
    }

    public function show(Request $request, string $slug, ?int $year = null)
    {
        return $this->guard(function () use ($request, $slug, $year) {
            $ctx = $this->context($request, $slug, $year);
            $fit = null;
            $source = $this->cutoffSource($slug, $ctx['page'], $year);
            $catId = $this->pickCategory($ctx['profile']['cat'], $source['categories'] ?? []);
            if ($ctx['profile']['rank'] && $source && $catId) {
                $fit = Api::get("counselling/$slug/cutoffs", ['round' => $source['round']['id'], 'year' => $source['year'], 'category' => $catId,
                    'rank' => $ctx['profile']['rank'], 'within' => 1, 'sort' => 'closing_asc', 'per_page' => 5]);
            }
            $also = collect($ctx['list'])->filter(fn ($c) => $c['slug'] !== $slug && Ui::isMine($c, $ctx['profile']['state']))
                ->sortBy(fn ($c) => Ui::statusOrder($c['now']['state'] ?? null))->take(3)->values()->all();
            return view('counselling.show', $ctx + compact('fit', 'source', 'catId', 'also') + ['tab' => 'overview']);
        });
    }

    public function cutoffs(Request $request, string $slug)
    {
        return $this->explorer($request, $slug, 'cutoffs');
    }

    public function seats(Request $request, string $slug)
    {
        return $this->explorer($request, $slug, 'seats');
    }

    public function colleges(Request $request, string $slug)
    {
        return $this->explorer($request, $slug, 'colleges');
    }

    // ------------------------------------------------------------------ explorer

    private function explorer(Request $request, string $slug, string $kind)
    {
        return $this->guard(function () use ($request, $slug, $kind) {
            $year = $request->filled('year') ? (int) $request->query('year') : null;
            $ctx = $this->context($request, $slug, $year);
            $f = $this->filters($request, $kind);
            $notice = null;
            $source = null;

            if ($kind === 'cutoffs') {
                // Default round: the latest one with cutoffs; falls back to last year's when this year has none yet.
                $source = $this->cutoffSource($slug, $ctx['page'], $year);
                if ($source && !$year && $source['year']) {
                    $notice = "No cutoffs for {$ctx['page']['cycle']['year']} yet. Showing {$source['year']}.";
                }
                if ($source && !$f['year']) $f['year'] = $source['year'];
                $f['round'] = $f['round'] ?: ($source['round']['id'] ?? null);
                $f['category'] = $f['category'] ?: $this->pickCategory($ctx['profile']['cat'], $source['categories'] ?? []);
                $f['rank'] = $f['rank'] ?: $ctx['profile']['rank'];
                $f['sort'] = $f['sort'] ?: ($f['rank'] ? 'fit' : 'closing_asc');
                $query = ['q' => $f['q'], 'round' => $f['round'], 'category' => $f['category'], 'rank' => $f['rank'], 'within' => $f['within'] ? 1 : null,
                    'quota' => $f['quota'], 'state' => $f['state'], 'institute_type' => $f['type'], 'sort' => $f['sort'], 'page' => $f['page'], 'per_page' => $f['per_page'], 'year' => $f['year']];
                $path = "counselling/$slug/cutoffs";
            } elseif ($kind === 'seats') {
                $f['sort'] = $f['sort'] ?: 'total_desc';
                $query = ['q' => $f['q'], 'round' => $f['round'], 'quota' => $f['quota'], 'state' => $f['state'], 'institute_type' => $f['type'], 'changed' => $f['changed'] ? 1 : null,
                    'sort' => $f['sort'], 'page' => $f['page'], 'per_page' => $f['per_page'], 'year' => $f['year']];
                $path = "counselling/$slug/seat-matrix";
            } else {
                $f['sort'] = $f['sort'] ?: 'college';
                $f['rank'] = $f['rank'] ?: $ctx['profile']['rank'];
                $query = ['group' => 'college', 'q' => $f['q'], 'quota' => $f['quota'], 'state' => $f['state'], 'institute_type' => $f['type'], 'max_fee' => $f['fee'],
                    'sort' => $f['sort'], 'page' => $f['page'], 'per_page' => $f['per_page'], 'year' => $f['year']];
                $probe = Api::get("counselling/$slug/institutes", ['group' => 'college', 'per_page' => 1, 'year' => $f['year']]) ?? [];
                $f['category'] = $f['category'] ?: $this->pickCategory($ctx['profile']['cat'], $probe['filters']['categories'] ?? []);
                $query['category'] = $f['category'];
                $path = "counselling/$slug/institutes";
            }

            $data = $ctx['page']['cycle'] ? (Api::get($path, $query) ?? ['data' => [], 'meta' => ['total' => 0, 'page' => 1, 'last_page' => 1], 'filters' => []])
                : ['data' => [], 'meta' => ['total' => 0, 'page' => 1, 'last_page' => 1], 'filters' => []];
            $view = compact('kind', 'f', 'data', 'notice', 'source') + $ctx + ['tab' => $kind, 'sorts' => self::SORTS[$kind], 'perPages' => self::PER_PAGE];

            if ($request->header('X-Cz-Partial')) {
                return response()->view('counselling._results', $view)->header('Vary', 'X-Cz-Partial');
            }
            return response()->view('counselling.explorer', $view)->header('Vary', 'X-Cz-Partial');
        });
    }

    /** The explorer's filters from the URL, cleaned. */
    private function filters(Request $request, string $kind): array
    {
        $out = [];
        foreach (self::FILTERS[$kind] as $k) {
            $v = $request->query($k);
            $out[$k] = is_string($v) ? trim($v) : null;
        }
        $int = fn ($v, $min = 1, $max = PHP_INT_MAX) => filter_var($v, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]) ?: null;
        foreach (['round', 'category', 'quota', 'year'] as $k) if (array_key_exists($k, $out)) $out[$k] = $int($out[$k]);
        if (array_key_exists('rank', $out)) $out['rank'] = $int($out['rank'], 1, 5000000);
        $out['page'] = $int($out['page']) ?? 1;
        $out['per_page'] = in_array((int) $out['per_page'], self::PER_PAGE, true) ? (int) $out['per_page'] : 25;
        $out['sort'] = array_key_exists((string) $out['sort'], self::SORTS[$kind]) ? $out['sort'] : null;
        $out['q'] = $out['q'] !== null ? mb_substr($out['q'], 0, 80) : null;
        foreach (['within', 'changed'] as $k) if (array_key_exists($k, $out)) $out[$k] = (bool) $out[$k];
        if (array_key_exists('fee', $out)) $out['fee'] = array_key_exists((string) $out['fee'], self::FEES) ? $out['fee'] : null;
        return $out + ['round' => null, 'category' => null, 'rank' => null, 'within' => false, 'changed' => false, 'fee' => null];
    }

    // ------------------------------------------------------------------ shared

    /** What every counselling page needs: the page payload, the switcher list and the visitor's details. */
    private function context(Request $request, string $slug, ?int $year): array
    {
        $page = Api::get('counselling/' . rawurlencode($slug), ['year' => $year]) ?? abort(404);
        $masters = $this->masters();
        $profile = Ui::profile($request, $masters['states']);
        $list = collect(Api::all('counselling'))->map(fn ($c) => $c + ['mine' => Ui::isMine($c, $profile['state'])])->sortBy('name')->values()->all();
        $exams = $page['exams'] ?? [];
        $primary = collect($exams)->firstWhere('role', 'primary') ?? ($exams[0] ?? null);
        $isPast = $year && ($page['cycle']['is_current'] ?? false) === false;
        return compact('page', 'masters', 'profile', 'list', 'primary', 'slug', 'year', 'isPast');
    }

    /**
     * Which cutoffs to show by default: the latest round that has cutoffs in this cycle; when the cycle has none yet,
     * the latest round of the previous public year. Null when there are no cutoffs at all.
     */
    private function cutoffSource(string $slug, array $page, ?int $year): ?array
    {
        if (!$page['cycle']) return null;
        $years = $year ? [$year] : array_values(array_unique(array_merge([$page['cycle']['year']], $page['available_years'] ?? [])));
        foreach (array_slice($years, 0, 2) as $y) {
            $probe = Api::get("counselling/$slug/cutoffs", ['per_page' => 1, 'year' => $y === $page['cycle']['year'] && !$year ? null : $y]);
            $round = collect($probe['filters']['rounds'] ?? [])->filter(fn ($r) => ($r['cutoffs'] ?? 0) > 0)->last();
            if ($round) {
                return ['year' => $y === $page['cycle']['year'] && !$year ? null : $y, 'label_year' => $y, 'round' => $round,
                    'rounds' => collect($probe['filters']['rounds'])->filter(fn ($r) => ($r['cutoffs'] ?? 0) > 0)->values()->all(),
                    'categories' => $probe['filters']['categories'] ?? [], 'total' => collect($probe['filters']['rounds'])->sum('cutoffs')];
            }
        }
        return null;
    }

    /** The visitor's category when this counselling has cutoffs for it, else the first one (usually General). */
    private function pickCategory(?int $wanted, array $categories): ?int
    {
        $ids = array_map(fn ($c) => (int) (is_array($c) ? $c['id'] : $c->id), $categories);
        if ($wanted && in_array($wanted, $ids, true)) return $wanted;
        return $ids[0] ?? null;
    }

    private function masters(): array
    {
        $m = Api::get('masters') ?? [];
        return ['categories' => $m['categories'] ?? [], 'states' => $m['states'] ?? []];
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
