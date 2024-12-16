@include('front.common.header')

<!--  Header Menu start -->
    @include('front.common.navbar')
	 <!-- Page title -->
        <section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
            <div class="container">
                <div class="page-title">
                    <h1>Register</h1>
                    
                </div>
            </div>
        </section>
        <!-- end: Page title -->
<section class="pt-5 pb-5">
            <div class="container-fluid d-flex flex-column">
                <div class="row align-items-center min-vh-20">
                    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                        <div class="card shadow-lg">
                            <div class="card-body py-5 px-sm-5">
                                <h3>Register New Account</h3>
                                <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                <form method="POST" action="{{ route('register') }}">
								@csrf
                                    <div class="h5 mb-4">Account details</div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="username">Full name<span class="text-danger">*</span></label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
											@error('name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required="" value="{{ old('email') }}">
											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
									<div class="row">
										<div class="form-group col-md-6">
                                            <label for="telephone">Age<span class="text-danger">*</span></label>
                                            <input id="age" type="number" class="form-control" name="age" min="10" value="{{ old('age') }}" required autocomplete="age">
											@error('age')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mobile">Mobile Number<span class="text-danger">*</span></label>
                                            <input id="mobile" type="text" class="form-control" onkeypress="return isNumberKey(event)" name="mobile" maxlength="10" value="{{ old('mobile') }}" required autocomplete="mobile">
											@error('mobile')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
									<div class="row">
										<div class="form-group col-md-6">
                                            <label for="school">University/School<span class="text-danger">*</span></label>
                                            <input id="school" type="text" class="form-control" name="school" value="{{ old('school') }}" required autocomplete="University/school">
											@error('school')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="profession">Profession<span class="text-danger">*</span></label>
                                            <input id="profession" type="text" class="form-control" name="profession" value="{{ old('profession') }}" required autocomplete="Profession">
											@error('profession')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
									<div class="row">
										<div class="form-group col-md-6">
                                            <label for="country">Country<span class="text-danger">*</span></label>
                                            <select class="form-control" id="country" name="country" required>
												<option value="">----Select country----</option>
												@foreach(country_list() as $k=>$v)
												<option value="{{$v->id}}" <?php if(old('country') == $v->id){echo 'selected';}?>>{{$v->name}}</option>
												@endforeach
											</select>
											@error('country')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="state">State<span class="text-danger">*</span></label>
                                            <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required autocomplete="state">
											@error('state')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <div class="input-group show-hide-password">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                <span class="input-group-text"><i class="icon-eye" aria-hidden="true" style="cursor: pointer;"></i></span>
												@error('password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password2">Confirm Password<span class="text-danger">*</span></label>
                                            <div class="input-group show-hide-password">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                            </div>
                                        </div>
                                    </div>
									 <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="reference">Reference</label>
                                            <div class="input-group show-hide-password">
                                                <input id="reference" type="text" class="form-control" name="reference">
                                            </div>
                                        </div>
                                    </div>         
                                    
                                    
                                    <button type="submit" class="btn m-t-30 mt-3">Submit</button>
                                </form>
                                <div class="mt-4"><small>Already have an acocunt?</small> <a href="{{url('login')}}" class="small fw-bold">Sign in</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@include('front.common.footer')

<script>
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}
</script>