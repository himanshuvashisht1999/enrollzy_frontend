<!-- Book Session Modal -->
<div class="modal fade" id="bookSessionModal" tabindex="-1" aria-labelledby="bookSessionModalLabel" aria-hidden="true" style="z-index: 100005;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
                <h5 class="modal-title fw-bold text-white mb-0" id="bookSessionModalLabel">
                    <i class="fa-solid fa-calendar-check me-2"></i>Book Counseling Session
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="bookingAlert"></div>
                <form id="bookSessionForm">
                    @csrf
                    <input type="hidden" id="booking_expert_id" name="expert_id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Select Available Time Slot <span class="text-danger">*</span></label>
                        <select id="booking_slot_id" name="slot_id" class="form-select border-2" required>
                            <option value="">Loading available slots...</option>
                        </select>
                        <div id="noSlotsWarning" class="text-danger small mt-1 d-none">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i>No active time slots available for this expert currently. Please try another mentor or check back later.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Your Full Name <span class="text-danger">*</span></label>
                        <input type="text" id="booking_name" name="name" class="form-control" placeholder="Enter your full name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Your Email Address <span class="text-danger">*</span></label>
                        <input type="email" id="booking_email" name="email" class="form-control" placeholder="name@example.com" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Session Topic / Notes (Optional)</label>
                        <textarea id="booking_notes" name="notes" class="form-control" rows="3" placeholder="Briefly describe what you would like to discuss during this session..."></textarea>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" id="btnSubmitBooking" class="btn btn-primary py-2 fw-bold rounded-pill" style="background: #1e3a8a; border: none;">
                            Confirm & Book Session
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openBookingModal(expertId, expertName) {
    document.getElementById('booking_expert_id').value = expertId;
    document.getElementById('bookSessionModalLabel').innerHTML = '<i class="fa-solid fa-calendar-check me-2"></i>Book Session with ' + (expertName || 'Expert');
    
    const form = document.getElementById('bookSessionForm');
    if (form) form.style.display = 'block';

    const slotSelect = document.getElementById('booking_slot_id');
    const warning = document.getElementById('noSlotsWarning');
    const alertDiv = document.getElementById('bookingAlert');
    alertDiv.innerHTML = '';
    slotSelect.innerHTML = '<option value="">Loading available slots...</option>';
    warning.classList.add('d-none');
    
    const modalEl = document.getElementById('bookSessionModal');
    if (modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    fetch('/api/expert-slots/' + expertId)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.slots && data.slots.length > 0) {
                let options = '<option value="">-- Select Time Slot --</option>';
                data.slots.forEach(slot => {
                    const dateFormatted = new Date(slot.date).toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' });
                    const costText = slot.cost > 0 ? (' - ₹' + slot.cost) : ' - Free';
                    const modeText = (slot.mode || 'video').toUpperCase();
                    options += `<option value="${slot.id}">${dateFormatted} (${slot.start_time} - ${slot.end_time}) [${modeText}]${costText}</option>`;
                });
                slotSelect.innerHTML = options;
            } else {
                slotSelect.innerHTML = '<option value="">No slots available</option>';
                warning.classList.remove('d-none');
            }
        })
        .catch(err => {
            slotSelect.innerHTML = '<option value="">Error loading slots</option>';
            warning.classList.remove('d-none');
        });
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookSessionForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitBooking');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Booking...';

            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch('{{ route("session.book") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async res => {
                const data = await res.json().catch(() => ({}));
                btn.disabled = false;
                btn.innerHTML = 'Confirm & Book Session';
                const alertDiv = document.getElementById('bookingAlert');

                if (res.status === 419) {
                    alertDiv.innerHTML = `<div class="alert alert-danger border-0 shadow-sm"><i class="fa-solid fa-triangle-exclamation me-2"></i>Session expired. Please refresh the page and try booking again.</div>`;
                    return;
                }

                if (res.ok && data.success) {
                    form.style.display = 'none';
                    alertDiv.innerHTML = `
                        <div class="text-center py-4">
                            <div class="mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow-sm" style="width: 80px; height: 80px;">
                                    <i class="fa-solid fa-check fa-2x"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-2 text-success">Booking Confirmed!</h4>
                            <p class="text-muted mb-4 fs-6">${data.message}</p>
                            
                            <div class="bg-light p-3 rounded-4 mb-4 border" style="border-style: dashed !important; border-color: #cbd5e1 !important; border-width: 2px !important;">
                                <p class="small text-muted text-uppercase fw-bold mb-1 letter-spacing-1">Booking ID</p>
                                <div class="fs-4 fw-bold text-dark font-monospace">${data.booking_id}</div>
                            </div>
                            
                            <button type="button" class="btn btn-outline-secondary px-5 py-2 rounded-pill fw-bold" data-bs-dismiss="modal">Done</button>
                        </div>
                    `;
                    form.reset();
                } else {
                    alertDiv.innerHTML = `<div class="alert alert-danger border-0 shadow-sm">${data.message || 'Error submitting booking.'}</div>`;
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = 'Confirm & Book Session';
                document.getElementById('bookingAlert').innerHTML = `<div class="alert alert-danger border-0 shadow-sm">Failed to book session. Please try again.</div>`;
            });
        });
    }
});
</script>
