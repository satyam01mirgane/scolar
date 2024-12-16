<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<footer id="footer" style="background-color: #25286e; color: #ffffff; padding-top: 50px;">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <!-- Logo and Description -->
                <div class="col-lg-5">
                    <div class="widget" style="animation: fadeIn 0.5s ease-out;">
                        <img alt="{{app_setting()->site_title}} Logo" src="{{asset('assets/images/logo.svg')}}" 
                             style="max-width: 200px; margin-bottom: 20px; background-color: white; padding: 10px 30px; border-radius: 10px;">
                        <p style="color:#fff; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                            V Scolar is dedicated to empowering learners by providing top-notch educational resources and transformative workshops. Join us to enhance your skills and achieve your goals.
                        </p>
                    </div>
                </div>
                <!-- Quick Links -->
                <div class="col-lg-3">
                    <div class="widget" style="animation: fadeIn 0.5s ease-out 0.2s both;">
                        <h4 style="color: #ffffff; font-size: 20px; margin-bottom: 20px; position: relative; padding-bottom: 10px;">
                            QUICK LINKS
                            <span style="position: absolute; bottom: 0; left: 0; width: 50px; height: 2px; background-color: #4CAF50;"></span>
                        </h4>
                        <ul style="list-style: none; padding: 0;">
                            @php
                            $quickLinks = [
                                ['url' => '/', 'text' => 'Home'],
                                ['url' => 'about-us', 'text' => 'About Us'],
                                ['url' => 'workshops', 'text' => 'Workshops'],
                                ['url' => 'blogs', 'text' => 'Study Material'],
                                ['url' => 'contact-us', 'text' => 'Contact Us'],
                                ['url' => 'page/term-condition', 'text' => 'Terms & Conditions'],
                                ['url' => 'page/privacy-policy', 'text' => 'Privacy Policy'],
                            ];
                            @endphp
                            @foreach($quickLinks as $link)
                            <li style="margin-bottom: 10px;">
                                <a href="{{url($link['url'])}}" style="color: #ffffff; text-decoration: none; transition: color 0.3s ease;">
                                    <i class="fa fa-chevron-right" style="margin-right: 5px; font-size: 12px;"></i>
                                    {{$link['text']}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Upcoming Workshops -->
                <div class="col-lg-4">
                    <div class="widget" style="animation: fadeIn 0.5s ease-out 0.4s both;">
                        <h4 style="color: #ffffff; font-size: 20px; margin-bottom: 10px; position: relative; padding-bottom: 7px;">
                            UP COMINGS
                            <span style="position: absolute; bottom: 0; left: 0; width: 50px; height: 2px; background-color: #4CAF50;"></span>
                        </h4>
                        <div class="post-thumbnail-list" style="margin-top:20px;">
                            @foreach(workshop_list() as $k => $v)
                            <div class="post-thumbnail-entry" style="display: flex; align-items: center; margin-bottom: 15px; transition: transform 0.3s ease;">
                                <img src="{{asset($v->image)}}" alt="{{$v->name}}" 
                                     style="width: 70px; height: 70px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                                <div class="post-thumbnail-content">
                                    <a href="{{url('/workshops-detail/'.$v->slug)}}" 
                                       style="color: #ffffff; text-decoration: none; font-size: 16px; transition: color 0.3s ease;">{{$v->name}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright Section -->
    <div class="copyright-content" style="background-color: rgba(0, 0, 0, 0.1); padding: 20px 0; margin-top: 30px;">
        <div class="container">
            <div class="copyright-text text-center" style="font-size: 14px;">
                &copy; Copyright V Scolar {{date('Y')}}. <a href="#" style="color: #4CAF50; text-decoration: none;">VSCHOLAR</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Button -->
<a href="https://api.whatsapp.com/send?phone=+919667576014&text=Hello." class="floating" target="_blank" 
   style="position: fixed; width: 60px; height: 60px; bottom: 40px; right: 40px; background-color: #25d366; color: #FFF; 
          border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; 
          box-shadow: 2px 2px 3px #999; z-index: 100; transition: all 0.3s ease;">
    <i class="fa fa-whatsapp"></i>
</a>

<!-- Scroll to Top Button -->
<a id="scrollTop" style="position: fixed; right: 20px; bottom: 40px; width: 40px; height: 40px; background-color: #4CAF50; color: #fff; 
                          border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; 
                          opacity: 0; visibility: hidden; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
    <i class="icon-chevron-up"></i>
</a>

<script src="{{asset('assets/js/plugins.js')}}"></script>
<script src="{{asset('assets/js/functions.js')}}"></script>

<script>
$(document).ready(function(){
    // Show/hide scroll to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#scrollTop').css({opacity: 1, visibility: 'visible'});
        } else {
            $('#scrollTop').css({opacity: 0, visibility: 'hidden'});
        }
    });

    // Smooth scroll to top
    $('#scrollTop').click(function() {
        $('html, body').animate({scrollTop : 0}, 800);
        return false;
    });

    // Hover effect for footer links
    $('.footer-content a').hover(
        function() { $(this).css('color', '#4CAF50'); },
        function() { $(this).css('color', '#ffffff'); }
    );

    // Hover effect for post thumbnails
    $('.post-thumbnail-entry').hover(
        function() { $(this).css('transform', 'translateY(-5px)'); },
        function() { $(this).css('transform', 'translateY(0)'); }
    );
});
</script>
