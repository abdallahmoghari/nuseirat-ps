@extends('cms.service_employee.parent')
@section('title', 'طلب #' . $request->tracking_number)
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="fas fa-file-alt"></i> طلب #{{ $request->tracking_number }}</h4>
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6"><strong>المواطن:</strong><p>{{ $request->citizen->full_name ?? '' }} ({{ $request->citizen->email ?? '' }})</p></div>
                    <div class="col-md-6"><strong>رقم الهاتف:</strong><p>{{ $request->citizen->phone ?? 'غير متوفر' }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6"><strong>نوع الخدمة:</strong><p>{{ \App\Models\ServiceRequest::SERVICE_TYPES[$request->service_type] ?? $request->service_type }}</p></div>
                    <div class="col-md-6"><strong>تاريخ التقديم:</strong><p>{{ $request->created_at->format('Y-m-d h:i A') }}</p></div>
                </div>
                <div class="mb-3"><strong>تفاصيل الطلب:</strong><div class="bg-light p-3 rounded">{{ $request->description }}</div></div>
                @if($request->file_path)
                <div class="mb-3">
                    <strong>الملف المرفق من المواطن:</strong>
                    <div><a href="{{ asset('storage/' . $request->file_path) }}" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-download"></i> تحميل الملف</a></div>
                </div>
                @endif
                @if($request->admin_response)
                <div class="mb-3"><strong>الرد السابق:</strong><div class="bg-success bg-opacity-10 p-3 rounded border border-success">{{ $request->admin_response }}</div></div>
                @endif
                <hr>
                <h5>تحديث الحالة</h5>
                <form id="statusForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">الحالة</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                <option value="under_study" {{ $request->status == 'under_study' ? 'selected' : '' }}>قيد الدراسة</option>
                                <option value="awaiting_review" {{ $request->status == 'awaiting_review' ? 'selected' : '' }}>بانتظار المراجعة</option>
                                <option value="completed" {{ $request->status == 'completed' ? 'selected' : '' }}>تم الإنجاز</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">الرد على المواطن</label>
                            <textarea name="admin_response" class="form-control" rows="3">{{ $request->admin_response }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">إرفاق ملف الرد (الشهادة/المستند)</label>
                        <input type="file" name="response_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">يمكنك إرفاق ملف PDF أو صورة (حد أقصى 10 ميغابايت)</small>
                    </div>
                    <button type="submit" class="btn btn-primary">حفظ التحديث</button>
                </form>
            </div>
            <div class="card-footer"><a href="{{ route('service-employee.requests') }}" class="btn btn-secondary">عودة</a></div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var fd = new FormData(this);
    axios.post('{{ route("service-employee.update-status", $request->id) }}', fd).then(function(r) {
        Swal.fire({icon:'success',title:r.data.title}).then(()=>{location.reload();});
    }).catch(function(e) {
        Swal.fire({icon:'error',title:e.response?e.response.data.title:'خطأ'});
    });
});
</script>
@endsection
