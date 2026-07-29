@extends('cms.parent')
@section('title', 'Edit Category')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Edit Category</h3></div>
    <div class="card-body">
        <form id="editForm">
            @csrf
            <div class="form-group"><label>Name</label><input type="text" name="name" value="{{ $categories->name }}" class="form-control" required></div>
            <div class="form-group"><label>Description</label><textarea name="description" class="form-control">{{ $categories->description }}</textarea></div>
            <div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="active" {{ $categories->status == 'active' ? 'selected' : '' }}>Active</option><option value="inactive" {{ $categories->status == 'inactive' ? 'selected' : '' }}>Inactive</option></select></div>
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
        axios.post('{{ route("categories-update", $categories->id) }}', formData).then(function(response) {
            if (response.data.redirect) window.location.href = response.data.redirect;
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
