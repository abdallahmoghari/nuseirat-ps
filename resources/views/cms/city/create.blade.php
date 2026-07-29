@extends('cms.parent')
@section('title', 'Create City')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Create City</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('cities.store') }}">
            @csrf
            <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
            <div class="form-group"><label>Street</label><input type="text" name="street" class="form-control"></div>
            <div class="form-group"><label>Country</label>
                <select name="country_id" class="form-control">
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
