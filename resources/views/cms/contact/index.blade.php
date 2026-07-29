@extends('cms.parent')
@section('title', 'Contacts')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Contacts List</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Message</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($contact->message, 50) }}</td>
                    <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <button onclick="confirmDelete('{{ $contact->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $contacts->links() }}</div>
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
                axios.delete('/cms/admin/contacts/' + id).then(function() {
                    Swal.fire('Deleted!', 'Contact has been deleted.', 'success').then(() => location.reload());
                });
            }
        });
    }
</script>
@endsection
