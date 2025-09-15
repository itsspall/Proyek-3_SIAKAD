@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Selamat datang, {{ $user->username }}!</h4>
        <p>Role Anda: <strong>{{ $user->role }}</strong></p>
    </div>
</div>
@endsection
