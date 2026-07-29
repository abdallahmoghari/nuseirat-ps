@extends('cms.parent')
@section('title', 'Trashed Countries')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Trashed Countries</h3>
        <div class="card-tools" id="trashActions">
            <button onclick="confirmForceDeleteAll()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete All</button>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Country Name</th><th>Code</th><th>Deleted At</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->country_name }}</td>
                    <td>{{ $country->code }}</td>
                    <td>{{ $country->deleted_at }}</td>
                    <td>
                        <button onclick="confirmRestore('{{ $country->id }}')" class="btn btn-success btn-sm"><i class="fas fa-trash-restore"></i></button>
                        <button onclick="confirmForceDelete('{{ $country->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $countries->links() }}</div>
    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
@section('scripts')
<script>
    function confirmRestore(id) {
        Swal.fire({
            title: 'Restore this country?', icon: 'question',
            showCancelButton: true, confirmButtonColor: '#3085d6', confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('/cms/admin/countries-restore/' + id).then(function() {
                    Swal.fire('Restored!', '', 'success').then(() => location.reload());
                }).catch(function() {
                    Swal.fire('Error!', 'Restore failed.', 'error');
                });
            }
        });
    }
    function confirmForceDelete(id) {
        Swal.fire({
            title: 'Permanently delete?', text: "This cannot be undone!", icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('/cms/admin/countries-forceDelete/' + id).then(function() {
                    Swal.fire('Deleted!', '', 'success').then(() => location.reload());
                }).catch(function() {
                    Swal.fire('Error!', 'Delete failed.', 'error');
                });
            }
        });
    }
    function confirmForceDeleteAll() {
        Swal.fire({
            title: 'Delete all trashed?', text: "This cannot be undone!", icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Yes, delete all!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('/cms/admin/countries-forceDeleteAll').then(function() {
                    Swal.fire('Deleted!', 'All trashed countries deleted.', 'success').then(() => location.reload());
                }).catch(function() {
                    Swal.fire('Error!', 'Delete failed.', 'error');
                });
            }
        });
    }
</script>
@endsection