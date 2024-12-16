<section class="testimonials-section" style="background-color: #f8f9fa; padding-top:0px; ">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h5 style="text-align: center; color: #4CAF50; font-size: 18px; text-transform: uppercase; margin-bottom: 10px;">Testimonials</h5>
        <h3 style="text-align: center; color: #333; font-size: 36px; margin-bottom: 40px;">What Our Scholars Say</h3>
        
        <div class="testimonial-carousel" style="position: relative; overflow: hidden;">
            <div class="testimonial-container" style="display: flex; transition: transform 0.5s ease;">
                @foreach($testimonials as $k => $v)
                <div class="testimonial-item" style="flex: 0 0 calc(50% - 10px); margin-right: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 20px; display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img src="{{asset($v->image)}}" alt="{{$v->name}}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;">
                    <p style="font-size: 16px; color: #666; line-height: 1.6; margin-bottom: 15px;">{{$v->content}}</p>
                    <strong style="font-size: 18px; color: #333;">{{$v->name}}</strong>
                    <span style="font-size: 14px; color: #888;">{{$v->designation}}</span>
                </div>
                @endforeach
            </div>
            <button class="nav-button prev" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background: rgba(76, 175, 80, 0.8); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center;">&lt;</button>
            <button class="nav-button next" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: rgba(76, 175, 80, 0.8); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center;">&gt;</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.testimonial-container');
            const items = document.querySelectorAll('.testimonial-item');
            const prevBtn = document.querySelector('.nav-button.prev');
            const nextBtn = document.querySelector('.nav-button.next');
            let currentIndex = 0;

            function updateCarousel() {
                container.style.transform = `translateX(-${currentIndex * 50}%)`;
                prevBtn.style.display = currentIndex === 0 ? 'none' : 'flex';
                nextBtn.style.display = currentIndex >= items.length - 2 ? 'none' : 'flex';
            }

            function scrollTestimonials(direction) {
                if (direction === 'next' && currentIndex < items.length - 2) {
                    currentIndex += 2;
                } else if (direction === 'prev' && currentIndex > 0) {
                    currentIndex -= 2;
                }
                updateCarousel();
            }

            prevBtn.addEventListener('click', () => scrollTestimonials('prev'));
            nextBtn.addEventListener('click', () => scrollTestimonials('next'));

            // Initial display
            updateCarousel();

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') scrollTestimonials('prev');
                if (e.key === 'ArrowRight') scrollTestimonials('next');
            });
        });
    </script>

    <style>
        @media (max-width: 768px) {
            .testimonial-item {
                flex: 0 0 calc(100% - 20px);
            }
            .testimonial-carousel {
                padding: 0 50px;
            }
        }
    </style>
</section>

