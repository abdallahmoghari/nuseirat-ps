@extends('cms.service_employee.parent')
@section('title', 'استفسار')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="fas fa-question-circle"></i> {{ $inquiry->subject }}</h4>
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6"><strong>من:</strong><p>{{ $inquiry->citizen->full_name ?? '' }} ({{ $inquiry->citizen->email ?? '' }})</p></div>
                    <div class="col-md-6"><strong>التاريخ:</strong><p>{{ $inquiry->created_at->format('Y-m-d h:i A') }}</p></div>
                </div>
                <div class="mb-3"><strong>الرسالة:</strong><div class="bg-light p-3 rounded">{{ $inquiry->message }}</div></div>
                @if($inquiry->response)
                <div class="mb-3"><strong>الرد:</strong><div class="bg-success bg-opacity-10 p-3 rounded border border-success">{{ $inquiry->response }}</div></div>
                @endif
                <hr>
                @if(!$inquiry->response)
                <h5>الرد على الاستفسار</h5>
                <form id="responseForm">
                    @csrf
                    <div class="mb-3">
                        <textarea name="response" class="form-control" rows="4" required placeholder="اكتب ردك هنا..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">إرسال الرد</button>
                </form>
                @endif
            </div>
            <div class="card-footer"><a href="{{ route('service-employee.inquiries') }}" class="btn btn-secondary">عودة</a></div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
var form = document.getElementById('responseForm');
if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        axios.post('{{ route("service-employee.respond-inquiry", $inquiry->id) }}', fd).then(function(r) {
            Swal.fire({icon:'success',title:r.data.title}).then(()=>{location.reload();});
        }).catch(function(e) {
            Swal.fire({icon:'error',title:e.response?e.response.data.title:'خطأ'});
        });
    });
}
</script>
@endsection
