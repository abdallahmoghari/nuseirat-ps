@extends('cms.parent')
@section('title', 'Countries')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Countries List</h3>
        <div class="card-tools">
            <a href="{{ route('countries.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</a>
            <a href="{{ route('countries-trashed') }}" class="btn btn-secondary btn-sm"><i class="fas fa-trash-restore"></i> Trashed</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Country Name</th><th>Code</th><th>Cities Count</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->country_name }}</td>
                    <td>{{ $country->code }}</td>
                    <td>{{ $country->cities->count() }}</td>
                    <td>{{ $country->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('countries.show', $country->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('{{ $country->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $countries->links() }}</div>
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
                axios.delete('/cms/admin/countries/' + id).then(function() {
                    Swal.fire('Deleted!', 'Country has been deleted.', 'success').then(() => location.reload());
                });
            }
        });
    }
</script>
@endsection
