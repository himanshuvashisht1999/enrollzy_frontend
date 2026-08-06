@php
    if (!isset($campuses) || empty($campuses)) {
        $campuses = \App\Models\Campus::with([
            'organisation.organisationType',
            'departments' => function ($q) {
                $q->whereIn('status', [1, '1', 'Active', true]);
            },
            'departments.courses' => function ($q) {
                $q->whereIn('status', [1, '1', 'Active', true])->with(['course', 'programLevel', 'specialization']);
            }
        ])->whereIn('status', [1, '1', 'Active', true])->get();

        if ($campuses->isEmpty()) {
            $campuses = \App\Models\Campus::with(['organisation', 'departments.courses.course'])->get();
        }
    }

    if (!isset($allFacilities) || empty($allFacilities)) {
        $allFacilities = \App\Models\Facility::where('status', 'Active')->get();
    }
@endphp

<!-- Unified Selection Modal -->
<div class="modal fade selection-modal" id="courseSelectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Select Courses to Compare</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="if(window.jQuery){ $('#courseSelectionModal').modal('hide'); } else if(window.bootstrap && bootstrap.Modal){ var m = bootstrap.Modal.getInstance(document.getElementById('courseSelectionModal')); if(m) m.hide(); }"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4 justify-content-center">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-lg-3 col-md-6">
                            <div class="compare-card slot-card-{{ $i }}" data-slot-card="{{ $i }}">
                                <!-- Empty State -->
                                <div class="empty-state" id="empty-state-{{ $i }}">
                                    <button type="button" class="btn btn-outline-dashed w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="switchToEditing({{ $i }})">
                                        <i class="fas fa-plus mb-2 fs-4"></i>
                                        <span class="fw-bold">Add Campus</span>
                                    </button>
                                </div>

                                <!-- Editing State (Dropdowns) -->
                                <div class="editing-state d-none" id="editing-state-{{ $i }}">
                                    <div class="card-top">
                                        <span class="option-tag">OPTION {{ $i }}</span>
                                        <button type="button" class="btn btn-sm btn-link text-muted p-0" onclick="switchToEmpty({{ $i }})"><i class="fas fa-times"></i></button>
                                    </div>

                                    <div class="field">
                                        <label>Campus</label>
                                        <select class="form-select campus-selector" data-slot="{{ $i }}">
                                            <option value="">Select Campus</option>
                                            @foreach ($campuses as $campus)
                                                <option value="{{ $campus->id }}">{{ $campus->campus_name ?? $campus->brand_name ?? $campus->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="field">
                                        <label>Department</label>
                                        <select class="form-select dept-selector" data-slot="{{ $i }}" disabled>
                                            <option value="">Select Department</option>
                                        </select>
                                    </div>

                                    <div class="field mb-0">
                                        <label>Course</label>
                                        <select class="form-select course-selector" data-slot="{{ $i }}" disabled>
                                            <option value="">Select Course</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Filled State -->
                                <div class="filled-state d-none" id="filled-state-{{ $i }}">
                                    <div class="card-top">
                                        <span class="option-tag text-white" style="background: rgba(255, 255, 255, 0.25); padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; display: inline-block;">OPTION {{ $i }}</span>
                                        <div class="filled-actions">
                                            <button class="btn btn-sm btn-link text-white p-0 me-2" onclick="switchToEditing({{ $i }})"><i class="fas fa-pencil-alt"></i></button>
                                            <button class="btn btn-sm btn-link text-white p-0" onclick="switchToEmpty({{ $i }})"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    
                                    <div class="filled-content mt-3 text-white">
                                        <div class="small text-uppercase opacity-75 fw-bold mb-1">Campus</div>
                                        <h5 class="fw-bold mb-3" id="filled-campus-{{ $i }}">Campus Name</h5>
                                        
                                        <div class="small text-uppercase opacity-75 fw-bold mb-1">Department</div>
                                        <div class="fw-bold mb-3" id="filled-dept-{{ $i }}">Dept Name</div>
                                        
                                        <div class="small text-uppercase opacity-75 fw-bold mb-1">Course</div>
                                        <div class="fw-bold" id="filled-course-{{ $i }}">Course Name</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="modal-footer justify-content-center border-top">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" onclick="if(window.jQuery){ $('#courseSelectionModal').modal('hide'); } else if(window.bootstrap && bootstrap.Modal){ var m = bootstrap.Modal.getInstance(document.getElementById('courseSelectionModal')); if(m) m.hide(); }">Cancel</button>
                <button type="button" class="btn btn-primary rounded-pill px-5 shadow-sm" id="confirmSelectionBtn" data-bs-dismiss="modal">Compare Now</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@php
    $maxClassProfileYear = 0;
    $maxPlacementYear = 0;

    $compData = $campuses->mapWithKeys(function($campus) use (&$maxClassProfileYear, &$maxPlacementYear) {
        $cpList = is_array($campus->class_profile) ? $campus->class_profile : [];
        $cp = count($cpList) > 0 ? end($cpList) : [];
        
        $mapped = [$campus->id => [
            'name' => $campus->campus_name,
            'location' => $campus->city . ($campus->state ? ', ' . $campus->state : ''),
            'ownership' => $campus->organisation->ownership_type ?? 'N/A',
            'type_of_institute' => $campus->campus_type ?? 'N/A',
            'college_type' => $campus->organisation->organisationType->title ?? 'N/A',
            'establishment_year' => $campus->established_year ?? 'N/A',
            'campus_size' => $campus->campus_area_acres ? $campus->campus_area_acres . ' Acres' : 'N/A',
            'total_courses_offered' => $campus->departments->flatMap->courses->count(),
            'c360_rank' => 'N/A',
            'c360_rating' => 'N/A',
            'nirf_overall' => $campus->organisation->nirf_rank_overall ?? 'N/A',
            'nirf_category' => $campus->organisation->nirf_rank_category ?? 'N/A',
            'approvals' => is_array($campus->organisation->statutory_approvals) ? implode(', ', $campus->organisation->statutory_approvals) : ($campus->organisation->statutory_approvals ?: 'N/A'),
            'accreditations' => $campus->organisation->naac_accredited ? 'NAAC' . ($campus->organisation->naac_grade ? ' (' . $campus->organisation->naac_grade . ')' : '') : 'N/A',
            'total_students' => $cp['total_students'] ?? 'N/A',
            'total_faculty' => $cp['total_faculty'] ?? 'N/A',
            'total_male_students' => $cp['total_male_students'] ?? 'N/A',
            'total_female_students' => $cp['total_female_students'] ?? 'N/A',
            'total_students_outside_state' => $cp['total_outside_state'] ?? 'N/A',
            'facilities' => is_array($campus->facilities) ? $campus->facilities : [],
            'class_profile_year' => $cp['year'] ?? 'N/A',
            'departments' => $campus->departments->mapWithKeys(function($dept) use (&$maxPlacementYear) {
                $placementStats = is_array($dept->placement_statistics) ? $dept->placement_statistics : [];
                $latestPlacement = count($placementStats) > 0 
                    ? end($placementStats) 
                    : [];
                    
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
                    'courses' => $dept->courses->map(function($c) {
                        return [
                            'id' => $c->id,
                            'name' => $c->course->name ?? 'N/A',
                            'course_credential' => $c->programLevel->name ?? ($c->course->programLevel->name ?? 'N/A'),
                            'degree' => $c->course->name ?? 'N/A',
                            'branch' => $c->specialization->name ?? ($c->course->discipline->name ?? 'N/A'),
                            'duration' => $c->duration ? $c->duration . ' Years' : ($c->course->duration ? $c->course->duration . ' Years' : 'N/A'),
                            'mode' => $c->mode ?? 'N/A',
                            'approved_intake' => $c->student_strength ?? 'N/A',
                            'fees' => $c->total_fees ? '₹ ' . $c->total_fees : ($c->fees ? '₹ ' . $c->fees : 'N/A'),
                            'exams_accepted' => (is_array($c->entrance_exam_ids) && count($c->entrance_exam_ids) > 0) 
                                ? \App\Models\Exam::whereIn('id', $c->entrance_exam_ids)->pluck('name')->implode(', ') 
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
                            'highest_scholarship_authority' => 'N/A'
                        ];
                    })
                ]];
            })
        ]];

        if (isset($cp['year']) && is_numeric($cp['year'])) {
            $maxClassProfileYear = max($maxClassProfileYear, $cp['year']);
        }

        return $mapped;
    });

    $maxClassProfileYear = $maxClassProfileYear ?: 'N/A';
    $maxPlacementYear = $maxPlacementYear ?: 'N/A';
@endphp
<script>
    // Ensure compareModalData is set correctly before compare-modal.js loads
    window.compareModalData = {!! json_encode($compData ?? []) !!};
    window.maxClassProfileYear = @json($maxClassProfileYear);
    window.maxPlacementYear = @json($maxPlacementYear);
</script>
<script src="{{ asset('assets/js/compare-modal.js') }}?v={{ time() }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.jQuery && $.fn.select2) {
            $('.campus-selector, .dept-selector, .course-selector').select2({
                dropdownParent: $('#courseSelectionModal'),
                width: '100%'
            });
            
            $('.campus-selector, .dept-selector, .course-selector').on('select2:select', function (e) {
                this.dispatchEvent(new Event('change'));
            });
        }
    });
</script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/organisation-comparison.css') }}">
@endpush
