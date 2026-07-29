@extends('cms.parent')
@section('title', 'Edit Admin')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Edit Admin</h3></div>
    <div class="card-body">
        <form id="editForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label>First Name</label><input type="text" name="first_name" value="{{ $admins->user->first_name ?? '' }}" class="form-control" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Last Name</label><input type="text" name="last_name" value="{{ $admins->user->last_name ?? '' }}" class="form-control" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ $admins->email }}" class="form-control" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Mobile</label><input type="text" name="mobile" value="{{ $admins->user->mobile ?? '' }}" class="form-control" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Date</label><input type="date" name="date" value="{{ $admins->user->date ?? '' }}" class="form-control" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" {{ ($admins->user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ ($admins->user->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ ($admins->user->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ ($admins->user->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>City</label>
                        <select name="city_id" class="form-control">
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ ($admins->user->city_id ?? '') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control"></div>
                </div>
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
        axios.post('{{ route("admins-update", $admins->id) }}', formData).then(function(response) {
            if (response.data.redirect) {
                window.location.href = response.data.redirect;
            } else {
                Swal.fire({ icon: 'success', title: 'Updated Successfully' }).then(() => {
                    window.location.href = '{{ route("admins.index") }}';
                });
            }
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
