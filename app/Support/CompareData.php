<?php

namespace App\Support;

use App\Models\Campus;

/**
 * Data for the "Compare" pop-up and page, built only for the campuses being compared (at most 4) instead of for every
 * campus on every page load. Loading all campuses with all departments and programmes ran out of memory once the
 * database held the full live data (776 campuses, 7,000+ departments, 19,000+ programmes).
 * The shape of each campus entry is exactly what compare-modal.js and compare.blade.php already read.
 */
class CompareData
{
    private const ACTIVE = [1, '1', 'Active', true];

    /** "4" -> "4 Years"; "4 Years" stays as it is (it used to become "4 Years Years"). */
    private static function years($value): string
    {
        $value = trim((string) $value);
        if ($value === '') return 'N/A';
        return is_numeric($value) ? $value . ((float) $value == 1.0 ? ' Year' : ' Years') : $value;
    }

    /** Light list for the "Select Campus" dropdown: id and name only. */
    public static function campusList()
    {
        $list = Campus::whereIn('status', self::ACTIVE)->orderBy('sort_order', 'asc')->orderBy('campus_name', 'asc')->get(['id', 'campus_name']);
        return $list->isEmpty() ? Campus::orderBy('sort_order', 'asc')->orderBy('campus_name', 'asc')->get(['id', 'campus_name']) : $list;
    }

    /** @return array{campuses: array, max_class_profile_year: int|string, max_placement_year: int|string} */
    public static function forCampuses(array $ids): array
    {
        $ids = array_values(array_unique(array_filter(array_map('strval', $ids))));
        if (!$ids) {
            return ['campuses' => [], 'max_class_profile_year' => 'N/A', 'max_placement_year' => 'N/A'];
        }

        $campuses = Campus::with([
            'organisation.organisationType',
            'departments' => fn ($q) => $q->whereIn('status', self::ACTIVE)->orderBy('sort_order', 'asc'),
            'departments.courses' => fn ($q) => $q->whereIn('status', self::ACTIVE)->orderBy('sort_order', 'asc')
                ->with(['course.programLevel', 'course.discipline', 'programLevel', 'specialization', 'entranceExam']),
        ])->whereIn('id', $ids)->get();

        // Exam names for every programme in one query (was one query per programme).
        $examIds = $campuses->flatMap->departments->flatMap->courses
            ->flatMap(fn ($c) => is_array($c->entrance_exam_ids) ? $c->entrance_exam_ids : [])->unique()->values()->all();
        $examNames = $examIds ? \App\Models\Exam::whereIn('id', $examIds)->pluck('name', 'id') : collect();

        $maxClassProfileYear = 0;
        $maxPlacementYear = 0;
        $out = [];
        foreach ($campuses as $campus) {
            $cpList = is_array($campus->class_profile) ? $campus->class_profile : [];
            $cp = count($cpList) > 0 ? end($cpList) : [];
            if (isset($cp['year']) && is_numeric($cp['year'])) {
                $maxClassProfileYear = max($maxClassProfileYear, $cp['year']);
            }
            $org = $campus->organisation;

            $out[$campus->id] = [
                'name' => $campus->campus_name,
                'location' => $campus->city . ($campus->state ? ', ' . $campus->state : ''),
                'ownership' => $org->ownership_type ?? 'N/A',
                'type_of_institute' => $campus->campus_type ?? 'N/A',
                'college_type' => $org->organisationType->title ?? 'N/A',
                'establishment_year' => $campus->established_year ?? 'N/A',
                'campus_size' => $campus->campus_area_acres ? $campus->campus_area_acres . ' Acres' : 'N/A',
                'total_courses_offered' => $campus->departments->flatMap->courses->count(),
                'c360_rank' => 'N/A',
                'c360_rating' => 'N/A',
                'nirf_overall' => $org->nirf_rank_overall ?? 'N/A',
                'nirf_category' => $org->nirf_rank_category ?? 'N/A',
                'approvals' => $org ? (is_array($org->statutory_approvals) ? implode(', ', $org->statutory_approvals) : ($org->statutory_approvals ?: 'N/A')) : 'N/A',
                'accreditations' => ($org && $org->naac_accredited) ? 'NAAC' . ($org->naac_grade ? ' (' . $org->naac_grade . ')' : '') : 'N/A',
                'total_students' => $cp['total_students'] ?? 'N/A',
                'total_faculty' => $cp['total_faculty'] ?? 'N/A',
                'total_male_students' => $cp['total_male_students'] ?? 'N/A',
                'total_female_students' => $cp['total_female_students'] ?? 'N/A',
                'total_students_outside_state' => $cp['total_outside_state'] ?? 'N/A',
                'facilities' => is_array($campus->facilities) ? $campus->facilities : [],
                'class_profile_year' => $cp['year'] ?? 'N/A',
                'departments' => $campus->departments->mapWithKeys(function ($dept) use (&$maxPlacementYear, $examNames) {
                    $placementStats = is_array($dept->placement_statistics) ? $dept->placement_statistics : [];
                    $latestPlacement = count($placementStats) > 0 ? end($placementStats) : [];
                    if (isset($latestPlacement['year']) && is_numeric($latestPlacement['year'])) {
                        $maxPlacementYear = max($maxPlacementYear, $latestPlacement['year']);
                    }
                    $reviewsList = is_array($dept->college_reviews) ? $dept->college_reviews : [];
                    $reviews = count($reviewsList) > 0 ? end($reviewsList) : [];

                    return [$dept->id => [
                        'name' => $dept->department_name,
                        'placement_year' => $latestPlacement['year'] ?? 'N/A',
                        'rating_infrastructure' => $reviews['infrastructure'] ?? 'N/A',
                        'rating_campus_life' => $reviews['campus_life'] ?? 'N/A',
                        'rating_academics' => $reviews['academics'] ?? 'N/A',
                        'rating_placements' => $reviews['placements'] ?? 'N/A',
                        'rating_value_for_money' => $reviews['value_for_money'] ?? 'N/A',
                        'total_reviews' => count($reviewsList) > 0 ? count($reviewsList) : 'N/A',
                        'individual_reviews' => [],
                        'dept_students_placed' => $latestPlacement['dept_students_placed'] ?? 'N/A',
                        'dept_graduating_students' => $latestPlacement['dept_graduating_students'] ?? 'N/A',
                        'dept_placement_percentage' => isset($latestPlacement['dept_placement_percentage']) ? $latestPlacement['dept_placement_percentage'] . '%' : 'N/A',
                        'dept_median_salary' => isset($latestPlacement['dept_median_salary']) ? '₹' . $latestPlacement['dept_median_salary'] . ' LPA' : 'N/A',
                        'dept_higher_studies' => $latestPlacement['dept_higher_studies'] ?? 'N/A',
                        'overall_students_placed' => $latestPlacement['overall_students_placed'] ?? 'N/A',
                        'overall_graduating_students' => $latestPlacement['overall_graduating_students'] ?? 'N/A',
                        'overall_placement_percentage' => isset($latestPlacement['overall_placement_percentage']) ? $latestPlacement['overall_placement_percentage'] . '%' : 'N/A',
                        'overall_median_salary' => isset($latestPlacement['overall_median_salary']) ? '₹' . $latestPlacement['overall_median_salary'] . ' LPA' : 'N/A',
                        'overall_higher_studies' => $latestPlacement['overall_higher_studies'] ?? 'N/A',
                        'courses' => $dept->courses->map(fn ($c) => [
                            'id' => $c->id,
                            'name' => $c->course->name ?? 'N/A',
                            'course_credential' => $c->programLevel->title ?? ($c->course->programLevel->title ?? 'N/A'),   // these masters use "title"
                            'degree' => $c->course->name ?? 'N/A',
                            'branch' => $c->specialization->title ?? ($c->course->discipline->title ?? 'N/A'),
                            'duration' => self::years($c->duration ?: ($c->course->duration ?? null)),
                            'mode' => $c->mode ?? 'N/A',
                            'approved_intake' => $c->student_strength ?? 'N/A',
                            'fees' => $c->total_fees ? '₹ ' . $c->total_fees : ($c->fees ? '₹ ' . $c->fees : 'N/A'),
                            'exams_accepted' => (is_array($c->entrance_exam_ids) && count($c->entrance_exam_ids) > 0)
                                ? collect($c->entrance_exam_ids)->map(fn ($id) => $examNames[$id] ?? null)->filter()->implode(', ')
                                : ($c->entranceExam->name ?? 'N/A'),
                            'course_approval' => 'N/A',
                            'admission_details' => strip_tags($c->admission_process ?? '') ?: 'N/A',
                            'eligibility_criteria' => strip_tags($c->eligibility ?? '') ?: 'N/A',
                            'fees_structure' => strip_tags($c->fees_structure ?? '') ?: 'N/A',
                            'curriculum' => strip_tags($c->curriculum ?? '') ?: 'N/A',
                            'career_prospects' => strip_tags($c->career_prospects ?? '') ?: 'N/A',
                            'placement_details' => strip_tags($c->placement_details ?? '') ?: 'N/A',
                            'industrial_collaboration' => strip_tags($c->industrial_collaboration ?? '') ?: 'N/A',
                            'internship_ranking' => strip_tags($c->internship_ranking ?? '') ?: 'N/A',
                            'total_scholarships' => 'N/A',
                            'highest_scholarship_authority' => 'N/A',
                        ])->values(),
                    ]];
                }),
            ];
        }

        return ['campuses' => $out, 'max_class_profile_year' => $maxClassProfileYear ?: 'N/A', 'max_placement_year' => $maxPlacementYear ?: 'N/A'];
    }
}
