<header style="background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: fixed; width: 100%; z-index: 1000; padding: 2px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <!-- Logo -->
            <div id="logo" style="margin-right: 10px;">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo dashboard.svg') }}" alt="logo" style="height: 50px;">
                </a>
            </div>

            <!-- Hamburger Menu -->
            <div id="hamburger-menu" class="mobile-only" style="cursor: pointer;">
                <i class="fas fa-bars" style="font-size: 24px; color: #333;"></i>
            </div>

            <!-- Navigation -->
            <nav class="desktop-nav" style="flex-grow: 1;">
                <ul style="display: flex; list-style-type: none; margin: 0; padding: 0; justify-content: center;">
                    <li><a href="{{ url('/') }}" style="color: #333; text-decoration: none; padding: 10px 15px; font-weight: 500; font-size: 14px; font-family: 'Montserrat', sans-serif;">Home</a></li>
                    <li><a href="{{ url('/about-us') }}" style="color: #333; text-decoration: none; padding: 10px 15px; font-size: 14px; font-family: 'Montserrat', sans-serif;">About</a></li>
                    <li><a href="{{ url('/courses') }}" style="color: #333; text-decoration: none; padding: 10px 15px; font-size: 14px; font-family: 'Montserrat', sans-serif;">Masterclass</a></li>
                    <li><a href="{{ url('/blogs') }}" style="color: #333; text-decoration: none; padding: 10px 15px; font-size: 14px; font-family: 'Montserrat', sans-serif;">Study Material</a></li>
                    <li><a href="{{ url('/workshops') }}" style="color: #333; text-decoration: none; padding: 10px 15px; font-size: 14px; font-family: 'Montserrat', sans-serif;">Career</a></li>
                    <li><a href="{{ url('/contact-us') }}" style="color: #333; text-decoration: none; padding: 10px 15px; font-size: 14px; font-family: 'Montserrat', sans-serif;">Support</a></li>
                </ul>
            </nav>

            <!-- Action Buttons -->
            <div class="action-buttons" style="display: flex; gap: 8px; align-items: center;">
                <a href="https://www.vief.in/" class="action-button" style="padding: 6px 12px; background-color: #ff4d00; color: white; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 13px; font-family: 'Montserrat', sans-serif;" target="_blank">VIEF</a>
                <a href="http://xcubit.in/" class="action-button" style="padding: 6px 12px; background-color: white; color: #ff4d00; border: 1px solid #ff4d00; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 13px; font-family: 'Montserrat', sans-serif;" target="_blank">Xcubit</a>
                <a href="https://www.vastavintellect.com/" class="action-button" style="padding: 6px 12px; background-color: white; color: #ff4d00; border: 1px solid #ff4d00; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 13px; font-family: 'Montserrat', sans-serif;" target="_blank">VIIP</a>
                
                <a href="{{ url('cart') }}" class="cart-icon" style="color: #333; font-size: 16px; display: flex; align-items: center; margin-left: 20px; font-family: 'Montserrat', sans-serif;">
                    <i class="fas fa-shopping-cart"></i>
                    <span style="background-color:#ff4d00; color: white; border-radius: 50%; padding: 2px 6px; font-size: 10px; margin-left: 4px;">{{ Cart::getTotalQuantity() }}</span>
                </a>

                @if(isset(Auth::user()->name))
                    <a href="{{ url('dashboard') }}" title="{{ Auth::user()->name }}" class="user-icon" style="font-family: 'Montserrat', sans-serif;">
                        <i class="fas fa-user"></i>
                    </a>
                @else
                    <a href="{{ url('login') }}" class="login-button" style="font-family: 'Montserrat', sans-serif;">Login</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu" style="display: none;">
        <ul style="list-style-type: none; margin: 0; padding: 10px;">
            <li><a href="{{ url('/') }}" style="color: #333; text-decoration: none; padding: 12px 15px; display: block; border-bottom: 1px solid #eee; font-family: 'Montserrat', sans-serif;">Home</a></li>
            <li><a href="{{ url('/about-us') }}" style="color: #333; text-decoration: none; padding: 12px 15px; display: block; border-bottom: 1px solid #eee; font-family: 'Montserrat', sans-serif;">About</a></li>
            <li><a href="{{ url('/courses') }}" style="color: #333; text-decoration: none; padding: 12px 15px; display: block; border-bottom: 1px solid #eee; font-family: 'Montserrat', sans-serif;">Masterclass</a></li>
            <li><a href="{{ url('/blogs') }}" style="color: #333; text-decoration: none; padding: 12px 15px; display: block; border-bottom: 1px solid #eee; font-family: 'Montserrat', sans-serif;">Study Material</a></li>
            <li><a href="{{ url('/workshops') }}" style="color: #333; text-decoration: none; padding: 12px 15px; display: block; border-bottom: 1px solid #eee; font-family: 'Montserrat', sans-serif;">Career</a></li>
            <li><a href="{{ url('/contact-us') }}" style="color: #333; text-decoration: none; padding: 12px 15px; display: block; border-bottom: 1px solid #eee; font-family: 'Montserrat', sans-serif;">Support</a></li>
        </ul>
        <div class="mobile-action-buttons" style="padding: 15px; display: flex; flex-wrap: wrap; gap: 10px;">
            <a href="https://www.vief.in/" style="padding: 8px 15px; background-color: #ff4d00; color: white; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 14px; text-align: center; flex: 1; font-family: 'Montserrat', sans-serif;" target="_blank">VIEF</a>
            <a href="http://xcubit.in/" style="padding: 8px 15px; background-color: white; color: #ff4d00; border: 1px solid #ff4d00; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 14px; text-align: center; flex: 1; font-family: 'Montserrat', sans-serif;" target="_blank">Xcubit</a>
            <a href="https://www.vastavintellect.com/" style="padding: 8px 15px; background-color: white; color: #ff4d00; border: 1px solid #ff4d00; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 14px; text-align: center; flex: 1; font-family: 'Montserrat', sans-serif;" target="_blank">VIIP</a>
        </div>
    </div>
</header>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

    body {
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
    }

    .container {
        margin-top: 60px;
    }

    .mobile-only {
        display: none;
    }

    .mobile-menu {
        display: none;
        position: fixed;
        top: 60px;
        left: 0;
        right: 0;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 999;
    }

    .action-buttons a:hover {
        opacity: 0.9;
    }

    @media (max-width: 1024px) {
        .desktop-nav {
            display: none;
        }

        .mobile-only {
            display: block;
        }

        .action-buttons .action-button {
            display: none;
        }

        .cart-icon, .user-icon, .login-button {
            margin-left: 15px !important;
        }
    }

    @media (max-width: 768px) {
        #logo img {
            height: 40px;
        }

        .cart-icon {
            font-size: 14px !important;
        }

        .mobile-menu ul li a {
            font-size: 14px;
        }

        .mobile-action-buttons {
            flex-direction: column;
        }

        .mobile-action-buttons a {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 0 10px;
        }

        .cart-icon span {
            padding: 1px 4px;
            font-size: 8px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    let isMenuOpen = false;

    hamburgerMenu.addEventListener('click', function() {
        isMenuOpen = !isMenuOpen;
        mobileMenu.style.display = isMenuOpen ? 'block' : 'none';
        
        // Prevent body scrolling when menu is open
        document.body.style.overflow = isMenuOpen ? 'hidden' : 'auto';
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (isMenuOpen && !mobileMenu.contains(event.target) && !hamburgerMenu.contains(event.target)) {
            mobileMenu.style.display = 'none';
            isMenuOpen = false;
            document.body.style.overflow = 'auto';
        }
    });

    // Close menu on window resize if switching to desktop view
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024 && isMenuOpen) {
            mobileMenu.style.display = 'none';
            isMenuOpen = false;
            document.body.style.overflow = 'auto';
        }
    });
});
</script>