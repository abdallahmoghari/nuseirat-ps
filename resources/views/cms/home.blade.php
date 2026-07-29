@php
    $adminsCount = \App\Models\Admin::count();
    $authorsCount = \App\Models\Author::count();
    $categoriesCount = \App\Models\Category::count();
    $articlesCount = \App\Models\Article::count();
    $countriesCount = \App\Models\Country::count();
    $citiesCount = \App\Models\City::count();
    $contactsCount = \App\Models\Contact::count();
    $slidersCount = \App\Models\Slider::count();
@endphp
@extends('cms.parent')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner"><h3>{{ $adminsCount }}</h3><p>Admins</p></div>
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <a href="{{ route('admins.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner"><h3>{{ $authorsCount }}</h3><p>Authors</p></div>
            <div class="icon"><i class="fas fa-user-edit"></i></div>
            <a href="{{ route('authors.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner"><h3>{{ $categoriesCount }}</h3><p>Categories</p></div>
            <div class="icon"><i class="fas fa-tags"></i></div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner"><h3>{{ $articlesCount }}</h3><p>Articles</p></div>
            <div class="icon"><i class="fas fa-newspaper"></i></div>
            <a href="{{ route('articles.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner"><h3>{{ $countriesCount }}</h3><p>Countries</p></div>
            <div class="icon"><i class="fas fa-globe"></i></div>
            <a href="{{ route('countries.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner"><h3>{{ $citiesCount }}</h3><p>Cities</p></div>
            <div class="icon"><i class="fas fa-city"></i></div>
            <a href="{{ route('cities.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner"><h3>{{ $contactsCount }}</h3><p>Contacts</p></div>
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <a href="{{ route('contacts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner"><h3>{{ $slidersCount }}</h3><p>Sliders</p></div>
            <div class="icon"><i class="fas fa-images"></i></div>
            <a href="{{ route('sliders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection
