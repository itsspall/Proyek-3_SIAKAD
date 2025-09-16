@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Mahasiswa</h2>
    <div class="card p-3">
        <h4>Data Akun</h4>
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $user->full_name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ $user->role }}</td>
            </tr>
        </table>

        @if($student)
        <h4 class="mt-4">Data Mahasiswa</h4>
        <table class="table table-bordered">
            <tr>
                <th>NIM</th>
                <td>{{ $student->student_id }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>{{ $student->major }}</td>
            </tr>
            <tr>
                <th>Angkatan</th>
                <td>{{ $student->entry_year }}</td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>{{ $student->semester }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $user->status }}</td>
            </tr>
        </table>
        @else
            <p class="text-danger mt-3">Data mahasiswa belum tersedia.</p>
        @endif
    </div>
</div>
@endsection
