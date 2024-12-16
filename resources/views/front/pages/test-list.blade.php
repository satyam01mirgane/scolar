@include('front.common.header')
@include('front.common.navbar')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{asset('assets/images/course.png')}}">
	<div class="container">
		<div class="page-title" style="min-height:150px;">
			<h1>Online Test</h1>
		</div>
	</div>
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section id="page-content">
            <div class="container">
                <div class="row">
                    <div class="content col-lg-12">                       
						<!--Post Carousel -->
						@php 
							$total = count($start_quiz);
							if($total > 8){
								$first_loop = floor($total/2);
							}else{
								$first_loop = $total;
							}
							$second_lopp = $total - $first_loop;
						@endphp
				<div class="heading-text heading-section">
                    <h2>Test List</h2>
                    <span class="lead">We have identified the best offline and online courses that will assist people in honing their innate talents and
					aptitudes and moving forward into a successful era. Enroll in our next course to benefit from top-notch instruction. Enroll today!</span>
                </div>
                        <div class="carousel" data-items="3">
						@foreach($start_quiz as $k=>$v)
						@if($k < $first_loop )
                            <!-- Post item-->
                            <div class="post-item border">
                                <div class="post-item-wrap">
                                    <div class="post-image">
                                        <a href="{{url('start-test/'.$v->slug)}}">
                                            <img alt="" src="{{asset($v->image)}}"></a>
                                    </div>
                                    <div class="post-item-description">                                
										<h2><a href="{{url('start-test/'.$v->slug)}}">{{truncate($v->name,30)}}</a></h2>
										<p>{{truncate($v->description,40)}}</p>
           
											<h2>
												<a href="{{url('start-test/'.$v->slug)}}"><button class="btn btn-outline" type="button">Start Test</button></a>
											</h2>

                                    </div>
                                </div>
                            </div>
                            <!-- end: Post item-->
							@endif
							@endforeach
							
                        </div>
						<div class="carousel t-5 pt-5" data-items="3">
						@foreach($start_quiz as $k=>$v)
						<?php if(++$k > $first_loop && $total > 3){?>
                            <!-- Post item-->
                             <div class="post-item border">
                                <div class="post-item-wrap">
                                    <div class="post-image">
                                        <a href="{{url('start-test/'.$v->slug)}}">
                                            <img alt="" src="{{asset($v->image)}}"></a>
                                    </div>
                                    <div class="post-item-description">                                
										<h2><a href="{{url('start-test/'.$v->slug)}}">{{truncate($v->name,30)}}</a></h2>
										<p>{{truncate($v->description,40)}}</p>
           
											<h2>
												<a href="{{url('start-test/'.$v->slug)}}"><button class="btn btn-outline" type="button">Start Test</button></a>
											</h2>

                                    </div>
                                </div>
                            </div>
                            <!-- end: Post item-->
						<?php }?>
							@endforeach
							
                        </div>
                      
                    </div>
                    
                </div>
            </div>
        </section>

<!--End Workshop Section-->
@include('front.common.footer')
<script>
$("#course_type").change(function(){
	var val = $(this).val();
	if(val =='CBSE Courses'){
		$("#classes").prop("disabled",false);
	}else{
		$("#classes").prop("disabled",true);
	}
});
</script>