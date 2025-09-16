<div class="mb-3">
    <label class="form-label">Course Name</label>
    <input type="text" name="course_name" value="{{ old('course_name', $course->course_name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Course Code</label>
    <input type="text" name="course_code" value="{{ old('course_code', $course->course_code ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Credits</label>
    <input type="number" name="credits" value="{{ old('credits', $course->credits ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Semester Offered</label>
    <input type="number" name="semester_offered" value="{{ old('semester_offered', $course->semester_offered ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Room</label>
    <input type="text" name="room" value="{{ old('room', $course->room ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Lecturer</label>
    <input type="text" name="lecturer" value="{{ old('lecturer', $course->lecturer ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $course->description ?? '') }}</textarea>
</div>
