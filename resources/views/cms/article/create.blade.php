@extends('cms.parent')
@section('title', 'Create Article')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Create Article</h3></div>
    <div class="card-body">
        <form id="createForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Title</label><input type="text" name="title" class="form-control" required></div>
            <div class="form-group"><label>Short Description</label><textarea name="short_description" class="form-control" required></textarea></div>
            <div class="form-group"><label>Full Description</label><textarea name="full_description" class="form-control" rows="5" required></textarea></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Author</label>
                        <select name="author_id" class="form-control">
                            @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ isset($id) && $id == $author->id ? 'selected' : '' }}>{{ $author->user->first_name ?? '' }} {{ $author->user->last_name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control"></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.getElementById('createForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        axios.post('{{ route("articles.store") }}', formData).then(function(response) {
            Swal.fire({ icon: 'success', title: response.data.title }).then(() => {
                @if(isset($id))
                window.location.href = '{{ route("indexArticle", $id) }}';
                @else
                window.location.href = '{{ route("articles.index") }}';
                @endif
            });
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
