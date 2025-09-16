@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Courses</h3>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">+ Add Course</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Course Name</th>
            <th>Code</th>
            <th>Credits</th>
            <th>Semester</th>
            <th>Room</th>
            <th>Lecturer</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($courses as $course)
        <tr>
            <td>{{ $course->course_id }}</td>
            <td>{{ $course->course_name }}</td>
            <td>{{ $course->course_code }}</td>
            <td>{{ $course->credits }}</td>
            <td>{{ $course->semester_offered }}</td>
            <td>{{ $course->room }}</td>
            <td>{{ $course->lecturer }}</td>
            <td>
                <a href="{{ route('courses.edit', $course->course_id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('courses.destroy', $course->course_id) }}" method="POST" class="d-inline form-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center">No courses found</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
