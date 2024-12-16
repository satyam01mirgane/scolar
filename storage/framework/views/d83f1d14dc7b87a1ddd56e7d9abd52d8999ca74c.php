<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(url('/')); ?>" class="brand-link">
      <img src="<?php echo e(asset('assets/images/logo.svg')); ?>">
      <span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
    
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo e(url('dashboard')); ?>" class="nav-link <?php echo e($menu1); ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>       
          <!-- <li class="nav-item">
            <a href="<?php echo e(url('enrolled-workshop')); ?>" class="nav-link <?php echo e($menu3); ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Enrolled Workshops
              </p>
            </a>
          </li> -->
           
		  <!-- <li class="nav-item">
            <a href="<?php echo e(url('scheduled-workshop')); ?>" class="nav-link <?php echo e($menu4); ?>">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Scheduled Workshops
              </p>
            </a>
          </li> -->
		  
		  <!-- <li class="nav-item">
            <a href="<?php echo e(url('enrolled-course')); ?>" class="nav-link <?php echo e($menu6); ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
               Enrolled Workshops
              </p>
            </a>
          </li> -->
		  
		  <li class="nav-item">
            <a href="<?php echo e(url('scheduled-course')); ?>" class="nav-link <?php echo e($menu7); ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Scheduled Workshops
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="<?php echo e(url('certificate-feedback')); ?>" class="nav-link <?php echo e($menu5); ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Certificate & Feedback
              </p>
            </a>
          </li>
		   <!-- <li class="nav-item">
            <a href="<?php echo e(url('quiz-list')); ?>" class="nav-link <?php echo e($menu8); ?>">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Online Quiz
              </p>
            </a>
          </li> -->
		   <!-- <li class="nav-item">
            <a href="<?php echo e(url('test-list')); ?>" class="nav-link <?php echo e($menu9); ?>">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Online Test
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?php echo e(url('change-password')); ?>" class="nav-link <?php echo e($menu2); ?>">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?php echo e(url('logout')); ?>" class="nav-link">
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
  </aside><?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/common/sidebar.blade.php ENDPATH**/ ?>