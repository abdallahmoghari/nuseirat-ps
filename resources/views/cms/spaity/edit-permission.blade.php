@extends('cms.parent')
@section('title', 'Edit Permission')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Edit Permission</h3></div>
    <div class="card-body">
        <form id="editForm">
            @csrf
            <div class="form-group"><label>Name</label><input type="text" name="name" value="{{ $permissions->name }}" class="form-control" required></div>
            <div class="form-group"><label>Guard Name</label>
                <select name="guard_name" class="form-control">
                    <option value="admin" {{ $permissions->guard_name == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="author" {{ $permissions->guard_name == 'author' ? 'selected' : '' }}>Author</option>
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
        axios.post('{{ route("permissions-update", $permissions->id) }}', formData).then(function(response) {
            if (response.data.redirect) window.location.href = response.data.redirect;
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
