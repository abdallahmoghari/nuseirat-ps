<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') — قلم الجمهور</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/nuseirat.css') }}">
@yield('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="@auth('service_employee'){{ route('service-employee.dashboard') }}@else#@endauth">
      <i class="fas fa-users-cog"></i> قلم الجمهور
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#empNav">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="empNav">
      <ul class="navbar-nav ms-auto">
        @auth('service_employee')
        <li class="nav-item"><a class="nav-link" href="{{ route('service-employee.dashboard') }}"><i class="fas fa-tachometer-alt"></i> الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('service-employee.requests') }}"><i class="fas fa-file-alt"></i> الطلبات</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('service-employee.inquiries') }}"><i class="fas fa-question-circle"></i> الاستفسارات</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt"></i> الموقع الرئيسي</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('service-employee.logout') }}"><i class="fas fa-sign-out-alt"></i> تسجيل خروج</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid py-4">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.content;</script>
@yield('scripts')
</body>
</html>
