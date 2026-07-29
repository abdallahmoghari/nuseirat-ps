@extends('cms.parent')
@section('title', 'Edit Country')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Edit Country</h3></div>
    <div class="card-body">
        <form id="editForm">
            @csrf
            <div class="form-group"><label>Country Name</label><input type="text" name="country_name" value="{{ $countries->country_name }}" class="form-control" required></div>
            <div class="form-group"><label>Code</label><input type="text" name="code" value="{{ $countries->code }}" class="form-control" required></div>
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
        axios.post('{{ route("countries-update", $countries->id) }}', formData).then(function(response) {
            if (response.data.redirect) window.location.href = response.data.redirect;
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
