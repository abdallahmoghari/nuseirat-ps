@extends('news.parent')
@section('title', 'استفسار')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-question-circle fa-4x text-warning"></i>
                        <h3 class="mt-3">إرسال استفسار</h3>
                        <p class="text-muted">لديك سؤال؟ اكتبه وسنرد عليك في أقرب وقت</p>
                    </div>
                    <form id="inquiryForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">الموضوع</label>
                            <input type="text" name="subject" class="form-control" required placeholder="عنوان الاستفسار">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الرسالة</label>
                            <textarea name="message" class="form-control" rows="5" required placeholder="اكتب استفسارك هنا..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning text-white w-100 py-2">إرسال الاستفسار</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('inquiryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    axios.post('{{ route("citizen.store-inquiry") }}', formData).then(function(response) {
        Swal.fire({icon:'success',title:response.data.title}).then(()=>{
            window.location.href='{{ route("citizen.services") }}';
        });
    }).catch(function(error) {
        Swal.fire({icon:'error',title:error.response?error.response.data.title:'خطأ'});
    });
});
</script>
@endsection
