@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Courses</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Name</th>
                <th>Credits</th>
                <th>Semester</th>
                <th>Lecturer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->course_code }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->credits }}</td>
                <td>{{ $course->semester_offered }}</td>
                <td>{{ $course->lecturer }}</td>
                <td>
                    @if(in_array($course->course_id, $enrolled))
                        @php
                            $take = $student->takes->firstWhere('course_id', $course->course_id);
                        @endphp

                        @if($take && $take->status === 'ongoing')
                            <form action="{{ route('student.courses.drop', $course->course_id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Drop</button>
                            </form>
                        @elseif($take && $take->status === 'dropped')
                            <span class="badge bg-danger">Dropped</span>
                        @elseif($take && $take->status === 'completed')
                            <span class="badge bg-secondary">Completed</span>
                        @endif
                    @else
                        <form action="{{ route('student.courses.enroll', $course->course_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Enroll</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
