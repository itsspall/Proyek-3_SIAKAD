@extends('layouts.app')

@section('content')
<h3>Edit Course</h3>

<form action="{{ route('courses.update', $course->course_id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.courses.partials.form')
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
