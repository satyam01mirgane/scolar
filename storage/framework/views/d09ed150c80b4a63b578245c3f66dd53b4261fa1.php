<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<section class="py-5" style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Section -->
            <div class="col-lg-6 mb-5">
                <h3 class="text-uppercase text-center" style="font-weight: bold; color: #333;">Get In Touch</h3>
                <p class="text-center" style="color: #6c757d;">We'd love to hear from you! Reach out to us by filling out the form below.</p>
                <form class="widget-contact-form" id="contactForm" novalidate method="POST">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name" class="font-weight-bold text-dark">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="email" class="font-weight-bold text-dark">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="contact" class="font-weight-bold text-dark">Phone Number</label>
                            <input type="text" name="contact" class="form-control" placeholder="Your Phone No..." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="font-weight-bold text-dark">Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Enter your Message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Send Message</button>
                    </div>
                </form>
            </div>

            <!-- Address & Map Section -->
            <div class="col-lg-6">
                <h3 class="text-uppercase text-center" style="font-weight: bold; color: #333;">Our Location</h3>
                <div class="card shadow-sm p-4" style="border-radius: 8px; background-color: #fff;">
                    <address style="font-size: 1rem; line-height: 1.8; color: #6c757d;">
                        <strong>VScholar Office</strong><br>
                        <?php echo e(app_setting()->contact_address); ?><br>
                        <abbr title="Phone">Phone:</abbr> <?php echo e(app_setting()->contact_phone); ?><br>
                        <abbr title="Email">Email:</abbr> <?php echo e(app_setting()->contact_email); ?>

                    </address>
                    <div id="map-container" style="width: 100%; height: 250px; border-radius: 8px; background: url('https://via.placeholder.com/600x250') center center/cover; transition: background 0.3s ease;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Custom Styles -->
<?php $__env->startPush('styles'); ?>
<style>
    /* Button Styling */
    .btn-primary {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        border: none;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        border-radius: 50px;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #009bff);
        box-shadow: 0 8px 12px rgba(0, 123, 255, 0.4);
        transform: scale(1.05);
    }

    /* Form Styling */
    .form-group label {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.75rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Address Styling */
    address {
        font-size: 1rem;
        line-height: 1.8;
        color: #6c757d;
    }

    /* Map Hover Effect */
    #map-container:hover {
        background: url('https://via.placeholder.com/600x250') center center/contain;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .col-lg-6 {
            margin-bottom: 20px;
        }
        .btn-primary {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
        }
    }

    /* Animation for Form */
    .widget-contact-form {
        opacity: 0;
        animation: fadeIn 1s ease-in-out forwards;
    }
    @keyframes  fadeIn {
        100% {
            opacity: 1;
        }
    }

</style>
<?php $__env->stopPush(); ?>

<!-- Form Submission Script -->
<script>
    document.querySelector('#contactForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('<?php echo e(url("/submit-contact")); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                this.reset();
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/contact-us.blade.php ENDPATH**/ ?>