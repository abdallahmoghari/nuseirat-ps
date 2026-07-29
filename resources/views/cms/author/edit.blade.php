@extends('cms.parent')
@section('title', 'Edit Author')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Edit Author</h3></div>
    <div class="card-body">
        <form id="editForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label>First Name</label><input type="text" name="first_name" value="{{ $authors->user->first_name ?? '' }}" class="form-control" required></div></div>
                <div class="col-md-6"><div class="form-group"><label>Last Name</label><input type="text" name="last_name" value="{{ $authors->user->last_name ?? '' }}" class="form-control" required></div></div>
                <div class="col-md-6"><div class="form-group"><label>Email</label><input type="email" name="email" value="{{ $authors->email }}" class="form-control" required></div></div>
                <div class="col-md-6"><div class="form-group"><label>Mobile</label><input type="text" name="mobile" value="{{ $authors->user->mobile ?? '' }}" class="form-control" required></div></div>
                <div class="col-md-6"><div class="form-group"><label>Date</label><input type="date" name="date" value="{{ $authors->user->date ?? '' }}" class="form-control" required></div></div>
                <div class="col-md-6"><div class="form-group"><label>Gender</label><select name="gender" class="form-control"><option value="male" {{ ($authors->user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option><option value="female" {{ ($authors->user->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option></select></div></div>
                <div class="col-md-6"><div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="active" {{ ($authors->user->status ?? '') == 'active' ? 'selected' : '' }}>Active</option><option value="inactive" {{ ($authors->user->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option></select></div></div>
                <div class="col-md-6"><div class="form-group"><label>City</label><select name="city_id" class="form-control">@foreach($cities as $city)<option value="{{ $city->id }}" {{ ($authors->user->city_id ?? '') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>@endforeach</select></div></div>
                <div class="col-md-6"><div class="form-group"><label>Image</label><input type="file" name="image" class="form-control"></div></div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        axios.post('{{ route("authors-update", $authors->id) }}', formData).then(function(response) {
            if (response.data.redirect) window.location.href = response.data.redirect;
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
