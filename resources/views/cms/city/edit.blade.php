@extends('cms.parent')
@section('title', 'Edit City')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Edit City</h3></div>
    <div class="card-body">
        <form id="editForm">
            @csrf
            <div class="form-group"><label>Name</label><input type="text" name="name" value="{{ $cities->name }}" class="form-control" required></div>
            <div class="form-group"><label>Street</label><input type="text" name="street" value="{{ $cities->street }}" class="form-control"></div>
            <div class="form-group"><label>Country</label>
                <select name="country_id" class="form-control">
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ $cities->country_id == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                    @endforeach
                </select>
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
        formData.append('_method', 'PUT');
        axios.post('{{ route("cities-update", $cities->id) }}', formData).then(function(response) {
            if (response.data.redirect) window.location.href = response.data.redirect;
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
