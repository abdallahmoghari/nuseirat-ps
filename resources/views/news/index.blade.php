@extends('news.parent')
@section('title', 'الرئيسية')
@section('content')

<!-- HERO SLIDER -->
<section class="hero-slider">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1>بلدية النصيرات<br>في خدمتك دائماً</h1>
        <p>منصتنا الإلكترونية تهدف لتسهيل التواصل بين المواطن والبلدية، ومتابعة آخر الأخبار والخدمات البلدية.</p>
        <a href="{{ route('contact') }}" class="btn-primary-custom"><i class="fas fa-paper-plane"></i> تواصل معنا</a>
      </div>
      <div class="col-lg-6">
        <div class="slider-img">
          <img src="https://picsum.photos/600/350?random=1" alt="بلدية النصيرات">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- LATEST NEWS -->
<section style="background: var(--bg-light);">
  <div class="container">
    <div class="section-title">
      <h2>آخر الأخبار</h2>
      <p>أحدث المقالات والأخبار البلدية</p>
    </div>
    <div class="row">
      @forelse($articles as $article)
      <div class="col-lg-4 col-md-6">
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
        <p class="text-muted">لا توجد أخبار حالياً</p>
      </div>
      @endforelse
    </div>
  </div>
</section>

<!-- CATEGORIES -->
<section>
  <div class="container">
    <div class="section-title">
      <h2>الأقسام</h2>
      <p>تصفح الأخبار حسب الأقسام</p>
    </div>
    <div class="row">
      @forelse($categories as $cat)
      <div class="col-md-3 col-6 mb-3">
        <div class="news-card text-center" style="padding: 25px 15px;">
          <div style="font-size: 40px; color: var(--primary); margin-bottom: 12px;">
            <i class="fas fa-newspaper"></i>
          </div>
          <h5 style="font-weight: 700;"><a href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a></h5>
          <p style="font-size: 13px; color: var(--text-muted); margin: 0;">{{ $cat->articles_count ?? $cat->articles()->count() }} مقال</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- STATS -->
<section>
  <div class="container">
    <div class="row text-center">
      <div class="col-md-3 col-6 mb-3">
        <div class="news-card" style="padding: 25px;">
          <div style="font-size: 36px; color: var(--primary);">{{\App\Models\Article::count()}}</div>
          <p style="color: var(--text-muted); margin: 0;">مقال منشور</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <div class="news-card" style="padding: 25px;">
          <div style="font-size: 36px; color: var(--primary);">{{\App\Models\Category::count()}}</div>
          <p style="color: var(--text-muted); margin: 0;">قسم</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <div class="news-card" style="padding: 25px;">
          <div style="font-size: 36px; color: var(--primary);">6</div>
          <p style="color: var(--text-muted); margin: 0;">أيام العمل</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <div class="news-card" style="padding: 25px;">
          <div style="font-size: 36px; color: var(--primary);">{{\App\Models\User::count()}}</div>
          <p style="color: var(--text-muted); margin: 0;">مستخدم</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- RECENT ARTICLES TABLE SECTION -->
<section style="background: var(--bg-light);">
  <div class="container">
    <div class="section-title">
      <h2>أحدث المقالات</h2>
      <p>أحدث المنشورات على الموقع</p>
    </div>
    <div class="row">
      @foreach($recent as $article)
      <div class="col-md-3 col-6 mb-3">
        <div class="news-card" style="padding: 20px;">
          <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">#{{ $article->id }} — {{ $article->created_at->format('Y-m-d') }}</div>
          <h6 style="font-weight: 700;"><a href="{{ route('article', $article->slug) }}">{{ \Illuminate\Support\Str::limit($article->title, 40) }}</a></h6>
          <span class="badge bg-primary">{{ optional($article->category)->name ?? 'عام' }}</span>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- COMPLAINTS & SUGGESTIONS -->
<section style="background: var(--bg-light);">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="news-card" style="padding: 35px; text-align: center; height: 100%;">
          <div style="font-size: 48px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-exclamation-triangle"></i></div>
          <h4 style="font-weight: 700; margin-bottom: 12px;">الشكاوي والإبلاغات</h4>
          <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">يمكنك تقديم شكوى ومتابعة الرد عليها ومعرفة حالة الشكوى.</p>
          <a href="{{ route('contact') }}" class="btn-primary-custom"><i class="fas fa-paper-plane"></i> إرسال شكوى</a>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="news-card" style="padding: 35px; text-align: center; height: 100%;">
          <div style="font-size: 48px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-lightbulb"></i></div>
          <h4 style="font-weight: 700; margin-bottom: 12px;">الإقتراحات والأفكار</h4>
          <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">هنا يتم استقبال اكبر قدر ممكن من الاقتراحات والأفكار التي يمكن ان تساهم في رفع اسهم البلدية واكتساب ثقة المواطنين.</p>
          <a href="{{ route('contact') }}" class="btn-primary-custom"><i class="fas fa-paper-plane"></i> إرسال اقتراح</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SOCIAL ACTIVITIES -->
<section>
  <div class="container">
    <div class="section-title">
      <h2>النشاطات الإجتماعية</h2>
      <p>أبرز النشاطات الإجتماعية</p>
    </div>
    <div class="row">
      @php $socialArticles = \App\Models\Article::inRandomOrder()->take(4)->get(); @endphp
      @foreach($socialArticles as $article)
      <div class="col-md-3 col-6 mb-3">
        <div class="news-card">
          <div class="card-img-wrapper" style="height: 160px;">
            <img src="{{ $article->image ? asset('storage/images/article/' . $article->image) : 'https://picsum.photos/300/160?random=' . $article->id }}" alt="">
          </div>
          <div class="card-body" style="padding: 15px;">
            <h6 style="font-weight: 700;"><a href="{{ route('article', $article->slug) }}">{{ \Illuminate\Support\Str::limit($article->title, 50) }}</a></h6>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ANNOUNCEMENTS -->
<section style="background: var(--bg-light);">
  <div class="container">
    <div class="section-title">
      <h2>الإعلانات والإصدارات</h2>
      <p>نضع بين أيديكم الإعلانات والإصدارات</p>
    </div>
    <div class="row">
      @php $deptCats = \App\Models\Category::whereIn('name', ['التقارير المالية','الأنظمة والقوانين','تقارير إدارية','الخطة التشغيلية','قرارات المجلس البلدي'])->get(); @endphp
      @foreach($deptCats as $dcat)
      <div class="col-md-4 col-6 mb-3">
        <div class="news-card text-center" style="padding: 25px 15px;">
          <div style="font-size: 36px; color: var(--primary); margin-bottom: 12px;"><i class="fas fa-file-alt"></i></div>
          <h6 style="font-weight: 700;"><a href="{{ route('category', $dcat->slug) }}">{{ $dcat->name }}</a></h6>
          <p style="font-size: 13px; color: var(--text-muted); margin: 0;">{{ $dcat->articles()->count() }} إصدار</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
