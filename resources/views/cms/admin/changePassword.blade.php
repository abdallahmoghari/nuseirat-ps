@extends('cms.parent')
@section('title', 'Change Password')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Change Password</h3></div>
    <div class="card-body">
        <form id="passwordForm">
            @csrf
            <div class="form-group"><label>Current Password</label><input type="password" name="current_password" class="form-control" required></div>
            <div class="form-group"><label>New Password</label><input type="password" name="new_password" class="form-control" required></div>
            <div class="form-group"><label>Confirm New Password</label><input type="password" name="new_password_confirmation" class="form-control" required></div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        axios.post('{{ route("updatePassword") }}', formData).then(function(response) {
            Swal.fire({ icon: 'success', title: response.data.title }).then(() => location.reload());
        }).catch(function(error) {
            Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Error' });
        });
    });
</script>
@endsection
