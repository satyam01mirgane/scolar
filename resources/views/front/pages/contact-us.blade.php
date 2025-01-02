@include('front.common.header')
@include('front.common.navbar')

<section class="py-5" style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-6 mb-5">
                <h3 class="text-uppercase text-center" style="font-weight: bold; color: #333;">Get In Touch</h3>
                <p class="text-center" style="color: #6c757d;">We'd love to hear from you! Reach out to us by filling out the form below.</p>
                <form class="widget-contact-form" id="contactForm" novalidate method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-dark">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="font-weight-bold text-dark">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="font-weight-bold text-dark">Phone Number</label>
                        <input type="text" name="contact" class="form-control" placeholder="Your Phone No..." required>
                    </div>
                    <div class="form-group">
                        <label for="message" class="font-weight-bold text-dark">Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Enter your Message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="fa fa-paper-plane"></i>&nbsp;Send Message
                        </button>
                    </div>
                </form>
            </div>
            <!-- Address Section -->
            <div class="col-lg-6">
                <div class="address-box p-4" style="background-color: #fff; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1); border-radius: 8px; animation: fadeInRight 1s;">
                    <h4 class="font-weight-bold text-dark text-center mb-4">Our Address</h4>
                    <p class="text-dark text-center" style="font-size: 1.1rem;">
                        A-61-C Shivaji Enclave<br>
                        Rajori Garden<br>
                        New Delhi-27
                    </p>
                    <div class="map-container mt-4" style="border-radius: 8px; overflow: hidden;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3498.123456789!2d77.123456789!3d28.654321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0234567890123%3A0x456789abcd12345!2sShivaji%20Enclave%20Rajouri%20Garden%20Delhi!5e0!3m2!1sen!2sin!4v1691762300123!5m2!1sen!2sin"
                            width="100%" 
                            height="250" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

<script>
    document.querySelector('#contactForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('{{ url("/submit-contact") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const existingAlert = document.querySelector('.alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            const alertBox = document.createElement('div');
            alertBox.className = 'alert mt-3';
            alertBox.style.padding = '15px';
            alertBox.style.borderRadius = '5px';
            alertBox.style.fontWeight = 'bold';

            if (data.success) {
                alertBox.className += ' alert-success';
                alertBox.style.color = '#155724';
                alertBox.style.backgroundColor = '#d4edda';
                alertBox.style.borderColor = '#c3e6cb';
                alertBox.innerText = data.message;
                this.reset();
            } else {
                alertBox.className += ' alert-danger';
                alertBox.style.color = '#721c24';
                alertBox.style.backgroundColor = '#f8d7da';
                alertBox.style.borderColor = '#f5c6cb';
                alertBox.innerText = data.message;
            }

            this.insertAdjacentElement('beforebegin', alertBox);

            setTimeout(() => alertBox.remove(), 5000);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

<style>
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .address-box {
        animation: fadeInRight 1s ease-in-out;
    }
</style>
