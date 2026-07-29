@extends('news.parent')
@section('title', 'قلم الجمهور')
@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <i class="fas fa-concierge-bell fa-4x text-primary mb-3"></i>
        <h1>قلم الجمهور</h1>
        <p class="text-muted lead">اختر الخدمة التي تريد تقديم طلب بشأنها</p>
    </div>
    <div class="row g-4">
        @php $serviceTypes = [
            'license' => ['icon'=>'fa-id-card','title'=>'ترخيص','desc'=>'تقديم طلب ترخيص جديد أو تجديد'],
            'certificate' => ['icon'=>'fa-certificate','title'=>'شهادة','desc'=>'طلب شهادة رسمية من البلدية'],
            'road_maintenance' => ['icon'=>'fa-road','title'=>'صيانة شارع','desc'=>'الإبلاغ عن حاجة لصيانة شارع'],
            'waste_container' => ['icon'=>'fa-trash-alt','title'=>'حاوية نفايات','desc'=>'طلب توفير حاوية نفايات'],
            'tree_pruning' => ['icon'=>'fa-tree','title'=>'تقليم أشجار','desc'=>'طلب تقليم أشجار أو إزالة خطر'],
        ]; @endphp
        @foreach($serviceTypes as $type => $service)
        <div class="col-md-6 col-lg-4">
            <div class="card service-card h-100 border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <i class="fas {{ $service['icon'] }} fa-3x text-primary mb-3"></i>
                    <h4>{{ $service['title'] }}</h4>
                    <p class="text-muted">{{ $service['desc'] }}</p>
                    <a href="{{ route('citizen.create-request', $type) }}" class="btn btn-primary stretched-link">تقديم طلب</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-4">
                    <i class="fas fa-search fa-3x text-success mb-3"></i>
                    <h4>متابعة الطلبات</h4>
                    <p class="text-muted">استعرض طلباتك السابقة وتابع حالتها</p>
                    <a href="{{ route('citizen.my-requests') }}" class="btn btn-success">طلباتي</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-4">
                    <i class="fas fa-question-circle fa-3x text-warning mb-3"></i>
                    <h4>استفسار</h4>
                    <p class="text-muted">لديك سؤال؟ أرسله لنا وسنرد عليك</p>
                    <a href="{{ route('citizen.inquiry') }}" class="btn btn-warning text-white">إرسال استفسار</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
