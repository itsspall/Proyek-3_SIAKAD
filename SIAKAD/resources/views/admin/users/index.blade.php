@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Users</h2>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs" id="userTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="admins-tab" data-bs-toggle="tab" data-bs-target="#admins" type="button" role="tab">Admins</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button" role="tab">Students</button>
  </li>
</ul>

<div class="tab-content mt-3" id="userTabsContent">
  <!-- All Users -->
  <div class="tab-pane fade show active" id="all" role="tabpanel">
      @include('admin.users.table', ['users' => $allUsers])
  </div>

  <!-- Admins -->
  <div class="tab-pane fade" id="admins" role="tabpanel">
      @include('admin.users.table', ['users' => $admins])
  </div>

  <!-- Students -->
  <div class="tab-pane fade" id="students" role="tabpanel">
      @include('admin.users.table', ['users' => $students])
  </div>
</div>
@endsection
