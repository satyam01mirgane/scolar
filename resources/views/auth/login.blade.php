@include('front.common.header')
@include('front.common.navbar')

<section class="login-section" style="min-height: calc(100vh - 80px); display: flex; align-items: center; background-color: #f0f2f5; overflow: hidden; position: relative;">
    <div class="container" style="max-width: 400px; margin: 0 auto; position: relative; z-index: 1;">
        <div class="login-container" style="background-color: #ffffff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); overflow: hidden; animation: slideUp 0.6s ease-out;">
            <div class="login-header" style="background-color:#25286e; padding: 30px 0; text-align: center;">
                <h1 style="color: #ffffff; font-size: 28px; margin: 0;">Login</h1>
            </div>
            <div class="login-form-section" style="padding: 40px;">
                <p style="text-align: center; color: #666; margin-bottom: 30px;">Sign in to your account to continue.</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="email" style="display: block; margin-bottom: 5px; color: #333;">Email address</label>
                        <div class="input-group" style="position: relative;">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="width: 100%; padding: 12px 15px 12px 40px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s ease;">
                            <span class="input-group-text" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);"><i class="icon-user" style="color: #25286e;"></i></span>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="color: #e3342f; font-size: 14px; margin-top: 5px;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="password" style="display: block; margin-bottom: 5px; color: #333;">Password</label>
                        <div class="input-group show-hide-password" style="position: relative;">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="width: 100%; padding: 12px 15px 12px 40px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s ease;">
                            <span class="input-group-text toggle-password" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"><i class="icon-eye-off" aria-hidden="true"></i></span>
                            <span class="input-group-text" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);"><i class="icon-lock" style="color: #25286e;"></i></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="color: #e3342f; font-size: 14px; margin-top: 5px;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100%; padding: 12px; background-color: #4a90e2; color: #fff; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease;">Sign in</button>
                    </div>
                </form>
                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="color: #25286e; text-decoration: none; font-size: 14px; transition: color 0.3s ease;">Forgot Your Password?</a>
                    @endif
                    <p style="margin-top: 15px; font-size: 14px; color: #666;">
                        Not registered? 
                        <a href="{{ route('register') }}" style="color: #25286e; text-decoration: none; font-weight: bold; transition: color 0.3s ease;">Create account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="background-decoration" style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background-color: rgba(74, 144, 226, 0.1); border-radius: 50%; z-index: 0;"></div>
    <div class="background-decoration" style="position: absolute; bottom: -100px; left: -100px; width: 500px; height: 500px; background-color: rgba(74, 144, 226, 0.05); border-radius: 50%; z-index: 0;"></div>
</section>

@include('front.common.footer')

<style>
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-control:focus {
    border-color: #25286e;
    outline: none;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}

.btn-primary:hover {
    background-color: #25286e;
}

a:hover {
    color: #25286e;
}

@media (max-width: 480px) {
    .container {
        max-width: 100%;
        padding: 0 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('icon-eye-off');
        this.querySelector('i').classList.toggle('icon-eye');
    });

    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#4a90e2';
        });
        input.addEventListener('blur', function() {
            this.style.borderColor = '#ddd';
        });
    });
});
</script>

