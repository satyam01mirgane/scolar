@include('front.common.header')
@include('front.common.navbar')
 <!-- Breadcrumb Begin -->
 <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{asset('assets/img/hero/h1_hero.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center text-dark">
                            <h2>@if(!$catdata)Product List @else {{$catdata->name}} @endif</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    
    <!-- product list part start-->
    <style>
	li.catc:hover {
	  color: blue;
	  text-decoration:underline;
	}
	.boldc{font-weight:bold;color:blue;}
	</style>
	<section class="product_list pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="product_sidebar">
                        <!--<div class="single_sedebar">
                            <form action="#">
                                <input type="text" name="#" placeholder="Search keyword">
                                <i class="ti-search"></i>
                            </form>
                        </div>-->
                        <div style="background:white;">
							<h4><b>Category List</b></h4>
							<ul>
								@php
									$category = category_list();
								@endphp
								
								@foreach($category as $k=>$v)
								
								
								<a href="{{url('category/'.$v->slug)}}"  style="color:#000;padding:10px;"><li class="catc @if($catdata->slug==$v->slug)boldc @endif ">{{$v->name}}</li></a>
								@endforeach
							</ul>
                        </div>
                        <!--<div class="single_sedebar">
                            <div class="select_option">
                                <div class="select_option_list">Type <i class="right fas fa-caret-down"></i> </div>
                                <div class="select_option_dropdown">
                                    <p><a href="#">Type 1</a></p>
                                    <p><a href="#">Type 2</a></p>
                                    <p><a href="#">Type 3</a></p>
                                    <p><a href="#">Type 4</a></p>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="product_list">
                        <div class="row">
							@php
								$discount = 0;
							@endphp
							@if(count($products)>0)
							@foreach($products as $k=>$v)
							@php
							$discount = ($v->price1) - (($v->price1 * $v->discount)/100);
							@endphp
                            <div class="col-lg-4 col-sm-4">
                                <div class="single_product_item">
									<a href="{{url('product/'.$v->slug)}}">
                                    <img src="{{asset($v->product_image)}}" alt="" class="img-fluid border">
									@if($v->rating >0)
										<div class="product-ratting">
										<?php
										for($i=1; $i<=5;$i++) {
										if($i<=$v->rating){	
										?>
											<i class="far fa-star"></i>
										<?php }else{?>
										<i class="far fa-star low-star"></i>
										<?php }}?>
										</div>
									@endif
                                    <h3 class="height50"> <a href="{{url('product/'.$v->slug)}}">{{truncate($v->name)}}</a> </h3>
                                    <div class="price mb-3">
										<ul>
											<li>₹{{ $v->price1 - $v->discount }} &nbsp;&nbsp; <span class="discount" style="color:#ff003c;text-decoration: line-through">₹{{$v->price1}}</span></li>
											
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
                            </div>
							@php  @endphp
							@endforeach
							{!! $products->links() !!}
							@else
							<div class="col-lg-4 col-sm-4">
                                <div class="single_product_item">
									<span class="text-danger">No Products</span>
								</div>
							</div>
							@endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product list part end-->
    
   
	
<hr>
    <!-- Shop Method Start-->
    <div class="shop-method-area pt-4">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-method mb-40">
                        <i class="ti-package"></i>
                        <h6>Free Shipping Method</h6>
                        <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-method mb-40">
                        <i class="ti-unlock"></i>
                        <h6>Secure Payment System</h6>
                        <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                    </div>
                </div> 
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-method mb-40">
                        <i class="ti-reload"></i>
                        <h6>Secure Payment System</h6>
                        <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Method End-->
	 <!-- client review part here -->
    @include('front.home-page-common.subscribe')
    <!-- client review part end -->
@include('front.common.footer')