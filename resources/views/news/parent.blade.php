<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') — بلدية النصيرات</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/nuseirat.css') }}">
@yield('styles')
</head>
<body>

<!-- TOP BAR -->
<div class="top-bar">
  <div class="container d-flex justify-content-between align-items-center">
    <div>
      <a href="#"><i class="fas fa-phone"></i> 2560126</a>
      <a href="#"><i class="fas fa-envelope"></i> pal.nuseirat@gmail.com</a>
    </div>
    <div class="social-icons">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-whatsapp"></i></a>
    </div>
  </div>
</div>

<!-- NAV -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <i class="fas fa-city"></i>
      بلدية النصيرات
      <span>Nuseirat Municipality</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">من نحن</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">خدماتنا</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">تواصل معنا</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Str::startsWith(request()->path(), 'citizen') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
            @if(Auth::guard('service_employee')->check())
            <i class="fas fa-user-tie"></i> {{ Auth::guard('service_employee')->user()->name }}
            @else
            <i class="fas fa-concierge-bell"></i> قلم الجمهور
            @endif
          </a>
          <ul class="dropdown-menu">
            @if(Auth::guard('citizen')->check())
            <li><a class="dropdown-item" href="{{ route('citizen.services') }}"><i class="fas fa-concierge-bell"></i> الخدمات</a></li>
            <li><a class="dropdown-item" href="{{ route('citizen.my-requests') }}"><i class="fas fa-file-alt"></i> طلباتي</a></li>
            <li><a class="dropdown-item" href="{{ route('citizen.inquiry') }}"><i class="fas fa-question-circle"></i> استفسار</a></li>
            <li><a class="dropdown-item" href="{{ route('citizen.profile') }}"><i class="fas fa-user"></i> الملف الشخصي</a></li>
            <li><a class="dropdown-item text-danger border-top" href="{{ route('citizen.logout') }}"><i class="fas fa-sign-out-alt"></i> تسجيل خروج</a></li>
            @elseif(Auth::guard('service_employee')->check())
            <li><a class="dropdown-item" href="{{ route('service-employee.profile') }}"><i class="fas fa-user-cog"></i> تعديل الملف الشخصي</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="{{ route('service-employee.logout') }}"><i class="fas fa-sign-out-alt"></i> تسجيل خروج</a></li>
            @else
            <li><a class="dropdown-item" href="{{ route('citizen.login') }}"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</a></li>
            <li><a class="dropdown-item" href="{{ route('citizen.register') }}"><i class="fas fa-user-plus"></i> إنشاء حساب</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('service-employee.login') }}"><i class="fas fa-user-tie"></i> دخول الموظفين</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

@yield('content')

<!-- FOOTER -->
<footer class="main-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <h5>من نحن</h5>
        <p>في العام 1977م تم تأسيس لجنة محلية تولت مهمة إنشاء شبكة كهرباء بكامل أنحاء مخيم النصيرات. وفي العام 1996م صدر مرسوم رئاسي بتحويل المجلس القروي إلى مجلس بلدي يتبع لوزارة الحكم المحلي.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-whatsapp"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <h5>الصفحات</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-chevron-left ms-1"></i> الرئيسية</a></li>
          <li class="mb-2"><a href="{{ route('about') }}"><i class="fas fa-chevron-left ms-1"></i> من نحن</a></li>
          <li class="mb-2"><a href="{{ route('services') }}"><i class="fas fa-chevron-left ms-1"></i> خدماتنا</a></li>
          <li class="mb-2"><a href="{{ route('contact') }}"><i class="fas fa-chevron-left ms-1"></i> تواصل معنا</a></li>
          <li class="mb-2"><a href="{{ route('citizen.services') }}"><i class="fas fa-chevron-left ms-1"></i> قلم الجمهور</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-4">
        <h5>معلومات التواصل</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><i class="fas fa-envelope ms-1"></i> pal.nuseirat@gmail.com</li>
          <li class="mb-2"><i class="fas fa-map-marker-alt ms-1"></i> النصيرات - الشارع العام - مقابل بنك فلسطين</li>
          <li class="mb-2"><i class="fas fa-phone ms-1"></i> 2560126</li>
          <li class="mb-2"><i class="fas fa-mobile-alt ms-1"></i> 970592370900+</li>
          <li class="mb-2"><i class="fab fa-whatsapp ms-1"></i> 970592370900+</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p class="mb-0">جميع الحقوق محفوظة &copy; {{ date('Y') }} بلدية النصيرات</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.content;</script>
@yield('scripts')
</body>
</html>
