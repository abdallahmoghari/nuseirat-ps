@extends('news.parent')
@section('title', 'من نحن')
@section('content')

<div class="breadcrumb-area">
  <div class="container d-flex justify-content-between align-items-center">
    <h2>من نحن</h2>
    <nav>
      <ol class="breadcrumb bg-transparent mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
        <li class="breadcrumb-item active">من نحن</li>
      </ol>
    </nav>
  </div>
</div>

<section>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="news-card" style="padding: 40px;">
          <h3 style="font-weight: 700; margin-bottom: 25px; color: var(--primary);">نبذة عن بلدية النصيرات</h3>
          <p style="font-size: 16px; line-height: 2; color: #444;">
            في العام 1977م تم تأسيس لجنة محلية تولت مهمة إنشاء شبكة كهرباء بكامل أنحاء مخيم النصيرات وكانت تقوم بأعمال النظافة بالتعاون مع الوكالة، وتم إمدادها أيضاً بشبكة مياه عام 1980م واستمرت أعمال اللجنة حتى أكتوبر عام 1987م حيث تحولت إلى مجلس قروي وزاد هذا المجلس من الاهتمام بالخدمات المقدمة للمواطنين.
          </p>
          <p style="font-size: 16px; line-height: 2; color: #444;">
            وفي العام 1996م صدر مرسوم رئاسي بتحويل المجلس القروي إلى مجلس بلدي يتبع لوزارة الحكم المحلي.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
