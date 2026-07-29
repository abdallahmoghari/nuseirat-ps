@extends('news.parent')
@section('title', 'تسجيل الدخول')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-4x text-primary"></i>
                        <h3 class="mt-3">تسجيل الدخول</h3>
                        <p class="text-muted">أدخل بياناتك للدخول إلى خدمات قلم الجمهور</p>
                    </div>
                    <form id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">دخول</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">ليس لديك حساب؟ <a href="{{ route('citizen.register') }}">إنشاء حساب جديد</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    axios.post('{{ route("citizen.login.submit") }}', formData).then(function(response) {
        Swal.fire({icon:'success',title:response.data.title}).then(()=>{
            window.location.href='{{ route("citizen.services") }}';
        });
    }).catch(function(error) {
        Swal.fire({icon:'error',title:error.response?error.response.data.title:'خطأ'});
    });
});
</script>
@endsection
