@extends('news.parent')
@section('title', $category->name)
@section('content')

<div class="breadcrumb-area">
  <div class="container d-flex justify-content-between align-items-center">
    <h2>{{ $category->name }}</h2>
    <nav>
      <ol class="breadcrumb bg-transparent mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">الرئيسية</a></li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
      </ol>
    </nav>
  </div>
</div>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          @forelse($articles as $article)
          <div class="col-md-6">
            <div class="news-card">
              <div class="card-img-wrapper">
                <img src="{{ $article->image ? asset('storage/images/article/' . $article->image) : 'https://picsum.photos/400/250?random=' . $article->id }}" alt="{{ $article->title }}">
                <div class="date-badge"><i class="far fa-calendar-alt"></i> {{ $article->created_at->format('Y-m-d') }}</div>
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="{{ route('article', $article->slug) }}">{{ $article->title }}</a></h5>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($article->short_description, 100) }}</p>
              </div>
              <div class="card-footer">
                <span><i class="fas fa-user"></i> {{ optional(optional($article->author)->user)->first_name ?? 'محرر' }}</span>
                <a href="{{ route('article', $article->slug) }}" class="read-more">التفاصيل <i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center py-5">
            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
            <p class="text-muted">لا توجد مقالات في هذا القسم</p>
          </div>
          @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
          {{ $articles->links() }}
        </div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar-card">
          <div class="card-header"><i class="fas fa-list"></i> الإعلانات والإصدارات</div>
          <ul class="list-group list-group-flush">
            @php $deptCats = \App\Models\Category::whereIn('name', ['التقارير المالية','الأنظمة والقوانين','تقارير إدارية','الخطة التشغيلية','قرارات المجلس البلدي'])->get(); @endphp
            @foreach($deptCats as $dcat)
            <li class="list-group-item"><a href="{{ route('category', $dcat->slug) }}"><i class="fas fa-file-alt ms-1"></i> {{ $dcat->name }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="sidebar-card">
          <div class="card-header"><i class="fas fa-video"></i> مكتبة الفيديو</div>
          <div class="card-body text-center">
            <i class="fas fa-film fa-3x text-muted mb-2"></i>
            <p class="text-muted">قريباً</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
