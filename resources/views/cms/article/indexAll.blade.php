@extends('cms.parent')
@section('title', 'All Articles')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">All Articles</h3>
        <div class="card-tools"><a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</a></div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->author->user->first_name ?? '' }} {{ $article->author->user->last_name ?? '' }}</td>
                    <td>{{ $article->category->name ?? '' }}</td>
                    <td>{{ $article->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('{{ $article->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $articles->links() }}</div>
</div>
@endsection
@section('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('/cms/admin/articles/' + id).then(function() {
                    Swal.fire('Deleted!', 'Article has been deleted.', 'success').then(() => location.reload());
                });
            }
        });
    }
</script>
@endsection
