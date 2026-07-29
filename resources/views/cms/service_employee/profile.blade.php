@extends('cms.service_employee.parent')
@section('title', 'الملف الشخصي')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="fas fa-user-cog"></i> الملف الشخصي</h4>
            </div>
            <div class="card-body p-4">
                <form id="profileForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">القسم</label>
                        <input type="text" class="form-control" value="{{ $employee->department }}" disabled>
                    </div>
                    <hr>
                    <h5>تغيير كلمة المرور</h5>
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" name="password" class="form-control" placeholder="اتركه فارغاً إذا لا تريد التغيير">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور الجديدة">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var fd = new FormData(this);
    axios.post('{{ route("service-employee.update-profile") }}', fd).then(function(r) {
        Swal.fire({icon:'success',title:r.data.title}).then(function(){
            location.reload();
        });
    }).catch(function(e) {
        Swal.fire({icon:'error',title:e.response?e.response.data.title:'خطأ'});
    });
});
</script>
@endsection
