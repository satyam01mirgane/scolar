@include('front.common.header')
@include('front.common.navbar')

<section class="login-section" style="min-height: calc(100vh - 80px); display: flex; align-items: center; background-color: #f0f2f5; overflow: hidden; position: relative;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;">
        <div class="login-container" style="background-color: #ffffff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); overflow: hidden; display: flex; animation: slideUp 0.6s ease-out;">
            <div class="login-form-section" style="flex: 1; padding: 50px;">
                <h2 style="font-size: 32px; color: #333; margin-bottom: 30px; text-align: center;">Welcome Back</h2>
                <form class="login-form" action="#" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Username" style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s ease;">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s ease;">
                    </div>
                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" id="remember" name="remember" style="margin-right: 5px;">
                            <span style="font-size: 14px; color: #666;">Remember me</span>
                        </label>
                        <a href="#" style="font-size: 14px; color: #4a90e2; text-decoration: none; transition: color 0.3s ease;">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn-login" style="width: 100%; padding: 12px; background-color: #4a90e2; color: #fff; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease;">
                        Log In
                    </button>
                </form>
            </div>
            <div class="signup-section" style="flex: 1; background-color: #4a90e2; padding: 50px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: #fff; position: relative; overflow: hidden;">
                <h2 style="font-size: 32px; margin-bottom: 20px; position: relative; z-index: 1;">New to our Shop?</h2>
                <p style="font-size: 16px; margin-bottom: 30px; text-align: center; max-width: 300px; position: relative; z-index: 1;">Join our community and discover amazing products!</p>
                <a href="#" class="btn-signup" style="padding: 12px 30px; background-color: #fff; color: #4a90e2; text-decoration: none; border-radius: 8px; font-size: 16px; transition: background-color 0.3s ease, color 0.3s ease; position: relative; z-index: 1;">
                    Create an Account
                </a>
                <div class="decoration" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('https://assets.website-files.com/5e51c674258ffe10d286d30a/5e5358878e2493fbea064dd9_peep-59.svg') no-repeat center center; background-size: cover; opacity: 0.1;"></div>
            </div>
        </div>
    </div>
    <div class="background-decoration" style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background-color: rgba(74, 144, 226, 0.1); border-radius: 50%; z-index: 0;"></div>
    <div class="background-decoration" style="position: absolute; bottom: -100px; left: -100px; width: 500px; height: 500px; background-color: rgba(74, 144, 226, 0.05); border-radius: 50%; z-index: 0;"></div>
</section>

@include('front.home-page-common.subscribe')
@include('front.common.footer')

<style>
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-control:focus {
    border-color: #4a90e2;
    outline: none;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}

.btn-login:hover {
    background-color: #3a7bc8;
}

.btn-signup:hover {
    background-color: #f0f2f5;
}

@media (max-width: 768px) {
    .login-container {
        flex-direction: column;
    }
    .login-form-section, .signup-section {
        padding: 30px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#4a90e2';
        });
        input.addEventListener('blur', function() {
            this.style.borderColor = '#ddd';
        });
    });

    const loginForm = document.querySelector('.login-form');
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.textContent = 'Logging in...';
        submitButton.disabled = true;
        // Simulate login process
        setTimeout(() => {
            submitButton.textContent = 'Log In';
            submitButton.disabled = false;
            alert('Login functionality would be implemented here.');
        }, 2000);
    });
});
</script>

