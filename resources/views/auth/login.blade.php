@include('front.common.header')
@include('front.common.navbar')
<!-- end: Header -->
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
	<div class="container">
		<div class="page-title">
			<h1>Login</h1>
			
		</div>
	</div>
</section>
<section class="pt-5 pb-5">
            <div class="container-fluid d-flex flex-column">
                <div class="row align-items-center min-vh-20">
                    <div class="col-md-6 col-lg-4 col-xl-3 mx-auto">
                          <div class="card">
                            <div class="card-body py-5 px-sm-5">
                                <div class="mb-5 text-center">
                                    <!---<h6 class="h3 mb-1">Login</h6>--->
                                    <p class="text-muted mb-0">Sign in to your account to continue.</p>
                                </div><span class="clearfix"></span>
                                <form method="POST" action="{{ route('login') }}">
								@csrf
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <div class="input-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <span class="input-group-text"><i class="icon-user"></i></span>
										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
                                    </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="password">Password</label>
                                        <div class="input-group show-hide-password">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
												@error('password')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror

                                        </div>
                                    </div>
                                    <div class="mt-4"><button type="submit" class="btn btn-primary btn-block btn-primary">Sign in</button></div>
                                </form>
                                <div class="mt-4 text-center">
								@if (Route::has('password.request'))
								<a href="{{ route('password.request') }}" class="small fw-bold">Forgot Your Password?</a>
							    @endif
								<small>Not registered?</small> 
								<a href="{{ route('register') }}" class="small fw-bold">Create account</a> 
								
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@include('front.common.footer')
