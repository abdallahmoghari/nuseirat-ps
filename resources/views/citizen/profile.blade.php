@extends('news.parent')
@section('title', 'الملف الشخصي')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-5x text-primary"></i>
                        <h3 class="mt-3">{{ $citizen->full_name }}</h3>
                    </div>
                    <table class="table table-borderless">
                        <tr><th>البريد الإلكتروني</th><td>{{ $citizen->email }}</td></tr>
                        <tr><th>رقم الهاتف</th><td>{{ $citizen->phone ?? 'غير محدد' }}</td></tr>
                        <tr><th>رقم الهوية</th><td>{{ $citizen->id_number ?? 'غير محدد' }}</td></tr>
                    </table>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('citizen.services') }}" class="btn btn-primary"><i class="fas fa-arrow-right"></i> الخدمات</a>
                        <a href="{{ route('citizen.my-requests') }}" class="btn btn-info text-white"><i class="fas fa-file-alt"></i> طلباتي</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
