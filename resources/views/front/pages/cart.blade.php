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
					@php 
						$udis = 0;
						$total_dis = 0;
					@endphp
                    <div class="table table-sm table-striped table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-remove"></th>
                                    <th class="cart-product-thumbnail">Workshop/Course</th>
                                    <th class="cart-product-name">Instructor</th>
                                    <th class="cart-product-price">Unit Price</th>
                                    <th class="cart-product-price">Discount</th>
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
											  <button class="btn btn-light text-danger">X</button>
										  </form>
                                    </td>
                                    <td class="cart-product-thumbnail">
                                        <a href="#">
                                            <img alt="Learn Cloud Computing" src="{{asset($item->attributes->image)}}">
                                        </a>
                                        <div class="cart-product-thumbnail-name">{{$item->name}}</div>
                                    </td>
									@php
										$udis = calculate_discount($item->id);
										$total_dis = $total_dis + $udis;
									@endphp 
                                    <td class="cart-product-description">
                                        <p><span>{{GetCatNameById($item->id)->trainer_name}}</span>
                                        </p>
                                    </td>
                                    <td class="cart-product-price">
                                        <span class="amount">₹ {{ $item->price }}</span>
                                    </td>

									<td class="cart-product-price">
                                        <span class="amount">₹ {{ $udis }}</span>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <span class="amount">₹ {{  ($item->price * $item->quantity) - $udis}}</span>
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
					@php
						$subtotal = Cart::getTotal();
						$discount = $total_dis;
						$grand_total = $subtotal - $discount;
					@endphp 
                    <div class="row">
                        <hr class="space">
                        <div class="col-lg-12 p-r-10 ">
                            <div class="table-responsive">
                                <h4>Cart Subtotal</h4>
                                <table class="table">
                                    <tbody>
										<tr>
                                            <td class="cart-product-name">
                                                <strong>Subtotal</strong>
                                            </td>
                                            <td class="cart-product-name text-end">
                                                <span class="amount color lead"><strong>₹{{$subtotal}}</strong></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart-product-name">
                                                <strong>Discount(-)</strong>
                                            </td>
                                            <td class="cart-product-name text-end">
                                                <span class="amount color lead"><strong>₹{{$discount}}</strong></span>
                                            </td>
                                        </tr>
										<tr>
                                            <td class="cart-product-name">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="cart-product-name text-end">
                                                <span class="amount color lead"><strong>@if(Cart::getTotal() ==0 ) Free @else ₹{{ $grand_total }} @endif</strong></span>
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
							  <a href="{{url('workshops')}}" class="btn icon-left float-right" style="margin-right:5px;"> Back to explore </a>
							@else
								<form  action="{{url('process-order')}}" method="post">
								@csrf
							  <button class="btn icon-left float-right" type="submit" style="margin-right:5px;">Make Purchase</button>
							  <a href="{{url('workshops')}}" class="btn icon-left float-right" style="margin-right:5px;">  Back to explore </a>
							  </form>
							@endif
							
                        </div>
                    </div>
                </div>
            </div>
        </section>
@include('front.common.footer')
