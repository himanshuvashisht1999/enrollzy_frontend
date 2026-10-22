<?php

namespace App\Support\University;

use App\Models\Organisation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Everything the university pages show, built once per university and cached (the cache key changes whenever the
 * university, a campus, a department or a programme is edited).
 *
 * Model (client design "University page v2"): a PROGRAMME (a course, e.g. B.Tech CSE) has OFFERINGS (programme x campus,
 * or online). Each offering has its own fee, seats, hostel, eligibility, placements and cutoffs. "Campus" is a page-wide
 * scope: every section can be narrowed to one or more campuses.
 *
 * All values are plain arrays, so a section with no data can simply be left out.
 */
class UniversityData
{
    public array $org = [];
    /** @var Collection<string, array> campuses keyed by id */
    public Collection $campuses;
    /** @var Collection<int, array> on-campus and online offerings */
    public Collection $offerings;
    /** @var Collection<string, array> departments keyed by id */
    public Collection $departments;
    public array $quality = [];
    public array $colleges = [];

    public static function load(string $slug): ?self
    {
        $org = Organisation::where('slug', $slug)->where('organisation_type_id', 1)->where('status', 1)->first();
        if (!$org) return null;

        $stamp = implode('|', [
            $org->updated_at,
            DB::table('campuses')->where('organisation_id', $org->id)->max('updated_at'),
            DB::table('organisation_courses')->where('organisation_id', $org->id)->max('updated_at'),
            DB::table('departments')->where('organisation_id', $org->id)->max('updated_at'),
        ]);
        $raw = Cache::remember('uni-page:v8:' . $org->id . ':' . md5($stamp), 600, fn () => (new self())->build($org));

        $d = new self();
        foreach ($raw as $k => $v) {
            $d->{$k} = in_array($k, ['campuses', 'offerings', 'departments'], true) ? collect($v) : $v;
        }
        return $d;
    }

    // ------------------------------------------------------------------ building

    private function build(Organisation $o): array
    {
        $list = fn ($v) => is_array($v) ? $v : (json_decode((string) $v, true) ?: []);

        // ---- campuses
        $campusRows = DB::table('campuses')->where('organisation_id', $o->id)->whereNull('deleted_at')
            ->whereIn('status', [1, '1', 'Active', 'active'])->orderBy('sort_order')->orderBy('campus_name')->get();
        if ($campusRows->isEmpty()) {
            $campusRows = DB::table('campuses')->where('organisation_id', $o->id)->whereNull('deleted_at')->orderBy('sort_order')->orderBy('campus_name')->get();
        }
        // main campus: marked as main in the CRM, else named "main", else named like the university, else in the headquarters city, else the first
        $hq = Str::lower((string) $o->head_office_location);
        $mainId = optional($campusRows->first(fn ($c) => $c->campus_role === 'main'))->id
            ?? optional($campusRows->first(fn ($c) => Str::contains(Str::lower($c->campus_name), 'main')))->id
            ?? optional($campusRows->first(fn ($c) => Str::lower(trim($c->campus_name)) === Str::lower(trim($o->name))))->id
            ?? optional($campusRows->first(fn ($c) => $c->city && $hq !== '' && Str::contains($hq, Str::lower(trim($c->city)))))->id
            ?? optional($campusRows->first())->id;

        $campuses = $campusRows->map(function ($c) use ($list, $mainId, $o) {
            $profile = collect($list($c->class_profile))->filter(fn ($p) => !empty($p['total_students']))->sortByDesc('year')->first();
            return [
                'id' => $c->id, 'slug' => $c->slug, 'name' => self::campusLabel($c->campus_name, $o, $c->city), 'full_name' => trim($c->campus_name), 'city' => trim((string) $c->city), 'state' => trim((string) $c->state),
                'main' => $c->id === $mainId, 'type' => $c->campus_type, 'established' => $c->established_year,
                'address' => trim(implode(', ', array_filter([$c->full_address, $c->pincode ? 'PIN ' . $c->pincode : null]))),
                'map' => $c->google_map_url, 'transport' => $c->nearest_transport_hub, 'landmark' => $c->nearest_landmark,
                'area' => self::num($c->campus_area_acres), 'area_unit' => $c->campus_area_unit ?: 'acres',
                'students' => self::num($profile['total_students'] ?? null) ?: self::num($c->total_enrolled_students),
                'hostel' => (bool) $c->hostel_available, 'hostel_type' => $c->hostel_type, 'hostel_capacity' => self::num($c->hostel_capacity),
                'infra' => array_filter([
                    'Academic blocks' => self::num($c->academic_blocks_count), 'Classrooms' => self::num($c->classrooms_count),
                    'Smart classrooms' => $c->smart_classrooms ? 'Yes' : null, 'Labs' => self::num($c->laboratories_count),
                    'Research centres' => self::num($c->research_centers_count), 'Library books' => self::num($c->library_books_count),
                    'Digital library' => $c->digital_library_access ? 'Yes' : null,
                ]),
                'safety' => array_filter([
                    'Bus service' . ($c->bus_routes_count ? ' · ' . $c->bus_routes_count . ' routes' : '') . ($c->bus_fleet_size ? ' · ' . $c->bus_fleet_size . ' buses' : '') => $c->transport_available ? true : null,
                    'GPS on buses' => $c->gps_enabled_buses ? true : null, 'Parking' => $c->parking_available ? true : null,
                    'CCTV' => $c->cctv_coverage ? true : null, ($c->security_staff_count ? $c->security_staff_count . ' security staff' : 'Security staff') => $c->security_staff_count ? true : null,
                    'Fire safety certified' => $c->fire_safety_certified ? true : null, 'Visitor management system' => $c->visitor_management_system ? true : null,
                    'Medical facility' => $c->medical_facility_available ? true : null, 'Food / cafeteria' => $c->food_facility ? true : null,
                ]),
                'facilities' => array_values(array_filter(array_map(fn ($f) => is_array($f) ? ($f['name'] ?? $f['title'] ?? null) : $f, $list($c->facilities)))),
                'sports' => array_values(array_filter((array) $list($c->sports_facilities))),
                'email' => $c->campus_email, 'phone' => $c->campus_contact_numbers, 'website' => $c->campus_website,
                'faqs' => collect($list($c->faqs))->map(fn ($f) => ['q' => $f['question'] ?? $f['q'] ?? null, 'a' => $f['answer'] ?? $f['a'] ?? null])->filter(fn ($f) => $f['q'] && $f['a'])->values()->all(),
            ];
        })->keyBy('id');

        // ---- departments (per campus)
        $departments = DB::table('departments')->where('organisation_id', $o->id)->whereNull('deleted_at')->get()->map(function ($d) use ($list) {
            return [
                'id' => $d->id, 'campus_id' => $d->campus_id, 'name' => trim((string) $d->department_name), 'code' => $d->department_code,
                'faculty' => self::num($d->faculty_count), 'phd' => (bool) $d->phd_supervision_available, 'labs' => self::num($d->department_labs_count),
                'pubs' => self::num($d->research_publications_count), 'patents' => self::num($d->patents_filed_count), 'projects' => self::num($d->funded_projects_count),
                'hod' => $d->head_of_department_name, 'established' => $d->established_year,
                'placements' => self::deptPlacements($list($d->placement_statistics)),
            ];
        })->keyBy('id');

        // ---- programmes and offerings
        $names = fn (string $table, string $col = 'title') => DB::table($table)->pluck($col, 'id')->all();
        $levels = $names('program_levels');
        $streams = $names('stream_offereds');
        $disciplines = $names('disciplines');
        $specs = $names('specializations');
        $oldExams = DB::table('exams')->get(['id', 'name', 'short_name', 'slug'])->keyBy('id');

        $rows = DB::table('organisation_courses as oc')->join('courses as c', 'c.id', '=', 'oc.course_id')
            ->where('oc.organisation_id', $o->id)->whereIn('oc.status', [1, '1', 'Active', 'active'])
            ->select('oc.*', 'c.name as course_name', 'c.slug as course_slug', 'c.duration as course_duration', 'c.program_level_id as course_level_id', 'c.discipline_id as course_discipline_id')
            ->orderBy('oc.sort_order')->orderBy('c.name')->get();

        $offerings = $rows->map(function ($r) use ($campuses, $levels, $streams, $disciplines, $specs, $oldExams, $list) {
            $years = self::years($r->duration ?: $r->course_duration);
            $annual = self::annualFee($r->fees, $r->total_fees, $years);
            $total = (float) $r->total_fees > 0 ? (float) $r->total_fees : ($annual && $years ? $annual * $years : null);
            $online = (bool) preg_match('/online|distance|odl/i', ($r->mode ?? '') . ' ' . ($r->delivery_mode ?? '') . ' ' . $r->course_name);
            $examIds = array_filter(array_merge($list($r->entrance_exam_ids), [$r->entrance_exam_id]));
            $exams = collect($examIds)->map(fn ($id) => $oldExams[$id] ?? null)->filter()->unique('id')
                ->map(fn ($e) => ['name' => $e->short_name ?: $e->name, 'slug' => $e->slug])->values()->all();
            $levelTitle = $levels[$r->program_level_id ?: $r->course_level_id] ?? null;
            return [
                'id' => $r->id, 'course_id' => $r->course_id, 'slug' => $r->course_slug ?: Str::slug($r->course_name) . '-' . $r->course_id,
                'name' => trim($r->course_name), 'level' => self::shortLevel($levelTitle), 'level_title' => $levelTitle,
                'stream' => $streams[$r->stream_offered_id] ?? $disciplines[$r->discipline_id ?: $r->course_discipline_id] ?? 'Other',
                'years' => $years, 'online' => $online, 'mode' => $r->mode ?: ($online ? 'Online' : 'Full time'),
                'campus_id' => $campuses->has($r->campus_id) ? $r->campus_id : null, 'department_id' => $r->department_id,
                'annual_fee' => $annual, 'total_fee' => $total, 'fee_text' => $r->fees, 'seats' => self::num($r->student_strength),
                'hostel_fee' => (float) $r->hostel_fee > 0 ? (float) $r->hostel_fee : null,
                'exams' => $exams, 'eligibility' => self::text($r->eligibility), 'admission' => self::text($r->admission_process),
                'fee_structure' => self::text($r->fees_structure), 'curriculum' => self::text($r->curriculum), 'careers' => self::text($r->career_prospects),
                'specializations' => collect(array_merge($list($r->specialization_ids), [$r->specialization_id]))->filter()->map(fn ($id) => $specs[$id] ?? null)->filter()->unique()->values()->all(),
                'scholarship' => (bool) $r->scholarship_available, 'lateral' => null,
            ];
        })->filter(fn ($x) => $x['online'] || $x['campus_id'])->values();

        // ---- quality records (rankings, accreditation, approvals, placements, reviews)
        $ids = ['organisation' => [(string) $o->id], 'campus' => $campuses->keys()->map(fn ($k) => (string) $k)->all(),
            'department' => $departments->keys()->map(fn ($k) => (string) $k)->all(), 'course' => $offerings->pluck('id')->map(fn ($k) => (string) $k)->all()];
        $of = function (string $table) use ($ids) {
            return DB::table($table)->whereNull('deleted_at')->where('verification_status', '!=', 'rejected')
                ->where(function ($w) use ($ids) { foreach ($ids as $t => $list) if ($list) $w->orWhere(fn ($q) => $q->where('entity_type', $t)->whereIn('entity_id', $list)); });
        };
        $rankings = $of('entity_rankings')->where('entity_type', 'organisation')
            ->leftJoin('ranking_bodies as b', 'b.id', '=', 'entity_rankings.ranking_body_id')->leftJoin('ranking_categories as c', 'c.id', '=', 'entity_rankings.ranking_category_id')
            ->orderByDesc('ranking_year')->get(['b.short_name as body', 'b.name as body_name', 'c.name as category', 'ranking_year', 'rank_exact', 'rank_band_from', 'rank_band_to', 'verification_status'])
            ->map(fn ($r) => ['body' => $r->body ?: $r->body_name, 'category' => ($r->category && !Str::contains(Str::lower($r->category), 'unspecified')) ? $r->category : 'Category not stated', 'year' => $r->ranking_year,
                'rank' => $r->rank_exact ? '#' . $r->rank_exact : ($r->rank_band_from ? '#' . $r->rank_band_from . '–' . $r->rank_band_to : null), 'verified' => $r->verification_status === 'verified'])
            ->filter(fn ($r) => $r['rank'])->values()->all();
        $accreditations = $of('entity_accreditations')->where('entity_type', 'organisation')->whereIn('entity_accreditations.status', ['active', 'applied'])
            ->join('accreditation_bodies as b', 'b.id', '=', 'entity_accreditations.accreditation_body_id')
            ->get(['b.short_name as body', 'grade', 'entity_accreditations.status', 'valid_to', 'verification_status'])
            ->map(fn ($a) => ['body' => $a->body, 'grade' => $a->grade, 'applied' => $a->status === 'applied', 'verified' => $a->verification_status === 'verified'])->values()->all();
        // a record without a grade (UGC, AICTE...) is a recognition, listed with the approvals
        $ungraded = collect($accreditations)->filter(fn ($a) => !$a['grade'])->pluck('body')->all();
        $accreditations = collect($accreditations)->filter(fn ($a) => $a['grade'])->values()->all();
        $approvalRows = $of('entity_approvals')->where('entity_type', 'organisation')->where('entity_approvals.status', 'active')
            ->join('accreditation_bodies as b', 'b.id', '=', 'entity_approvals.accreditation_body_id')->distinct()->pluck('b.short_name')->filter()->values()->all();
        $placements = $of('entity_placements')->orderByDesc('academic_year')->get()->map(fn ($p) => [
            'entity_type' => $p->entity_type, 'entity_id' => $p->entity_id, 'year' => $p->academic_year,
            'graduating' => self::num($p->students_graduating), 'placed' => self::num($p->students_placed),
            'pct' => self::pct($p->students_placed, $p->students_graduating),
            'median' => self::num($p->median_salary), 'average' => self::num($p->average_salary), 'highest' => self::num($p->highest_salary),
            'recruiters' => self::num($p->recruiters_count), 'verified' => $p->verification_status === 'verified',
        ])->all();
        $reviews = $of('entity_reviews')->where('is_published', true)->orderByDesc('reviewed_on')->orderByDesc('id')->get()->map(fn ($r) => [
            'entity_type' => $r->entity_type, 'entity_id' => $r->entity_id, 'name' => $r->reviewer_name, 'type' => $r->reviewer_type,
            'rating' => self::num($r->rating), 'academics' => self::num($r->academics), 'placements' => self::num($r->placements), 'campus_life' => self::num($r->campus_life),
            'infrastructure' => self::num($r->infrastructure), 'value' => self::num($r->value_for_money),
            'title' => $r->title, 'comment' => $r->comment, 'year' => $r->review_year, 'verified' => $r->verification_status === 'verified',
        ])->all();

        // legacy values when there is no quality record yet
        if (!$accreditations && $o->naac_grade) $accreditations[] = ['body' => 'NAAC', 'grade' => $o->naac_grade, 'applied' => false, 'verified' => false];
        if (!$rankings && $o->nirf_rank_overall) $rankings[] = ['body' => 'NIRF', 'category' => 'Overall', 'year' => null, 'rank' => '#' . preg_replace('/^#/', '', $o->nirf_rank_overall), 'verified' => false];
        $approvals = array_values(array_unique(array_merge($ungraded, $approvalRows)));
        if (!$approvals) $approvals = array_slice(array_values(array_filter(array_map(fn ($a) => trim(preg_replace('/\s*\(.*?\)/', '', $a)), is_array($o->statutory_approvals) ? $o->statutory_approvals : explode(',', (string) $o->statutory_approvals)), fn ($a) => $a !== '' && strlen($a) <= 40)), 0, 8);

        // colleges under this university
        $children = Organisation::where('organisation_type_id', 2)->where('status', 1)->where('university_id', $o->id)->orderBy('name')->get();

        $states = $campuses->pluck('state')->filter()->unique()->values();
        return [
            'org' => [
                'id' => $o->id, 'name' => $o->name, 'slug' => $o->slug, 'short' => $o->short_name ?: $o->abbreviation ?: $o->brand_name,
                'brand' => $o->brand_name, 'logo' => $o->logo_url ? (Str::startsWith($o->logo_url, 'http') ? $o->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($o->logo_url, '/')) : null,
                'about' => self::text($o->about_university ?: $o->about_organisation), 'hq' => $o->head_office_location,
                'type' => $o->university_type, 'ownership' => $o->ownership_type, 'established' => $o->established_year,
                'category' => $o->university_category, 'autonomous' => $o->autonomous_status, 'trust' => $o->managing_trust_or_society_name ?: $o->governing_body_name,
                'degree_by' => $o->degree_awarding_authority, 'chancellor' => $o->chancellor_name, 'vc' => $o->vice_chancellor_name,
                'international' => array_values(array_filter((array) (is_array($o->international_accreditations) ? $o->international_accreditations : json_decode((string) $o->international_accreditations, true)))),
                'constituent' => self::num($o->number_of_constituent_colleges), 'affiliated' => self::num($o->number_of_affiliated_colleges),
                'website' => $o->official_website, 'admission_portal' => $o->admission_portal_url, 'student_portal' => $o->student_portal_url,
                'states' => $states->all(),
            ],
            'campuses' => $campuses->all(),
            'offerings' => $offerings->all(),
            'departments' => $departments->all(),
            'quality' => compact('rankings', 'accreditations', 'approvals', 'placements', 'reviews'),
            // colleges have no page on the website yet
            'colleges' => $children->map(fn ($c) => ['name' => $c->name, 'place' => $c->head_office_location])->all(),
        ];
    }

    // ------------------------------------------------------------------ queries used by the pages

    public function campus(?string $id): ?array
    {
        return $id ? $this->campuses->get($id) : null;
    }

    public function campusBySlug(?string $slug): ?array
    {
        return $slug ? $this->campuses->first(fn ($c) => $c['slug'] === $slug) : null;
    }

    public function mainCampus(): ?array
    {
        return $this->campuses->first(fn ($c) => $c['main']) ?? $this->campuses->first();
    }

    /** On-campus offerings, optionally only at some campuses. */
    public function onCampus(?array $campusIds = null): Collection
    {
        return $this->offerings->filter(fn ($o) => !$o['online'] && (!$campusIds || in_array($o['campus_id'], $campusIds, true)))->values();
    }

    public function online(): Collection
    {
        return $this->offerings->filter(fn ($o) => $o['online'])->unique('course_id')->values();
    }

    /** Programme summaries (one per course) from a set of offerings: fee range, campuses, seats. */
    public function programmes(Collection $offerings): Collection
    {
        return $offerings->groupBy('course_id')->map(function ($os) {
            $first = $os->first();
            $fees = $os->pluck('annual_fee')->filter();
            return $first + [
                'offerings' => $os->values()->all(), 'n' => $os->pluck('campus_id')->unique()->count(),
                'fee_min' => $fees->min(), 'fee_max' => $fees->max(),
                'seats_total' => $os->sum(fn ($o) => $o['seats'] ?? 0) ?: null,
                'has_online' => $this->online()->contains('course_id', $first['course_id']),
                'exam_text' => collect($os->pluck('exams')->flatten(1))->pluck('name')->unique()->implode(' / ') ?: null,
            ];
        })->values();
    }

    public function programmeBySlug(string $slug): ?array
    {
        $os = $this->offerings->filter(fn ($o) => $o['slug'] === $slug);
        if ($os->isEmpty()) return null;
        $campus = $os->reject(fn ($o) => $o['online']);
        return ['name' => $os->first()['name'], 'course_id' => $os->first()['course_id'], 'slug' => $slug, 'first' => $os->first(),
            'campus' => $campus->values(), 'online' => $os->first(fn ($o) => $o['online'])];
    }

    /** Departments, per campus or summed for the whole university (same name = same department). */
    public function departmentsFor(?string $campusId): Collection
    {
        $ds = $this->departments->filter(fn ($d) => !$campusId || $d['campus_id'] === $campusId);
        return $ds->groupBy(fn ($d) => Str::lower($d['name']))->map(function ($g) use ($campusId) {
            $f = $g->first();
            $sum = fn ($k) => $g->sum(fn ($d) => $d[$k] ?? 0) ?: null;
            return ['name' => $f['name'], 'code' => $f['code'], 'faculty' => $sum('faculty'), 'labs' => $sum('labs'), 'pubs' => $sum('pubs'),
                'patents' => $sum('patents'), 'projects' => $sum('projects'), 'phd' => $g->contains('phd', true),
                'hod' => $g->pluck('hod')->filter()->first(), 'campuses' => $g->pluck('campus_id')->unique()->count(), 'ids' => $g->pluck('id')->all(), 'scoped' => (bool) $campusId];
        })->sortByDesc(fn ($d) => $d['faculty'] ?? 0)->values();
    }

    /** Latest placement record for an entity: quality record first, else the department's own figures. */
    public function placementFor(string $type, $id): ?array
    {
        $rec = collect($this->quality['placements'])->first(fn ($p) => $p['entity_type'] === $type && (string) $p['entity_id'] === (string) $id && ($p['median'] || $p['pct'] || $p['average']));
        if ($rec) return $rec;
        if ($type === 'department') return collect($this->departments->get($id)['placements'] ?? [])->first();
        return null;
    }

    /** All years of placement records for an entity (newest first). */
    public function placementYears(string $type, $id): array
    {
        $rec = collect($this->quality['placements'])->filter(fn ($p) => $p['entity_type'] === $type && (string) $p['entity_id'] === (string) $id)->values();
        if ($rec->isNotEmpty() || $type !== 'department') return $rec->all();
        return $this->departments->get($id)['placements'] ?? [];
    }

    /** University-wide placement summary: the university's own record, else the latest department "overall" figures. */
    public function universityPlacement(): ?array
    {
        return $this->placementFor('organisation', $this->org['id'])
            ?? $this->departments->flatMap(fn ($d) => collect($d['placements'])->where('scope', 'overall'))->sortByDesc('year')->first();
    }

    /** Campus placement summary: the campus record, else the median of its departments' latest figures. */
    public function campusPlacement(string $campusId): ?array
    {
        if ($p = $this->placementFor('campus', $campusId)) return $p;
        $ps = $this->departments->where('campus_id', $campusId)->map(fn ($d) => collect($d['placements'])->firstWhere('scope', 'department'))->filter();
        if ($ps->isEmpty()) return null;
        return ['year' => $ps->pluck('year')->filter()->max(), 'pct' => self::avg($ps->pluck('pct')), 'median' => self::avg($ps->pluck('median')),
            'average' => self::avg($ps->pluck('average')), 'highest' => $ps->pluck('highest')->filter()->max(), 'placed' => $ps->sum('placed') ?: null, 'recruiters' => null, 'verified' => false];
    }

    /** Placement for one offering (course x campus): its own record, else its department's. */
    public function offeringPlacement(array $o): ?array
    {
        return $this->placementFor('course', $o['id']) ?? ($o['department_id'] ? collect($this->departments->get($o['department_id'])['placements'] ?? [])->firstWhere('scope', 'department') : null);
    }

    /** Any placement figure anywhere in the university (else the Placements section and tab are left out). */
    public function hasPlacements(): bool
    {
        return collect($this->quality['placements'])->contains(fn ($p) => $p['median'] || $p['pct'] || $p['average'])
            || $this->departments->contains(fn ($d) => !empty($d['placements']));
    }

    public function hasReviews(): bool
    {
        return !empty($this->quality['reviews']);
    }

    /** Reviews for the university (all of it) or for some campuses: average rating, per-aspect averages, count, latest. */
    public function reviews(?array $campusIds = null, ?string $offeringId = null): array
    {
        $deptCampus = $this->departments->mapWithKeys(fn ($d) => [(string) $d['id'] => $d['campus_id']]);
        $offCampus = $this->offerings->mapWithKeys(fn ($o) => [(string) $o['id'] => $o['campus_id']]);
        $rs = collect($this->quality['reviews'])->filter(function ($r) use ($campusIds, $deptCampus, $offCampus, $offeringId) {
            if ($offeringId) return $r['entity_type'] === 'course' && (string) $r['entity_id'] === (string) $offeringId;
            if (!$campusIds) return true;
            $cid = match ($r['entity_type']) { 'campus' => $r['entity_id'], 'department' => $deptCampus[(string) $r['entity_id']] ?? null, 'course' => $offCampus[(string) $r['entity_id']] ?? null, default => null };
            return $cid && in_array($cid, $campusIds, true);
        })->values();
        if ($rs->isEmpty()) return ['count' => 0, 'rating' => null, 'aspects' => [], 'latest' => []];
        $aspects = collect(['Academics' => 'academics', 'Placements' => 'placements', 'Campus life' => 'campus_life', 'Infrastructure' => 'infrastructure', 'Value for money' => 'value'])
            ->map(fn ($k) => self::avg($rs->pluck($k)))->filter()->all();
        return ['count' => $rs->count(), 'rating' => self::avg($rs->pluck('rating')), 'aspects' => $aspects, 'latest' => $rs->filter(fn ($r) => $r['comment'] || $r['title'])->take(3)->values()->all()];
    }

    // ------------------------------------------------------------------ helpers

    public static function num($v): ?float
    {
        if ($v === null || $v === '' || $v === false) return null;
        if (is_numeric($v)) return (float) $v > 0 ? (float) $v : null;
        $n = (float) preg_replace('/[^\d.]/', '', (string) $v);
        return $n > 0 ? $n : null;
    }

    private static function avg(Collection $c): ?float
    {
        $c = $c->filter(fn ($v) => $v !== null && $v > 0);
        return $c->isEmpty() ? null : round($c->avg(), 1);
    }

    private static function pct($placed, $graduating): ?float
    {
        $p = self::num($placed);
        $g = self::num($graduating);
        return $p && $g ? min(100, round($p / $g * 100)) : null;
    }

    public static function years($v): ?float
    {
        $s = Str::lower(trim((string) $v));
        if ($s === '') return null;
        if (!preg_match('/(\d+(?:\.\d+)?)/', $s, $m)) return null;
        $n = (float) $m[1];
        if (Str::contains($s, 'month')) $n = $n / 12;
        if (Str::contains($s, 'sem')) $n = $n / 2;
        return $n > 0 && $n <= 7 ? round($n, 1) : null;
    }

    /** Yearly fee from the "fees" text ("₹ 1,75,000 / Year", "1.5 Lakh per semester", "Total ₹6,00,000") or total ÷ years. */
    public static function annualFee($text, $total, $years): ?float
    {
        $t = Str::lower((string) $text);
        if (preg_match('/(\d[\d,]*(?:\.\d+)?)\s*(lakh|lac|l\b)?/', $t, $m)) {
            $n = (float) str_replace(',', '', $m[1]);
            if (!empty($m[2])) $n *= 100000;
            if ($n >= 1000) {
                if (Str::contains($t, 'sem')) return $n * 2;
                if (Str::contains($t, 'month')) return $n * 12;
                if (Str::contains($t, ['total', 'full course', 'entire', 'programme fee', 'program fee']) && $years) return round($n / $years);
                return $n;
            }
        }
        return (float) $total > 0 && $years ? round((float) $total / $years) : null;
    }

    /**
     * "Amrita Vishwa Vidyapeetham - Bengaluru Campus" -> "Bengaluru Campus" (the university name is already on the page).
     * A campus named just like the university ("Amrita Vishwa Vidyapeetham", "Andra University") -> "Amritanagar campus".
     */
    public static function campusLabel(string $name, Organisation $o, ?string $city = null): string
    {
        $name = trim($name);
        $norm = fn ($s) => preg_replace('/[^a-z0-9]/', '', Str::lower((string) $s));
        $n = $norm(preg_replace('/\s*\(\s*[A-Za-z.]{2,8}\s*\)$/', '', $name));   // "... (MAHE)" is still the university's name
        foreach (array_filter([$o->name, $o->short_name]) as $uni) {
            $u = $norm($uni);
            similar_text($n, $u, $pct);
            if ($n !== '' && (Str::startsWith($u, $n) || ($pct >= 90 && abs(strlen($n) - strlen($u)) <= 3))) {
                return trim((string) $city) !== '' ? trim($city) . ' campus' : 'Main campus';
            }
        }
        $prefixes = collect([$o->name, $o->short_name, $o->abbreviation, $o->brand_name])->filter()->map(fn ($p) => trim($p))->sortByDesc(fn ($p) => mb_strlen($p));
        foreach ($prefixes as $prefix) {
            // only when a separator follows ("Amrita - Kochi Campus"), never mid-name ("Amrita Vishwa Vidyapeetham")
            // or a plain space when the rest says "campus" ("NMIMS Bengaluru Campus")
            if (preg_match('/^' . preg_quote(trim($prefix), '/') . '\s*([-–—,:|]|\()\s*(.+)$/iu', $name, $m)
                || preg_match('/^' . preg_quote(trim($prefix), '/') . '(\s)\s*(.*\bcampus\b.*)$/iu', $name, $m)) {
                $rest = preg_replace('/[\s\-–—,:|]+$/u', '', $m[2]);
                // "Uni (SLIET) Main Campus" -> "Main Campus"; "Uni (Mumbai)" -> "Mumbai"
                if ($m[1] === '(' && preg_match('/^[^()]*\)\s*(\S.*)$/u', $rest, $after)) $rest = $after[1];
                elseif ($m[1] === '(' && !str_contains($rest, '(')) $rest = preg_replace('/\)$/', '', $rest);
                if (mb_strlen(trim(preg_replace('/\bcampus\b/iu', '', $rest))) >= 3) return $rest;
            }
        }
        return $name;
    }

    public static function shortLevel(?string $title): ?string
    {
        if (!$title) return null;
        if (preg_match('/\(([^)]+)\)/', $title, $m)) return $m[1];
        return match (true) { Str::contains(Str::lower($title), 'under') => 'UG', Str::contains(Str::lower($title), 'post') => 'PG', default => $title };
    }

    public static function text($v): ?string
    {
        $t = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags(str_replace(['</p>', '<br>', '<br/>', '<br />', '</li>'], "\n", (string) $v)))));
        return $t !== '' ? $t : null;
    }

    /** Department placement JSON -> records with a year and at least one figure. "overall_*" figures are kept as university-wide. */
    private static function deptPlacements(array $rows): array
    {
        $out = [];
        foreach ($rows as $r) {
            if (!is_array($r) || empty($r['year'])) continue;
            foreach (['dept' => 'department', 'overall' => 'overall'] as $p => $scope) {
                $rec = ['scope' => $scope, 'year' => $r['year'], 'graduating' => self::num($r[$p . '_graduating_students'] ?? null), 'placed' => self::num($r[$p . '_students_placed'] ?? null),
                    'pct' => self::num($r[$p . '_placement_percentage'] ?? null) ?? self::pct($r[$p . '_students_placed'] ?? null, $r[$p . '_graduating_students'] ?? null),
                    'median' => self::num($r[$p . '_median_salary'] ?? null), 'average' => null, 'highest' => null,
                    'higher_studies' => self::num($r[$p . '_higher_studies'] ?? null), 'recruiters' => null, 'verified' => false];
                if ($rec['pct'] || $rec['median'] || $rec['placed']) $out[] = $rec;
            }
        }
        return collect($out)->sortByDesc('year')->values()->all();
    }

    // formatting
    public static function inr($n): string
    {
        if (!$n) return '–';
        $int = (string) (int) round($n);
        if (strlen($int) > 3) $int = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', substr($int, 0, -3)) . ',' . substr($int, -3);
        return '₹' . $int;
    }

    public static function lakh($n): string
    {
        if (!$n) return '–';
        return $n >= 100000 ? '₹' . rtrim(rtrim(number_format($n / 100000, 2), '0'), '.') . ' L' : self::inr($n);
    }

    /** Salary in rupees -> "₹6.5 LPA" (values already under 1,000 are taken as LPA). */
    public static function lpa($n): string
    {
        if (!$n) return '–';
        $l = $n >= 1000 ? $n / 100000 : $n;
        return '₹' . rtrim(rtrim(number_format($l, 1), '0'), '.') . ' LPA';
    }

    public static function feeRange(?float $min, ?float $max): string
    {
        if (!$min) return 'Fee on request';
        return $min == $max ? self::inr($min) : self::lakh($min) . ' – ' . self::lakh($max);
    }
}
