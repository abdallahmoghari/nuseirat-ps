@extends('cms.parent')
@section('title', 'Create Category')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Create Category</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
            <div class="form-group"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
            <div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
