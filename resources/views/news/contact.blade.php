@extends('news.parent')
@section('title', 'تواصل معنا')
@section('content')

<div class="breadcrumb-area">
  <div class="container d-flex justify-content-between align-items-center">
    <h2>تواصل معنا</h2>
    <nav>
      <ol class="breadcrumb bg-transparent mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">الرئيسية</a></li>
        <li class="breadcrumb-item active">تواصل معنا</li>
      </ol>
    </nav>
  </div>
</div>

<section>
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="contact-info-box">
          <i class="fas fa-map-marker-alt"></i>
          <h5>العنوان</h5>
          <p>النصيرات - الشارع العام<br>مقابل بنك فلسطين</p>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="contact-info-box">
          <i class="fas fa-phone"></i>
          <h5>الهاتف</h5>
          <p>2560126<br>970592370900+</p>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="contact-info-box">
          <i class="fas fa-envelope"></i>
          <h5>البريد الإلكتروني</h5>
          <p>pal.nuseirat@gmail.com</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h4 class="mb-4" style="color: var(--primary);">أرسل لنا رسالة</h4>
            <form id="contactForm">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">الاسم <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                  <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="form-label">الرسالة <span class="text-danger">*</span></label>
                  <textarea name="message" rows="5" class="form-control" required></textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-primary-custom"><i class="fas fa-paper-plane"></i> إرسال</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar-card">
          <div class="card-header"><i class="fas fa-info-circle"></i> معلومات إضافية</div>
          <div class="card-body">
            <p>يمكنكم التواصل معنا خلال أوقات الدوام الرسمي من الأحد إلى الخميس من الساعة 8:00 صباحاً حتى 3:00 مساءً.</p>
            <hr>
            <p class="mb-1"><strong><i class="fas fa-phone" style="color:var(--primary);"></i> هاتف:</strong> 2560126</p>
            <p class="mb-1"><strong><i class="fab fa-whatsapp" style="color:var(--primary);"></i> واتساب:</strong> 970592370900+</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('scripts')
<script>
  document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    axios.post('{{ route("contacts.send") }}', formData).then(function(response) {
      Swal.fire({ icon: 'success', title: 'تم إرسال الرسالة بنجاح' });
      document.getElementById('contactForm').reset();
    }).catch(function(error) {
      Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'حدث خطأ أثناء الإرسال' });
    });
  });
</script>
@endsection
