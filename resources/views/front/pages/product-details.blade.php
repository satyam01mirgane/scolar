@include('front.common.header')
@include('front.common.navbar')
<style>
.owl-prev{background:black;}
.owl-next{background:black;}
</style>
 <!-- Breadcrumb Begin -->
 <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{asset('assets/img/hero/h1_hero.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center text-dark">
                            <h2>Product Details</h2>
							<span><a href="{{url('category/'.$catdata->slug)}}" class="text-dark">{{$catdata->name}}</a>/{{$product_details->name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    
    <!--================Single Product Area =================-->
  <section class="product_list pt-4">
        <div class="container">
  <div class="row pt-4">
	<div class="col-sm-6">
		<div class="product_img_slide owl-carousel" style="margin:10px;">
            <div class="single_product_img img-wrapper1">
              <img alt="{{$product_details->name}}" src="{{asset($product_details->product_image)}}"
                data-izoomify-url="{{asset($product_details->product_image)}}"
                data-izoomify-magnify="2.75"
                data-izoomify-duration="300"  class="img-responsive">
            </div>
            <div class="single_product_img img-wrapper1">
              <img src="{{asset($product_details->other_image1)}}" alt="{{$product_details->name}}" data-izoomify-url="{{asset($product_details->other_image1)}}"
                data-izoomify-magnify="2.75"
                data-izoomify-duration="300"  class="img-responsive">
            </div>
			@if($product_details->other_image2)
            <div class="single_product_img img-wrapper1">
              <img src="{{asset($product_details->other_image2)}}" alt="{{$product_details->name}}" class="img-responsive" data-izoomify-url="{{asset($product_details->other_image2)}}"
                data-izoomify-magnify="2.75"
                data-izoomify-duration="300"  class="img-responsive">
            </div>
			@endif
			@if($product_details->other_image3)
            <div class="single_product_img img-wrapper1">
              <img src="{{asset($product_details->other_image3)}}" alt="{{$product_details->name}}" class="img-responsive" data-izoomify-url="{{asset($product_details->other_image3)}}"
                data-izoomify-magnify="2.75"
                data-izoomify-duration="300"  class="img-responsive">
            </div>
			@endif
			@if($product_details->other_image4)
            <div class="single_product_img img-wrapper1">
              <img src="{{asset($product_details->other_image4)}}" alt="{{$product_details->name}}" class="img-responsive" data-izoomify-url="{{asset($product_details->other_image4)}}"
                data-izoomify-magnify="2.75"
                data-izoomify-duration="300"  class="img-responsive">
            </div>
			@endif
			@if($product_details->other_image5)
            <div class="single_product_img img-wrapper1">
              <img src="{{asset($product_details->other_image5)}}" alt="{{$product_details->name}}" class="img-responsive" data-izoomify-url="{{asset($product_details->other_image5)}}"
                data-izoomify-magnify="2.75"
                data-izoomify-duration="300"  class="img-responsive">
            </div>
			@endif
          </div>
	</div>
	@php 
			$discount = ($product_details->price1 - ($product_details->price1*$product_details->discount)/100)
		@endphp
	<div class="col-sm-6">
		<div class="flex">
			<div class="f-left">
				<h3 class="mt-3">{{$product_details->name}} </h3>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="f-left">
				@if($product_details->rating >0)
					<div class="product-ratting">
					<?php
					for($i=1; $i<=5;$i++) {
					if($i<=$product_details->rating){	
					?>
						<i class="far fa-star"></i>
					<?php }else{?>
					<i class="far fa-star low-star"></i>
					<?php }}?>
					</div>
				@endif
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>
            <div class="card_area mt-0">
                <div class="price">
					<ul class="flex mb-3">
						<li style="font-size:20px;">₹{{ $product_details->price1 - $product_details->discount }} &nbsp; <span style="color:#ff003c;text-decoration: line-through;font-size:20px;">₹{{$product_details->price1}}</span></li>
						
					</ul>
				</div>
			<div>
			<div class="f-left">
				<form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" value="{{ $product_details->id }}" name="id">
					<input type="hidden" value="{{ $product_details->name }}" name="name">
					<input type="hidden" value="{{ $discount }}" name="price">
					<input type="hidden" value="{{ $product_details->product_image }}"  name="image">
					<input type="hidden" value="1" name="quantity">
					<button class="genric-btn primary" name="btnname" value="cart">Add To Cart</button>
					<button class="genric-btn danger" name="btnname" value="buy">Buy Now</button>
				</form>
			</div>
			@if(Auth::user())
				@if(!in_array($product_details->id,$wishids))
				<div class="f-right">
					<a href="{{url('add-to-wishlist/'.$product_details->slug)}}" class="genric-btn info"><i class="fas fa-heart fa-fw me-3"></i> Add to Wishlist</a>
				</div>
				@endif
			@endif
			</div>
            <div class="clearfix">&nbsp;</div>
			<h4 class="mt-4">Product Description:</h4>
			<p>
			{{$product_details->short_description}}
            </p>
			<p><?php echo $product_details->full_description?></p>
            </div>
	</div>
  </div>
  </div>
  </section>
  <!--================End Single Product Area =================-->
  <hr>
  <section class="product_list">
        <div class="container">
            <div class="row">
				<h2 class="pl-3 mb-3">Related Product</h2>
                <div class="col-xl-12 col-lg-12">
                        <div class="single-category mb-30">
                            <div class="owl-carousel owl-theme">
							@php
								$discount = 0;
								if(count($products)>0){
							@endphp
							@foreach($products as $k=>$v)
							@php
							$discount = ($v->price1) - (($v->price1 * $v->discount)/100);
							@endphp
                                <div class="single_product_item">
									<a href="{{url('product/'.$v->slug)}}">
                                    <img src="{{asset($v->product_image)}}" alt="" class="img-fluid">
                                    <h3 class="text-primary height50"> <a href="{{url('product/'.$v->slug)}}" class="text-dark">{{truncate($v->name)}}</a> </h3>
                                    <div class="price">
										<ul>
											<li>₹{{ $v->price1 - $v->discount }} &nbsp; <span class="discount" style="color:#ff003c;text-decoration: line-through">₹{{$v->price1}}</span></li>
											
										</ul>
									</div>
									</a>
									<form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<input type="hidden" value="{{ $v->id }}" name="id">
										<input type="hidden" value="{{ $v->name }}" name="name">
										<input type="hidden" value="{{ $v->price1 - $v->discount }}" name="price">
										<input type="hidden" value="{{ $v->product_image }}"  name="image">
										<input type="hidden" value="1" name="quantity">
										<button class="genric-btn primary" name="btnname" value="cart">Add To Cart</button>
										<button class="genric-btn danger" name="btnname" value="buy">Buy Now</button>
									</form>
                                </div>
							@endforeach
							@php }else{ @endphp
							<div class="red">No product found</div>
							@php }@endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
	<section class="section-padding"></section>

@include('front.home-page-common.subscribe')
@include('front.common.footer')
<script src="{{asset('assets/js/jquery.izoomify.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.img-wrapper1').izoomify();
        });
		
		$('.owl-carousel').owlCarousel({
				slidesToShow: 1,
				slidesToScroll: 1,
				loop: true,
				autoplay:true,
				speed: 3000,
				smartSpeed:2000,
				nav: true,
				dots: false,
				margin: 15,

				autoplayHoverPause: true,
				responsive : {
				  0 : {
					items: 1
				  },
				  768 : {
					items: 2
				  },
				  992 : {
					items: 2
				  },
				  1200:{
					items: 3
				  }
				}
			})
    </script>