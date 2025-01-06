<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('assets/images/logo.svg')}}">
      <span></span>
    </a>

    <!-- Sidebar -->
    <div class="navbar-collapse">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
      <!-- Sidebar user (optional) -->
    
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{$menu1}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>       
          <!-- <li class="nav-item">
            <a href="{{url('enrolled-workshop')}}" class="nav-link {{$menu3}}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Enrolled Workshops
              </p>
            </a>
          </li>
           
		  <li class="nav-item">
            <a href="{{url('scheduled-workshop')}}" class="nav-link {{$menu4}}">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Scheduled Workshops
              </p>
            </a>
          </li>
		   -->
		  <!-- <li class="nav-item">
            <a href="{{url('enrolled-course')}}" class="nav-link {{$menu6}}">
              <i class="nav-icon far fa-image"></i>
              <p>
               Enrolled Courses
              </p>
            </a>
          </li> -->
		  
		  <li class="nav-item">
            <a href="{{url('scheduled-course')}}" class="nav-link {{$menu7}}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Scheduled Courses
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="{{url('certificate-feedback')}}" class="nav-link {{$menu5}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Certificate & Feedback
              </p>
            </a>
          </li>
		   <!-- <li class="nav-item">
            <a href="{{url('quiz-list')}}" class="nav-link {{$menu8}}">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Online Quiz
              </p>
            </a>
          </li> -->
		   <!-- <li class="nav-item">
            <a href="{{url('test-list')}}" class="nav-link {{$menu9}}">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Online Test
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="{{url('change-password')}}" class="nav-link {{$menu2}}">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="{{url('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
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

  </aside>




