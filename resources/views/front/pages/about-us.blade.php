@include('front.common.header')
@include('front.common.navbar')

<section class="how-it-started py-5" style="background-color: #f4f4f4;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text Content -->
            <div class="col-lg-6 mb-4 content-column">
                <h6 class="text-uppercase animate-text" data-aos="fade-up" style="color: #FF4A11; font-weight: bold;">About us</h6>
                <h2 class="animate-text" data-aos="fade-up" data-aos-delay="100" style="font-size: 2.5rem; font-weight: bold; color: #000;">VScholar: Empowering Global Learning</h2>
                <p class="animate-text" data-aos="fade-up" data-aos-delay="200" style="font-size: 1rem; color: #6c757d; line-height: 1.8; text-align: justify;">
                    At <b>VScholar</b>, we believe in the transformative power of knowledge. Our platform is designed to provide individuals from all walks of life with access to the latest insights, practical skills, and hands-on learning, no matter their field of interest.
                </p>
                <hr class="animate-line" data-aos="fade-right" data-aos-delay="300">
                <h3 class="animate-text" data-aos="fade-up" data-aos-delay="400" style="font-size: 1.8rem; font-weight: bold; color: #000;">Our Vision: Unlocking Potential, Fueling Success</h3>
                <p class="animate-text" data-aos="fade-up" data-aos-delay="500" style="font-size: 1rem; color: #6c757d; line-height: 1.8; text-align: justify;">
                    We envision a world where every individual is equipped with the skills, knowledge, and mindset needed to thrive in an ever-evolving global landscape. Whether you're in business, healthcare, design, or engineering, VScholar empowers you to stay ahead of the curve and turn your potential into success.
                </p>
                <hr class="animate-line" data-aos="fade-right" data-aos-delay="600">
                <h3 class="animate-text" data-aos="fade-up" data-aos-delay="700" style="font-size: 1.8rem; font-weight: bold; color: #000;">Our Mission: Bridging Learning with Opportunity</h3>
                <p class="animate-text" data-aos="fade-up" data-aos-delay="800" style="font-size: 1rem; color: #6c757d; line-height: 1.8; text-align: justify;">
                    Our mission is to bridge the gap between academic learning and real-world opportunities. We offer industry-focused Masterclasss and webinars across all domains—designed to help you stay current, build future-ready skills, and enhance your career potential. Through engaging content and expert-led sessions, we make learning interactive, relevant, and accessible to all.
                </p>
                <a href="#" class="btn btn-primary mt-3" style="background: linear-gradient(45deg, #FF4A11, #FF8E53); border: none; border-radius: 50px; padding: 10px 25px; font-weight: bold;">Learn More</a>
            </div>
            <!-- Image -->
            <div class="col-lg-6 text-center image-column" data-aos="zoom-in" data-aos-delay="900">
                <img src="{{ asset('assets/images/ABOUTUS.jpeg') }}" alt="About Us" class="img-fluid animate-image" style="border-radius: 12px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">
            </div>
        </div>

        <!-- What We Offer Section -->
        <div class="row mt-5 offer-section">
            <h3 class="text-center w-100 animate-text" data-aos="fade-up" style="font-size: 2rem; font-weight: bold; color: #000;">What We Offer: Comprehensive Learning for Every Domain</h3>
            <div class="row text-center">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm p-3" style="border-radius: 12px;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #FF4A11; font-weight: bold;">Tailored Masterclasss</h5>
                            <p class="card-text">Specialized sessions that cater to diverse fields—from technology and business to arts and health.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm p-3" style="border-radius: 12px;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #FF4A11; font-weight: bold;">Live Sessions</h5>
                            <p class="card-text">Interactive learning experiences with real-time guidance and engagement.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm p-3" style="border-radius: 12px;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #FF4A11; font-weight: bold;">Expert Mentors</h5>
                            <p class="card-text">Learn directly from seasoned professionals and industry leaders—the mentors you've always dreamed of learning from.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="row mt-5 choose-section">
            <h3 class="text-center w-100 animate-text" data-aos="fade-up" style="font-size: 2rem; font-weight: bold; color: #000;">Why Choose VScholar?</h3>
            <ul class="choose-list" style="font-size: 1rem; color: #6c757d; line-height: 1.8; margin: 0 auto; max-width: 800px; text-align: justify;">
                <li class="animate-list-item" data-aos="fade-up" data-aos-delay="100"><b>Accessible:</b> Learn from anywhere at any time, with no barriers to entry.</li>
                <li class="animate-list-item" data-aos="fade-up" data-aos-delay="200"><b>Up-to-Date:</b> Stay ahead with the latest industry trends and tools.</li>
                <li class="animate-list-item" data-aos="fade-up" data-aos-delay="300"><b>Affordable:</b> Quality learning, at a price that doesn't break the bank.</li>
                <li class="animate-list-item" data-aos="fade-up" data-aos-delay="400"><b>All Domains Covered:</b> From tech to business, healthcare to design, we've got it all.</li>
                <li class="animate-list-item" data-aos="fade-up" data-aos-delay="500"><b>Dream Mentors:</b> Gain insights from the professionals you've always aspired to learn from.</li>
            </ul>
        </div>
    </div>
</section>

@include('front.common.footer')

<!-- Custom Styles -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<style>
.how-it-started {
    overflow-x: hidden;
    padding: 40px;
}

.card {
    background: #fff;
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
}

.animate-line {
    width: 0;
    transition: width 1s ease-out;
}

.offer-section, .choose-section {
    margin-top: 40px;
}

@media (max-width: 768px) {
    .how-it-started h2 {
        font-size: 2rem;
    }
    .how-it-started h3 {
        font-size: 1.5rem;
    }
    .how-it-started p, .offer-list, .choose-list {
        font-size: 0.9rem;
    }
    .image-column {
        margin-top: 2rem;
    }
}
</style>
@endpush

<!-- Custom Scripts -->
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        once: true,
        mirror: false
    });

    const animateLines = document.querySelectorAll('.animate-line');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.width = '100%';
            }
        });
    }, { threshold: 0.5 });

    animateLines.forEach(line => observer.observe(line));
});
</script>
@endpush
