<nav class="main-header navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="{{url('/')}}" class="navbar-brand">
            <img src="{{asset('assets/images/logo.svg')}}" alt="Logo" class="brand-image" style="height: 40px;">
        </a>

        <!-- Toggler for Sidebar (for Mobile View) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar" id="sidebarToggle">
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

<!-- Required scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Toggle sidebar visibility when the button is clicked on mobile
    $('.navbar-toggler').click(function() {
        $('#sidebarToggle').toggleClass('show');
    });
});
</script>

<style>
/* Styling for the sidebar */
.main-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
    background-color: #343a40;
    color: #fff;
    z-index: 9999;
}

.nav-sidebar {
    padding-top: 10px;
}

.nav-sidebar .nav-item {
    padding: 10px;
    margin: 0;
}

.nav-sidebar .nav-link {
    color: #ddd;
}

.nav-sidebar .nav-link:hover {
    background-color: #495057;
}

.nav-sidebar .nav-item.active .nav-link {
    background-color: #007bff;
}

/* For better mobile responsiveness */
@media (max-width: 768px) {
    .main-sidebar {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 200px;
        display: none; /* Initially hide the sidebar */
    }

    .main-sidebar.show {
        display: block; /* Show when toggled */
    }

    .navbar-toggler {
        display: block; /* Display the toggler button */
    }
}
</style>
