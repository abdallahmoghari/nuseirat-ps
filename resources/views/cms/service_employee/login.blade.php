@extends('cms.service_employee.parent')
@section('title', 'تسجيل دخول الموظفين')
@section('content')
<div class="row justify-content-center" style="margin-top:10vh">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-user-tie fa-4x text-primary"></i>
                    <h4 class="mt-3">تسجيل دخول الموظفين</h4>
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var fd = new FormData(this);
    axios.post('{{ route("service-employee.login") }}', fd).then(function(r) {
        Swal.fire({icon:'success',title:r.data.title}).then(()=>{
            window.location.href='{{ route("service-employee.dashboard") }}';
        });
    }).catch(function(e) {
        Swal.fire({icon:'error',title:e.response?e.response.data.title:'خطأ'});
    });
});
</script>
@endsection
