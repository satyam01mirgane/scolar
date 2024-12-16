@include('front.common.header')

<!--  Header Menu start -->
    @include('front.common.navbar')
	<section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
            <div class="container">
                <div class="page-title">
                    <h1>Reset Password</h1>
                    
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
                                    <p class="text-muted mb-0"> Forgot Your Password? Don't worry reset now</p>
                                </div><span class="clearfix"></span>
								@if (session('status'))
									<div class="alert alert-success" role="alert">
										{{ session('status') }}
									</div>
								@endif
                                <form class="form-validate" method="POST" action="{{ route('password.email') }}">
								@csrf
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <div class="input-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    </div>
									<button type="submit" class="btn btn-primary">
									Send Password Reset Link</button>
                                    
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@include('front.common.footer')
