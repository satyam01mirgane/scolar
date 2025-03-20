@include('front.common.header')
@include('front.common.navbar')

<section id="page-title" data-bg-parallax="{{asset('assets/images/newpayment.jpg')}}">
    <div class="container">
        <div class="page-title">
            <h1>Payment Page</h1>
        </div>
    </div>
</section>

<!-- Checkout Area -->
<section class="checkout_area" style="padding-top:30px;">
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
                $total_dis = 0;
                $coupon_discount = 0;
                $coupon_code = request('coupon_code');
                $subtotal = Cart::getTotal();

                // Calculate item discounts
                foreach ($cartItems as $item) {
                    $total_dis += calculate_discount($item->id);
                }

                // Calculate grand total after item discounts
                $grand_total = $subtotal - $total_dis;

                // Apply coupon discount if a valid coupon is entered
                if (!empty($coupon_code) && $coupon_code === 'FLAT10') {
                    $coupon_discount = ($grand_total * 10) / 100;
                    $grand_total -= $coupon_discount;
                }

                // Ensure total is not negative
                if ($grand_total < 0) {
                    $grand_total = 0;
                }
            @endphp

            <div class="row">
                <div class="col-lg-12">
                    <h3 style="text-align:center;">Complete payment <br> Please do not press back button or refresh the page.</h3>

                    <!-- Hidden Form to Send Correct Discounted Total to Razorpay -->
                    <form action="{{ route('razorpay.payment.store') }}" method="POST" id="razorpay-form" style="display:none;">
                        @csrf
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="rzp_live_lP2LYJNlqAhhTs"
                                data-amount="{{ $grand_total * 100 }}"
                                data-buttontext="Complete Order"
                                data-name="{{ Auth::user()->name }}"
                                data-description="Online Payment"
                                data-image="{{ asset(app_setting()->logo) }}"
                                data-prefill.name="{{ Auth::user()->name }}"
                                data-prefill.email="{{ Auth::user()->email }}"
                                data-theme.color="#ff7529">
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

<script>
    document.getElementById("razorpay-form").submit();
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>
