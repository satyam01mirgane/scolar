@include('front.common.header')

<!--  Header Menu start -->
<header>
    @include('front.common.topbar')
    @include('front.common.navbar')
</header>
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <section class="popular-courses">
					<h2>Your Courses</h2>
					<div class="container">
						<div class="row">
							@if(count($course_details)>0)
							@foreach($course_details as $m=>$vjm)
							<div class="col-lg-4 col-md-6">
								<div class="course-block style-5">
									<div class="course-img">
										<img src="{{asset($vjm->image)}}" alt="" class="img-fluid">
									</div>
									
									<div class="course-content">
										<a href="{{url('course-content/'.cleanString($vjm->name).'/'.base64_encode($vjm->id))}}"><div class="course-price ">Play</div> </a>  

										<div class="rating">
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<a href="#"><i class="fa fa-star"></i></a>
											<span>(5.00)</span>
										</div>
										<h4><a href="{{url('course-content/'.cleanString($vjm->name).'/'.base64_encode($vjm->id))}}">{{$vjm->name}}</a></h4>   
									</div>
								</div>
							</div>
							@endforeach
							@else
							<span style="color:red;">No course found.</span>
							@endif
						</div>
					</div>
				</section>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix pt-5"></div>
@include('front.common.footer')
