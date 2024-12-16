

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container my-5">
    <div class="text-center">
        <h1 class="mb-4">Join Our Team</h1>
        <p class="mb-5">Explore opportunities to become a part of our team. Select an option below:</p>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <a href="https://forms.gle/example-instructor" target="_blank" class="btn btn-primary btn-block">
                    Join as Instructor
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="https://forms.gle/example-intern" target="_blank" class="btn btn-success btn-block">
                    Join as Intern
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="https://forms.gle/example-job" target="_blank" class="btn btn-danger btn-block">
                    Apply for a Job
                </a>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\New folder\htdocs\RUN\resources\views/career.blade.php ENDPATH**/ ?>