@include('front.common.header')
@include('front.common.navbar')

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="mb-4">Your Cart</h2>

    @if ($message = Session::get('success'))
      <div class="alert alert-success">{{ $message }}</div>
    @endif

    {{-- Items List --}}
    <div class="card mb-4">
      <div class="card-body">
        @php
          $subtotal = 0;
        @endphp

        @if(count($cartItems) > 0)
          @foreach ($cartItems as $item)
            @php
              $itemTotal = $item->price * $item->quantity;
              $subtotal += $itemTotal;
            @endphp
            <div class="row align-items-center mb-3">
              <div class="col-md-6">
                <h6 class="mb-0">{{ $item->name }}</h6>
                <small>Qty: {{ $item->quantity }}</small>
              </div>
              <div class="col-md-6 text-end">
                ₹{{ $itemTotal }}
              </div>
            </div>
          @endforeach
        @else
          <p class="text-danger">Cart is empty.</p>
        @endif
      </div>
    </div>

    {{-- Price Summary & Coupon --}}
    <div class="card mb-4">
      <div class="card-body">
        {{-- Coupon Code Form --}}
        <form method="GET" action="{{ url()->current() }}">
          <div class="mb-3">
            <label class="form-label">Have a coupon?</label>
            <div class="input-group">
              <input type="text" class="form-control" name="coupon" value="{{ request('coupon') }}" placeholder="Enter coupon code">
              <button type="submit" class="btn btn-outline-primary">Apply</button>
            </div>
          </div>
        </form>

        {{-- Discount Calculation --}}
        @php
          $discount = 0;
          $couponCode = strtoupper(request('coupon'));
          if ($couponCode === 'FF10') {
              $discount = $subtotal * 0.10;
          }
          $grandTotal = $subtotal - $discount;
          $subtotal=$subtotal-$discount;
        @endphp

        <dl class="row">
          <dt class="col-sm-6">Total Price:</dt>
          <dd class="col-sm-6 text-end">₹{{ number_format($subtotal, 2) }}</dd>

          <dt class="col-sm-6">
            Discount 
            @if($couponCode === 'FF10') (10% - Code: FF10) 
            @endif
          </dt>
          <dd class="col-sm-6 text-end text-success">- ₹{{ number_format($discount, 2) }}</dd>

          <hr>

          <dt class="col-sm-6 h5">Grand Total:</dt>
          <dd class="col-sm-6 text-end h5 text-dark">₹{{ number_format($grandTotal, 2) }}</dd>
        </dl>
      </div>
    </div>

    {{-- Proceed to Payment --}}
    <div class="text-end">
      @if(Auth::check())
        <form action="{{ url('process-order') }}" method="POST">
          @csrf
          @if(empty(Auth::user()->email_verified_at))
            <button type="submit" class="btn btn-success">Proceed to Payment</button>
          @else
            <button type="button" class="btn btn-danger">Email not verified</button>
          @endif
        </form>
      @else
        <form action="{{ url('process-order') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-success">Proceed to Payment</button>
        </form>
      @endif
    </div>
  </div>
</section>

@include('front.common.footer')
