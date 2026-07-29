@extends('cms.service_employee.parent')
@section('title', 'لوحة التحكم')
@section('content')
<div class="row mb-4">
    <div class="col-12"><h2><i class="fas fa-tachometer-alt"></i> لوحة التحكم</h2></div>
</div>
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-white">
            <div class="card-body text-center p-4">
                <i class="fas fa-clock fa-3x mb-2"></i>
                <h5>بانتظار المراجعة</h5>
                <h2>{{ $pendingCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-info text-white">
            <div class="card-body text-center p-4">
                <i class="fas fa-search fa-3x mb-2"></i>
                <h5>قيد الدراسة</h5>
                <h2>{{ $underStudyCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body text-center p-4">
                <i class="fas fa-check-circle fa-3x mb-2"></i>
                <h5>تم الإنجاز</h5>
                <h2>{{ $completedCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-secondary text-white">
            <div class="card-body text-center p-4">
                <i class="fas fa-question-circle fa-3x mb-2"></i>
                <h5>استفسارات جديدة</h5>
                <h2>{{ $inquiryCount }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white"><h5 class="mb-0"><i class="fas fa-history"></i> أحدث الطلبات</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>رقم الطلب</th><th>المواطن</th><th>الخدمة</th><th>الحالة</th><th>التاريخ</th></tr></thead>
                <tbody>
                    @forelse($recentRequests as $req)
                    <tr>
                        <td><a href="{{ route('service-employee.show-request', $req->id) }}">{{ $req->tracking_number }}</a></td>
                        <td>{{ $req->citizen->full_name ?? '' }}</td>
                        <td>{{ \App\Models\ServiceRequest::SERVICE_TYPES[$req->service_type] ?? $req->service_type }}</td>
                        <td><span class="badge bg-{{ $req->status == 'pending' ? 'warning' : ($req->status == 'under_study' ? 'info' : ($req->status == 'completed' ? 'success' : 'secondary')) }}">{{ \App\Models\ServiceRequest::STATUSES[$req->status] ?? $req->status }}</span></td>
                        <td>{{ $req->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">لا توجد طلبات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
