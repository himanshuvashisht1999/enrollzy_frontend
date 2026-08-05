@extends('layouts.app')

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

@section('title', 'Compare Campuses & Courses')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/organisation-comparison.css') }}">
@endpush

@section('content')
    <div class="breadcrumb-area py-4 bg-light">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="fw-bold mb-0 fs-3">Compare Courses</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Compare</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="compare-section">
        <div class="container">
            <div class="text-center mb-3">
                <h2 class="fw-bold">Make an Informed Decision</h2>
                <p class="text-muted">Select up to 4 courses from different campuses and departments to compare them side-by-side.</p>
            </div>

            <div class="text-center mb-3">
                <button type="button" id="btnOpenCompareModal" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" data-bs-toggle="modal" data-bs-target="#courseSelectionModal">
                    <i class="fas fa-layer-group me-2"></i> SELECT COURSES TO COMPARE
                </button>
            </div>

            <!-- Comparison Matrix -->
            <div id="comparisonResults" class="comparison-matrix-wrapper d-none mt-3 p-3">
                <div class="table-responsive">
                    <table class="table comparison-matrix-table mb-0">
                        <thead>
                            <tr id="matrixHead">
                                <th class="params-column py-4 ps-4">
                                    <div class="fs-5 fw-bold text-dark">Comparison</div>
                                    <div class="small text-muted fw-normal">Key Performance Indicators</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="matrixBody"></tbody>
                    </table>
                </div>
                <div class="text-center py-4 bg-light border-top mt-3">
                    <button id="resetComparison" class="btn btn-dark rounded-pill px-5 py-2 shadow-sm">
                        <i class="fas fa-undo me-2"></i> Reset Comparison
                    </button>
                </div>
            </div>

            <div id="emptyMessage" class="text-center py-5 mt-4">
                <i class="fas fa-columns fa-3x text-light mb-3" style="color: #e2e8f0 !important;"></i>
                <h4 class="text-muted fw-bold">Select courses to compare</h4>
                <p class="text-muted">Your comparison results will appear here automatically.</p>
            </div>
        </div>
    </section>

    <!-- Unified Selection Modal -->
    @include('partials.compare-modal')

    <!-- Read More Modal -->
    <div class="modal fade" id="readMoreModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.1);">
                <div class="modal-header bg-light" style="border-radius: 20px 20px 0 0; padding: 20px 30px; border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold text-dark" id="readMoreModalTitle" style="font-size: 1.3rem;">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="readMoreModalBody" style="font-size: 1rem; line-height: 1.7; color: #475569;">
                    <!-- Content goes here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openModalBtn = document.getElementById('btnOpenCompareModal');
            if (openModalBtn) {
                openModalBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const modalEl = document.getElementById('courseSelectionModal');
                    if (modalEl) {
                        if (window.bootstrap && bootstrap.Modal) {
                            var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                            modalInstance.show();
                        } else if (window.jQuery) {
                            $(modalEl).modal('show');
                        }
                    }
                });
            }

            const data = window.compareModalData || {};

            const campusSelectors = document.querySelectorAll('.campus-selector');
            const deptSelectors = document.querySelectorAll('.dept-selector');
            const courseSelectors = document.querySelectorAll('.course-selector');
            
            const resultsDiv = document.getElementById('comparisonResults');
            const emptyMessage = document.getElementById('emptyMessage');
            const paramTabs = document.getElementById('paramTabs');
            const matrixHead = document.getElementById('matrixHead');
            const matrixBody = document.getElementById('matrixBody');
            const resetBtn = document.getElementById('resetComparison');

            const params = [
                { isSectionHeader: true, label: 'Quick Facts' },
                { label: 'Location', key: 'location', icon: 'fas fa-map-marker-alt' },
                { label: 'Ownership', key: 'ownership', icon: 'fas fa-building' },
                { label: 'Type Of Institute', key: 'type_of_institute', icon: 'fas fa-university' },
                { label: 'College Type', key: 'college_type', icon: 'fas fa-graduation-cap' },
                { label: 'Establishment Year', key: 'establishment_year', icon: 'fas fa-calendar-alt' },
                { label: 'Campus Size', key: 'campus_size', icon: 'fas fa-expand-arrows-alt' },
                { label: 'Total Courses Offered', key: 'total_courses_offered', icon: 'fas fa-book' },
                { isSectionHeader: true, label: 'Ranking & Accreditations' },
                { label: 'University Rank', key: 'c360_rank', icon: 'fas fa-trophy' },
                { label: 'Rating (Engg & Arch)', key: 'c360_rating', icon: 'fas fa-star' },
                { label: 'NIRF Rank (Overall)', key: 'nirf_overall', icon: 'fas fa-award' },
                { label: 'NIRF Rank (Engg & Arch)', key: 'nirf_category', icon: 'fas fa-award' },
                { label: 'Approvals', key: 'approvals', icon: 'fas fa-check-circle' },
                { label: 'Accreditations', key: 'accreditations', icon: 'fas fa-certificate' },
                { isSectionHeader: true, label: 'Placement Statistics', subtitle: `Data presented for the year ${window.maxPlacementYear || 'N/A'}` },
                { label: 'Data Year', key: 'placement_year', icon: 'fas fa-calendar-alt' },
                { label: 'Graduating Students (overall)', key: 'overall_graduating_students', icon: 'fas fa-user-graduate' },
                { label: 'Total Students Placed (overall)', key: 'overall_students_placed', icon: 'fas fa-user-check' },
                { label: 'Placement Percentage (overall)', key: 'overall_placement_percentage', icon: 'fas fa-percent' },
                { label: 'Median Salary Lpa (overall)', key: 'overall_median_salary', icon: 'fas fa-rupee-sign' },
                { label: 'Student Going Higher Studies (overall)', key: 'overall_higher_studies', icon: 'fas fa-book-reader' },
                { isSectionHeader: true, label: 'Course & Fees Details' },
                { label: 'Degree', key: 'degree', icon: 'fas fa-user-graduate' },
                { label: 'Duration', key: 'duration', icon: 'fas fa-clock' },
                { label: 'Mode', key: 'mode', icon: 'fas fa-laptop-house' },
                { label: 'Fees', key: 'fees', icon: 'fas fa-rupee-sign' },
                { label: 'Exams Accepted', key: 'exams_accepted', icon: 'fas fa-file-alt' },
                { label: 'Admission Details', key: 'admission_details', icon: 'fas fa-info-circle' },
                { label: 'Eligibility Criteria', key: 'eligibility_criteria', icon: 'fas fa-list-ul' },
                { label: 'Fees Structure', key: 'fees_structure', icon: 'fas fa-file-invoice-dollar' },
                { label: 'Curriculum', key: 'curriculum', icon: 'fas fa-book-open' },
                { label: 'Career Prospects', key: 'career_prospects', icon: 'fas fa-chart-line' },
                { label: 'Placement Details', key: 'placement_details', icon: 'fas fa-user-tie' },
                { label: 'Industrial Collaboration', key: 'industrial_collaboration', icon: 'fas fa-handshake' },
                { label: 'Internship Ranking', key: 'internship_ranking', icon: 'fas fa-medal' },
                { isSectionHeader: true, label: 'Fees' },
                { label: 'Total Fees', key: 'fees', icon: 'fas fa-money-bill-wave' },
                { isSectionHeader: true, label: 'Class Profile', subtitle: `Data presented for the year ${window.maxClassProfileYear || 'N/A'}` },
                { label: 'Data Year', key: 'class_profile_year', icon: 'fas fa-calendar-alt' },
                { label: 'Total Students', key: 'total_students', icon: 'fas fa-users' },
                { label: 'Total Faculty', key: 'total_faculty', icon: 'fas fa-chalkboard-teacher' },
                { label: 'Total Male Students', key: 'total_male_students', icon: 'fas fa-male' },
                { label: 'Total Female Students', key: 'total_female_students', icon: 'fas fa-female' },
                { label: 'Total Students Outside State', key: 'total_students_outside_state', icon: 'fas fa-globe' },
                { isSectionHeader: true, label: 'Facilities' }
            ];

            const masterFacilities = @json($allFacilities);
            masterFacilities.forEach(f => {
                params.push({
                    label: f.name,
                    key: 'facility_' + f.id,
                    icon: f.icon || 'fas fa-check'
                });
            });

            params.push(
                { isSectionHeader: true, label: 'College Reviews & Perception' },
                { label: 'College Infrastructure', key: 'rating_infrastructure', icon: 'fas fa-building', isRating: true },
                { label: 'Campus Life', key: 'rating_campus_life', icon: 'fas fa-users', isRating: true },
                { label: 'Academics', key: 'rating_academics', icon: 'fas fa-book', isRating: true },
                { label: 'Placements', key: 'rating_placements', icon: 'fas fa-briefcase', isRating: true },
                { label: 'Value for Money', key: 'rating_value_for_money', icon: 'fas fa-wallet', isRating: true },
                { label: 'Total Reviews', key: 'total_reviews', icon: 'fas fa-comment-dots' },
                { label: 'Individual Reviews', key: 'individual_reviews', icon: 'fas fa-comments', isReview: true }
            );

            window.updateComparison = function() {
                const activeData = [];
                const currentSelections = window.selections || {};
                
                for (let i = 1; i <= 4; i++) {
                    const sel = currentSelections[i];
                    if (sel && data[sel.campusId]) {
                        const campus = data[sel.campusId];
                        const dept = campus.departments[sel.deptId];
                        if (dept) {
                            const courseData = dept.courses.find(c => c.id == sel.courseId);
                            if (courseData) {
                                let rowData = { 
                                    slot: i,
                                    campusName: campus.name,
                                    deptName: dept.name,
                                    location: campus.location,
                                    ownership: campus.ownership,
                                    type_of_institute: campus.type_of_institute,
                                    college_type: campus.college_type,
                                    establishment_year: campus.establishment_year,
                                    campus_size: campus.campus_size,
                                    total_courses_offered: campus.total_courses_offered,
                                    c360_rank: campus.c360_rank,
                                    c360_rating: campus.c360_rating,
                                    nirf_overall: campus.nirf_overall,
                                    nirf_category: campus.nirf_category,
                                    approvals: campus.approvals,
                                    accreditations: campus.accreditations,
                                    class_profile_year: campus.class_profile_year,
                                    total_students: campus.total_students,
                                    total_faculty: campus.total_faculty,
                                    total_male_students: campus.total_male_students,
                                    total_female_students: campus.total_female_students,
                                    total_students_outside_state: campus.total_students_outside_state,
                                    placement_year: dept.placement_year,
                                    dept_students_placed: dept.dept_students_placed,
                                    dept_graduating_students: dept.dept_graduating_students,
                                    dept_placement_percentage: dept.dept_placement_percentage,
                                    dept_median_salary: dept.dept_median_salary,
                                    dept_higher_studies: dept.dept_higher_studies,
                                    overall_students_placed: dept.overall_students_placed,
                                    overall_graduating_students: dept.overall_graduating_students,
                                    overall_placement_percentage: dept.overall_placement_percentage,
                                    overall_median_salary: dept.overall_median_salary,
                                    overall_higher_studies: dept.overall_higher_studies,
                                    rating_infrastructure: dept.rating_infrastructure,
                                    rating_campus_life: dept.rating_campus_life,
                                    rating_academics: dept.rating_academics,
                                    rating_placements: dept.rating_placements,
                                    rating_value_for_money: dept.rating_value_for_money,
                                    total_reviews: dept.total_reviews,
                                    individual_reviews: dept.individual_reviews,
                                    ...courseData 
                                };

                                masterFacilities.forEach(f => {
                                    if (campus.facilities && campus.facilities.includes(f.id)) {
                                        rowData['facility_' + f.id] = '<i class="fas fa-check text-success fs-5"></i>';
                                    } else {
                                        rowData['facility_' + f.id] = '';
                                    }
                                });

                                activeData.push(rowData);
                            }
                        }
                    }
                }

                if (activeData.length > 0) {
                    emptyMessage.classList.add('d-none');
                    resultsDiv.classList.remove('d-none');
                    renderMatrix(activeData);
                } else {
                    emptyMessage.classList.remove('d-none');
                    resultsDiv.classList.add('d-none');
                }
            }

            window.readMoreData = {};
            let readMoreCounter = 0;

            window.showReadMore = function(id) {
                const data = window.readMoreData[id];
                if(data) {
                    document.getElementById('readMoreModalTitle').textContent = data.title;
                    document.getElementById('readMoreModalBody').innerHTML = data.content;
                    new bootstrap.Modal(document.getElementById('readMoreModal')).show();
                }
            };

            function createReadMoreHtml(title, htmlContent) {
                if (!htmlContent || typeof htmlContent !== 'string') return htmlContent;
                let temp = document.createElement('div');
                temp.innerHTML = htmlContent;
                let textContent = temp.textContent || temp.innerText || "";
                
                if (textContent.length > 150) {
                    let snippet = textContent.substring(0, 150) + '...';
                    let id = 'rm_' + (++readMoreCounter);
                    window.readMoreData[id] = { title: title, content: htmlContent };
                    
                    return `<div class="read-more-wrapper text-start">
                        <span class="text-muted" style="display:block; font-size: 0.9rem; line-height:1.6;">${snippet}</span>
                        <button class="btn btn-link btn-sm p-0 mt-2 fw-bold text-primary" style="text-decoration: none;" onclick="showReadMore('${id}')">
                            Read More <i class="fas fa-angle-right ms-1"></i>
                        </button>
                    </div>`;
                }
                return htmlContent;
            }

            function renderMatrix(activeData) {
                let headHtml = `<th class="params-column py-4 ps-4">
                                    <div class="fs-5 fw-bold text-dark">Comparison</div>
                                    <div class="small text-muted fw-normal">Key Performance Indicators</div>
                                </th>`;
                activeData.forEach(item => {
                    headHtml += `
                        <th class="matrix-org-header position-relative" style="min-width: 200px;">
                            <button type="button" class="btn btn-sm text-danger position-absolute top-0 end-0 m-1 p-1" onclick="switchToEmpty(${item.slot})" title="Remove">
                                <i class="fas fa-times-circle fs-6"></i>
                            </button>
                            <div class="matrix-org-badge text-truncate px-2 pe-4" title="${item.campusName}">${item.campusName}</div>
                            <div class="matrix-dept-badge text-truncate px-2" title="${item.deptName}">${item.deptName}</div>
                            <div class="matrix-course-badge text-truncate px-2 mt-2" title="${item.name}">${item.name}</div>
                        </th>`;
                });
                matrixHead.innerHTML = headHtml;

                let bodyHtml = '';
                const colSpan = activeData.length + 1;
                params.forEach(p => {
                    if (p.isSectionHeader) {
                        bodyHtml += `<tr class="section-header-row" style="background-color: #f1f5f9;">
                            <td colspan="${colSpan}" class="py-3 ps-4 border-bottom-0">
                                <h4 class="fw-bold mb-0 text-dark" style="font-size: 1.25rem;">${p.label}</h4>
                                ${p.subtitle ? `<div class="small text-muted mt-1">${p.subtitle}</div>` : ''}
                            </td>
                        </tr>`;
                        return;
                    }

                    bodyHtml += `<tr id="row-${p.key}">
                        <td class="params-column ps-4">
                            <div class="d-flex align-items-center">
                                <div class="param-icon">
                                    <i class="${p.icon}"></i>
                                </div>
                                <div class="matrix-label">${p.label}</div>
                            </div>
                        </td>`;
                    activeData.forEach(item => {
                        let val = item[p.key] || 'N/A';
                        let badgeClass = '';
                        let strVal = String(val);
                        
                        let tempDiv = document.createElement('div');
                        tempDiv.innerHTML = strVal;
                        let rawTextLen = (tempDiv.textContent || tempDiv.innerText || "").length;

                        let isShortValue = rawTextLen < 100;

                        if (val !== 'N/A' && !p.isReview && !p.isRating && isShortValue && (strVal.includes('₹') || strVal.includes('%') || p.key.includes('rank') || p.key.includes('year'))) {
                            badgeClass = p.key.includes('rank') ? 'primary' : (strVal.includes('₹') ? 'success' : 'badge-value');
                            val = `<span class="badge-value ${badgeClass}">${val}</span>`;
                        } else if (p.isRating && val !== 'N/A') {
                            const starCount = Math.round(val);
                            let stars = '';
                            for(let i=1; i<=5; i++) {
                                stars += `<i class="fa${i <= starCount ? 's' : 'r'} fa-star text-warning"></i>`;
                            }
                            val = `<div class="rating-box d-flex justify-content-center align-items-center">${stars}</div>`;
                        } else if (p.isReview && Array.isArray(val) && val.length > 0) {
                            const rev = val[0];
                            let stars = '';
                            for(let i=1; i<=5; i++) {
                                stars += `<i class="fa${i <= Math.round(rev.rating || 0) ? 's' : 'r'} fa-star text-warning small"></i>`;
                            }
                            val = `<div class="text-start p-3 bg-light rounded mt-2 border">
                                <div class="mb-2">${stars}</div>
                                <p class="fst-italic mb-1 small fw-bold text-dark">" ${rev.text || ''} "</p>
                                <div class="text-muted" style="font-size: 0.75rem;">posted on ${rev.date || 'unknown'} by <strong class="text-dark">${rev.author || 'Anonymous'}</strong></div>
                                <a href="#" class="d-block mt-3 small fw-bold text-primary text-decoration-none">Read All Reviews</a>
                            </div>`;
                        } else if (p.isReview) {
                            val = '-';
                        } else if (val !== 'N/A' && !strVal.includes('<i class="fas fa-check')) {
                            val = createReadMoreHtml(p.label, strVal);
                        }

                        bodyHtml += `<td>
                            <div class="matrix-value-card text-center">
                                <div class="matrix-value">${val}</div>
                            </div>
                        </td>`;
                    });
                    bodyHtml += '</tr>';
                });
                matrixBody.innerHTML = bodyHtml;
            }

            resetBtn.addEventListener('click', function() {
                campusSelectors.forEach(s => s.value = '');
                deptSelectors.forEach(s => { s.innerHTML = '<option value="">Select Department</option>'; s.disabled = true; });
                courseSelectors.forEach(s => { s.innerHTML = '<option value="">Select Course</option>'; s.disabled = true; });
                document.querySelectorAll('.compare-card').forEach(c => c.classList.remove('active-slot'));
                window.selections = { 1: null, 2: null, 3: null, 4: null };
                sessionStorage.removeItem('enrollzy_compare_slots');
                window.updateComparison();
            });

            try {
                const storedSelections = sessionStorage.getItem('enrollzy_compare_slots');
                if (storedSelections) {
                    window.selections = JSON.parse(storedSelections);
                    window.updateComparison();
                }
            } catch (e) {
                console.error("Failed to parse selections from storage", e);
            }
        });
    </script>
@endpush
