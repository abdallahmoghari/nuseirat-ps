@extends('cms.parent')
@section('title', 'Slider Details')
@section('content')
<div class="card">
    <div class="card-header"><h3>{{ $sliders->title }}</h3></div>
    <div class="card-body">
        @if($sliders->image)
        <img src="{{ asset('storage/images/slider/' . $sliders->image) }}" class="img-fluid mb-3" style="max-height: 300px;">
        @endif
        <p>{{ $sliders->description }}</p>
        <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
