<section id="page-content" style="padding: 2rem 2rem; background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="content col-lg-12">
                <div class="heading-text heading-section text-center" style="margin-bottom: 1rem;">
                    <h3 style="font-size: 2rem; font-weight: bold;">Our Masterclass</h3>
                </div>

                <!-- Course Grid -->
                <div id="course-list" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    <?php $__currentLoopData = $course_list->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="post-item animated-card" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; background-color: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div class="post-item-wrap" style="border-radius: inherit;">
                            <div class="post-image" style="overflow: hidden; border-radius: inherit;">
                                <a href="<?php echo e(url('course-detail/'.$course->slug)); ?>">
                                    <img src="<?php echo e(asset($course->image)); ?>" alt="<?php echo e($course->name); ?>" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease; border-radius: inherit;">
                                </a>
                            </div>
                            <div class="post-item-description" style="padding: 1rem;">
                                <span>
                                    <i class="fa fa-calendar-o" style="margin-right: 0.5rem;"></i><?php echo e(date('d M Y h:i A', strtotime($course->session_date . ' ' . $course->session_time))); ?>

                                </span>
                                <h4><?php echo e($course->course_type); ?></h4>
                                <h3 style="color: #000;">
                                    <a href="<?php echo e(url('course-detail/'.$course->slug)); ?>" style="text-decoration: none; color: inherit;"><?php echo e(Str::limit($course->name, 30)); ?></a>
                                </h3>
                                <p><?php echo e(Str::limit($course->short_description, 40)); ?></p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                                    <p style="font-size: 1rem; font-weight: bold; color: #28a745; margin: 0;">
                                        <?php echo e($course->workshop_type == 'Free' ? 'Free' : '₹' . number_format($course->price, 2)); ?>

                                    </p>
                                    <?php if(!in_array($course->id, cartproduct())): ?>
                                    <form action="<?php echo e(route('cart.store')); ?>" method="POST" style="margin: 0;">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" value="<?php echo e($course->id); ?>" name="id">
                                        <input type="hidden" value="<?php echo e($course->name); ?>" name="name">
                                        <input type="hidden" value="<?php echo e($course->price); ?>" name="price">
                                        <input type="hidden" value="<?php echo e($course->image); ?>" name="image">
                                        <input type="hidden" value="1" name="quantity">
                                    </form>
                                    <?php else: ?>
                                    <button class="btn btn-orange btn-sm" type="button">In Cart</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- View All Courses Button -->
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="<?php echo e(url('/courses')); ?>" style="color: black; font-weight:500; text-decoration:underline">More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS -->
<style>
    /* Card hover effects */
    .animated-card {
        animation: fadeInUp 0.5s ease-out;
    }

    .animated-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .post-item-wrap img:hover {
        transform: scale(1.1);
    }

    /* Uniform border radius */
    .post-item {
        border-radius: 10px;
        overflow: hidden;
    }

    .post-item-wrap {
        border-radius: inherit;
    }

    .post-image img {
        border-radius: inherit;
    }

    /* Font and Text Styling */
    .post-item-description span {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .post-item-description h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #000;
    }

    .post-item-description h3 {
        font-size: 1.25rem;
        font-weight: bold;
        color: #000;
        margin-bottom: 0.5rem;
    }

    .post-item-description p {
        font-size: 0.95rem;
        line-height: 1.5;
        color: #000;
        margin: 0;
    }

    /* Button Styling */
    .btn-orange {
        background-color: #ff9800;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-orange:hover {
        background-color: #e68900;
    }

    /* Animation for fade-in effect */
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

    /* View All Courses Button */
    .btn-primary {
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/home-page-common/home-course.blade.php ENDPATH**/ ?>