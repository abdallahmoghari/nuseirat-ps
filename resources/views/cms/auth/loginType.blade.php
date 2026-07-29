<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>دخول — بلدية النصيرات</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">
<style>
  body {
    background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
    display: flex; align-items: center; justify-content: center; min-height: 100vh;
    font-family: 'Tajawal', 'Segoe UI', sans-serif;
  }
  .login-box {
    background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    padding: 40px; text-align: center; max-width: 420px; width: 100%;
  }
  .login-box .icon { font-size: 48px; color: #0d6efd; margin-bottom: 16px; }
  .login-box h2 { font-weight: 700; margin-bottom: 8px; color: #2c3e50; }
  .login-box p { color: #6c757d; margin-bottom: 24px; }
  .login-box .btn {
    width: 100%; padding: 14px; font-weight: 600; border-radius: 10px;
    margin-bottom: 12px; font-size: 16px; border: none;
    transition: all 0.3s ease;
  }
  .login-box .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
  .login-box .btn-admin { background: #0d6efd; color: #fff; }
  .login-box .btn-author { background: #ffc107; color: #2c3e50; }
</style>
</head>
<body>
<div class="login-box">
  <div class="icon"><i class="fas fa-city"></i></div>
  <h2>بلدية النصيرات</h2>
  <p>اختر نوع الدخول إلى لوحة التحكم</p>
  <a href="{{ route('view.login', 'admin') }}" class="btn btn-admin"><i class="fas fa-user-shield"></i> Admin</a>
  <a href="{{ route('view.login', 'author') }}" class="btn btn-author"><i class="fas fa-user-edit"></i> Author</a>
</div>
</body>
</html>
