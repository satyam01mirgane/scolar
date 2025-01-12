<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Header Menu -->
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- SECTION IMAGE FULLSCREEN -->
<section class="fullscreen slide animate-slide-in" 
         style="background-image: url('<?php echo e(asset('assets/images/newbg.jpeg')); ?>'); 
                position: relative; 
                background-size: cover; 
                background-position: center;">

    <!-- Overlay -->
    <div style="position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                background-color: rgba(0, 0, 0, 0.5); 
                z-index: 1;">
    </div>

    <!-- Content -->
    <div class="container" style="position: relative; z-index: 2; animation: fadeIn 1s;">
        <div class="container-fullscreen">
            <div class="text-left">
                <div class="text-light">
                    <h1 class="text-uppercase text-sm animate-fade-up">
                        <span style="color:#FF4A11 !important;">Empowering</span> Knowledge,<br>
                        <span style="color: #FF4A11 !important;">Inspiring</span> Growth
                    </h1>
                    <a href="<?php echo e(url('about-us')); ?>" class="btn btn-red animate-bounce">Know More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section>
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = service_list(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6" style="animation: fadeInUp 1s <?php echo e($k * 0.1); ?>s;">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="<?php echo e($v->image); ?>"></i></a>
                    </div>
                    <h3><?php echo e($v->name); ?></h3>
                    <p><?php echo e($v->description); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- end: SERVICES -->
<!-- IMAGE BLOCK -->
<section id="image-block" class="image-block no-padding animate-fade-in">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" 
                 style="height: 609px; 
                        display: flex; 
                        justify-content: center;  
                        background-size: cover;   
                        background-image: url('<?php echo e(asset('assets/images/yt-bg.jpg')); ?>');  
                        align-items: center;">
                <iframe id="video-frame" 
                        style="border-radius: 25px; width: 70%; height: 80%; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2); animation: scaleIn 1s;" 
                        src="https://res.cloudinary.com/dql4uvrzz/video/upload/v1732974634/hsdpte3zjn7aja6s0gv3.mp4" 
                        title="Video player" 
                        frameborder="0" 
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen
                        onclick="toggleVideo(this)">
                </iframe>
            </div>
        </div>
    </div>
</section>

<script>
    function toggleVideo(iframe) {
        // If the video is not playing, play it
        if (!iframe.src.includes('autoplay=1')) {
            iframe.src += '?autoplay=1';
        } else {
            // If the video is already playing, stop it by resetting the src
            iframe.src = iframe.src.split('?')[0];
        }
    }
</script>


<!-- end: IMAGE BLOCK -->

<?php echo $__env->make('front.home-page-common.home-course', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.home-page-common.testimonial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Add Custom Styles for Animations -->
<?php $__env->startPush('styles'); ?>
<style>
/* General Animation Keyframes */
@keyframes  fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes  fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes  fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes  bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes  scaleIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

/* Apply Animations to Specific Classes */
.animate-fade-in { animation: fadeIn 1s ease-out; }
.animate-fade-up { animation: fadeInUp 1s ease-out; }
.animate-slide-in { animation: fadeUp 1s ease-out; }
.animate-bounce { animation: bounce 2s infinite; }

/* Responsive Adjustments */
@media (max-width: 768px) {
    .animate-slide-in { animation-duration: 1.2s; }
    .animate-bounce { animation-duration: 2.5s; }
}
</style>
<?php $__env->stopPush(); ?>

<!-- Add Custom Scripts for Scroll-Based Animations -->
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    });

    // Observe specific sections
    document.querySelectorAll('.icon-box, #image-block, .testimonial').forEach(element => {
        observer.observe(element);
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/home.blade.php ENDPATH**/ ?>