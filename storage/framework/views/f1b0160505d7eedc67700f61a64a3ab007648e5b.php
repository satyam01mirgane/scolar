<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content Section -->
<section id="course-details" style="padding: 4rem 1rem; background-color: #f4f7fc;">
    <div class="container">
        <!-- Course Card -->
        <div class="row course-card mb-5 p-4 shadow-lg rounded-4" style="background-color: #ffffff; transition: all 0.3s ease; border-radius: 16px;">
            <div class="col-md-4 col-12 d-flex align-items-center justify-content-center">
                <img src="<?php echo e($course_details->image ? asset($course_details->image) : asset('images/default.jpg')); ?>" 
                     alt="<?php echo e($course_details->name); ?>" 
                     class="img-fluid rounded-4 course-image" 
                     style="object-fit: cover; max-height: 300px; border-radius: 12px; transition: all 0.3s ease;">
            </div>
            <div class="col-md-8 col-12">
                <h1 style="font-size: 2.5rem; font-weight: 700; color: #333; line-height: 1.2; margin-bottom: 1rem;"><?php echo e($course_details->name); ?></h1>
                <p style="font-size: 1.1rem; color: #666; margin-bottom: 1.5rem;"><?php echo e($course_details->short_description); ?></p>

                <!-- Course Info List -->
                <ul class="list-unstyled mt-3">
                    <?php if(isset($course_details->edureka_certificates)): ?>
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-certificate" style="color: #007bff; margin-right: 0.8rem; font-size: 1.2rem;"></i>
                        <span><?php echo e($course_details->edureka_certificates); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if(isset($course_details->hrs_live_classes)): ?>
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock" style="color: #28a745; margin-right: 0.8rem; font-size: 1.2rem;"></i>
                        <span><?php echo e($course_details->hrs_live_classes); ?> </span>
                    </li>
                    <?php endif; ?>
                    <?php if(isset($course_details->weekend_classes)): ?>
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-calendar-check" style="color: #6f42c1; margin-right: 0.8rem; font-size: 1.2rem;"></i>
                        <span><?php echo e($course_details->weekend_classes); ?> </span>
                    </li>
                    <?php endif; ?>
                </ul>

                <!-- Button Section -->
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <?php if($course_details->total_seat > 0): ?>
                    <button class="btn btn-outline-success seats-left" style=" font-size: 1rem; border-radius: 0.5rem; font-weight: 600;">
                        <i class="fas fa-users" style="margin-right: 0.5rem;"></i>
                        <?php echo e($course_details->total_seat); ?> Seats Left
                    </button>
                    <?php else: ?>
                    <button class="btn btn-outline-secondary seats-full" style=" font-size: 1rem; border-radius: 0.5rem; font-weight: 600;" disabled>
                        <i class="fas fa-users-slash" style="margin-right: 0.5rem;"></i>
                        Seat Full
                    </button>
                    <?php endif; ?>

                    <?php if(!in_array($course_details->id, cartproduct())): ?>
                        <?php if($course_details->total_seat > 0): ?>
                        <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($course_details->id); ?>">
                            <input type="hidden" name="name" value="<?php echo e($course_details->name); ?>-Course">
                            <input type="hidden" name="price" value="<?php echo e($course_details->price); ?>">
                            <input type="hidden" name="image" value="<?php echo e($course_details->image); ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary enroll-now" style=" font-size: 1rem; border-radius: 0.5rem; font-weight: 600;">
                                <i class="fas fa-shopping-cart" style="margin-right: 0.5rem;"></i>
                                Enroll Now
                            </button>
                        </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(url('cart')); ?>" class="btn btn-secondary in-cart" style=" font-size: 1rem; border-radius: 0.5rem; font-weight: 600;">
                            <i class="fas fa-shopping-cart" style="margin-right: 0.5rem;"></i>
                            In Cart
                        </a>
                    <?php endif; ?>

                    <button class="btn btn-warning price-tag" style="padding:  font-size: 1rem; border-radius: 0.5rem; font-weight: 600;">
                        <i class="fas fa-tag" style="margin-right: 0.5rem;"></i>
                        ₹<?php echo e($course_details->price - $course_details->discount_value); ?>

                    </button>
                </div>
            </div>
        </div>

        <!-- Course Description -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 style="font-size: 2rem; font-weight: 600; color: #333; margin-bottom: 1rem;">Course Description</h2>
                <div style="background-color: #ffffff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <p style="font-size: 1rem; color: #666; line-height: 1.6;">
                        <?php echo nl2br($course_details->full_description); ?>

                    </p>
                </div>
            </div>
        </div>
<!-- Learning Modules Section -->
<div class="row mb-5">
    <div class="col-lg-12">
        <h2 style="font-size: 2rem; font-weight: 600; color: #333; margin-bottom: 1rem; text-align: center;">Learning Modules</h2>
        <div class="text-center mb-3">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#learningModulesCollapse" aria-expanded="false" aria-controls="learningModulesCollapse" style="transition: all 0.3s ease;">
                <i class="fas fa-caret-down" style="margin-right: 0.5rem;"></i> View Learning Modules
            </button>
        </div>
        <div class="collapse" id="learningModulesCollapse">
            <div style="background-color: #ffffff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <ul style="list-style: none; padding: 0;">
                    <?php $__currentLoopData = explode("\r\n", trim($course_details->learning_modules)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="module-item mb-2" style="padding: 0.75rem; background-color: #f8f9fa; border-radius: 8px; transition: all 0.3s ease;">
                        <i class="fas fa-book" style="margin-right: 0.5rem; color: #007bff;"></i> <?php echo e($module); ?>

                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>


        <!-- Certificate Section -->
        <div class="row mb-5">
            <div class="col-lg-12 text-center">
                <h2 style="font-size: 2rem; font-weight: 600; color: #333; margin-bottom: 1rem;">Sample Certificate</h2>
                <img src="<?php echo e(asset($course_details->sample_certificate_image)); ?>" alt="Sample Certificate" class="img-fluid rounded-4 shadow-lg" style="max-width: 80%;">
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 style="font-size: 2rem; font-weight: 600; color: #333; margin-bottom: 1rem;">Frequently Asked Questions</h2>
                <div style="background-color: #ffffff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($course_details->{'question' . $index})): ?>
                    <div class="mb-4">
                        <h4 style="font-size: 1.25rem; font-weight: 500; color: #333; cursor: pointer;" onclick="toggleFAQ(this)">
                            <i class="fas fa-plus" style="color: #007bff; margin-right: 0.5rem;"></i> <?php echo e($course_details->{'question' . $index}); ?>

                        </h4>
                        <p style="color: #666; line-height: 1.6; display: none; padding-left: 1.5rem;"><?php echo e($course_details->{'answer' . $index}); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    .btn { white-space: normal; }
    .module-item:hover {
        background-color: #e9ecef;
        transform: translateX(5px);
    }
</style>

<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const icon = element.querySelector('i');
        if (answer.style.display === 'none' || answer.style.display === '') {
            answer.style.display = 'block';
            icon.classList.replace('fa-plus', 'fa-minus');
        } else {
            answer.style.display = 'none';
            icon.classList.replace('fa-minus', 'fa-plus');
        }
    }
</script>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/course-details.blade.php ENDPATH**/ ?>