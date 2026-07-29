@extends('news.parent')
@section('title', 'إنشاء حساب جديد')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-4x text-primary"></i>
                        <h3 class="mt-3">إنشاء حساب جديد</h3>
                        <p class="text-muted">أنشئ حسابك للاستفادة من خدمات قلم الجمهور</p>
                    </div>
                    <form id="registerForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الاسم الأول</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الاسم الأخير</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">كلمة المرور</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" placeholder="اختياري">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">رقم الهوية</label>
                                <input type="text" name="id_number" class="form-control" placeholder="اختياري">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">إنشاء حساب</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">لديك حساب بالفعل؟ <a href="{{ route('citizen.login') }}">تسجيل الدخول</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    axios.post('{{ route("citizen.register") }}', formData).then(function(response) {
        Swal.fire({icon:'success',title:response.data.title}).then(()=>{
            window.location.href='{{ route("citizen.services") }}';
        });
    }).catch(function(error) {
        Swal.fire({icon:'error',title:error.response?error.response.data.title:'خطأ'});
    });
});
</script>
@endsection
