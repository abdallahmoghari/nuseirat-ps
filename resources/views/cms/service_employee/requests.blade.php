@extends('cms.service_employee.parent')
@section('title', 'الطلبات')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-file-alt"></i> جميع الطلبات</h2>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead class="table-primary">
                    <tr><th>رقم الطلب</th><th>المواطن</th><th>الخدمة</th><th>الحالة</th><th>التاريخ</th><th>الإجراء</th></tr>
                </thead>
                <tbody>
                    @foreach($requests as $req)
                    <tr>
                        <td><strong>{{ $req->tracking_number }}</strong></td>
                        <td>{{ $req->citizen->full_name ?? '' }}</td>
                        <td>{{ \App\Models\ServiceRequest::SERVICE_TYPES[$req->service_type] ?? $req->service_type }}</td>
                        <td><span class="badge bg-{{ $req->status == 'pending' ? 'warning' : ($req->status == 'under_study' ? 'info' : ($req->status == 'completed' ? 'success' : 'secondary')) }} p-2">{{ \App\Models\ServiceRequest::STATUSES[$req->status] ?? $req->status }}</span></td>
                        <td>{{ $req->created_at->format('Y-m-d') }}</td>
                        <td><a href="{{ route('service-employee.show-request', $req->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $requests->links() }}</div>
</div>
@endsection
