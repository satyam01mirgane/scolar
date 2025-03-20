@include('front.common.header')

<!-- Header Menu start -->
@include('front.common.navbar')

<section class="pt-5 pb-5">
    <div class="container-fluid d-flex flex-column">
        <div class="row align-items-center min-vh-20">
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <div class="card shadow-lg animate__animated animate__fadeIn">
                    <div class="card-body py-5 px-sm-5">
                        <h3 class="mb-4">Register New Account</h3>
                        <p>Create an account by entering the information below. If you are a returning customer, please login at the top of the page.</p>
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
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
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter your email" required value="{{ old('email') }}">
                                    <div id="emailError" class="invalid-feedback" style="display: none;">This email is already registered.</div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="age">Age<span class="text-danger">*</span></label>
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
                                        <div class="form-group col-md-12">
                                            <label for="reference">Reference Code</label>
                                            <div class="input-group show-hide-password">
                                                <input id="reference" type="text" class="form-control" name="reference">
                                            </div>
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
                                        <option value="{{$v->id}}" {{ old('country') == $v->id ? 'selected' : '' }}>{{$v->name}}</option>
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
                            <button type="submit" class="btn btn-primary m-t-30 mt-3 w-100">Submit</button>
                        </form>
                        <div class="mt-4 text-center">
                            <small>Already have an account?</small>
                            <a href="{{url('login')}}" class="small fw-bold">Sign in</a>
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
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

document.getElementById('email').addEventListener('blur', function () {
    const email = this.value;
    fetch(`{{ url('check-email') }}?email=${email}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                document.getElementById('emailError').style.display = 'block';
                this.classList.add('is-invalid');
            } else {
                document.getElementById('emailError').style.display = 'none';
                this.classList.remove('is-invalid');
            }
        });
});
</script>
