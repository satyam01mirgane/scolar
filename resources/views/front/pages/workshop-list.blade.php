@include('front.common.header')
@include('front.common.navbar')

<section id="opportunities-section" class="animate-fade-in" style="padding: 6rem 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <!-- Title -->
                <h2 class="mb-4 animate-title" style="font-size: 3rem; font-weight: bold; color: #333;">Explore Opportunities</h2>
                <p class="lead mb-5 animate-subtitle" style="color: #666;">Join our team and make a difference. Choose the path that suits you best.</p>

                <!-- Buttons Section -->
                <div class="d-flex justify-content-center flex-wrap gap-4">
                    <!-- Apply for Internship -->
                    <a href="https://forms.gle/REUMWYRNR28fRXjv6" target="_blank" class="btn-modern btn-internship">
                        <i class="fas fa-graduation-cap me-2"></i> Apply for Internship
                    </a>

                    <!-- Apply as an Instructor -->
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdMykqR2xjRUu01u07EKQXHm3AVxJXZVyc-ZOcgxVHCurKY-A/viewform?usp=sharing" target="_blank" class="btn-modern btn-instructor">
                        <i class="fas fa-chalkboard-teacher me-2"></i> Apply as an Instructor
                    </a>

                    <!-- Apply for Job -->
                    <a href="https://forms.gle/rXPYwMGAAUhyu98u6" target="_blank" class="btn-modern btn-job">
                        <i class="fas fa-briefcase me-2"></i> Apply for Job
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

@push('styles')
<style>
/* General Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Button Base Styles */
.btn-modern {
    position: relative;
    display: inline-block;
    padding: 0.8rem 1.8rem;
    font-size: 1.1rem;
    font-weight: 600;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 50px;
    overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
}

/* Hover Transform */
.btn-modern:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

/* Ripple Effect */
.btn-modern::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: all 0.4s ease;
}

.btn-modern:hover::after {
    width: 300%;
    height: 300%;
    opacity: 0;
}

/* Specific Button Backgrounds */
.btn-internship {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
}

.btn-instructor {
    background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
}

.btn-job {
    background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
}

/* Hover Effects for Backgrounds */
.btn-internship:hover {
    background: linear-gradient(135deg, #8e44ad 0%, #3498db 100%);
}

.btn-instructor:hover {
    background: linear-gradient(135deg, #ff6f61 0%, #ffae66 100%);
}

.btn-job:hover {
    background: linear-gradient(135deg, #56ab91 0%, #1e5799 100%);
}

/* Section Animations */
.animate-fade-in {
    animation: fadeInUp 1s ease-out;
}

.animate-title {
    animation: scaleIn 0.8s ease-out 0.2s both;
}

.animate-subtitle {
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

/* Responsive Design */
@media (max-width: 768px) {
    .btn-modern {
        width: 100%;
        margin-bottom: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    // Page Load Animation
    document.body.classList.add('animate-fade-in');
});
</script>
@endpush
