@extends('cms.parent')
@section('title', 'Role Permissions')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Permissions for Role: {{ $role->name }}</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Permission</th><th>Guard</th><th>Action</th></tr></thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>
                        <form action="{{ route('roles.permissions.store', $role->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                            <button type="submit" class="btn btn-sm {{ $role->hasPermissionTo($permission->name) ? 'btn-success' : 'btn-secondary' }}">
                                {{ $role->hasPermissionTo($permission->name) ? 'Assigned' : 'Assign' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $permissions->links() }}</div>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
