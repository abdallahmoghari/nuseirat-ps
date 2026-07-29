@extends('cms.parent')
@section('title', 'Contact Details')
@section('content')
<div class="card">
    <div class="card-header"><h3>Contact from {{ $contacts->name }}</h3></div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $contacts->name }}</p>
        <p><strong>Phone:</strong> {{ $contacts->phone }}</p>
        <p><strong>Email:</strong> {{ $contacts->email }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $contacts->message }}</p>
        <p><strong>Received:</strong> {{ $contacts->created_at }}</p>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
