<aside class="main-sidebar elevation-2" id="sidebar" style="background-color: #1E3A8A; position: fixed; top: 0; left: 0; bottom: 0; transition: all 0.3s ease; display: block;">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link" style="display: flex; align-items: center; padding: 1.5rem; text-decoration: none; border-bottom: 1px solid #374151;">
        <img src="{{asset('assets/images/logo dashboard.jpg')}}" style="height: 35px; width: auto;" alt="Logo">
    </a>

    <!-- Sidebar Content -->
    <div class="sidebar-content" style="padding: 1rem 0; height: calc(100% - 70px); overflow-y: auto;">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="list-style: none; padding: 0;">
                <!-- Dashboard -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="{{url('dashboard')}}" class="nav-link {{$menu1}}" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; {{ $menu1 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : '' }}">
                        <i class="fas fa-tachometer-alt" style="margin-right: 0.75rem; {{ $menu1 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;' }}"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; {{ $menu1 == 'active' ? 'color: #FFFFFF;' : '' }}">Dashboard</p>
                    </a>
                </li>

                <!-- Scheduled Workshops -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="{{url('scheduled-course')}}" class="nav-link {{$menu7}}" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; {{ $menu7 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : '' }}">
                        <i class="far fa-image" style="margin-right: 0.75rem; {{ $menu7 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;' }}"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; {{ $menu7 == 'active' ? 'color: #FFFFFF;' : '' }}">Scheduled Masterclass</p>
                    </a>
                </li>

                <!-- Certificate & Feedback -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="{{url('certificate-feedback')}}" class="nav-link {{$menu5}}" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; {{ $menu5 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : '' }}">
                        <i class="fas fa-certificate" style="margin-right: 0.75rem; {{ $menu5 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;' }}"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; {{ $menu5 == 'active' ? 'color: #FFFFFF;' : '' }}">Certificate & Feedback</p>
                    </a>
                </li>

                <!-- Change Password -->
                <li class="nav-item" style="margin-bottom: 0.5rem;">
                    <a href="{{url('change-password')}}" class="nav-link {{$menu2}}" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease; {{ $menu2 == 'active' ? 'background-color: #2563EB; color: #FFFFFF;' : '' }}">
                        <i class="far fa-calendar-alt" style="margin-right: 0.75rem; {{ $menu2 == 'active' ? 'color: #FFFFFF;' : 'color: #D1D5DB;' }}"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500; {{ $menu2 == 'active' ? 'color: #FFFFFF;' : '' }}">Change Password</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item" style="margin-top: auto;">
                    <a href="{{url('logout')}}" class="nav-link" style="display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #D1D5DB; text-decoration: none; border-radius: 8px; margin: 0 0.75rem; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#EF4444'; this.style.color='#FFFFFF';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#D1D5DB';">
                        <i class="fas fa-sign-out-alt" style="margin-right: 0.75rem;"></i>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 500;">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Floating Sidebar Button -->
    <button class="floating-btn" style="display: none; position: fixed; bottom: 2rem; left: 1.5rem; background-color: #2563EB; color: white; border: none; border-radius: 50%; padding: 1rem; font-size: 1.5rem; cursor: pointer; z-index: 1000;">
        <i class="fas fa-bars"></i>
    </button>
</aside>

<style>
    .main-sidebar {
        display: block; /* Ensure sidebar is visible on desktop */
    }

    .floating-btn {
        display: block; /* Floating button is visible by default */
    }

    /* Mobile and Tablet Responsiveness */
    @media (max-width: 768px) {
        .main-sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px; /* Initially hidden */
            transition: all 0.3s ease;
        }

        .sidebar-content {
            padding: 1rem 0;
        }

        .nav-link {
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            text-align: center;
        }

        .nav-item i {
            margin-right: 0;
        }

        .brand-link {
            justify-content: center;
            padding: 0.75rem;
        }

        .main-sidebar .nav-pills {
            flex-direction: column;
        }

        .main-sidebar .nav-item {
            text-align: center;
            margin: 0;
        }

        .nav-item p {
            display: none;
        }

        .floating-btn {
            left: 1rem; /* Adjust positioning on smaller screens */
        }
    }

    @media (max-width: 480px) {
        .main-sidebar {
            width: 60px;
        }

        .nav-link {
            font-size: 0.65rem;
            padding: 0.5rem 1rem;
        }
    }
</style>

<script>
    document.querySelector('.floating-btn').addEventListener('click', function() {
        var sidebar = document.querySelector('#sidebar');
        if (sidebar.style.left === '-250px' || sidebar.style.left === '') {
            sidebar.style.left = '0';
        } else {
            sidebar.style.left = '-250px';
        }
    });
</script>
