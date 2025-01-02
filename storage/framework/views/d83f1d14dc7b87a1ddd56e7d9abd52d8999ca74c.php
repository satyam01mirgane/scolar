<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-2" style="background-color: #1E3A8A; width: 250px; position: fixed; top: 0; left: 0; bottom: 0; transition: all 0.3s ease;">
    <!-- Brand Logo -->
    <a href="<?php echo e(url('/')); ?>" class="brand-link" style="display: flex; align-items: center; padding: 1.5rem; text-decoration: none; border-bottom: 1px solid #374151;">
        <img src="<?php echo e(asset('assets/images/logo dashboard.jpg')); ?>" style="height: 35px; width: auto;" alt="Logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="padding: 1rem 0; height: calc(100% - 70px); overflow-y: auto;">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="list-style: none; padding: 0;">
                <!-- Dashboard -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="<?php echo e(url('dashboard')); ?>" class="nav-link <?php echo e($menu1); ?>" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; <?php echo e($menu1 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : ''); ?>" onmouseover="this.style.backgroundColor='#3B82F6'" onmouseout="this.style.backgroundColor='<?php echo e($menu1 == 'active' ? '#2563EB' : 'transparent'); ?>'; this.style.color='<?php echo e($menu1 == 'active' ? '#FFFFFF' : '#D1D5DB'); ?>';">
                        <i class="fas fa-tachometer-alt" style="margin-right: 0.75rem; <?php echo e($menu1 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;'); ?>"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; <?php echo e($menu1 == 'active' ? 'color: #FFFFFF;' : ''); ?>">Dashboard</p>
                    </a>
                </li>

                <!-- Scheduled Workshops -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="<?php echo e(url('scheduled-course')); ?>" class="nav-link <?php echo e($menu7); ?>" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; <?php echo e($menu7 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : ''); ?>" onmouseover="this.style.backgroundColor='#3B82F6'" onmouseout="this.style.backgroundColor='<?php echo e($menu7 == 'active' ? '#2563EB' : 'transparent'); ?>'; this.style.color='<?php echo e($menu7 == 'active' ? '#FFFFFF' : '#D1D5DB'); ?>';">
                        <i class="far fa-image" style="margin-right: 0.75rem; <?php echo e($menu7 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;'); ?>"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; <?php echo e($menu7 == 'active' ? 'color: #FFFFFF;' : ''); ?>">Scheduled Masterclass</p>
                    </a>
                </li>

                <!-- Certificate & Feedback -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="<?php echo e(url('certificate-feedback')); ?>" class="nav-link <?php echo e($menu5); ?>" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; <?php echo e($menu5 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : ''); ?>" onmouseover="this.style.backgroundColor='#3B82F6'" onmouseout="this.style.backgroundColor='<?php echo e($menu5 == 'active' ? '#2563EB' : 'transparent'); ?>'; this.style.color='<?php echo e($menu5 == 'active' ? '#FFFFFF' : '#D1D5DB'); ?>';">
                        <i class="fas fa-certificate" style="margin-right: 0.75rem; <?php echo e($menu5 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;'); ?>"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; <?php echo e($menu5 == 'active' ? 'color: #FFFFFF;' : ''); ?>">Certificate & Feedback</p>
                    </a>
                </li>

                <!-- Change Password -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="<?php echo e(url('change-password')); ?>" class="nav-link <?php echo e($menu2); ?>" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; <?php echo e($menu2 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : ''); ?>" onmouseover="this.style.backgroundColor='#3B82F6'" onmouseout="this.style.backgroundColor='<?php echo e($menu2 == 'active' ? '#2563EB' : 'transparent'); ?>'; this.style.color='<?php echo e($menu2 == 'active' ? '#FFFFFF' : '#D1D5DB'); ?>';">
                        <i class="far fa-calendar-alt" style="margin-right: 0.75rem; <?php echo e($menu2 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;'); ?>"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; <?php echo e($menu2 == 'active' ? 'color: #FFFFFF;' : ''); ?>">Change Password</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item" style="margin-top: auto;">
                    <a href="<?php echo e(url('logout')); ?>" class="nav-link" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#EF4444'; this.style.color='#FFFFFF';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#D1D5DB';">
                        <i class="fas fa-sign-out-alt" style="margin-right: 0.75rem;"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500;">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    .main-sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .main-sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .main-sidebar::-webkit-scrollbar-thumb {
        background: #4B5563;
        border-radius: 2px;
    }

    .main-sidebar::-webkit-scrollbar-thumb:hover {
        background: #374151;
    }

    @keyframes  fadeIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .nav-item {
        animation: fadeIn 0.3s ease-out forwards;
    }

    .nav-item:nth-child(1) { animation-delay: 0.1s; }
    .nav-item:nth-child(2) { animation-delay: 0.2s; }
    .nav-item:nth-child(3) { animation-delay: 0.3s; }
    .nav-item:nth-child(4) { animation-delay: 0.4s; }
    .nav-item:nth-child(5) { animation-delay: 0.5s; }
    .nav-item:nth-child(6) { animation-delay: 0.6s; }
</style>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/common/sidebar.blade.php ENDPATH**/ ?>