@extends('cms.parent')
@section('title', 'Article Details')
@section('content')
<div class="card">
    <div class="card-header"><h3>{{ $articles->title }}</h3></div>
    <div class="card-body">
        @if($articles->image)
        <img src="{{ asset('storage/images/article/' . $articles->image) }}" class="img-fluid mb-3" style="max-height: 400px;">
        @endif
        <p><strong>Category:</strong> {{ $articles->category->name ?? '' }}</p>
        <p><strong>Author:</strong> {{ $articles->author->user->first_name ?? '' }} {{ $articles->author->user->last_name ?? '' }}</p>
        <p><strong>Short Description:</strong> {{ $articles->short_description }}</p>
        <hr>
        <p>{{ $articles->full_description }}</p>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
