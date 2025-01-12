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
                    <a href="https://forms.gle/REUMWYRNR28fRXjv6" target="_blank" class="btn btn-primary btn-lg animate-button">
                        <i class="fas fa-graduation-cap me-2"></i>Apply for Internship
                    </a>

                    <!-- Apply as an Instructor -->
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdMykqR2xjRUu01u07EKQXHm3AVxJXZVyc-ZOcgxVHCurKY-A/viewform?usp=sharing" target="_blank" class="btn btn-success btn-lg animate-button">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Apply as an Instructor
                    </a>

                    <!-- Apply for Job -->
                    <a href="https://forms.gle/rXPYwMGAAUhyu98u6" target="_blank" class="btn btn-dark btn-lg animate-button">
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
        /* General button styles */
        .animate-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        /* Apply specific button color */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-dark:hover {
            background-color: #23272b;
            border-color: #1d2124;
        }

        /* Button icons spacing */
        .btn i {
            margin-right: 10px;
        }

        /* Button container adjustments */
        .animate-buttons-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            padding-top: 20px;
        }

        /* Responsive behavior */
        @media (max-width: 768px) {
            .animate-button {
                width: 100%;
                text-align: center;
                padding: 14px 20px;
            }

            .animate-buttons-container {
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .animate-button {
                font-size: 0.9rem;
                padding: 12px 16px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/workshop-list.blade.php ENDPATH**/ ?>