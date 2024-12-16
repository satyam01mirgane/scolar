<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section id="page-content" class="sidebar-right py-5" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row">
            <!-- Post Content -->
            <div class="content col-lg-9">
                <!-- Page Title -->
                <div class="page-title mb-4">
                    <h1 style="font-size: 2.5rem; font-weight: bold; color: #333;">Our Latest Study Material</h1>
                </div>

                <!-- Blog Section -->
                <div id="blog" class="row">
                    <?php $__currentLoopData = $blog_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm animate-fade-in" style="border: none; border-radius: 12px; overflow: hidden;">
                            <!-- Image -->
                            <a href="<?php echo e(url('blog-detail/'.$v->slug)); ?>">
                                <img src="<?php echo e(asset($v->image)); ?>" alt="<?php echo e($v->name); ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                            </a>
                            <!-- Content -->
                            <div class="card-body">
                                <h3 class="card-title" style="font-size: 1.25rem; font-weight: bold; color: #333;">
                                    <a href="<?php echo e(url('blog-detail/'.$v->slug)); ?>" style="text-decoration: none; color: inherit;"><?php echo e($v->name); ?></a>
                                </h3>
                                <p class="card-text" style="color: #6c757d; font-size: 0.95rem;"><?php echo e(Str::limit($v->description, 150)); ?></p>
                                <a href="<?php echo e(url('blog-detail/'.$v->slug)); ?>" class="btn btn-outline-primary btn-sm">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($blog_list->links()); ?>

                </div>
            </div>
            <!-- End Post Content -->

            <!-- Sidebar -->
            <div class="sidebar col-lg-3">
                <!-- Recent Posts -->
                <div class="widget">
                    <h4 class="widget-title" style="font-weight: bold; color: #333;">Recently Posted</h4>
                    <div class="post-thumbnail-list">
                        <?php $__currentLoopData = $blog_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="post-thumbnail-entry d-flex mb-3">
                            <img src="<?php echo e(asset($v->image)); ?>" alt="<?php echo e($v->name); ?>" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; margin-right: 1rem;">
                            <div>
                                <a href="<?php echo e(url('blog-detail/'.$v->slug)); ?>" style="font-weight: bold; font-size: 1rem; text-decoration: none; color: #333;"><?php echo e($v->name); ?></a>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</section>

<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Custom Styles -->
<?php $__env->startPush('styles'); ?>
<style>
/* Modern UI Enhancements */
.card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}
.card-title a:hover {
    color: #007bff;
}
.widget-title {
    margin-bottom: 1rem;
    border-bottom: 2px solid #007bff;
    padding-bottom: 0.5rem;
}
.post-thumbnail-entry a:hover {
    color: #007bff;
}

/* Animations */
@keyframes  fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-text {
        font-size: 0.85rem;
    }
    .widget-title {
        font-size: 1.2rem;
    }
}
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/blogs.blade.php ENDPATH**/ ?>