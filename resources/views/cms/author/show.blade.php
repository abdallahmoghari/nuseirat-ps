@extends('cms.parent')
@section('title', 'Author Profile')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Author Profile</h3></div>
    <div class="card-body">
        <div class="text-center mb-3">
            <img src="{{ $authors->user->image ? asset('storage/images/author/' . $authors->user->image) : asset('assets/images/default-avatar.png') }}" class="img-circle elevation-2" style="width: 100px; height: 100px; object-fit: cover;">
        </div>
        <table class="table table-bordered">
            <tr><th>ID</th><td>{{ $authors->id }}</td></tr>
            <tr><th>Name</th><td>{{ $authors->user->first_name ?? '' }} {{ $authors->user->last_name ?? '' }}</td></tr>
            <tr><th>Email</th><td>{{ $authors->email }}</td></tr>
            <tr><th>Mobile</th><td>{{ $authors->user->mobile ?? '' }}</td></tr>
            <tr><th>Gender</th><td>{{ $authors->user->gender ?? '' }}</td></tr>
            <tr><th>Status</th><td>{{ $authors->user->status ?? '' }}</td></tr>
            <tr><th>City</th><td>{{ $authors->user->city->name ?? '' }}</td></tr>
            <tr><th>Roles</th><td>@foreach($authors->roles as $role)<span class="badge badge-info">{{ $role->name }}</span> @endforeach</td></tr>
            <tr><th>Created</th><td>{{ $authors->created_at }}</td></tr>
        </table>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
