@include('front.common.header')
@include('front.common.navbar')

<section id="shop-cart" style="padding: 60px 0; background-color: #f8f9fa;">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 2.5rem; color: #333; margin-bottom: 30px; text-align: center; opacity: 0; animation: fadeIn 0.5s ease-out forwards;">Your Cart</h1>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; opacity: 0; animation: slideDown 0.5s ease-out forwards;">
                <p>{{ $message }}</p>
            </div>
        @endif

        @php 
            $udis = 0;
            $total_dis = 0;
            $coupon_discount = 0;
            $coupon_code = request('coupon_code');
        @endphp

        <div class="shop-cart" style="background-color: #fff; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; opacity: 0; animation: fadeIn 0.5s ease-out 0.2s forwards;">
            <div class="table-responsive" style="padding: 20px;">
                <table class="table" style="width: 100%; border-collapse: separate; border-spacing: 0 15px;">
                    <!-- Table content same as before -->
                </table>
            </div>

            @php
                $subtotal = Cart::getTotal();
                $discount = $total_dis;
                $grand_total = $subtotal - $discount;

                if ($coupon_code === 'FLAT10') {
                    $coupon_discount = $subtotal * 0.10;
                    $grand_total -= $coupon_discount;
                }
            @endphp 

            <div style="background-color: #f8f9fa; padding: 30px; border-top: 1px solid #e9ecef;">
                <!-- Coupon and summary section same as before -->

                <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
                    <a href="{{url('workshops')}}" style="display: inline-block; padding: 12px 24px; background-color: #6c757d; color: #fff; text-decoration: none; border-radius: 5px; margin-right: 10px; transition: background-color 0.3s ease;">Back to Explore</a>
                    
                    @if(!empty(Auth::user()))
                        <form action="{{url('process-order')}}" method="post" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="coupon_code" value="{{ $coupon_code }}">
                            @if(empty(Auth::user()->email_verified_at))
                                <button type="submit" style="display: inline-block; padding: 12px 24px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Make Purchase</button>
                            @else
                                <button type="button" style="display: inline-block; padding: 12px 24px; background-color: #dc3545; color: #fff; border: none; border-radius: 5px; cursor: not-allowed;">Email not verified</button>
                            @endif
                        </form>
                    @else
                        <form action="{{url('process-order')}}" method="post" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="coupon_code" value="{{ $coupon_code }}">
                            <button type="submit" style="display: inline-block; padding: 12px 24px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Make Purchase</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Same styles as before -->

@include('front.common.footer')