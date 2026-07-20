@php
    $enrollzyPhone = App\Models\ContactUsDetail::value('phone_general') ?? '+91 98765 43210';
    $contactRoute = route('contact');
@endphp

<!-- Call Institute / School Modal -->
<div class="modal fade" id="callInstituteModal" tabindex="-1" aria-labelledby="callInstituteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="callInstituteModalLabel" style="color: #3771C8;">Call Institution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary" style="width: 64px; height: 64px; font-size: 24px;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-1" id="callOrgName">Institute Name</h5>
                <p class="text-muted small mb-1" id="callOrgSubtext">Connect directly with the admissions team at:</p>
                <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-center gap-3 mb-4 border">
                    <span class="fs-4 fw-bold text-dark" id="callOrgPhone">{{ $enrollzyPhone }}</span>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $enrollzyPhone) }}" id="callNowLink" class="btn btn-primary rounded-pill px-4 fw-bold" style="background-color: #3771C8; border: none;">
                        <i class="fa-solid fa-phone me-1"></i> Call Now
                    </a>
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-3 fw-bold" onclick="copyCallPhone()">
                        <i class="fa-solid fa-copy me-1"></i> <span id="copyPhoneText">Copy Number</span>
                    </button>
                </div>
                <p class="text-muted mt-3 mb-0" style="font-size: 11px;" id="callEnrollzyNote">
                    * This is Enrollzy's helpdesk number. We'll connect you to the institute.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Enrollzy fallback phone
var enrollzyPhone = "{{ $enrollzyPhone }}";
var contactPageUrl = "{{ $contactRoute }}";

document.addEventListener('DOMContentLoaded', function () {
    // Populate Call Modal
    const callModal = document.getElementById('callInstituteModal');
    if (callModal) {
        callModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const orgName = button.getAttribute('data-org-name') || 'Institute';
            const orgPhone = button.getAttribute('data-org-phone') || '';
            const isOrgPhone = orgPhone && orgPhone.trim() !== '' && orgPhone !== '+91 1800-123-4567';

            // Set org name
            document.getElementById('callOrgName').textContent = orgName;
            document.getElementById('copyPhoneText').textContent = 'Copy Number';

            if (isOrgPhone) {
                // Use the institute's own phone number
                document.getElementById('callOrgPhone').textContent = orgPhone;
                document.getElementById('callNowLink').setAttribute('href', 'tel:' + orgPhone.replace(/[^0-9+]/g, ''));
                document.getElementById('callOrgSubtext').textContent = 'Connect directly with the admissions team at:';
                document.getElementById('callEnrollzyNote').style.display = 'none';
            } else {
                // Fallback to Enrollzy helpdesk
                document.getElementById('callOrgPhone').textContent = enrollzyPhone;
                document.getElementById('callNowLink').setAttribute('href', 'tel:' + enrollzyPhone.replace(/[^0-9+]/g, ''));
                document.getElementById('callOrgSubtext').textContent = 'Reach out to Enrollzy helpdesk for ' + orgName + ':';
                document.getElementById('callEnrollzyNote').style.display = 'block';
            }
        });
    }

    // Request a Callback — redirect to contact-us page with org name prefilled
    document.querySelectorAll('[data-bs-target="#requestCallbackModal"]').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            const orgName = btn.getAttribute('data-org-name') || '';
            const url = contactPageUrl + '?from_org=' + encodeURIComponent(orgName) + '#contact-form';
            window.location.href = url;
        }, true);
    });
});

function copyCallPhone() {
    const phoneNum = document.getElementById('callOrgPhone').textContent.trim();
    navigator.clipboard.writeText(phoneNum).then(() => {
        document.getElementById('copyPhoneText').textContent = 'Copied!';
        setTimeout(() => {
            document.getElementById('copyPhoneText').textContent = 'Copy Number';
        }, 2000);
    }).catch(() => {
        // Fallback for browsers without clipboard API
        const el = document.createElement('input');
        el.value = phoneNum;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        document.getElementById('copyPhoneText').textContent = 'Copied!';
        setTimeout(() => {
            document.getElementById('copyPhoneText').textContent = 'Copy Number';
        }, 2000);
    });
}
</script>
