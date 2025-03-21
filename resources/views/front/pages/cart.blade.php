@include('front.common.header')
@include('front.common.navbar')

<section id="page-title" data-bg-parallax="{{ asset('assets/images/top-cart-banner.jpg') }}">
    <div class="container">
        <div class="page-title">
            <h1>Cart</h1>
        </div>
    </div>
</section>

<section id="shop-cart">
    <div class="container">
        <div class="shop-cart">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p class="text-green-800">{{ $message }}</p>
                </div>
            @endif

            <div class="table table-sm table-striped table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Workshop/Course</th>
                            <th>Instructor</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($cartItems) > 0)
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <button class="btn btn-light text-danger">×</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="#"><img alt="Course Image" src="{{ asset($item->attributes->image) }}" style="width: 80px;"></a>
                                        <div>{{ $item->name }}</div>
                                    </td>
                                    <td>{{ GetCatNameById($item->id)->trainer_name ?? 'N/A' }}</td>
                                    <td>₹{{ $item->price }}</td>
                                    <td>₹{{ $item->price * $item->quantity }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Cart is empty</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="row">
                <hr class="space">
                <div class="col-lg-12 p-r-10">
                    <div class="table-responsive">
                        <h4>Cart Subtotal</h4>
                        <table class="table">
                            <tbody>
                                @php
                                    $subtotal = Cart::getTotal();
                                    $discount = 0;
                                    $coupon = strtoupper(request('coupon'));
                                    if ($coupon === 'FF10') {
                                        $discount = $subtotal * 0.10;
                                    }
                                    $grandTotal = $subtotal - $discount;
                                @endphp
                                <tr>
                                    <td><strong>Total:</strong></td>
                                    <td class="text-end"><strong>₹{{ number_format($subtotal, 2) }}</strong></td>
                                </tr>
                                @if($discount > 0)
                                <tr>
                                    <td><strong>Discount (FF10 - 10%)</strong></td>
                                    <td class="text-end text-success">- ₹{{ number_format($discount, 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Grand Total:</strong></td>
                                    <td class="text-end text-dark h5"><strong>₹{{ number_format($grandTotal, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Coupon Field --}}
                    <form method="GET" action="{{ url()->current() }}" class="mb-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Have a coupon?</label>
                            <div class="col-sm-6">
                                <input type="text" name="coupon" class="form-control" value="{{ request('coupon') }}" placeholder="Enter coupon code">
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-outline-primary">Apply</button>
                            </div>
                        </div>
                    </form>

                    {{-- Payment Button --}}
                    @if(Auth::check())
                        <form action="{{ url('process-order') }}" method="POST">
                            @csrf
                            @if(empty(Auth::user()->email_verified_at))
                                <button class="btn btn-success float-end">Make Purchase</button>
                            @else
                                <button class="btn btn-danger float-end" type="button">Email not verified</button>
                            @endif
                        </form>
                        <a href="{{ url('workshops') }}" class="btn btn-secondary float-end me-2">Back to workshops</a>
                    @else
                        <form action="{{ url('process-order') }}" method="POST">
                            @csrf
                            <button class="btn btn-success float-end">Make Purchase</button>
                            <a href="{{ url('workshops') }}" class="btn btn-secondary float-end me-2">Back to workshops</a>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')
