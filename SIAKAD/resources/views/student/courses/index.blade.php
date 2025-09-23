@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Kode HTML Anda sudah OK, tidak perlu diubah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Available Courses</h3>
        <div>
            <span class="me-2">NIM: <strong>{{ $student->student_id }}</strong></span>
            <span>Semester: <strong>{{ $student->semester }}</strong></span>
        </div>
    </div>

    <div class="row">
        {{-- Left: course list with checkboxes --}}
        <div class="col-md-8">
            <div id="course-list-container" class="card mb-3">
                <div class="card-body">
                    <ul id="course-list" class="list-group"></ul>
                </div>
            </div>

            <div class="mb-3">
                <button id="btn-enroll-selected" class="btn btn-primary">Enroll Selected</button>
                <span class="ms-3">Total SKS: <strong id="total-sks">0</strong></span>
            </div>
        </div>

        {{-- Right: summary of enrolled courses --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">My Courses</div>
                <div class="card-body">
                    <ul id="my-courses" class="list-group mb-2"></ul>
                    <small class="text-muted">Status: ongoing / completed / dropped</small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // data from server
    const courses = @json($courses);
    let enrolled = @json($enrolled);
    const student = @json($student);

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    // DOM elements
    const courseList = document.getElementById('course-list');
    const myCourses = document.getElementById('my-courses');
    const totalSksEl = document.getElementById('total-sks');
    const btnEnrollSelected = document.getElementById('btn-enroll-selected');

    // Render course list (checkboxes)
    function renderCourseList() {
        courseList.innerHTML = '';
        courses.forEach(course => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            const isEnrolled = enrolled.some(e => e.course_id == course.course_id && e.status !== 'dropped');   
            const semesterMismatch = (student.semester != course.semester_offered);
            li.innerHTML = `
                <div>
                    <div class="form-check">
                        <input class="form-check-input course-checkbox" type="checkbox" value="${course.course_id}"
                                data-credits="${course.credits}" id="chk-${course.course_id}" ${isEnrolled || semesterMismatch ? 'disabled' : ''}>
                        <label class="form-check-label" for="chk-${course.course_id}">
                            <strong>${course.course_name}</strong> <small class="text-muted">(${course.course_code})</small>
                            <div><small>${course.lecturer} — ${course.room}</small></div>
                        </label>
                    </div>
                </div>
                <div class="text-end">
                    <div><span class="badge bg-info">${course.credits} SKS</span></div>
                    <div class="mt-1">
                        ${isEnrolled ? '<span class="badge bg-success">Enrolled</span>' : semesterMismatch ? '<span class="badge bg-warning text-dark">Semester Mismatch</span>' : '<button class="btn btn-sm btn-primary btn-enroll-single" data-id="'+course.course_id+'">Enroll</button>'}
                    </div>
                </div>
            `;
            courseList.appendChild(li);
        });
        attachCheckboxListeners();
        attachSingleEnrollButtons();
    }

    // Render my courses (from enrolled array + derive details)
    function renderMyCourses() {
        myCourses.innerHTML = '';
        // === PERBAIKAN UTAMA DI SINI ===
        // Filter hanya mata kuliah yang statusnya BUKAN 'dropped'
        const myActiveCourses = courses.filter(course =>
            enrolled.some(e => e.course_id == course.course_id && e.status !== 'dropped')
        );

        myActiveCourses.forEach(c => {
            const enrollmentDetails = enrolled.find(e => e.course_id == c.course_id);
            const status = enrollmentDetails ? enrollmentDetails.status : 'unknown';
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                <div>
                    <strong>${c.course_name}</strong>
                    <div><small>${c.course_code}</small></div>
                    <span class="badge bg-primary">${status}</span>
                </div>
                <div>
                    ${status === 'ongoing' ? `<button class="btn btn-sm btn-warning btn-drop" data-id="${c.course_id}">Drop</button>` : ''}
                </div>
            `;
            myCourses.appendChild(li);
        });
        attachDropButtons();
    }

    // Fungsi lainnya sudah OK dan tidak perlu diubah
    function attachCheckboxListeners() {
        document.querySelectorAll('.course-checkbox').forEach(chk => {
            chk.addEventListener('change', updateTotalSks);
        });
    }

    function updateTotalSks() {
        let total = 0;
        document.querySelectorAll('.course-checkbox:checked').forEach(chk => {  
            total += Number(chk.dataset.credits || 0);
        });
        totalSksEl.textContent = total;
    }

    function attachSingleEnrollButtons() {
        document.querySelectorAll('.btn-enroll-single').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const courseId = btn.dataset.id;
                await enrollSingle(courseId);
            });
        });
    }

    function attachDropButtons() {
        document.querySelectorAll('.btn-drop').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const cid = btn.dataset.id;
                Swal.fire({
                    title: 'Drop Mata Kuliah?',
                    text: 'Anda akan membatalkan mata kuliah ini.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Drop',
                }).then(async (res) => {
                    if (res.isConfirmed) {
                        await dropCourse(cid);
                    }
                });
            });
        });
    }

    async function enrollSingle(courseId) {
        try {
            const res = await fetch(`{{ url('/student/courses/enroll') }}/${courseId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json' },
                body: JSON.stringify({})
            });
            const data = await res.json();
            if (res.ok) {
                const index = enrolled.findIndex(e => e.course_id == data.inserted.course_id);
                if (index > -1) {
                    enrolled[index] = data.inserted;
                } else {
                    enrolled.push(data.inserted);
                }
                renderCourseList();
                renderMyCourses();
                Swal.fire({ icon: 'success', title: 'Enrolled', text: data.message || 'Berhasil' });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: data.error || 'Gagal enroll' });
            }
        } catch (err) {
            console.error(err);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Network / server error' });
        }
    }

    btnEnrollSelected.addEventListener('click', async function() {
        const selected = Array.from(document.querySelectorAll('.course-checkbox:checked')).map(c => Number(c.value));
        if (selected.length === 0) {
            Swal.fire({ icon: 'info', title: 'Info', text: 'Pilih minimal 1 mata kuliah.' });
            return;
        }
        const confirm = await Swal.fire({
            title: 'Konfirmasi Enroll',
            text: `Anda akan mendaftar pada ${selected.length} mata kuliah. Lanjutkan?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, enroll'
        });
        if (confirm.isConfirmed) {
            try {
                const res = await fetch("{{ route('student.courses.enrollBulk') }}", {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json' },
                    body: JSON.stringify({ course_ids: selected })
                });
                const data = await res.json();
                if (res.ok) {
                    data.inserted.forEach(newEnrollment => {
                        const index = enrolled.findIndex(e => e.course_id == newEnrollment.course_id);
                        if (index > -1) {
                            enrolled[index] = newEnrollment;
                        } else {
                            enrolled.push(newEnrollment);
                        }
                    });
                    renderCourseList();
                    renderMyCourses();
                    updateTotalSks();
                    document.querySelectorAll('.course-checkbox:checked').forEach(chk => chk.checked = false);
                    Swal.fire({ icon: 'success', title: 'Selesai', text: `Berhasil mendaftar pada ${data.inserted.length} mata kuliah.` });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: data.error || 'Gagal enroll' });
                }
            } catch (err) {
                console.error(err);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Network / server error' });
            }
        }
    });

    async function dropCourse(courseId) {
        try {
            const res = await fetch(`{{ url('/student/courses/drop') }}/${courseId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json' },
                body: JSON.stringify({})
            });
            const data = await res.json();
            if (res.ok) {
                const updated = data.updated;
                const index = enrolled.findIndex(e => e.course_id == updated.course_id);
                if (index > -1) {
                    enrolled[index] = updated;
                }
                renderCourseList();
                renderMyCourses();
                Swal.fire({ icon: 'success', title: 'Dropped', text: data.message || 'Berhasil' });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: data.error || 'Gagal drop' });
            }
        } catch (err) {
            console.error(err);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Network / server error' });
        }
    }

    (function init() {
        renderCourseList();
        renderMyCourses();
    })();
</script>
@endpush
@endsection