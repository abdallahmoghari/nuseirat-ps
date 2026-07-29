@extends('cms.parent')
@section('title', 'Country Details')
@section('content')
<div class="card">
    <div class="card-header"><h3>{{ $countries->country_name }}</h3></div>
    <div class="card-body">
        <p><strong>Code:</strong> {{ $countries->code }}</p>
        <h5>Cities ({{ $countries->cities->count() }})</h5>
        <ul>
            @foreach($countries->cities as $city)
            <li>{{ $city->name }}</li>
            @endforeach
        </ul>
        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
