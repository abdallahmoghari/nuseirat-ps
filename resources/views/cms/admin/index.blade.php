@extends('cms.parent')
@section('title', 'Admins')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Admins List</h3>
        <div class="card-tools">
            @can('admin-create')
            <a href="{{ route('admins.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create Admin</a>
            @endcan
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr><th>ID</th><th>Name</th><th>Email</th><th>Status</th><th>Created</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->user->first_name ?? 'N/A' }} {{ $admin->user->last_name ?? '' }}</td>
                    <td>{{ $admin->email }}</td>
                    <td><span class="badge badge-{{ $admin->user->status == 'active' ? 'success' : 'danger' }}">{{ $admin->user->status ?? 'N/A' }}</span></td>
                    <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                    <td>
                        @can('admin-show')
                        <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('admin-edit')
                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('admin-delete')
                        <button onclick="confirmDelete('{{ $admin->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $admins->links() }}</div>
</div>
@endsection
@section('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('/cms/admin/admins/' + id).then(function() {
                    Swal.fire('Deleted!', 'Admin has been deleted.', 'success').then(() => location.reload());
                });
            }
        });
    }
</script>
@endsection
