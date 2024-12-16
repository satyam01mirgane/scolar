@include('front.common.header')
@include('front.common.navbar')

<!-- CONTENT -->
<section id="page-content" style="padding: 2rem 0; background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="content col-lg-12">
                <div class="heading-text heading-section text-center" style="margin-bottom: 2rem;">
                    <h2 style="font-size: 2rem; font-weight: bold;">Workshops</h2>
                </div>

                <!-- Course Grid -->
                <div id="course-list" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    @foreach($course_list as $k => $v)
                    <div class="post-item animated-card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; background-color: #fff;">
                        <div class="post-item-wrap">
                            <div class="post-image" style="overflow: hidden; border-radius: 8px;">
                                <a href="{{ url('course-detail/'.$v->slug) }}">
                                    <img src="{{ asset($v->image) }}" alt="{{ $v->name }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                                </a>
                            </div>
                            <div class="post-item-description" style="padding: 1rem;">
                                <h4 style="font-size: 1rem; color: #6c757d; margin-bottom: 0.5rem;">
                                    {{ $v->course_type }}
                                </h4>
                                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">
                                    <a href="{{ url('course-detail/'.$v->slug) }}" style="text-decoration: none; color: #000;">
                                        {{ truncate($v->name, 30) }}
                                    </a>
                                </h3>
                                <p style="font-size: 0.95rem; color: #6c757d; margin-bottom: 1rem;">
                                    {{ truncate($v->short_description, 40) }}
                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <!-- Price Display -->
                                    <span style="font-size: 1rem; font-weight: bold; color: #28a745;">
                                        @if($v->workshop_type == 'Free' || $v->price == 0)
                                            Free
                                        @else
                                            ₹{{ $v->price }}
                                        @endif
                                    </span>

                                    <!-- Button Logic -->
                                    @if(!in_array($v->id, cartproduct()))
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $v->id }}" name="id">
                                        <input type="hidden" value="{{ $v->name }}-Course" name="name">
                                        <input type="hidden" value="{{ $v->price }}" name="price">
                                        <input type="hidden" value="{{ $v->image }}" name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        @if($v->total_seat > 0)
                                            <button class="btn btn-sm" style="background-color: #FF4A11; color: #fff; border: none;" type="submit">
                                                Enroll Now
                                            </button>
                                        @else
                                            <button class="btn btn-sm" style="background-color: #d6d6d6; color: #fff; border: none;" type="button" disabled>
                                                Seat Full
                                            </button>
                                        @endif
                                    </form>
                                    @else
                                    <button class="btn btn-outline-primary btn-sm" type="button">In Cart</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

<style>
    /* Animation for cards */
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

    .animated-card {
        animation: fadeInUp 1s ease-out;
        animation-delay: calc(var(--index) * 0.1s);
        animation-fill-mode: backwards;
    }

    /* Page fade-in animation */
    body {
        opacity: 0;
        animation: pageFadeIn 1s ease-in forwards;
    }

    @keyframes pageFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.animated-card');
    cards.forEach((card, index) => {
        card.style.setProperty('--index', index);
    });
});
</script>
