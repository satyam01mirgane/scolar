@include('front.common.header')
@include('front.common.navbar')

<section id="page-content" style="padding: 2rem 0; background-color: #f9f9f9;">
    <div class="container">
        <!-- Top Heading -->
        <div class="row">
            <div class="col-lg-12 text-center" style="margin-bottom: 2rem;">
                <h2 style="font-size: 2.5rem; font-weight: bold;">Course Details</h2>
            </div>
        </div>

        <!-- Course Card in Horizontal Layout -->
        <div class="row align-items-center course-card" style="border: 1px solid #ddd; border-radius: 8px; padding: 1rem; background-color: #fff; margin-bottom: 2rem; transition: all 0.3s ease;">
            <div class="col-md-4">
                <img src="{{ asset($course_details->image) }}" alt="{{ $course_details->name }}" style="width: 100%; border-radius: 8px; transition: transform 0.3s ease;" class="course-image">
            </div>
            <div class="col-md-8">
                <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem; color: #333;" class="animate-slide-in">{{ $course_details->name }}</h3>
                <ul style="list-style: none; padding: 0; margin: 0; color: #6c757d; font-size: 0.95rem;">
                    @if(isset($course_details->edureka_certificates))
                    <li class="animate-slide-in" style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <i class="fas fa-certificate" style="color: #007bff; margin-right: 0.5rem;"></i>
                        {{ $course_details->edureka_certificates }}
                    </li>
                    @endif
                    @if(isset($course_details->hrs_live_classes))
                    <li class="animate-slide-in" style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <i class="fas fa-clock" style="color: #28a745; margin-right: 0.5rem;"></i>
                        {{ $course_details->hrs_live_classes }}
                    </li>
                    @endif
                    @if(isset($course_details->weekend_classes))
                    <li class="animate-slide-in" style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <i class="fas fa-calendar-check" style="color: #6f42c1; margin-right: 0.5rem;"></i>
                        {{ $course_details->weekend_classes }}
                    </li>
                    @endif
                </ul>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; margin-top: 1rem;">
                    @if($course_details->total_seat > 0)
                    <button class="btn btn-outline-primary animate-scale-in" style="flex: 1; max-width: 200px;">
                        <i class="fas fa-users" style="margin-right: 0.5rem;"></i>
                        {{ $course_details->total_seat }} Seats Left
                    </button>
                    @else
                    <button class="btn btn-outline-danger animate-scale-in" style="flex: 1; max-width: 200px;" disabled>
                        <i class="fas fa-users-slash" style="margin-right: 0.5rem;"></i>
                        Seat Full
                    </button>
                    @endif
                    @if(!in_array($course_details->id, cartproduct()))
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $course_details->id }}">
                        <input type="hidden" name="name" value="{{ $course_details->name }}-Course">
                        <input type="hidden" name="price" value="{{ $course_details->price }}">
                        <input type="hidden" name="image" value="{{ $course_details->image }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-success animate-scale-in">
                            <i class="fas fa-shopping-cart" style="margin-right: 0.5rem;"></i>
                            Enroll Now
                        </button>
                    </form>
                    @else
                    <a href="{{ url('cart') }}" class="btn btn-secondary animate-scale-in">
                        <i class="fas fa-shopping-cart" style="margin-right: 0.5rem;"></i>
                        In Cart
                    </a>
                    @endif
                </div>
            </div>
        </div>
<style>
    @keyframes slideIn {
        from { transform: translateX(-20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes scaleIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .animate-slide-in {
        animation: slideIn 0.5s ease-out forwards;
    }

    .animate-scale-in {
        animation: scaleIn 0.5s ease-out forwards;
    }

    .course-card:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .course-card:hover .course-image {
        transform: scale(1.05);
    }

    .animate-slide-in:nth-child(1) { animation-delay: 0.1s; }
    .animate-slide-in:nth-child(2) { animation-delay: 0.2s; }
    .animate-slide-in:nth-child(3) { animation-delay: 0.3s; }
</style>
        <!-- Week-wise Modules with Dropdown -->
        <div class="row" style="margin-top: 2rem;">
            <div class="col-lg-12">
                <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Week-wise Modules</h3>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#modulesDropdown" aria-expanded="false" aria-controls="modulesDropdown">
                    View Modules
                </button>
                <div class="collapse" id="modulesDropdown" style="margin-top: 1rem;">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach(explode("\r\n", trim($course_details->learning_modules)) as $module)
                        <li style="padding: 0.5rem 1rem; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 0.5rem; background-color: #fff;">
                            {{ $module }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row" style="margin-top: 2rem;">
            <div class="col-lg-12">
                <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">FAQ</h3>
                <div style="border: 1px solid #ddd; border-radius: 8px; padding: 1rem; background-color: #fff;">
                    @foreach(range(1, 5) as $index)
                    @if(isset($course_details->{'question' . $index}))
                    <div style="margin-bottom: 1rem;">
                        <h4 style="font-size: 1.1rem; color: #000;"><i class="fa fa-arrow-right"></i> {{ $course_details->{'question' . $index} }}</h4>
                        <p style="color: #6c757d;">{{ $course_details->{'answer' . $index} }}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

<style>
    body {
        font-family: Arial, sans-serif;
    }

    h3 {
        font-weight: bold;
        color: #333;
    }

    p {
        line-height: 1.6;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
