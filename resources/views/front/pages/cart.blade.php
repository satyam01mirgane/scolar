@include('front.common.header')
@include('front.common.navbar')

<section id="page-title" data-bg-parallax="{{ asset('assets/images/top-cart-banner.jpg') }}">
    <div class="container">
        <div class="page-title">
            <h1>Cart</h1>
        </div>
    </div>
</section>

<section id="shop-cart" class="py-5">
    <div class="container">
        <div class="shop-cart">

            {{-- Success Message --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success text-green-800">{{ $message }}</div>
            @endif

            {{-- Cart Table --}}
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th>Workshop/Course</th>
                            <th>Instructor</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cartItems as $item)
                            <tr>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button class="btn btn-outline-danger btn-sm" title="Remove item">×</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="#">
                                        <img src="{{ asset($item->attributes->image) }}" alt="{{ $item->name }}" class="img-thumbnail" style="max-width: 80px;">
                                        <div>{{ $item->name }}</div>
                                    </a>
                                </td>
                                <td>{{ GetCatNameById($item->id)->trainer_name ?? 'N/A' }}</td>
                                <td>₹ {{ $item->price }}</td>
                                <td>₹ {{ $item->price * $item->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Your cart is empty</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Cart Summary --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Cart Summary</h4>
                    <dl class="row">
                        <dt class="col-6">Total Price:</dt>
                        <dd class="col-6 text-end">@if(Cart::getTotal() == 0) Free @else ₹{{ Cart::getTotal() }} @endif</dd>
                    </dl>
                    <hr>
                    <dl class="row fw-bold">
                        <dt class="col-6">Total:</dt>
                        <dd class="col-6 text-end text-dark h5">@if(Cart::getTotal() == 0) Free @else ₹{{ Cart::getTotal() }} @endif</dd>
                    </dl>

                    {{-- Purchase Buttons --}}
                    @if(Auth::check())
                        <form action="{{ url('process-order') }}" method="POST">
                            @csrf
                            @if(empty(Auth::user()->email_verified_at))
                                <button type="submit" class="btn btn-success w-100 my-2">Make Purchase</button>
                            @else
                                <button type="button" class="btn btn-danger w-100 my-2">Email not verified</button>
                            @endif
                        </form>
                    @else
                        <form action="{{ url('process-order') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 my-2">Make Purchase</button>
                        </form>
                    @endif

                    <a href="{{ url('workshops') }}" class="btn btn-outline-secondary w-100">Back to Workshops</a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')
