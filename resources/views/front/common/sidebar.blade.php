<!-- Remove the aside and add this navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="{{url('/')}}" class="navbar-brand">
            <img src="{{asset('assets/images/logo.svg')}}" alt="Logo" class="brand-image" style="height: 40px;">
        </a>

        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{url('dashboard')}}" class="nav-link {{$menu1}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('scheduled-course')}}" class="nav-link {{$menu7}}">
                        <i class="nav-icon far fa-image"></i> Scheduled Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('certificate-feedback')}}" class="nav-link {{$menu5}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i> Certificate & Feedback
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('change-password')}}" class="nav-link {{$menu2}}">
                        <i class="nav-icon far fa-calendar-alt"></i> Change Password
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
@media (max-width: 768px) {
    /* .navbar-collapse {
        background: #343a40;
    } */
    .nav-link {
        padding: 0.5rem 1rem;
    }
}

.content-wrapper {
    margin-left: 0 !important;
}
</style>