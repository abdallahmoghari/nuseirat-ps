@extends('cms.parent')
@section('title', 'Authors')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Authors List</h3>
        @can('author-create')
        <div class="card-tools"><a href="{{ route('authors.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create Author</a></div>
        @endcan
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->user->first_name ?? 'N/A' }} {{ $author->user->last_name ?? '' }}</td>
                    <td>{{ $author->email }}</td>
                    <td><span class="badge badge-{{ ($author->user->status ?? '') == 'active' ? 'success' : 'danger' }}">{{ $author->user->status ?? 'N/A' }}</span></td>
                    <td>{{ $author->created_at->format('Y-m-d') }}</td>
                    <td>
                        @can('author-show')
                        <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('author-edit')
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('article-list')
                        <a href="{{ route('indexArticle', $author->id) }}" class="btn btn-success btn-sm"><i class="fas fa-newspaper"></i></a>
                        @endcan
                        @can('author-delete')
                        <button onclick="confirmDelete('{{ $author->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $authors->links() }}</div>
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
                axios.delete('/cms/admin/authors/' + id).then(function() {
                    Swal.fire('Deleted!', 'Author has been deleted.', 'success').then(() => location.reload());
                });
            }
        });
    }
</script>
@endsection
