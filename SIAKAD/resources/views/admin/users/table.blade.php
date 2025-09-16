@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Users</h2>
</div>

<ul class="nav nav-tabs" id="userTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
            Semua Users
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab">
            Admin
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="student-tab" data-bs-toggle="tab" data-bs-target="#student" type="button" role="tab">
            Student
        </button>
    </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab">
            Add New User
        </button>
    </li>
</ul>

<div class="tab-content mt-3">
    {{-- Semua Users --}}
    <div class="tab-pane fade show active" id="all" role="tabpanel">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allUsers as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Admin --}}
    <div class="tab-pane fade" id="admin" role="tabpanel">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Student --}}
    <div class="tab-pane fade" id="student" role="tabpanel">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Entry Year</th>
                    <th>Major</th>
                    <th>Semester</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->student->entry_year ?? '-' }}</td>
                    <td>{{ $user->student->major ?? '-' }}</td>
                    <td>{{ $user->student->semester ?? '-' }}</td>
                    <td>{{ $user->student->dob ?? '-' }}</td>
                    <td>{{ $user->student->gender ?? '-' }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Add New User --}}
    <div class="tab-pane fade" id="add" role="tabpanel">
        <div class="card mt-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="addUserTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#form_admin" type="button" role="tab">
                            Tambah Admin
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="student-tab" data-bs-toggle="tab" data-bs-target="#form_student" type="button" role="tab">
                            Tambah Siswa
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="addUserTabContent">
                    <!-- FORM ADMIN -->
                    <div class="tab-pane fade show active" id="form_admin" role="tabpanel">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id_admin" class="form-label">NIP (User ID)</label>
                                <input type="text" name="user_id" id="user_id_admin" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="username_admin" class="form-label">Username</label>
                                <input type="text" name="username" id="username_admin" class="form-control" maxlength="50" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_admin" class="form-label">Password</label>
                                <input type="password" name="password" id="password_admin" class="form-control" required>
                            </div>
                            <input type="hidden" name="role" value="admin">
                            <div class="mb-3">
                                <label for="full_name_admin" class="form-label">Full Name</label>
                                <input type="text" name="full_name" id="full_name_admin" class="form-control" maxlength="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="email_admin" class="form-label">Email</label>
                                <input type="email" name="email" id="email_admin" class="form-control" maxlength="100">
                            </div>
                            <div class="mb-3">
                                <label for="phone_admin" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_admin" class="form-control" maxlength="20">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Admin</button>
                        </form>
                    </div>

                    <!-- FORM STUDENT -->
                    <div class="tab-pane fade" id="form_student" role="tabpanel">
                        <form action="{{ route('students.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id_student" class="form-label">NIM (User ID)</label>
                                <input type="text" name="user_id" id="user_id_student" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="username_student" class="form-label">Username</label>
                                <input type="text" name="username" id="username_student" class="form-control" maxlength="50" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_student" class="form-label">Password</label>
                                <input type="password" name="password" id="password_student" class="form-control" required>
                            </div>
                            <input type="hidden" name="role" value="student">
                            <div class="mb-3">
                                <label for="full_name_student" class="form-label">Full Name</label>
                                <input type="text" name="full_name" id="full_name_student" class="form-control" maxlength="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="entry_year" class="form-label">Entry Year</label>
                                <input type="number" name="entry_year" id="entry_year" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="major" class="form-label">Major</label>
                                <input type="text" name="major" id="major" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" id="dob" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="male" id="male" class="form-check-input" required>
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="female" id="female" class="form-check-input">
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email_student" class="form-label">Email</label>
                                <input type="email" name="email" id="email_student" class="form-control" maxlength="100">
                            </div>
                            <div class="mb-3">
                                <label for="phone_student" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_student" class="form-control" maxlength="20">
                            </div>
                            <button type="submit" class="btn btn-success">Tambah Siswa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
    