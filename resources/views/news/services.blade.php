@extends('news.parent')
@section('title', 'خدماتنا')
@section('content')

<div class="breadcrumb-area">
  <div class="container d-flex justify-content-between align-items-center">
    <h2>خدماتنا</h2>
    <nav>
      <ol class="breadcrumb bg-transparent mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
        <li class="breadcrumb-item active">خدماتنا</li>
      </ol>
    </nav>
  </div>
</div>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="news-card text-center" style="padding: 30px 20px;">
          <div style="font-size: 44px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-bolt"></i></div>
          <h5 style="font-weight: 700;">الإنارة العامة</h5>
          <p style="font-size: 14px; color: var(--text-muted);">صيانة وتوسعة شبكات الإنارة العامة في كامل المدينة.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="news-card text-center" style="padding: 30px 20px;">
          <div style="font-size: 44px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-trash-alt"></i></div>
          <h5 style="font-weight: 700;">النظافة العامة</h5>
          <p style="font-size: 14px; color: var(--text-muted);">جمع النفايات والحفاظ على نظافة المدينة.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="news-card text-center" style="padding: 30px 20px;">
          <div style="font-size: 44px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-water"></i></div>
          <h5 style="font-weight: 700;">المياه والصرف الصحي</h5>
          <p style="font-size: 14px; color: var(--text-muted);">إدارة شبكات المياه والصرف الصحي.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="news-card text-center" style="padding: 30px 20px;">
          <div style="font-size: 44px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-road"></i></div>
          <h5 style="font-weight: 700;">البنية التحتية</h5>
          <p style="font-size: 14px; color: var(--text-muted);">صيانة الطرق والأرصفة والبنية التحتية.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="news-card text-center" style="padding: 30px 20px;">
          <div style="font-size: 44px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-building"></i></div>
          <h5 style="font-weight: 700;">تنظيم المباني</h5>
          <p style="font-size: 14px; color: var(--text-muted);">إصدار تراخيص البناء والتنظيم.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="news-card text-center" style="padding: 30px 20px;">
          <div style="font-size: 44px; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-file-contract"></i></div>
          <h5 style="font-weight: 700;">الخدمات الإدارية</h5>
          <p style="font-size: 14px; color: var(--text-muted);">المعاملات الإدارية والتصديقات.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
