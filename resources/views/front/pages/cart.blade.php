@include('front.common.header')
@include('front.common.navbar')

<section id="page-title" data-bg-parallax="{{asset('assets/images/top-cart-banner.jpg')}}">
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
                                    <th class="cart-product-remove"></th>
                                    <th class="cart-product-thumbnail">Workshop/Course</th>
                                    <th class="cart-product-name">Instructor</th>
                                    <th class="cart-product-price">Unit Price</th>
                                    <th class="cart-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($cartItems) >0)
								@foreach ($cartItems as $item)
                                <tr>
                                    <td class="cart-product-remove">
										<form action="{{ route('cart.remove') }}" method="POST">
										  @csrf
											  <input type="hidden" value="{{ $item->id }}" name="id">
											  <button class="btn btn-light text-danger"></button>
										  </form>
                                    </td>
                                    <td class="cart-product-thumbnail">
                                        <a href="#">
                                            <img alt="Learn Cloud Computing" src="{{asset($item->attributes->image)}}">
                                        </a>
                                        <div class="cart-product-thumbnail-name">{{$item->name}}</div>
                                    </td>
                                    <td class="cart-product-description">
                                        <p><span>{{GetCatNameById($item->id)->trainer_name}}</span>
                                        </p>
                                    </td>
                                    <td class="cart-product-price">
                                        <span class="amount">₹ {{ $item->price }}</span>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <span class="amount">₹ {{ $item->price * $item->quantity }}</span>
                                    </td>
                                </tr>
								@endforeach
								@else
								<tr>
								  <td colspan="4">Cart is empty</td>
								</tr>
								@endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <hr class="space">
                        <div class="col-lg-12 p-r-10 ">
                            <div class="table-responsive">
                                <h4>Cart Subtotal</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="cart-product-name">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="cart-product-name text-end">
                                                <span class="amount color lead"><strong>@if(Cart::getTotal() ==0 ) Free @else ₹{{ Cart::getTotal() }} @endif</strong></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
							 @if(!empty(Auth::user()))
								<form action="{{url('process-order')}}" method="post">
								@csrf
							  @if(empty(Auth::user()->email_verified_at))<!-- will be checked not empty -->
							  <button class="btn icon-left float-right" type="submit">Make Purchase</button>
							  @else
								  <button class="btn icon-left float-right" type="button">Email not verified</button>
							  @endif
							  </form>
							  <a href="{{url('workshops')}}" class="btn icon-left float-right" style="margin-right:5px;"> Back to workshops </a>
							@else
								<form  action="{{url('process-order')}}" method="post">
								@csrf
							  <button class="btn icon-left float-right" type="submit" style="margin-right:5px;">Make Purchase</button>
							  <a href="{{url('workshops')}}" class="btn icon-left float-right"> Back to workshops </a>
							  </form>
							@endif
							
                        </div>
                    </div>
                </div>
            </div>
        </section>
<section class="padding-y bg-light">
  <div class="container">
  
  <!-- =================== COMPONENT CART+SUMMARY ====================== -->
  <div class="row">
    <div class="col-lg-9">
  
      <div class="card">
      <div class="content-body">
        <h4 class="card-title mb-4">Cart</h4>
		@if ($message = Session::get('success'))
			<div class="alert alert-success">
			  <p class="text-green-800">{{ $message }}</p>
			</div>
		@endif

		@if(count($cartItems) >0)
		@foreach ($cartItems as $item)
        <article class="row gy-3 mb-4">
          <div class="col-lg-5">
            <figure class="itemside me-lg-5">
              <div class="aside"><img src="{{asset($item->attributes->image)}}" class="img-sm img-thumbnail"></div>
              <figcaption class="info">
                <a href="#" class="title">Workshop Id - WKPID{{$item->id}}</a>
                <p class="text-muted"> {{$item->name}} </p>
                <p class="text-muted"> Instructor Name - {{GetCatNameById($item->id)->trainer_name}} </p>
              </figcaption>
            </figure>
          </div>
          <div class="col-lg-4 col-sm-4 col-6">
            <div class="price-wrap lh-sm"> 
              <var class="price h6">₹{{ $item->price * $item->quantity }}</var>  <br>
              <small class="text-muted"> ₹{{ $item->price}} / per item </small> 
            </div> <!-- price-wrap .// -->
          </div>
          <div class="col-lg col-sm-4">
            <div class="float-lg-end">
			  <form action="{{ route('cart.remove') }}" method="POST">
			  @csrf
				  <input type="hidden" value="{{ $item->id }}" name="id">
				  <button class="btn btn-light text-danger">Remove</button>
			  </form>
            </div>
          </div>
        </article> <!-- row.// -->
		@endforeach
		@else
		<article class="row gy-3 mb-4">
          <span style="color:red;">Cart is empty</span>
        </article> <!-- row.// -->	
		@endif
      </div> <!-- card-body .// -->
  
      
  
      </div> <!-- card.// -->
  
    </div> <!-- col.// -->
  <aside class="col-lg-3">
  
      <div class="card mb-3">
      <div class="card-body">
      <form>
        <div class="form-group">
          <label class="form-label">Have coupon?</label>
          <div class="input-group">
            <input type="text" class="form-control" name="" placeholder="Coupon code">
            <button class="btn btn-light">Apply</button>
          </div>
        </div>
      </form>
      </div>
      </div>
  
      <div class="card">
      <div class="card-body">
        <dl class="dlist-align">
          <dt>Total price:</dt>
          <dd class="text-end"> @if(Cart::getTotal() ==0 ) Free @else ₹{{ Cart::getTotal() }} @endif</dd>
        </dl>
        <dl class="dlist-align">
          <dt>Discount:</dt>
          <dd class="text-end text-success"> - ₹60.00 </dd>
        </dl>
        <dl class="dlist-align">
          <dt>TAX:</dt>
          <dd class="text-end"> ₹14.00 </dd>
        </dl>
        <hr>
        <dl class="dlist-align">
          <dt>Total:</dt>
          <dd class="text-end text-dark h5">@if(Cart::getTotal() ==0 ) Free @else ₹{{ Cart::getTotal() }} @endif</dd>
        </dl>
        @if(!empty(Auth::user()))
        <div class="d-grid gap-2 my-3">
			<form class="row contact_form" action="{{url('process-order')}}" method="post">
			@csrf
		  @if(empty(Auth::user()->email_verified_at))<!-- will be checked not empty -->
		  <button class="btn btn-success w-100" type="submit">Make Purchase</button>
		  @else
			  <button class="btn btn-danger w-100" type="button">Email not verified</button>
		  @endif
		  </form>
          <a href="{{url('workshops')}}" class="btn btn-light w-100"> Back to workshops </a>
        </div>
		@else
			<form class="row contact_form" action="{{url('process-order')}}" method="post">
			@csrf
		  <button class="btn btn-success w-100" type="submit">Make Purchase</button>
		  <a href="{{url('workshops')}}" class="btn btn-light w-100"> Back to workshops </a>
		  </form>
		@endif
      </div> <!-- card-body.// -->
      </div> <!-- card.// -->
  
    </aside> <!-- col.// -->
  </div> <!-- row.// -->
  <!-- =================== COMPONENT 1 CART+SUMMARY .//END  ====================== -->
  
  <br><br>
  
  </div> <!-- container .//  -->
  </section>
  
@include('front.common.footer')
