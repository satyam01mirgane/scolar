
<nav class="main-header navbar  navbar-dark bg-dark">
    <div class="container">
        <a href="{{url('/')}}" class="navbar-brand">
            <img src="{{asset('assets/images/logo.svg')}}" alt="Logo" class="brand-image" style="height: 0px;">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse  navbar-collapse" id="navbarCollapse">
            <ul class="nav nav-pills " data-widget="treeview" role="menu" data-accordion="false">
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
.navbar-collapse {
    transition: all 0s ease;
}

@media (max-width: 768px) {
    .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #343a40;
        padding: 1rem;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        display: none; /* Initially hidden */
    }
    
    .navbar-collapse.show {
        display: block;
    }
}
</style>

<!-- Required scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('.navbar-toggler').click(function() {
        $('#navbarCollapse').stop(true, true).slideToggle(300); // 300ms for smooth transition
    });

    // Close menu when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest('.navbar').length) {
            $('#navbarCollapse').slideUp(300); // Close the menu with a smooth transition
        }
    });

    // Close menu when clicking a link on mobile
    $('.nav-link').click(function() {
        $('#navbarCollapse').slideUp(300); // Close with smooth transition
    });
});
</script>
