@include('front.common.header')
@include('front.common.navbar')

<section class="how-it-started py-5" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text Content -->
            <div class="col-lg-6 mb-4">
                <h6 class="text-uppercase" style="color: #FF4A11; font-weight: bold;">How It Started</h6>
                <h2 style="font-size: 2.5rem; font-weight: bold; color: #000;">Our Dream is Global Learning Transformation</h2>
                <p style="font-size: 1rem; color: #6c757d; line-height: 1.8; text-align:justify">
                V scholar was established with a visionary mission to empower learners across the globe by providing them with unparalleled access to high-quality educational resources and innovative workshops. The platform is designed to bridge the gap between traditional education and modern-day learning requirements by embracing cutting-edge technology and fostering creativity. At V scholar, we are dedicated to curating exceptional learning experiences that cater to diverse domains, including technology, business, arts, health, and personal development. Our commitment lies in creating a robust ecosystem where students, professionals, and lifelong learners can thrive by acquiring practical knowledge and relevant skills.

Our workshops and courses are tailored to meet the ever-evolving demands of various industries, ensuring that learners are always a step ahead in their careers and personal aspirations. We believe education should be accessible, engaging, and transformative, and we aim to provide interactive, hands-on sessions led by experienced professionals who bring real-world expertise into the classroom. V scholar is more than just an educational platform; it is a movement towards fostering a global community of curious minds, critical thinkers, and problem solvers who are equipped to tackle the challenges of tomorrow.

From skill enhancement to career advancement, from technical mastery to creative exploration, V scholar offers a comprehensive suite of learning opportunities that empower individuals to realize their full potential. With a focus on quality, accessibility, and inclusivity, we strive to make education a transformative journey for everyone, whether they are taking their first steps or scaling new heights in their fields. Join us at V scholar and be a part of a learning revolution that inspires growth, innovation, and success.

</p>
            </div>
            <!-- Image -->
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/images/ABOUTUS.jpeg') }}" alt="About Us" class="img-fluid" style="border-radius: 12px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row mt-5" style="justify-content: center;">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-box text-center py-4" style="background: #fff; border-radius: 12px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 2rem; font-weight: bold; color: #000;">3.5</h3>
                    <p style="font-size: 1rem; color: #6c757d;">Years Experience</p>
                </div>
            </div>
           
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-box text-center py-4" style="background: #fff; border-radius: 12px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 2rem; font-weight: bold; color: #000;">830+</h3>
                    <p style="font-size: 1rem; color: #6c757d;">workshops conducted</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-box text-center py-4" style="background: #fff; border-radius: 12px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 2rem; font-weight: bold; color: #000;">100K</h3>
                    <p style="font-size: 1rem; color: #6c757d;">Trusted Students</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

<!-- Custom Styles -->
@push('styles')
<style>
/* Responsive adjustments */
@media (max-width: 768px) {
    .how-it-started h2 {
        font-size: 2rem;
    }
    .stat-box h3 {
        font-size: 1.5rem;
    }
    .stat-box p {
        font-size: 0.9rem;
    }
}
</style>
@endpush
