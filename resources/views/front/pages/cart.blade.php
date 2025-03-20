@include('front.common.header')
@include('front.common.navbar')

<section id="shop-cart" style="padding: 60px 0; background-color: #f8f9fa;">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 2.5rem; color: #333; margin-bottom: 30px; text-align: center; opacity: 0; animation: fadeIn 0.5s ease-out forwards;">
            Your Cart
        </h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; opacity: 0; animation: slideDown 0.5s ease-out forwards;">
                <p>{{ $message }}</p>
            </div>
        @endif

        @php 
            $total_dis = 0;
            $coupon_discount = 0;
            $coupon_code = request('coupon_code');
            $cartItems = Cart::getContent();
            $subtotal = 0;
        @endphp

        <div class="shop-cart" style="background-color: #fff; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; opacity: 0; animation: fadeIn 0.5s ease-out 0.2s forwards;">
            <div class="table-responsive" style="padding: 20px;">
                <table class="table" style="width: 100%; border-collapse: separate; border-spacing: 0 15px;">
                    <thead>
                        <tr style="background-color: #f1f3f5;">
                            <th style="padding: 15px; text-align: left; color: #495057; font-weight: 600;">Masterclass</th>
                            <th style="padding: 15px; text-align: left; color: #495057; font-weight: 600;">Instructor</th>
                            <th style="padding: 15px; text-align: right; color: #495057; font-weight: 600;">Unit Price</th>
                            <th style="padding: 15px; text-align: right; color: #495057; font-weight: 600;">Discount</th>
                            <th style="padding: 15px; text-align: right; color: #495057; font-weight: 600;">Total</th>
                            <th style="padding: 15px; text-align: center; color: #495057; font-weight: 600;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($cartItems) > 0)
                            @foreach ($cartItems as $item)
                                @php
                                    $item_discount = calculate_discount($item->id);
                                    $total_dis += $item_discount;
                                    $subtotal += ($item->price * $item->quantity);
                                @endphp
                                <tr style="background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                    <td style="padding: 15px; display: flex; align-items: center;">
                                        <img src="{{ asset($item->attributes->image) }}" alt="{{ $item->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                                        <span style="font-weight: 500; color: #333;">{{ $item->name }}</span>
                                    </td>
                                    <td style="padding: 15px; color: #666;">{{ GetCatNameById($item->id)->trainer_name }}</td>
                                    <td style="padding: 15px; text-align: right; color: #333;">₹{{ $item->price }}</td>
                                    <td style="padding: 15px; text-align: right; color: #28a745;">-₹{{ $item_discount }}</td>
                                    <td style="padding: 15px; text-align: right; font-weight: 600; color: #333;">
                                        ₹{{ ($item->price * $item->quantity) - $item_discount }}
                                    </td>
                                    <td style="padding: 15px; text-align: center;">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; transition: color 0.3s ease;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 30px; color: #666;">Your cart is empty</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @php
                $grand_total = $subtotal - $total_dis;

                // Apply coupon discount
                if ($coupon_code === 'FLAT10') {
                    $coupon_discount = ($subtotal * 10) / 100;
                    $grand_total -= $coupon_discount;
                }
            @endphp 

            <div style="background-color: #f8f9fa; padding: 30px; border-top: 1px solid #e9ecef;">
                <div style="display: flex; justify-content: flex-end; align-items: flex-start;">
                    <div style="width: 300px;">
                        <h4 style="margin-bottom: 20px; color: #333; font-size: 1.2rem;">Cart Summary</h4>

                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: #666;">Subtotal:</span>
                            <span style="font-weight: 600; color: #333;">₹{{ $subtotal }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: #666;">Item Discount:</span>
                            <span style="font-weight: 600; color: #28a745;">-₹{{ $total_dis }}</span>
                        </div>
                        @if ($coupon_discount > 0)
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span style="color: #666;">Coupon Discount:</span>
                                <span style="font-weight: 600; color: #28a745;">-₹{{ $coupon_discount }}</span>
                            </div>
                        @endif
                        <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 1px solid #dee2e6;">
                            <span style="font-weight: 600; color: #333;">Total:</span>
                            <span style="font-weight: 600; color: #333; font-size: 1.2rem;">₹{{ $grand_total }}</span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
                    <form action="{{ url('process-order') }}" method="post">
                        @csrf
                        <button type="submit" style="display: inline-block; padding: 12px 24px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">
                            Proceed to Payment (₹{{ $grand_total }})
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')
