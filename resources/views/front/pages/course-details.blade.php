@include('front.common.header')
@include('front.common.navbar')

<!-- Main Content Section -->
<section id="course-details" style="padding: 4rem 1rem; background-color: #f4f7fc;">
    <div class="container">

        <!-- Course Card -->
        <div class="row course-card mb-5 p-4 shadow-lg rounded-4" style="background-color: #ffffff;">
            <div class="col-md-4 col-12 d-flex align-items-center justify-content-center">
                <img src="{{ $course_details->image ? asset($course_details->image) : asset('images/default.jpg') }}"
                     alt="{{ $course_details->name }}"
                     class="img-fluid rounded-4 course-image"
                     style="object-fit: cover; max-height: 300px;">
            </div>
            <div class="col-md-8 col-12">
                <h1 style="font-size: 2.5rem; font-weight: 700; color: #333;">{{ $course_details->name }}</h1>
                <p style="font-size: 1.1rem; color: #666;">{{ $course_details->short_description }}</p>

                <!-- Course Info List -->
                <ul class="list-unstyled mt-3">
                    @if(isset($course_details->edureka_certificates))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-certificate text-primary me-2"></i>
                        <span>{{ $course_details->edureka_certificates }}</span>
                    </li>
                    @endif
                    @if(isset($course_details->hrs_live_classes))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock text-success me-2"></i>
                        <span>{{ $course_details->hrs_live_classes }}</span>
                    </li>
                    @endif
                    @if(isset($course_details->weekend_classes))
                    <li class="d-flex align-items-center mb-2">
                        <i class="fas fa-calendar-check text-purple me-2"></i>
                        <span>{{ $course_details->weekend_classes }}</span>
                    </li>
                    @endif
                </ul>

                <!-- Button Section -->
                <div class="d-flex flex-wrap gap-3 mt-4">
                    @if($course_details->total_seat > 0)
                    <button class="btn btn-outline-success">
                        <i class="fas fa-users me-1"></i> {{ $course_details->total_seat }} Seats Left
                    </button>
                    @else
                    <button class="btn btn-outline-secondary" disabled>
                        <i class="fas fa-users-slash me-1"></i> Seat Full
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-shopping-cart me-1"></i> Enroll Now
                            </button>
                        </form>
                        @endif
                    @else
                        <a href="{{ url('cart') }}" class="btn btn-secondary">
                            <i class="fas fa-shopping-cart me-1"></i> In Cart
                        </a>
                    @endif

                    <button class="btn btn-warning">
                        <i class="fas fa-tag me-1"></i> ₹{{ $course_details->price - $course_details->discount_value }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Course Description -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 class="mb-3">Course Description</h2>
                <div class="bg-white p-4 rounded shadow">
                    <p>{!! nl2br($course_details->full_description) !!}</p>
                </div>
            </div>
        </div>

        <!-- Learning Modules Section -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 class="text-center mb-3">Learning Modules</h2>
                <div class="text-center mb-3">
                    <button class="btn btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#learningModulesCollapse">
                        <i class="fas fa-caret-down me-1"></i> View Learning Modules
                    </button>
                </div>
                <div class="collapse" id="learningModulesCollapse">
                    <div class="bg-white p-4 rounded shadow">
                        <ul class="list-unstyled">
                            @foreach(explode("\r\n", trim($course_details->learning_modules)) as $module)
                            <li class="module-item mb-2 bg-light p-3 rounded">
                                <i class="fas fa-book text-primary me-2"></i> {{ $module }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Certificate Section -->
        <div class="row mb-5">
            <div class="col-lg-12 text-center">
                <h2 class="mb-3">Sample Certificate</h2>
                <img src="{{ asset($course_details->sample_certificate_image) }}" alt="Sample Certificate" class="img-fluid rounded shadow" style="max-width: 80%;">
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 class="mb-3">Frequently Asked Questions</h2>
                <div class="bg-white p-4 rounded shadow">
                    @foreach(range(1, 5) as $index)
                    @if(isset($course_details->{'question' . $index}))
                    <div class="mb-4">
                        <h4 onclick="toggleFAQ(this)" style="cursor: pointer;">
                            <i class="fas fa-plus text-primary me-2"></i> {{ $course_details->{'question' . $index} }}
                        </h4>
                        <p style="display: none; padding-left: 1.5rem;">{{ $course_details->{'answer' . $index} }}</p>
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
    .btn { white-space: normal; }
    .module-item:hover {
        background-color: #e9ecef;
        transform: translateX(5px);
    }
</style>

<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const icon = element.querySelector('i');
        if (answer.style.display === 'none' || answer.style.display === '') {
            answer.style.display = 'block';
            icon.classList.replace('fa-plus', 'fa-minus');
        } else {
            answer.style.display = 'none';
            icon.classList.replace('fa-minus', 'fa-plus');
        }
    }
</script>
