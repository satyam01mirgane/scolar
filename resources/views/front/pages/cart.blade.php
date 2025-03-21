@include('front.common.header')
@include('front.common.navbar')

<section id="page-title" data-bg-parallax="{{ asset('assets/images/top-cart-banner.jpg') }}" class="bg-cover bg-center py-12 relative">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="container relative z-10">
        <div class="page-title text-center">
            <h1 class="text-4xl font-bold text-white mb-2">Your Shopping Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white opacity-75 hover:opacity-100">Home</a></li>
                    <li class="breadcrumb-item text-white opacity-100" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section id="shop-cart" class="py-12 bg-gray-50">
    <div class="container">
        <div class="shop-cart">
            {{-- Success Message --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success bg-green-100 border border-green-200 text-green-800 rounded-lg p-4 mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    {{-- Cart Table --}}
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-800">Shopping Cart</h3>
                            <p class="text-gray-500 text-sm">{{ count($cartItems) }} item(s) in your cart</p>
                        </div>
                        
                        @if(count($cartItems) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Workshop/Course</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($cartItems as $item)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <form action="{{ route('cart.remove') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <button class="text-red-500 hover:text-red-700 transition-colors" title="Remove item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="px-4 py-4">
                                                    <div class="flex items-center">
                                                        <img src="{{ asset($item->attributes->image) }}" alt="{{ $item->name }}" class="h-16 w-16 object-cover rounded-md mr-3">
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-700">
                                                    {{ GetCatNameById($item->id)->trainer_name ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-700">
                                                    ₹{{ number_format($item->price, 2) }}
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                                    ₹{{ number_format($item->price * $item->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
                                <p class="text-gray-500 mb-6">Looks like you haven't added any workshops to your cart yet.</p>
                                <a href="{{ url('workshops') }}" class="btn btn-primary px-6 py-2 rounded-md">
                                    Browse Workshops
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-4">
                    {{-- Cart Summary --}}
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden sticky top-4">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-800">Order Summary</h3>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between py-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-900">
                                    @if(Cart::getTotal() == 0) 
                                        Free 
                                    @else 
                                        ₹{{ number_format(Cart::getTotal(), 2) }} 
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between py-2">
                                <span class="text-gray-600">Tax</span>
                                <span class="font-medium text-gray-900">₹0.00</span>
                            </div>
                            
                            <div class="border-t border-gray-200 mt-2 pt-2 mb-4">
                                <div class="flex justify-between py-2">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-gray-900">
                                        @if(Cart::getTotal() == 0) 
                                            Free 
                                        @else 
                                            ₹{{ number_format(Cart::getTotal(), 2) }} 
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            @if(count($cartItems) > 0)
                                {{-- Purchase Buttons --}}
                                @if(Auth::check())
                                    <form action="{{ url('process-order') }}" method="POST">
                                        @csrf
                                        @if(!empty(Auth::user()->email_verified_at))
                                            <button type="submit" class="btn btn-success w-100 py-3 text-white bg-green-600 hover:bg-green-700 rounded-md font-medium transition-colors mb-3">
                                                Complete Purchase
                                            </button>
                                        @else
                                            <div class="mb-3 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-md p-3 text-sm">
                                                Please verify your email address before making a purchase.
                                            </div>
                                            <button type="button" class="btn btn-warning w-100 py-3 text-white bg-yellow-500 hover:bg-yellow-600 rounded-md font-medium transition-colors mb-3">
                                                Verify Email First
                                            </button>
                                        @endif
                                    </form>
                                @else
                                    <div class="mb-3 bg-blue-50 border border-blue-200 text-blue-800 rounded-md p-3 text-sm">
                                        Sign in to complete your purchase and track your orders.
                                    </div>
                                    <a href="{{ url('login') }}" class="btn btn-primary w-100 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-md font-medium transition-colors mb-3 text-center block">
                                        Sign In to Continue
                                    </a>
                                    <form action="{{ url('process-order') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100 py-3 text-white bg-green-600 hover:bg-green-700 rounded-md font-medium transition-colors mb-3">
                                            Continue as Guest
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ url('workshops') }}" class="btn btn-outline-secondary w-100 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md font-medium transition-colors text-center block">
                                    Continue Shopping
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('front.common.footer')

