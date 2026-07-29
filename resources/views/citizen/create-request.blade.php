@extends('news.parent')
@section('title', 'طلب ' . $serviceName)
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-file-alt fa-4x text-primary"></i>
                        <h3 class="mt-3">طلب {{ $serviceName }}</h3>
                    </div>
                    <form id="requestForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="service_type" value="{{ $type }}">
                        <div class="mb-3">
                            <label class="form-label">نوع الخدمة</label>
                            <input type="text" class="form-control" value="{{ $serviceName }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تفاصيل الطلب</label>
                            <textarea name="description" class="form-control" rows="5" required placeholder="اكتب تفاصيل طلبك هنا..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">إرفاق ملفات</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">يمكنك إرفاق ملف PDF أو صورة (حد أقصى 10 ميغابايت)</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">إرسال الطلب</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('requestForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    axios.post('{{ route("citizen.store-request") }}', formData).then(function(response) {
        Swal.fire({
            icon:'success',
            title:response.data.title,
            text:'رقم المتابعة: ' + response.data.tracking_number,
            confirmButtonText:'حسناً'
        }).then(()=>{
            window.location.href='{{ route("citizen.my-requests") }}';
        });
    }).catch(function(error) {
        Swal.fire({icon:'error',title:error.response?error.response.data.title:'خطأ'});
    });
});
</script>
@endsection
