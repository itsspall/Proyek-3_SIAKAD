@extends('layouts.app')

@section('content')
<h3>Add Course</h3>

<form action="{{ route('admin.courses.store') }}" method="POST">
    @csrf
    @include('admin.courses.partials.form')
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
