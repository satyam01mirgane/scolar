@include('front.common.header')
@include('front.common.navbar')

<!-- Main Content Section -->
<section id="course-details" style="padding: 4rem 1rem; background-color: #f4f7fc;">
    <div class="container">
        <!-- Course Card - Modern Layout -->
        <div class="row course-card mb-5 p-4 shadow-lg rounded-4" style="background-color: #ffffff; transition: all 0.3s ease; border-radius: 16px; opacity: 0; animation: fadeIn 0.6s ease-out forwards;">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <img src="{{ asset($course_details->image) }}" alt="{{ $course_details->name }}" class="img-fluid rounded-4 course-image" style="object-fit: cover; max-height: 250px; border-radius: 12px; transition: all 0.3s ease;">
            </div>
            <div class="col-md-8">
                <h1 style="font-size: 2.5rem; font-weight: 700; color: #333; line-height: 1.2; margin-bottom: 1rem; opacity: 0; animation: slideInRight 0.6s ease-out 0.3s forwards;">{{ $course_details->name }}</h1>
                <p style="font-size: 1.1rem; color: #666; margin-bottom: 1.5rem; opacity: 0; animation: slideInRight 0.6s ease-out 0.4s forwards;">{{ $course_details->short_description }}</p>

                <!-- Course Info List -->
                <ul class="list-unstyled mt-3" style="opacity: 0; animation: slideInRight 0.6s ease-out 0.5s forwards;">
                    @if(isset($course_details->edureka_certificates))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-certificate" style="color: #007bff; margin-right: 0.8rem; font-size: 1.2rem;"></i>
                        <span>{{ $course_details->edureka_certificates }}</span>
                    </li>
                    @endif
                    @if(isset($course_details->hrs_live_classes))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock" style="color: #28a745; margin-right: 0.8rem; font-size: 1.2rem;"></i>
                        <span>{{ $course_details->hrs_live_classes }} Live Classes</span>
                    </li>
                    @endif
                    @if(isset($course_details->weekend_classes))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-calendar-check" style="color: #6f42c1; margin-right: 0.8rem; font-size: 1.2rem;"></i>
                        <span>{{ $course_details->weekend_classes }} Weekend Classes</span>
                    </li>
                    @endif
                </ul>

                <!-- Button Section -->
                <div class="d-flex flex-wrap gap-3 mt-4" style="opacity: 0; animation: slideInRight 0.6s ease-out 0.6s forwards;">
                    @if($course_details->total_seat > 0)
                    <button class="btn btn-outline-success seats-left responsive-btn">
                        <i class="fas fa-users" style="margin-right: 0.5rem;"></i>
                        {{ $course_details->total_seat }} Seats Left
                    </button>
                    @else
                    <button class="btn btn-outline-secondary seats-full responsive-btn" disabled>
                        <i class="fas fa-users-slash" style="margin-right: 0.5rem;"></i>
                        Seat Full
                    </button>
                    @endif

                    @if(!in_array($course_details->id, cartproduct()))
                        @if($course_details->total_seat > 0)
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $course_details->id }}">
                            <input type="hidden" name="name" value="{{ $course_details->name }}-Course">
                            <input type="hidden" name="price" value="{{ $course_details->price }}">
                            <input type="hidden" name="image" value="{{ $course_details->image }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary enroll-now responsive-btn">
                                <i class="fas fa-shopping-cart" style="margin-right: 0.5rem;"></i>
                                Enroll Now
                            </button>
                        </form>
                        @endif
                    @else
                        <a href="{{ url('cart') }}" class="btn btn-secondary in-cart responsive-btn">
                            <i class="fas fa-shopping-cart" style="margin-right: 0.5rem;"></i>
                            In Cart
                        </a>
                    @endif
                    <button class="btn btn-warning price-tag responsive-btn">
                        <i class="fas fa-tag" style="margin-right: 0.5rem;"></i>
                        ₹{{ $course_details->price - $course_details->discount_value }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Additional sections like Course Description, Modules, Certificate, and FAQ -->
        <!-- No changes made for brevity -->
    </div>
</section>

@include('front.common.footer')

<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideInRight {
        from { transform: translateX(30px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }
    .course-image:hover {
        transform: scale(1.05);
    }
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .responsive-btn {
        padding: 12px 16px;
        font-size: 1rem;
        border-radius: 8px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    @media (max-width: 768px) {
        .responsive-btn {
            width: 100%;
            padding: 10px;
            font-size: 0.9rem;
        }
    }
</style>
