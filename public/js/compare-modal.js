window.switchToEditing = function(slot) {
    const emptyState = document.getElementById('empty-state-' + slot);
    const filledState = document.getElementById('filled-state-' + slot);
    const editingState = document.getElementById('editing-state-' + slot);
    const slotCard = document.querySelector('.slot-card-' + slot);
    
    if (emptyState) emptyState.classList.add('d-none');
    if (filledState) filledState.classList.add('d-none');
    if (editingState) editingState.classList.remove('d-none');
    if (slotCard) slotCard.classList.remove('state-filled');
};

window.switchToEmpty = function(slot) {
    const emptyState = document.getElementById('empty-state-' + slot);
    const filledState = document.getElementById('filled-state-' + slot);
    const editingState = document.getElementById('editing-state-' + slot);
    const slotCard = document.querySelector('.slot-card-' + slot);
    
    if (editingState) editingState.classList.add('d-none');
    if (filledState) filledState.classList.add('d-none');
    if (emptyState) emptyState.classList.remove('d-none');
    if (slotCard) slotCard.classList.remove('state-filled');
    
    const campusSelect = document.querySelector(`.campus-selector[data-slot="${slot}"]`);
    if (campusSelect) campusSelect.value = '';
    
    let deptSelect = document.querySelector(`.dept-selector[data-slot="${slot}"]`);
    if (deptSelect) {
        deptSelect.innerHTML = '<option value="">Select Department</option>';
        deptSelect.disabled = true;
    }
    let courseSelect = document.querySelector(`.course-selector[data-slot="${slot}"]`);
    if (courseSelect) {
        courseSelect.innerHTML = '<option value="">Select Course</option>';
        courseSelect.disabled = true;
    }
    
    if (window.selections) {
        window.selections[slot] = null;
        sessionStorage.setItem('enrollzy_compare_slots', JSON.stringify(window.selections));
        if (typeof window.updateComparison === 'function') {
            window.updateComparison();
        }
    }
};

document.addEventListener('DOMContentLoaded', function () {
    const campusSelectors = document.querySelectorAll('.campus-selector');
    const deptSelectors = document.querySelectorAll('.dept-selector');
    const courseSelectors = document.querySelectorAll('.course-selector');
    
    if (!document.getElementById('courseSelectionModal')) return;

    const data = window.compareModalData || {};
    window.selections = { 1: null, 2: null, 3: null, 4: null };

    try {
        const stored = sessionStorage.getItem('enrollzy_compare_slots');
        if (stored) {
            Object.assign(window.selections, JSON.parse(stored));
        }
    } catch (e) {
        console.error("Failed to parse selections", e);
    }

    // 1. Campus Change -> Populate Departments
    campusSelectors.forEach(select => {
        select.addEventListener('change', function () {
            const slot = this.getAttribute('data-slot');
            const campusId = this.value;
            const deptSelect = document.querySelector(`.dept-selector[data-slot="${slot}"]`);
            const courseSelect = document.querySelector(`.course-selector[data-slot="${slot}"]`);
            
            deptSelect.innerHTML = '<option value="">Select Department</option>';
            courseSelect.innerHTML = '<option value="">Select Course</option>';
            deptSelect.disabled = true;
            courseSelect.disabled = true;
            window.selections[slot] = null;
            this.closest('.compare-card').classList.remove('active-slot');

            if (campusId && data[campusId]) {
                deptSelect.disabled = false;
                const depts = data[campusId].departments;
                Object.keys(depts).forEach(deptId => {
                    const option = document.createElement('option');
                    option.value = deptId;
                    option.textContent = depts[deptId].department_name || depts[deptId].name;
                    deptSelect.appendChild(option);
                });
            }
            
            if (window.jQuery && $(deptSelect).hasClass('select2-hidden-accessible')) {
                $(deptSelect).trigger('change.select2');
            }
            if (window.jQuery && $(courseSelect).hasClass('select2-hidden-accessible')) {
                $(courseSelect).trigger('change.select2');
            }
        });
    });

    // 2. Department Change -> Populate Courses
    deptSelectors.forEach(select => {
        select.addEventListener('change', function () {
            const slot = this.getAttribute('data-slot');
            const campusId = document.querySelector(`.campus-selector[data-slot="${slot}"]`).value;
            const deptId = this.value;
            const courseSelect = document.querySelector(`.course-selector[data-slot="${slot}"]`);

            courseSelect.innerHTML = '<option value="">Select Course</option>';
            courseSelect.disabled = true;
            window.selections[slot] = null;
            this.closest('.compare-card').classList.remove('active-slot');

            if (campusId && deptId && data[campusId].departments[deptId]) {
                courseSelect.disabled = false;
                const courses = data[campusId].departments[deptId].courses;
                courses.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.id;
                    option.textContent = course.name;
                    courseSelect.appendChild(option);
                });
            }
            
            if (window.jQuery && $(courseSelect).hasClass('select2-hidden-accessible')) {
                $(courseSelect).trigger('change.select2');
            }
        });
    });

    // 3. Course Change -> State transition
    courseSelectors.forEach(select => {
        select.addEventListener('change', function () {
            const slot = this.getAttribute('data-slot');
            const campusId = document.querySelector(`.campus-selector[data-slot="${slot}"]`).value;
            const deptId = document.querySelector(`.dept-selector[data-slot="${slot}"]`).value;
            const courseId = this.value;

            if (campusId && deptId && courseId) {
                const campus = data[campusId];
                const dept = campus.departments[deptId];
                const courseData = dept.courses.find(c => c.id == courseId);
                
                this.closest('.compare-card').classList.add('active-slot');
                
                document.getElementById('empty-state-' + slot).classList.add('d-none');
                document.getElementById('editing-state-' + slot).classList.add('d-none');
                
                document.getElementById('filled-campus-' + slot).textContent = campus.name || campus.campus_name;
                document.getElementById('filled-dept-' + slot).textContent = dept.department_name || dept.name;
                document.getElementById('filled-course-' + slot).textContent = courseData.name;
                
                document.getElementById('filled-state-' + slot).classList.remove('d-none');
                document.querySelector('.slot-card-' + slot).classList.add('state-filled');
                
                window.selections[slot] = {
                    campusId: campusId,
                    deptId: deptId,
                    courseId: courseId
                };
            } else {
                window.selections[slot] = null;
            }
        });
    });

    // Confirm Selection Button
    const confirmBtn = document.getElementById('confirmSelectionBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            sessionStorage.setItem('enrollzy_compare_slots', JSON.stringify(window.selections));
            if (!window.location.pathname.includes('/compare')) {
                window.location.href = '/compare';
            } else {
                if (typeof window.updateComparison === 'function') {
                    window.updateComparison();
                }
            }
        });
    }

    // Sync UI from existing selections
    function syncModalUI() {
        for (let slot = 1; slot <= 4; slot++) {
            const sel = window.selections[slot];
            if (sel && data[sel.campusId]) {
                const campus = data[sel.campusId];
                const dept = campus.departments[sel.deptId];
                if (dept) {
                    const courseData = dept.courses.find(c => c.id == sel.courseId);
                    if (courseData) {
                        document.querySelector(`.slot-card-${slot}`).classList.add('active-slot');
                        document.getElementById(`empty-state-${slot}`).classList.add('d-none');
                        document.getElementById(`editing-state-${slot}`).classList.add('d-none');
                        
                        document.getElementById(`filled-campus-${slot}`).textContent = campus.name || campus.campus_name;
                        document.getElementById(`filled-dept-${slot}`).textContent = dept.department_name || dept.name;
                        document.getElementById(`filled-course-${slot}`).textContent = courseData.name;
                        
                        document.getElementById(`filled-state-${slot}`).classList.remove('d-none');
                        document.querySelector(`.slot-card-${slot}`).classList.add('state-filled');
                    }
                }
            }
        }
    }
    
    syncModalUI();
});
