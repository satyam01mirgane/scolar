@include('front.common.header')
@include('front.common.navbar')
<style>
div.ex1 {
  background-color: lightblue;
  width: 100%;
  height: 700px;
  overflow: scroll;
}
</style>
<!-- slider Area Start-->
  <div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider d-flex align-items-center" data-background="{{asset('assets/img/hero/h1_hero.jpg')}}" style="min-height="100px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h4>{{Auth::user()->name}}</h4>
						<span>User Since - {{date('d,M Y',strtotime(Auth::user()->created_at))}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- slider Area End-->
<!--================Checkout Area =================-->
  <section class="checkout_area " style="padding-top:30px;">
    <div class="container">
        <div class="row">
		  @include('front.common.sidebar')
          <div class="col-lg-9">
            <h3>My Wishlist</h3>
			@if (count($errors) > 0)
			   <div class = "alert alert-danger">
				  <ul>
					 @foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					 @endforeach
				  </ul>
			   </div>
			@endif
			
			@if ($message = Session::get('success'))
			  <div class="alert alert-success">
				  <p class="text-green-800">{{ $message }}</p>
			  </div>
			@endif
			@if ($message = Session::get('error'))
			  <div class="alert alert-danger">
				  <p class="text-green-800">{{ $message }}</p>
			  </div>
			@endif
		
			<table class="table table bordered">
				<thead>
					<th>Name</th>
					<th>Image</th>
					<th>Price</th>
					<th>Discount</th>
					<th>Action</th>
				</thead>
				<tbody>
					@php
						$discount = 0;
					@endphp
					@foreach($wishlist as $key=>$item)
					@php
					$discount = ($item->price1) - (($item->price1 * $item->discount)/100);
					@endphp
					<tr>
						<td>{{$item->name}}</td>
						<td><img src="{{asset($item->product_image)}}" width="100" height="70"></td>
						<td>₹{{$item->price1}}</td>
						<td>{{$item->discount}}%</td>
						<td>
							<form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<input type="hidden" value="{{ $item->id }}" name="id">
										<input type="hidden" value="{{ $item->name }}" name="name">
										<input type="hidden" value="{{ $discount }}" name="price">
										<input type="hidden" value="{{ $item->product_image }}"  name="image">
										<input type="hidden" value="1" name="quantity">
										<button class="btn btn-primary rounded">Add To Cart</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
        </div>
      </div>
    </div>
  </section>
  <section style="padding-bottom:50px;">
  
  </section>
  <!--================End Checkout Area =================-->
@include('front.home-page-common.subscribe')
@include('front.common.footer')
