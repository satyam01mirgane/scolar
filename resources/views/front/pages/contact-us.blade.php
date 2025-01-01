@include('front.common.header')
@include('front.common.navbar')

<section class="py-5" style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row justify-content-center">
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
                        <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Send Message</button>
                    </div>
                </form>
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
            // Remove any existing alert box
            const existingAlert = document.querySelector('.alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            // Create a new alert box
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
                this.reset(); // Clear form fields
            } else {
                alertBox.className += ' alert-danger';
                alertBox.style.color = '#721c24';
                alertBox.style.backgroundColor = '#f8d7da';
                alertBox.style.borderColor = '#f5c6cb';
                alertBox.innerText = data.message;
            }

            // Insert the alert box before the form
            this.insertAdjacentElement('beforebegin', alertBox);

            // Auto-remove the alert after 5 seconds
            setTimeout(() => alertBox.remove(), 5000);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
<style>
    .alert-danger {
        display: none !important;
    }
    .alert {
    animation: fadeIn 0.5s ease-out;
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
