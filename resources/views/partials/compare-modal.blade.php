@php
    // Only campus names are needed here; the details of a campus are fetched when it is picked (see compare-modal.js).
    if (!isset($campuses) || empty($campuses)) {
        $campuses = \App\Support\CompareData::campusList();
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
<script>
    // Filled per campus on demand by compare-modal.js (window.loadCompareData) from this address.
    window.compareModalData = window.compareModalData || {};
    window.compareDataUrl = @json(route('compare.campus-data'));
    window.maxClassProfileYear = window.maxClassProfileYear || 'N/A';
    window.maxPlacementYear = window.maxPlacementYear || 'N/A';
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
