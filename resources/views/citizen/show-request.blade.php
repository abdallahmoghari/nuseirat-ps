@extends('news.parent')
@section('title', 'طلب ' . $request->tracking_number)
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-file-alt"></i> تفاصيل الطلب #{{ $request->tracking_number }}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>نوع الخدمة:</strong>
                            <p>{{ \App\Models\ServiceRequest::SERVICE_TYPES[$request->service_type] ?? $request->service_type }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>الحالة:</strong>
                            @php
                            $statusColors = ['pending'=>'bg-warning','under_study'=>'bg-info','awaiting_review'=>'bg-secondary','completed'=>'bg-success'];
                            @endphp
                            <p><span class="badge {{ $statusColors[$request->status] ?? 'bg-secondary' }} p-2">{{ \App\Models\ServiceRequest::STATUSES[$request->status] ?? $request->status }}</span></p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>تفاصيل الطلب:</strong>
                        <p class="bg-light p-3 rounded">{{ $request->description }}</p>
                    </div>
                    @if($request->file_path)
                    <div class="mb-3">
                        <strong>الملف المرفق:</strong>
                        <div>
                            <a href="{{ asset('storage/' . $request->file_path) }}" class="btn btn-sm btn-info" target="_blank">
                                <i class="fas fa-download"></i> تحميل الملف
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <strong>تاريخ التقديم:</strong>
                        <p>{{ $request->created_at->format('Y-m-d h:i A') }}</p>
                    </div>
                    @if($request->admin_response)
                    <div class="mb-3">
                        <strong>رد البلدية:</strong>
                        <div class="bg-success bg-opacity-10 p-3 rounded border border-success">
                            <p class="mb-0">{{ $request->admin_response }}</p>
                        </div>
                    </div>
                    @endif
                    @if($request->employee)
                    <div class="mb-3">
                        <strong>الموظف المسؤول:</strong>
                        <p>{{ $request->employee->name }} ({{ $request->employee->department }})</p>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('citizen.my-requests') }}" class="btn btn-secondary"><i class="fas fa-arrow-right"></i> عودة للطلبات</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
