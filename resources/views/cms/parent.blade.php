<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - CMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayScrollbars@1.13.3/css/OverlayScrollbars.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('mainPage') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link" target="_blank"><i class="fas fa-external-link-alt"></i> الموقع الرئيسي</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle"></i>
                    @auth('admin')
                        {{ auth('admin')->user()->user->first_name ?? 'Admin' }}
                    @endauth
                    @auth('author')
                        {{ auth('author')->user()->user->first_name ?? 'Author' }}
                    @endauth
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{ route('user.profile') }}" class="dropdown-item"><i class="fas fa-user mr-2"></i> Profile</a>
                    <a href="{{ route('edit-profile') }}" class="dropdown-item"><i class="fas fa-edit mr-2"></i> Edit Profile</a>
                    <a href="{{ route('changePassword') }}" class="dropdown-item"><i class="fas fa-key mr-2"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('view.logout') }}" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('view.logout') }}" method="GET" style="display: none;"></form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Nuseirat News CMS</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @php
                        $guard = auth('admin')->check() ? 'admin' : (auth('author')->check() ? 'author' : null);
                        $user = $guard ? auth($guard)->user() : null;
                        $userModel = $user && $user->user ? $user->user : null;
                        $img = $userModel ? $userModel->image : null;
                    @endphp
                    <img src="{{ $img ? asset('storage/images/' . $guard . '/' . $img) : asset('assets/images/default-avatar.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover;">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ $user && $user->user ? $user->user->first_name . ' ' . $user->user->last_name : 'User' }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('mainPage') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    @canany(['role-list', 'permission-list'])
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shield-alt"></i>
                            <p>Roles & Permissions<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link"><i class="fas fa-circle nav-icon"></i><p>Roles</p></a></li>
                            <li class="nav-item"><a href="{{ route('permissions.index') }}" class="nav-link"><i class="fas fa-circle nav-icon"></i><p>Permissions</p></a></li>
                        </ul>
                    </li>
                    @endcanany

                    @canany(['admin-list', 'author-list'])
                    <li class="nav-header">USER MANAGEMENT</li>
                    @can('admin-list')
                    <li class="nav-item"><a href="{{ route('admins.index') }}" class="nav-link"><i class="nav-icon fas fa-user-shield"></i><p>Admins</p></a></li>
                    @endcan
                    @can('author-list')
                    <li class="nav-item"><a href="{{ route('authors.index') }}" class="nav-link"><i class="nav-icon fas fa-user-edit"></i><p>Authors</p></a></li>
                    @endcan
                    @endcanany

                    <li class="nav-header">CONTENT MANAGEMENT</li>
                    @can('country-list')
                    <li class="nav-item"><a href="{{ route('countries.index') }}" class="nav-link"><i class="nav-icon fas fa-globe"></i><p>Countries</p></a></li>
                    @endcan
                    @can('city-list')
                    <li class="nav-item"><a href="{{ route('cities.index') }}" class="nav-link"><i class="nav-icon fas fa-city"></i><p>Cities</p></a></li>
                    @endcan
                    @can('category-list')
                    <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link"><i class="nav-icon fas fa-tags"></i><p>Categories</p></a></li>
                    @endcan
                    @can('article-list')
                    <li class="nav-item"><a href="{{ route('articles.index') }}" class="nav-link"><i class="nav-icon fas fa-newspaper"></i><p>Articles</p></a></li>
                    @endcan

                    <li class="nav-header">MANAGEMENT WEBSITE</li>
                    @can('slider-list')
                    <li class="nav-item"><a href="{{ route('sliders.index') }}" class="nav-link"><i class="nav-icon fas fa-images"></i><p>Sliders</p></a></li>
                    @endcan
                    @can('contact-list')
                    <li class="nav-item"><a href="{{ route('contacts.index') }}" class="nav-link"><i class="nav-icon fas fa-envelope"></i><p>Contacts</p></a></li>
                    @endcan

                    <li class="nav-header">SETTINGS</li>
                    <li class="nav-item"><a href="{{ route('user.profile') }}" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Show Profile</p></a></li>
                    <li class="nav-item"><a href="{{ route('edit-profile') }}" class="nav-link"><i class="nav-icon fas fa-edit"></i><p>Edit Profile</p></a></li>
                    <li class="nav-item"><a href="{{ route('changePassword') }}" class="nav-link"><i class="nav-icon fas fa-key"></i><p>Change Password</p></a></li>
                    <li class="nav-item"><a href="{{ route('view.logout') }}" class="nav-link text-danger"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="#">Nuseirat News</a>.</strong> All rights reserved.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/overlayScrollbars@1.13.3/js/OverlayScrollbars.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
</script>
@yield('scripts')
</body>
</html>
