@extends('cms.parent')
@section('title', 'Permissions')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Permissions List</h3>
        <div class="card-tools"><a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</a></div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Name</th><th>Guard</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>{{ $permission->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('{{ $permission->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $permissions->links() }}</div>
</div>
@if(session('success'))<script>Swal.fire({icon:'success',title:'{{ session("success") }}'});</script>@endif
@if(session('error'))<script>Swal.fire({icon:'error',title:'{{ session("error") }}'});</script>@endif
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
                axios.delete('/cms/admin/permissions/' + id).then(function() {
                    Swal.fire('Deleted!', 'Permission has been deleted.', 'success').then(() => location.reload());
                });
            }
        });
    }
</script>
@endsection
