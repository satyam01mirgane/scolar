<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    
    <style>
        .main-sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
        }
        .content-wrapper {
            margin-left: 250px;
        }
        .main-header {
            margin-left: 250px;
        }
        @media (max-width: 768px) {
            .main-sidebar {
                transform: translateX(-250px);
                transition: transform .3s ease-in-out;
            }
            .sidebar-open .main-sidebar {
                transform: translateX(0);
            }
            .content-wrapper, .main-header {
                margin-left: 0;
            }
            .navbar-collapse {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: #343a40;
                padding: 1rem;
                border-radius: 0 0 4px 4px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                display: none;
            }
            .navbar-collapse.show {
                display: block;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item d-md-none">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{url('/')}}" class="nav-link">Home</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('logout')}}">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/')}}" class="brand-link">
                <img src="{{asset('assets/images/logo.svg')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{url('dashboard')}}" class="nav-link {{$menu1 ?? ''}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('enrolled-workshop')}}" class="nav-link {{$menu3 ?? ''}}">
                                <i class="nav-icon far fa-image"></i>
                                <p>Enrolled Workshops</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('scheduled-workshop')}}" class="nav-link {{$menu4 ?? ''}}">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>Scheduled Workshops</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('enrolled-course')}}" class="nav-link {{$menu6 ?? ''}}">
                                <i class="nav-icon far fa-image"></i>
                                <p>Enrolled Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('scheduled-course')}}" class="nav-link {{$menu7 ?? ''}}">
                                <i class="nav-icon far fa-image"></i>
                                <p>Scheduled Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('certificate-feedback')}}" class="nav-link {{$menu5 ?? ''}}">
                                <i class="nav-icon fas fa-certificate"></i>
                                <p>Certificate & Feedback</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('quiz-list')}}" class="nav-link {{$menu8 ?? ''}}">
                                <i class="nav-icon fas fa-question"></i>
                                <p>Online Quiz</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('test-list')}}" class="nav-link {{$menu9 ?? ''}}">
                                <i class="nav-icon fas fa-question"></i>
                                <p>Online Test</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('change-password')}}" class="nav-link {{$menu2 ?? ''}}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
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

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- Required Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        // Toggle mobile menu
        $('[data-widget="pushmenu"]').on('click', function() {
            $('body').toggleClass('sidebar-open');
        });

        // Close sidebar when clicking outside on mobile
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-sidebar, .main-header').length) {
                $('body').removeClass('sidebar-open');
            }
        });
    });
    </script>
</body>
</html>

