@extends('cms.parent')
@section('title', 'Sliders')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Sliders List</h3>
        <div class="card-tools"><a href="{{ route('sliders.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</a></div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead><tr><th>ID</th><th>Title</th><th>Image</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->title }}</td>
                    <td><img src="{{ $slider->image ? asset('storage/images/slider/' . $slider->image) : '' }}" width="80"></td>
                    <td>{{ $slider->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('sliders.show', $slider->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('{{ $slider->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $sliders->links() }}</div>
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
                axios.delete('/cms/admin/sliders/' + id).then(function() {
                    Swal.fire('Deleted!', 'Slider has been deleted.', 'success').then(() => location.reload());
                });
            }
        });
    }
</script>
@endsection
