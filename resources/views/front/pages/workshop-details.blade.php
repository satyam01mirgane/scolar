@include('front.common.header')
@include('front.common.navbar')

<!--Page Title-->
<section id="page-title" data-bg-parallax="{{asset('assets/images/workshop.png')}}">
            <div class="container">
                <div class="page-title" style="min-height:150px;">
                    <!--<h1>{{$workshop_details->name}}</h1>-->
                    
                </div>
            </div>
        </section>


<!-- CONTENT -->        
		<section id="page-content">
            <div class="container">
                <div class="row">
                <div class="content col-lg-12">  
                    <div class="heading-text heading-section">
                        <h2>View Our Upcoming Workshops</h2>
                        <span class="lead">We have identified the best offline and online workshops that will assist people in honing their innate talents and 
                        aptitudes and moving forward into a successful era. Enroll in our next workshop to benefit from top-notch instruction. Enroll today!</span>
                    </div>
                </div>
					@php $pattern = "/<p[^>]*><\\/p[^>]*>/";  @endphp 
                    <div class="content col-lg-6">                     
						<!--Post Carousel -->				
                        <div class="yr-carousel">
                            <!-- Post item-->
                            <div class="post-item">
                                <div class="row">
                                    <div class="col-md-5">
                                    <div class="post-image">
                                        <a href="#">
                                        <img alt="" src="{{asset($workshop_details->image)}}"></a>
                                    </div>
                                    </div>
                                    <div class="col-md-7">
                                    <div class="post-item-description pt-0">
                                        <h2><a href="workshops-detail.php">{{$workshop_details->name}}</a></h2>
                                        <p><?php echo preg_replace($pattern, '', str_replace('Tahoma','',$workshop_details->short_description));?></p>
                                        <ul class="list_will_get">
											@if($workshop_details->trainer_name)
                                            <li><i class="fa fa-user"></i> {{$workshop_details->trainer_name}}</li>
											@endif
                                            <li><i class="fa fa-calendar-check-o"></i> {{date('d M, Y',strtotime($workshop_details->session_date))}}</li>   
											<li><i class="fa fa-clock"></i> {{$workshop_details->session_time}}</li>
                                        </ul>                                       
                                    </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end">
										@if($workshop_details->total_seat > 0)
											<button type="button" class="btn btn-outline;" style="margin-right:5px;">{{$workshop_details->total_seat}} SEAT LEFT </button>
										@else
											<button type="button" class="btn btn-outline;">SEAT FULL </button>	
										@endif
										@if(!in_array($workshop_details->id,cartproduct()))
											@if($workshop_details->total_seat > 0)
												<form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
													@csrf
													<input type="hidden" value="{{ $workshop_details->id }}" name="id">
													<input type="hidden" value="{{ $workshop_details->name }}-Workshop" name="name">
													<input type="hidden" value="{{$workshop_details->price}}" name="price">
													<input type="hidden" value="{{ $workshop_details->image }}"  name="image">
													<input type="hidden" value="1" name="quantity">
													<button class="btn btn-outline;" type="submit">Enroll Now </button>
												</form>
											@endif
										@else
											<a href="{{url('cart')}}"><button class="btn btn-outline disabled" type="button">In Cart</button></a>
										@endif
                                        <button type="button" class="btn btn-outline; " style="margin-left:5px;">₹{{$workshop_details->price}} </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="content col-lg-6">                     
						<!--Post Carousel -->				
                        <div class="card">
                        <div class="card-body">
                            <!-- Post item-->
                            <h3>Introduction </h3>
                            <p><?php echo preg_replace($pattern, '', str_replace('Tahoma','',$workshop_details->full_description));?></p>
                        </div>
                        </div>
                    </div>
                </div>
                 <!-- Module Start -->

                <div class="row pt-5">
                    <div class="content col-lg-8">
                        <h3>Learning modules</h3>
                        <ul class="list-group list-group-numbered">
							<?php
							if(isset($workshop_details->learning_modules)){
							$arr = explode("\r\n", trim($workshop_details->learning_modules));
							for ($i = 0; $i < count($arr); $i++) {?>
								<li class="list-group-item">{{$arr[$i]}}</li>
                            <?php }}?>
                        </ul>
                    </div>
                    <div class="content col-lg-4">
                    <img alt="" src="{{asset('assets/images/gif/course-1.jpg')}}" class="rounded-3 w-100">
                    </div>
                </div>
                 <!-- end: Module -->
            </div>
        </section>
        <!-- end: Content -->
		<!-- Section 2 Start -->
        <section id="page-content" class="background-grey no-padding">
            <div class="container">
            <div class="row pt-5">
                <div class="content col-lg-6">
                    <h3>Perks of Choosing VSCHOLAR workshop</h3>
                    <p>
						<?php echo nl2br($workshop_details->perks_of_choosing);?>
                    </p>
                </div>
                <div class="content col-lg-6">
                <img alt="" src="{{asset('assets/images/gif/course-2.png')}}" class="rounded-3 w-100">
                </div>                
            </div>
            <!-- Part 2 -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Tools you will learn </h3>
                    <p>
                   <?php echo nl2br($workshop_details->tools_you_will_learn);?>
                    </p>
                </div>
            </div>
             <!--end: Part 2 -->
             <!-- Part 3 -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Placement assistance</h3>
                    <p>
                    <?php echo nl2br($workshop_details->placement_assistance);?>
                    </p>
                </div>
            </div>
             <!--end: Part 3 -->
             <!-- Part 4 -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Career Opportunities</h3>
                    <p>
                    <?php echo nl2br($workshop_details->career_counselling);?>
                    </p>
                </div>
            </div>
             <!--end: Part 4 -->
             <!-- Part 5 -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>What we have to offers</h3>
                    <p>
                    <?php echo nl2br($workshop_details->what_we_have);?>
                    </p>
                </div>
            </div>
            
            
             <!--end: Part 5 -->
            
            </div>
            
        </section>
        <section id="page-content" class="liveProjecct">
            <div class="container">
            <div class="row">
            <h3>Live Projects & Case Studies</h3>
            <div class="content col-lg-12">
            <p><?php echo nl2br($workshop_details->live_projects);?>  
                    </p>
            </div>
            </div>

            <div class="row pt-3">
            <h3>Quiz & Win</h3>
                <div class="content col-lg-5">
                <img alt="" src="{{asset('assets/images/gif/course-5.jpg')}}" class="rounded-3 w-100">
                </div> 
                <div class="content col-lg-7">
                    <div class="card"> 
                    <div class="card-body">                   
                    <p>
                    <?php echo nl2br($workshop_details->quiz_win);?>  
                    </p>
                    </div></div>
                </div>         
            </div>
            <!-- Part 2 -->
            <div class="row">
                <div class="content col-lg-12">
                    <h3>Test your learning.</h3>
                    <ul class="list-group list-group-numbered">
							<?php
							if(isset($workshop_details->test_your_learning)){
							$arr = explode("\r\n", trim($workshop_details->test_your_learning));
							for ($i = 0; $i < count($arr); $i++) {?>
								<li class="list-group-item">{{$arr[$i]}}</li>
                            <?php }}?>
                        </ul>
                </div>
            </div>
             <!--end: Part 2 -->  
            </div>
        </section>
        
        <!-- end:  Section 2 -->
		
		@include('front.home-page-common.testimonial')
		
		<section id="page-content" class="background-grey no-padding">
            <div class="container">
             
            <div class="row pt-5">
            <h3>Sample Certificate</h3>                 
                <div class="content col-lg-6">                    
                    <p>
                    <?php echo nl2br($workshop_details->sample_certificate);?>    
                    </p>
                </div>
                <div class="content col-lg-6">
                <img alt="" src="{{asset($workshop_details->sample_certificate_image)}}" class="rounded-3 w-100">
                </div>         
            </div>
            <!-- Part 2 -->
            <div class="row">
            <h3>FAQ</h3>
                <div class="content col-lg-7">
                <!--start Accordion  -->
						<div class="accordion fancy radius clean">
                             <div class="ac-item ac-active">
                                 <h5 class="ac-title"><i class="fa fa-arrow-right"></i>{{$workshop_details->question1}}</h5>
                                 <div class="ac-content ac-active">{{$workshop_details->answer1}}</div>
                             </div>
                         </div>
						 <div class="accordion fancy radius clean">
                             <div class="ac-item">
                                 <h5 class="ac-title"><i class="fa fa-arrow-right"></i>{{$workshop_details->question2}}</h5>
                                 <div class="ac-content ac-active">{{$workshop_details->answer2}}</div>
                             </div>
                         </div>
						 <div class="accordion fancy radius clean">
                             <div class="ac-item">
                                 <h5 class="ac-title"><i class="fa fa-arrow-right"></i>{{$workshop_details->question3}}</h5>
                                 <div class="ac-content ac-active">{{$workshop_details->answer3}}</div>
                             </div>
                         </div>
						 <div class="accordion fancy radius clean">
                             <div class="ac-item">
                                 <h5 class="ac-title"><i class="fa fa-arrow-right"></i>{{$workshop_details->question4}}</h5>
                                 <div class="ac-content ac-active">{{$workshop_details->answer4}}</div>
                             </div>
                         </div>
						 <div class="accordion fancy radius clean">
                             <div class="ac-item">
                                 <h5 class="ac-title"><i class="fa fa-arrow-right"></i>{{$workshop_details->question5}}</h5>
                                 <div class="ac-content ac-active">{{$workshop_details->answer5}}</div>
                             </div>
                         </div>
                                   <!--end: Accordion  -->
                </div>
                <div class="content col-lg-5">
                <img alt="" src="{{asset('assets/images/gif/course-4.jpg')}}" class="rounded-3 w-100">                    
                </div>
            </div>
             <!--end: Part 2 -->a
             <!-- Part 3 -->
            <div class="row">
                <div class="content col-lg-12">
                  
                </div>
            </div>
             <!--end: Part 3 -->
            
            </div>
        </section>
@include('front.common.footer')
