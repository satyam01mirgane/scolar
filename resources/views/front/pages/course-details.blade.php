@include('front.common.header')
@include('front.common.navbar')

<!-- Main Content Section -->
<section id="course-details" style="padding: 2rem 1rem; background-color: #f4f7fc;">
    <div class="container">
        <!-- Course Card -->
        <div class="row course-card mb-5 p-3 shadow-lg rounded-4" style="background-color: #ffffff; transition: all 0.3s ease; opacity: 0; animation: fadeIn 0.6s ease-out forwards;">
            <div class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0">
                <img src="{{ asset($course_details->image) }}" alt="{{ $course_details->name }}" class="img-fluid rounded-4 course-image" style="object-fit: cover; max-height: 250px; border-radius: 12px;">
            </div>
            <div class="col-md-8">
                <h1 class="course-title" style="font-size: 2rem; font-weight: 700; color: #333; margin-bottom: 1rem;">{{ $course_details->name }}</h1>
                <p class="course-description" style="font-size: 1rem; color: #666; margin-bottom: 1.5rem;">{{ $course_details->short_description }}</p>

                <!-- Course Info List -->
                <ul class="list-unstyled mt-3">
                    @if(isset($course_details->edureka_certificates))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-certificate" style="color: #007bff; margin-right: 0.8rem;"></i>
                        <span>{{ $course_details->edureka_certificates }}</span>
                    </li>
                    @endif
                    @if(isset($course_details->hrs_live_classes))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock" style="color: #28a745; margin-right: 0.8rem;"></i>
                        <span>{{ $course_details->hrs_live_classes }} Live Classes</span>
                    </li>
                    @endif
                </ul>

                <!-- Buttons -->
                <div class="d-flex flex-wrap gap-2 mt-4">
                    @if($course_details->total_seat > 0)
                    <button class="btn btn-outline-success" style="padding: 8px 16px; font-size: 0.9rem;">
                        <i class="fas fa-users"></i> {{ $course_details->total_seat }} Seats Left
                    </button>
                    @else
                    <button class="btn btn-outline-secondary" style="padding: 8px 16px; font-size: 0.9rem;" disabled>
                        <i class="fas fa-users-slash"></i> Seat Full
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Course Description -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 style="font-size: 1.8rem; font-weight: 600; color: #333; margin-bottom: 1rem;">Course Description</h2>
                <div style="background-color: #ffffff; padding: 1.5rem; border-radius: 12px;">
                    <p style="font-size: 1rem; color: #666;">{!! nl2br($course_details->full_description) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

<!-- Styles -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* General Styling */
    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .course-title {
            font-size: 1.5rem;
        }
        .btn {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }
</style>
