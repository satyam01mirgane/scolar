@include('front.common.header')
@include('front.common.navbar')
<!--Page Title-->
<section id="page-title" data-bg-parallax="{{asset('assets/images/about-us-banner.jpg')}}">
            <div class="container">
                <div class="page-title" style="min-height:150px">
                   <h1>{{$page_details->name}}</h1>
                    
                </div>
            </div>
        </section>
<!--End Page Title-->
 <!-- Breadcrumb Begin -->

<!--End Page Title-->
<section>
@if(is_null($page_details))
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="column-title text-center">Page content not found</h3>
			</div>
		</div>
	</div>
@else
  <div class="container">
    <div class="row" style="margin:30px;">
        <div class="col-lg-12">
          <p style="text-align:justify;font-weight:normal;"><?php echo nl2br($page_details->description);?></p>

        </div><!-- Col end -->
    </div><!-- Content row end -->
    </div>

  </div><!-- Container end -->
  @endif
  <hr>
</section><!-- Main container end -->

<!--  Footer Start -->
@include('front.common.footer')