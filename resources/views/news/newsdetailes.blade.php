@extends('news.parent')
@section('title', $articles->title)
@section('styles')
<style>
  .related-item { padding: 10px 0; border-bottom: 1px solid var(--border); }
  .related-item:last-child { border-bottom: none; }
  .related-item a { color: #444; text-decoration: none; font-size: 14px; display: block; }
  .related-item a:hover { color: var(--primary); }
  .related-item .date { font-size: 12px; color: #999; }
</style>
@endsection
@section('content')

<div class="breadcrumb-area">
  <div class="container d-flex justify-content-between align-items-center">
    <h2>{{ $articles->title }}</h2>
    <nav>
      <ol class="breadcrumb bg-transparent mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="{{ $articles->category ? route('category', $articles->category->slug) : '#' }}" class="text-decoration-none">{{ optional($articles->category)->name ?? '' }}</a></li>
        <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($articles->title, 30) }}</li>
      </ol>
    </nav>
  </div>
</div>

<section class="article-detail">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="mb-3 fw-bold">{{ $articles->title }}</h1>
        <div class="article-meta">
          <span><i class="fas fa-user"></i> {{ optional(optional($articles->author)->user)->first_name ?? 'محرر' }} {{ optional(optional($articles->author)->user)->last_name ?? '' }}</span>
          <span><i class="fas fa-calendar"></i> {{ $articles->created_at->format('Y-m-d') }}</span>
          <span><i class="fas fa-tag"></i> {{ optional($articles->category)->name ?? 'غير مصنف' }}</span>
        </div>
        @if($articles->image)
        <img src="{{ asset('storage/images/article/' . $articles->image) }}" class="featured-image" alt="{{ $articles->title }}">
        @endif
        <div class="article-body">
          <p class="lead fw-bold" style="color: var(--primary);">{{ $articles->short_description }}</p>
          <p>{{ $articles->full_description }}</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar-card">
          <div class="card-header"><i class="fas fa-newspaper"></i> أخبار ذات صلة</div>
          <div class="card-body p-0">
            @php
            $related = \App\Models\Article::where('id', '!=', $articles->id)
              ->inRandomOrder()->take(5)->get();
            @endphp
            @forelse($related as $rel)
            <div class="related-item px-3">
              <a href="{{ route('article', $rel->slug) }}">
                <strong>{{ $rel->title }}</strong>
                <div class="date"><i class="far fa-calendar-alt"></i> {{ $rel->created_at->format('Y-m-d') }}</div>
              </a>
            </div>
            @empty
            <div class="text-center py-4">
              <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
              <p class="text-muted">لا توجد أخبار ذات صلة</p>
            </div>
            @endforelse
          </div>
        </div>
        <div class="sidebar-card">
          <div class="card-header"><i class="fas fa-list"></i> الإعلانات والإصدارات</div>
          <ul class="list-group list-group-flush">
            @php $deptCats = \App\Models\Category::whereIn('name', ['التقارير المالية','الأنظمة والقوانين','تقارير إدارية','الخطة التشغيلية','قرارات المجلس البلدي'])->get(); @endphp
            @foreach($deptCats as $dcat)
            <li class="list-group-item"><a href="{{ route('category', $dcat->slug) }}"><i class="fas fa-file-alt ms-1"></i> {{ $dcat->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
