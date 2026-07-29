<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ ucfirst($guard) }} Login — بلدية النصيرات</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/axios@1/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  body {
    background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
    display: flex; align-items: center; justify-content: center; min-height: 100vh;
    font-family: 'Tajawal', 'Segoe UI', sans-serif;
  }
  .login-card {
    background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    padding: 40px; max-width: 420px; width: 100%;
  }
  .login-card .icon { font-size: 40px; color: #0d6efd; text-align: center; margin-bottom: 12px; }
  .login-card h3 { text-align: center; font-weight: 700; color: #2c3e50; margin-bottom: 24px; }
  .login-card label { font-weight: 600; color: #2c3e50; margin-bottom: 6px; }
  .login-card .form-control {
    border-radius: 10px; border: 2px solid #dee2e6; padding: 12px 15px;
    transition: all 0.3s ease;
  }
  .login-card .form-control:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,0.15); }
  .login-card .btn {
    width: 100%; padding: 14px; font-weight: 600; border-radius: 10px;
    background: #0d6efd; color: #fff; border: none; font-size: 16px;
    transition: all 0.3s ease; margin-top: 8px;
  }
  .login-card .btn:hover { background: #0b5ed7; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
  .login-card .back-link { text-align: center; margin-top: 16px; }
  .login-card .back-link a { color: #6c757d; text-decoration: none; font-size: 14px; }
  .login-card .back-link a:hover { color: #0d6efd; }
</style>
</head>
<body>
<div class="login-card">
  <div class="icon"><i class="fas fa-city"></i></div>
  <h3>{{ ucfirst($guard) }} Login</h3>
  <form id="loginForm">
    @csrf
    <input type="hidden" name="guard" value="{{ $guard }}">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" placeholder="Enter email" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter password" required>
    </div>
    <button type="submit" class="btn">Login</button>
  </form>
  <div class="back-link"><a href="{{ route('login.type') }}">← العودة لاختيار نوع الدخول</a></div>
</div>
<script>
  document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    axios.post('{{ route("view.login", $guard) }}', {
      email: formData.get('email'),
      password: formData.get('password'),
      guard: '{{ $guard }}'
    }).then(function(response) {
      Swal.fire({ icon: 'success', title: 'Login Successfully' }).then(() => {
        window.location.href = '{{ route("mainPage") }}';
      });
    }).catch(function(error) {
      Swal.fire({ icon: 'error', title: error.response ? error.response.data.title : 'Login Failed' });
    });
  });
</script>
</body>
</html>
