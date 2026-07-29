@extends('cms.parent')
@section('title', 'Edit Slider')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Edit Slider</h3></div>
    <div class="card-body">
        <form id="editForm">
            @csrf
            <div class="form-group"><label>Title</label><input type="text" name="title" value="{{ $sliders->title }}" class="form-control" required></div>
            <div class="form-group"><label>Description</label><textarea name="description" class="form-control" required>{{ $sliders->description }}</textarea></div>
            <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control"></div>
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
        axios.post('{{ route("sliders-update", $sliders->id) }}', formData).then(function(response) {
            if (response.data.redirect) window.location.href = response.data.redirect;
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
