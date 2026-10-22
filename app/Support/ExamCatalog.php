<?php

namespace App\Support;

use App\Support\EnrollzyApi as Api;
use Illuminate\Support\Collection;

/**
 * Exams on the website come from the backend's Exam Module (public API), not from the old Dynamic Exams table.
 * This turns API exams into the "exam card" objects the existing views use (name, slug, logo, conducting body,
 * categories, frequency, registration / result status, section links), and resolves values that other modules saved
 * (homepage boxes, courses): "exm:{id}" = Exam Module exam; an old Dynamic Exam id or a plain name is matched to a
 * published exam by name, short name or alias.
 */
class ExamCatalog
{
    /** Exam page sections a card can link to (anchors on /exam/{slug}). */
    private const SECTIONS = ['dates' => ['x-dates', 'Important Dates'], 'eligibility' => ['x-elig', 'Eligibility'], 'pattern' => ['x-pattern', 'Exam Pattern'],
        'syllabus' => ['x-pattern', 'Syllabus'], 'counselling' => ['x-coun', 'Counselling'], 'faqs' => ['x-faq', 'FAQs']];

    /** @return array{items: Collection, meta: array, filters: array} */
    public static function list(array $query): array
    {
        $res = Api::get('exams', $query) ?? ['data' => [], 'meta' => [], 'filters' => []];
        return ['items' => collect($res['data'] ?? [])->map(fn ($e) => self::card($e)), 'meta' => $res['meta'] ?? [], 'filters' => $res['filters'] ?? []];
    }

    /** Same as list(), but an unreachable API gives an empty result (for the header, homepage and other side boxes). */
    public static function safeList(array $query): array
    {
        try {
            return self::list($query);
        } catch (ApiUnavailable $e) {
            return ['items' => collect(), 'meta' => ['total' => 0], 'filters' => []];
        }
    }

    /** An API exam as the card object the views use. */
    public static function card(array $e): object
    {
        $sections = collect(self::SECTIONS)->filter(fn ($s, $key) => !empty($e['sections'][$key]))
            ->map(fn ($s) => (object) ['slug' => $s[0], 'title' => $s[1]])->unique('slug')->values();
        return (object) [
            'id' => $e['id'] ?? null,
            'name' => $e['name'],
            'short_name' => $e['short_name'] ?? null,
            'slug' => $e['slug'] ?? null,
            'logo' => $e['logo_url'] ?? null,
            'about_exam' => $e['about'] ?? null,
            'featured_exam' => (bool) ($e['is_featured'] ?? false),
            'conducting_authority_name' => $e['conducting_body'] ? ($e['conducting_body']['short_name'] ?: $e['conducting_body']['name']) : null,
            'conducting_body_type' => null,
            'exam_type' => $e['type_label'] ?? null,
            'exam_category' => $e['categories'] ?? [],
            'exam_frequency' => $e['frequency_label'] ?? null,
            'registration_status' => $e['status']['registration']['text'] ?? null,
            'result_status' => $e['status']['result']['text'] ?? null,
            'exam_date_status' => $e['status']['exam-date']['text'] ?? null,
            'year' => $e['cycle']['year'] ?? null,
            'sections' => $sections,
        ];
    }

    /**
     * Saved exam values -> cards, in the saved order. Unmatched plain names come back as name-only cards (slug null)
     * so a page can still show the name (linking to a search); unmatched old ids are dropped.
     */
    public static function resolve(array $values, bool $keepUnmatchedNames = true): Collection
    {
        return self::resolveGroups([$values], $keepUnmatchedNames)[0];
    }

    /**
     * resolve() for several lists at once (e.g. every homepage stream tab) with one API call per kind, not per list.
     * @param  array<array-key, array>  $groups
     * @return array<array-key, Collection>
     */
    public static function resolveGroups(array $groups, bool $keepUnmatchedNames = true): array
    {
        $clean = fn ($list) => array_values(array_filter(array_map(fn ($v) => trim((string) $v), (array) $list), 'strlen'));
        $groups = array_map($clean, $groups);
        $all = array_merge([], ...array_values($groups));
        if (!$all) return array_map(fn () => collect(), $groups);

        try {
            $exmIds = [];
            $terms = [];
            $old = [];
            foreach (array_unique($all) as $v) {
                if (str_starts_with($v, 'exm:')) {
                    $exmIds[] = (int) substr($v, 4);
                } elseif (ctype_digit($v)) {
                    // an old Dynamic Exam id: matched by its slug / name / short name
                    if ($o = \App\Models\DynamicExam::find((int) $v)) {
                        $old[$v] = array_values(array_filter([$o->slug, $o->name, $o->short_name]));
                        array_push($terms, ...$old[$v]);
                    }
                } else {
                    $terms[] = $v;
                }
            }
            $byId = $exmIds ? collect((Api::get('exams', ['ids' => implode(',', array_unique($exmIds)), 'per_page' => 100]) ?? [])['data'] ?? [])->keyBy('id') : collect();
            $matches = $terms ? ((Api::get('exam-lookup', ['q' => array_values(array_unique($terms))]) ?? [])['matches'] ?? []) : [];
        } catch (ApiUnavailable $e) {
            return array_map(fn () => collect(), $groups);
        }

        $result = [];
        foreach ($groups as $key => $values) {
            $out = collect();
            foreach ($values as $v) {
                if (str_starts_with($v, 'exm:')) {
                    if ($e = $byId->get((int) substr($v, 4))) $out->push(self::card($e));
                } elseif (ctype_digit($v)) {
                    $hit = collect($old[$v] ?? [])->map(fn ($t) => $matches[$t] ?? null)->filter()->first();
                    if ($hit) $out->push(self::card($hit));
                } elseif (!empty($matches[$v])) {
                    $out->push(self::card($matches[$v]));
                } elseif ($keepUnmatchedNames) {
                    $out->push((object) ['id' => null, 'name' => $v, 'short_name' => null, 'slug' => null, 'logo' => null, 'about_exam' => null, 'conducting_authority_name' => null, 'exam_type' => null]);
                }
            }
            $result[$key] = $out->unique(fn ($c) => $c->slug ?? 'name:' . $c->name)->values();
        }
        return $result;
    }

    /**
     * Data for the exam listing views (top-exams, filtered-exams): a paginator of cards plus the sidebar options.
     * The sidebar works with names / labels (category, exam_type, conducting_body_type request params), mapped here
     * to the API's ids. $preset = fixed API filters of a filtered page (mode, frequency...).
     */
    public static function listing(\Illuminate\Http\Request $request, array $preset = []): array
    {
        $options = (Api::get('exams', ['per_page' => 1]) ?? [])['filters'] ?? [];
        $catIds = collect($options['categories'] ?? [])->pluck('id', 'name');
        $typeKeys = collect($options['types'] ?? [])->pluck('value', 'label');
        $bodyIds = collect($options['bodies'] ?? [])->pluck('id', 'name');

        $query = $preset + [
            'q' => trim((string) $request->query('search', '')) ?: null,
            'category' => collect((array) $request->query('category', []))->map(fn ($n) => $catIds[$n] ?? null)->filter()->implode(',') ?: null,
            'type' => $typeKeys[(string) $request->query('exam_type')] ?? null,
            'body' => $bodyIds[(string) $request->query('conducting_body_type')] ?? null,
            'featured' => $request->boolean('featured') ? 1 : null,
            'sort' => in_array($request->query('sort'), ['latest', 'name', 'featured'], true) ? $request->query('sort') : 'latest',
            'page' => max(1, (int) $request->query('page', 1)),
            'per_page' => 12,
        ];
        // a filter whose name no longer exists matches nothing (instead of silently showing everything)
        if ($request->filled('category') && !$query['category']) $query['ids'] = '0';
        if ($request->filled('exam_type') && !$query['type']) $query['ids'] = '0';
        if ($request->filled('conducting_body_type') && !$query['body']) $query['ids'] = '0';

        $res = self::list($query);
        $exams = new \Illuminate\Pagination\LengthAwarePaginator($res['items'], (int) ($res['meta']['total'] ?? 0), 12, (int) ($res['meta']['page'] ?? 1),
            ['path' => $request->url(), 'query' => $request->query()]);

        return [
            'exams' => $exams,
            'allCategories' => $catIds->keys()->values(),
            'allExamTypes' => $typeKeys->keys()->values(),
            'allConductingBodyTypes' => $bodyIds->keys()->values(),
        ];
    }

    /**
     * Where an old exam URL (/exam/{old-slug}) should go: [url, status], or null for a 404.
     *  - it means a published exam (by slug, name, short name or alias, also via the old Dynamic Exams / old exams
     *    tables): 301 to /exam/{new-slug}, so links and rankings move to the new page;
     *  - it is a known old exam (old tables, or a menu link) whose exam is not published yet: 302 (temporary) to the
     *    exam listing searched for its name, so visitors do not hit a dead end; it becomes a 301 once published.
     */
    public static function redirectFor(string $slug): ?array
    {
        $words = trim(preg_replace('/-\d{6,}$/', '', $slug));                 // "all-india-law-entrance-test-1787237279"
        $terms = [$slug, str_replace('-', ' ', $words)];
        $names = [];
        foreach (['dynamic_exams', 'exams'] as $table) {
            $row = \Illuminate\Support\Facades\DB::table($table)->where('slug', $slug)->first(['name', 'short_name']);
            if ($row) array_push($names, ...array_filter([$row->name, $row->short_name]));
        }
        $terms = array_values(array_unique(array_merge($terms, $names)));
        $matches = (Api::get('exam-lookup', ['q' => $terms]) ?? [])['matches'] ?? [];
        foreach ($terms as $t) {
            if (!empty($matches[$t]['slug']) && $matches[$t]['slug'] !== $slug) {
                return [route('exam.detail', $matches[$t]['slug']), 301];
            }
        }
        $inMenu = \Illuminate\Support\Facades\DB::table('mega_menus')->where('url', 'like', '%/exam/' . $slug)->first(['title']);
        if ($names || $inMenu) {
            return [route('top-exams', ['search' => $names[1] ?? $names[0] ?? $inMenu->title]), 302];
        }
        return null;
    }
}
