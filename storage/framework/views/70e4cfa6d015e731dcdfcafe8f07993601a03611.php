<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section id="opportunities-section" class="animate-fade-in" style="padding: 6rem 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <!-- Title -->
                <h2 class="mb-4 animate-title" style="font-size: 3rem; font-weight: bold; color: #333;">Explore Opportunities</h2>
                <p class="lead mb-5 animate-subtitle" style="color: #666;">Join our team and make a difference. Choose the path that suits you best.</p>

                <!-- Buttons Section -->
                <div class="d-flex justify-content-center flex-wrap gap-4 animate-buttons-container">
                    <!-- Apply for Internship -->
                    <a href="https://forms.gle/REUMWYRNR28fRXjv6" target="_blank" class="btn btn-primary btn-lg animate-button" style="width: 0px; background-color: #007bff; border-color: #007bff;">
                        <i class="fas fa-graduation-cap me-2"></i>Apply for Internship
                    </a>

                    <!-- Apply as an Instructor -->
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdMykqR2xjRUu01u07EKQXHm3AVxJXZVyc-ZOcgxVHCurKY-A/viewform?usp=sharing
" target="_blank" class="btn btn-success btn-lg animate-button" style="width: 0px; background-color: #28a745; border-color: #28a745;">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Apply as an Instructor
                    </a>

                    <!-- Apply for Job -->
                    <a href="https://forms.gle/rXPYwMGAAUhyu98u6" target="_blank" class="btn btn-dark btn-lg animate-button" style="width: 0px; background-color: #343a40; border-color: #343a40;">
                        <i class="fas fa-briefcase me-2"></i>Apply for Job
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* General Animations */
    @keyframes  fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes  scaleIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes  slideInFromLeft {
        from {
            transform: translateX(-50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Animation Classes */
    .animate-fade-in {
        animation: fadeInUp 1s ease-out;
    }

    .animate-title {
        animation: scaleIn 0.8s ease-out 0.2s both;
    }

    .animate-subtitle {
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .animate-buttons-container {
        animation: fadeInUp 0.8s ease-out 0.6s both;
    }

    .animate-button {
        animation: slideInFromLeft 0.6s ease-out both;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    }

    .animate-button:nth-child(1) { animation-delay: 0.8s; }
    .animate-button:nth-child(2) { animation-delay: 1s; }
    .animate-button:nth-child(3) { animation-delay: 1.2s; }

    /* Button Styling */
    .btn {
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }

    .btn:hover::after {
        animation: ripple 1s ease-out;
    }

    @keyframes  ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(20, 20);
            opacity: 0;
        }
    }

    /* Section Styling */
    #opportunities-section {
        position: relative;
        overflow: hidden;
    }

    #opportunities-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 50%);
        animation: rotate 30s linear infinite;
    }

    @keyframes  rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .animate-buttons-container {
            flex-direction: column;
            align-items: center;
        }
        .btn {
            width: 100% !important;
            margin-bottom: 1rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    // Page Load Animation
    document.body.classList.add('animate-fade-in');

    // Intersection Observer for button animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.visibility = 'visible';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-button').forEach(button => {
        button.style.visibility = 'hidden';
        observer.observe(button);
    });

    // Add hover effect to buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('mouseover', function() {
            this.style.backgroundColor = LightenDarkenColor(getComputedStyle(this).backgroundColor, 20);
        });
        button.addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
        });
    });

    // Function to lighten or darken a color
    function LightenDarkenColor(col, amt) {
        var usePound = false;
        if (col[0] == "#") {
            col = col.slice(1);
            usePound = true;
        }
        var num = parseInt(col,16);
        var r = (num >> 16) + amt;
        var b = ((num >> 8) & 0x00FF) + amt;
        var g = (num & 0x0000FF) + amt;
        if (r > 255) r = 255;
        else if  (r < 0) r = 0;
        if (b > 255) b = 255;
        else if  (b < 0) b = 0;
        if (g > 255) g = 255;
        else if (g < 0) g = 0;
        return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/workshop-list.blade.php ENDPATH**/ ?>