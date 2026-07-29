@extends('cms.parent')
@section('title', 'Create Slider')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Create Slider</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Title</label><input type="text" name="title" class="form-control" required></div>
            <div class="form-group"><label>Description</label><textarea name="description" class="form-control" required></textarea></div>
            <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control"></div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
