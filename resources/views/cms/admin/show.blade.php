@extends('cms.parent')
@section('title', 'Admin Profile')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Admin Profile</h3></div>
    <div class="card-body">
        <div class="text-center mb-3">
            <img src="{{ $admins->user->image ? asset('storage/images/admin/' . $admins->user->image) : asset('assets/images/default-avatar.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 100px; height: 100px; object-fit: cover;">
        </div>
        <table class="table table-bordered">
            <tr><th>ID</th><td>{{ $admins->id }}</td></tr>
            <tr><th>Name</th><td>{{ $admins->user->first_name ?? '' }} {{ $admins->user->last_name ?? '' }}</td></tr>
            <tr><th>Email</th><td>{{ $admins->email }}</td></tr>
            <tr><th>Mobile</th><td>{{ $admins->user->mobile ?? '' }}</td></tr>
            <tr><th>Gender</th><td>{{ $admins->user->gender ?? '' }}</td></tr>
            <tr><th>Status</th><td>{{ $admins->user->status ?? '' }}</td></tr>
            <tr><th>City</th><td>{{ $admins->user->city->name ?? '' }}</td></tr>
            <tr><th>Roles</th><td>@foreach($admins->roles as $role)<span class="badge badge-info">{{ $role->name }}</span> @endforeach</td></tr>
            <tr><th>Created</th><td>{{ $admins->created_at }}</td></tr>
        </table>
        <a href="{{ route('admins.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
