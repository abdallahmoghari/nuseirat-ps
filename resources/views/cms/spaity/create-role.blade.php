@extends('cms.parent')
@section('title', 'Create Role')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Create Role</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
            <div class="form-group"><label>Guard Name</label>
                <select name="guard_name" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="author">Author</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
