<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('assets/images/logo.svg')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{$menu1}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('enrolled-workshop')}}" class="nav-link {{$menu3}}">
              <i class="nav-icon far fa-image"></i>
              <p>Enrolled Workshops</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('scheduled-workshop')}}" class="nav-link {{$menu4}}">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Scheduled Workshops</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('enrolled-course')}}" class="nav-link {{$menu6}}">
              <i class="nav-icon far fa-image"></i>
              <p>Enrolled Courses</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('scheduled-course')}}" class="nav-link {{$menu7}}">
              <i class="nav-icon far fa-image"></i>
              <p>Scheduled Courses</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('certificate-feedback')}}" class="nav-link {{$menu5}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Certificate & Feedback</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('quiz-list')}}" class="nav-link {{$menu8}}">
              <i class="nav-icon fas fa-question"></i>
              <p>Online Quiz</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('test-list')}}" class="nav-link {{$menu9}}">
              <i class="nav-icon fas fa-question"></i>
              <p>Online Test</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('change-password')}}" class="nav-link {{$menu2}}">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Change Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        @yield('content-header')
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>
</div>

<!-- Required Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- Additional Scripts -->
@stack('scripts')

</body>
</html>

