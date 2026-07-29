@extends('news.parent')
@section('title', 'طلباتي')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-file-alt text-primary"></i> طلباتي</h2>
        <a href="{{ route('citizen.services') }}" class="btn btn-primary"><i class="fas fa-plus"></i> طلب جديد</a>
    </div>
    @if($requests->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>رقم الطلب</th>
                    <th>الخدمة</th>
                    <th>الحالة</th>
                    <th>تاريخ التقديم</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $req)
                <tr>
                    <td><strong>{{ $req->tracking_number }}</strong></td>
                    <td>{{ \App\Models\ServiceRequest::SERVICE_TYPES[$req->service_type] ?? $req->service_type }}</td>
                    <td>
                        @php
                        $statusColors = ['pending'=>'warning','under_study'=>'info','awaiting_review'=>'secondary','completed'=>'success'];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$req->status] ?? 'secondary' }} p-2">
                            {{ \App\Models\ServiceRequest::STATUSES[$req->status] ?? $req->status }}
                        </span>
                    </td>
                    <td>{{ $req->created_at->format('Y-m-d') }}</td>
                    <td><a href="{{ route('citizen.show-request', $req->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $requests->links() }}</div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-inbox fa-5x text-muted mb-3"></i>
        <h4 class="text-muted">لا توجد طلبات بعد</h4>
        <p>قم بتقديم طلب جديد للبدء</p>
        <a href="{{ route('citizen.services') }}" class="btn btn-primary">تقديم طلب</a>
    </div>
    @endif
</div>
@endsection
