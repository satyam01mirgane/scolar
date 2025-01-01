@include('front.common.header')
@include('front.common.navbar')

<section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
            <div class="container">
                <div class="page-title">
                    <h1>Payment Page</h1>
                    
                </div>
            </div>
        </section>
<!--End Page Title-->
  <!-- slider Area End-->
<!--================Checkout Area =================-->
  <section class="checkout_area " style="padding-top:30px;">
    <div class="container">
      <div class="billing_details">
	  <div class="row">
			@if($message = Session::get('error'))
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Error!</strong> {{ $message }}
				</div>
			@endif

			@if($message = Session::get('success'))
				<div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Success!</strong> {{ $message }}
				</div>
			@endif
	  </div>
		@php 
			$udis = 0;
			$total_dis = 0;
			foreach($cartItems as $item){
				$udis = calculate_discount($item->id);
				$total_dis = $total_dis + $udis;
			}
			$subtotal = Cart::getTotal();
			$discount = $total_dis;
			$grand_total = $subtotal - $discount;
		@endphp
        <div class="row">
          <div class="col-lg-12">
            <h3 style="text-align:center;">Complete payment <br> Please do not press back button or refresh the page.</h3>
			<form action="{{ route('razorpay.payment.store') }}" method="POST" id="op" style="display:none;">
					@csrf
					<script src="https://checkout.razorpay.com/v1/checkout.js"
							data-key="rzp_live_lP2LYJNlqAhhTs"
							data-amount="{{ $grand_total*100 }}"
							data-buttontext="Complete Order"
							data-name="{{Auth::user()->name}}"
							data-description="Online Payment"
							data-image="{{asset(app_setting()->logo)}}"
							data-prefill.name="{{Auth::user()->name}}"
							data-prefill.email="{{Auth::user()->email}}"
							data-theme.color="#ff7529">
					</script>
				</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->
@include('front.common.footer')
<script>
$("#op").submit();
window.history.forward();
function noBack() {
	window.history.forward();
}
</script>
