@extends('cms.parent')
@section('title', 'Create Country')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Create Country</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('countries.store') }}">
            @csrf
            <div class="form-group"><label>Country Name</label><input type="text" name="country_name" class="form-control" required></div>
            <div class="form-group"><label>Code</label><input type="text" name="code" class="form-control" required></div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
