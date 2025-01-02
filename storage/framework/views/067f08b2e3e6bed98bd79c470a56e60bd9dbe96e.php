<header style="background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: fixed; width: 100%; z-index: 1000; padding: 2px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 10px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <!-- Logo -->
            <div id="logo" style="margin-right: 10px;">
                <a href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('assets/images/logo dashboard.svg')); ?>" alt="logo" style="height: 60px;">
                </a>
            </div>

            <!-- Hamburger Menu for Mobile & Tablet -->
            <div id="hamburger-menu" style="display: none; cursor: pointer;">
                <i class="fas fa-bars" style="font-size: 24px;"></i>
            </div>

            <!-- Navigation & Action Buttons -->
            <nav style="flex-grow: 1; display: flex; justify-content: center;">
                <ul style="display: flex; list-style-type: none; margin: 0; padding: 0;">
                    <li><a href="<?php echo e(url('/')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; font-weight: 500; font-size: 12px;">Home</a></li>
                    <li><a href="<?php echo e(url('/about-us')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; font-size: 12px;">About</a></li>
                    <li><a href="<?php echo e(url('/courses')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; font-size: 12px;">Masterclass</a></li>
                    <li><a href="<?php echo e(url('/blogs')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; font-size: 12px;">Study Material</a></li>
                    <li><a href="<?php echo e(url('/workshops')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; font-size: 12px;">Career</a></li>
                    <li><a href="<?php echo e(url('/contact-us')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; font-size: 12px;">Support</a></li>
                </ul>
            </nav>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 8px; align-items: center;">
            <a href="https://www.vief.in/" style="padding: 4px 12px; background-color: #ff4d00; color: white; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 12px;" target="_blank">VIEF</a>
<a href="http://xcubit.in/" style="padding: 4px 12px; background-color: white; color: #ff4d00; border: 1px solid #ff4d00; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 12px;" target="_blank">Xcubit</a>
<a href="https://www.vastavintellect.com/" style="padding: 4px 12px; background-color: white; color: #ff4d00; border: 1px solid #ff4d00; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 12px;" target="_blank">VIIP</a>
<!-- <a href="#" style="padding: 4px 12px; background-color: white; color: #ff4d00; border: 1px solid #ff4d00; text-decoration: none; border-radius: 4px; font-weight: 500; font-size: 12px;" target="_blank">RTTP</a> -->

                <!-- Cart Icon -->
                <a href="<?php echo e(url('cart')); ?>" style="color: #333; font-size: 16px; display: flex; align-items: center; margin-left: 40px;">
                    <i class="fas fa-shopping-cart"></i>
                    <span style="background-color:#ff4d00; color: white; border-radius: 100%; padding: 3px 13px; font-size: 8px; margin-left: 4px;"><?php echo e(Cart::getTotalQuantity()); ?></span>
                </a>

                <?php if(isset(Auth::user()->name)): ?>
                    <a href="<?php echo e(url('dashboard')); ?>" title="<?php echo e(Auth::user()->name); ?>" class="btn btn-rounded">
                        <i class="fas fa-user"></i> <!-- User profile icon -->
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(url('login')); ?>" class="btn btn-rounded">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" style="display: none; background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: absolute; top: 60px; left: 0; right: 0; padding: 10px; z-index: 999;">
        <ul style="list-style-type: none; margin: 0; padding: 0; text-align: center;">
            <li><a href="<?php echo e(url('/')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; display: block;">Home</a></li>
            <li><a href="<?php echo e(url('/about-us')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; display: block;">About</a></li>
            <li><a href="<?php echo e(url('/courses')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; display: block;">Workshop</a></li>
            <li><a href="<?php echo e(url('/blogs')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; display: block;">Study Material</a></li>
            <li><a href="<?php echo e(url('/workshops')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; display: block;">Career</a></li>
            <li><a href="<?php echo e(url('/contact-us')); ?>" style="color: #333; text-decoration: none; padding: 10px 10px; display: block;">Contact</a></li>
        </ul>
    </div>
</header>

<style>
    body {
        margin: 0;
        padding: 0;
    }

    .container {
        margin-top: 60px;
    }

    #hamburger-menu {
        display: none;
    }

    @media (max-width: 1200px) {
        #hamburger-menu {
            display: block;
        }
        
        nav {
            display: none;
        }

        .action-buttons {
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .action-buttons a {
            margin-bottom: 5px;
        }
    }

    @media (max-width: 768px) {
        #mobile-menu {
            display: block;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerMenu.addEventListener('click', function() {
        mobileMenu.style.display = mobileMenu.style.display === 'none' || mobileMenu.style.display === '' ? 'block' : 'none';
    });
});
</script>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/common/navbar.blade.php ENDPATH**/ ?>