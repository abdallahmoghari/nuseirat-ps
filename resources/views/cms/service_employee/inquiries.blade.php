@extends('cms.service_employee.parent')
@section('title', 'الاستفسارات')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-question-circle"></i> الاستفسارات</h2>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead class="table-primary">
                    <tr><th>#</th><th>المواطن</th><th>الموضوع</th><th>التاريخ</th><th>الحالة</th><th>الإجراء</th></tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $inq)
                    <tr>
                        <td>{{ $inq->id }}</td>
                        <td>{{ $inq->citizen->full_name ?? '' }}</td>
                        <td>{{ $inq->subject }}</td>
                        <td>{{ $inq->created_at->format('Y-m-d') }}</td>
                        <td>@if($inq->response)<span class="badge bg-success">تم الرد</span>@else<span class="badge bg-warning">بانتظار الرد</span>@endif</td>
                        <td><a href="{{ route('service-employee.show-inquiry', $inq->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $inquiries->links() }}</div>
</div>
@endsection
