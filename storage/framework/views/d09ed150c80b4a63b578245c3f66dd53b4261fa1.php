<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<section class="py-5" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row">
            <!-- Contact Form Section -->
            <div class="col-lg-6 mb-4">
                <h3 class="text-uppercase" style="font-weight: bold; color: #333;">Get In Touch</h3>
                <p style="color: #6c757d;">Too excited to know us? So are we! If you wish to communicate with us for your queries, you can connect with us through the form attached below.</p>
                <form class="widget-contact-form" id="contactForm" novalidate method="POST">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="contact">Contact No</label>
                            <input type="text" name="contact" class="form-control" placeholder="Your Phone no..." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Enter your Message" required></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Send Message</button>
                </form>
            </div>

            <!-- Address & Map Section -->
            <div class="col-lg-6">
                <h3 class="text-uppercase" style="font-weight: bold; color: #333;">Address & Map</h3>
                <address style="margin-top: 1rem; color: #6c757d;">
                    <strong>V Scolar Office</strong><br>
                    <?php echo e(app_setting()->contact_address); ?><br>
                    <abbr title="Phone">P:</abbr> <?php echo e(app_setting()->contact_phone); ?><br>
                    <abbr title="Email">E:</abbr> <?php echo e(app_setting()->contact_email); ?>

                </address>
                <!-- Google Map -->
                <div style="margin-top: 2rem; border-radius: 12px; overflow: hidden; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1754.9499284705041!2d77.3471993!3d28.3920925!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cdd4c787f3ae7%3A0xe95dc28928865f63!2sVSCHOLAR%20SCHOLAR%20llp!5e0!3m2!1sen!2sin!4v1688733536534!5m2!1sen!2sin" 
                        width="100%" 
                        height="350" 
                        style="border: 0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
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
        background-color: #007bff;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Form Styling */
    .form-group label {
        font-weight: bold;
        color: #333;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 0.95rem;
    }

    /* Address Styling */
    address {
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        iframe {
            height: 250px;
        }
        .btn-primary {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
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