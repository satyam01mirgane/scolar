@include('front.common.header')
@include('front.common.navbar')

<!-- Page title -->
        <section id="page-title" data-bg-parallax="{{asset('assets/images/services-banner.png')}}">
            <div class="container">
                <div class="page-title" style="min-height:150px;">
                    <!--<h1>Services</h1>-->
                    <!--<span> VSCHOLAR survives by its promise to make the servicing sector worth the efforts of students and big players simultaneously. </span>-->
                </div>
            </div>
        </section>
        <!-- end: Page title -->
<!-- CONTENT -->
        <section id="section3" style="padding-bottom:10px !important;">
            <div class="container">
                <div class="row">
				<div class="heading-text heading-section">
                    <h2>Services</h2>
                    <span class="lead">We are not just a course providing platform but we are everything you want in ed tech under one roof! Don’t believe us, read about it below</span>
                </div>
				<div class="col-lg-7">
						<h2 class="text-medium">Workshops</h2>
                        <p>Our expertly taught industrial workshops provide participants with real-world experience in a variety of fields as well as academic understanding. These courses, taught by subject-matter experts, are ideal for anybody wishing to extend their horizons and develop their talents.</p>
						<h2 class="text-medium">Collaboration</h2>
                        <p>With the cutting-edge seminars offered by  VSCHOLAR , give your students the tools they need to succeed in the real world. Our extensive offerings include weekly workshops and customized programs tailored to your school's requirements. Take advantage of the chance to collaborate with us and share the tools they need to succeed. Give your pupils the gift of a better future by contacting us at 91-9667576014 or info@ VSCHOLAR .in.</p>
						<div class="clear"></div>
                        
                    </div>
					<div class="col-lg-5">
                        <img alt="real-estate" src="{{asset('assets/images/Workshop-AndColab.jpg')}}" class="img-fluid m-b-10">
                    </div>
                </div>

            </div>
        </section>
		<section id="section3" style="padding-top:5px !important;padding-bottom:10px !important;">
            <div class="container">
                <div class="row">
				<div class="col-lg-12">
						<h2 class="text-medium">Be a mentor at  VSCHOLAR </p>
						<p>Be an VSCHOLAR mentor and business professional! Help professionals get a salary and certification with little effort. Take advantage of the opportunity to advance your career and impact someone's life. Become an VSCHOLAR mentor right now to motivate the next generation of professionals!</p>
						
						<div class="clear"></div>
                        <a href="#" class="btn btn-roundeded">Contact Now</a>
                    </div>
                </div>
				
				 <div class="row">
				<div class="col-lg-12">
						<h2 class="text-medium">Online Coaching</h2>
						<p>Want to take the next step in your education? Go no farther than  VSCHOLAR , the industry leader in online education created for the 21st century student. Our platform is adapted to your requirements with a broad selection of courses and themes, knowledgeable teachers, and flexible scheduling. </p>
						 
						<div class="clear"></div>
                    </div>
                </div>

            </div>
        </section>
		<section id="section3" style="padding-top:5px !important;padding-bottom:10px !important;">
            <div class="container">
                <div class="row">
				<div class="heading-text heading-section">
                    <h2>FAQ</h2>
                </div>
				<div class="col-lg-12">
						@foreach(faq_list() as $k=>$v)
						<h2 class="text-small">{{++$k}}. {{$v->question}}</h2>
                        <p>{{$v->answer}}</h2>
						@endforeach
						<div class="clear"></div>
                        
                    </div>
                </div>

            </div>
        </section>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<section id="section3" style="padding-top:5px !important;padding-bottom:10px !important;">
            <div class="container">
                <div class="row">
				<div class="heading-text heading-section">
                    <h2>OPEN FOR INVESTMENTS & COLLABORATIONS</h2>
                </div>
				<div class="col-lg-12">
						@if(Session::has('message'))
						<p class="alert alert-success}}">{{ Session::get('success') }}</p>
						@endif
						<a href="Javascript:;" class="btn btn-style-one" data-toggle="modal" data-target="#exampleModal">Query</a>
						<div class="clear"></div>
                        
                    </div>
                </div>

            </div>
        </section>
		<section style="padding-top:5px !important;padding-bottom:10px !important;">
            <div class="container">
                <!--Clean icons-->
                <div class="heading-text heading-line text-center">
                    <h4>Provided Services</h4>
                </div>
                <div class="row">
				@foreach($service_list as $k=>$v)
				<div class="col-lg-6">
                        <div class="icon-box effect large clean">
                            <div class="icon">
                                <a href="#"><i class="{{$v->image}}"></i></a>
                            </div>
                            <h3>{{$v->name}}</h3>
                            <p>{{$v->description}}</p>
                        </div>
                    </div>
					@endforeach
                    
                 </div>
                <!--End: Clean icons-->
                <hr class="space">
                
            </div>
        </section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="contact_form" class="default-form contact-form" action="{{url('query-submit')}}" method="post">
		    @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" placeholder="Name" required="">
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" name="email" placeholder="Email" required="">
                </div>
                
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" name="phone" placeholder="Mobile No" required="" maxlength="10" min="10">
                </div>
                <div class="form-group">
                  <input class="form-control" type="date" name="date" placeholder="Date" required=""  autocomplete="off">
                </div>
                
              </div>
              <div class="col-md-12">
				<div class="form-group">
                  <select class="form-control" name="subject" required>
				    <option value="">-----Select-----</option>
                    <option value="University">University</option>
                    <option value="Coorporate">Coorporate</option>
                    <option value="School">School</option>
					<option value="Investor">Investor</option>
					<option value="Instructor">Instructor</option>
					<option value="Other">Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" placeholder="Your Message" required=""></textarea>
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary">Submit Now</button>
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@include('front.common.footer')
