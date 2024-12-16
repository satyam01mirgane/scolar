<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="login-section" style="min-height: calc(100vh - 80px); display: flex; align-items: center; background-color: #f0f2f5; overflow: hidden; position: relative;">
    <div class="container" style="max-width: 400px; margin: 0 auto; position: relative; z-index: 1;">
        <div class="login-container" style="background-color: #ffffff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); overflow: hidden; animation: slideUp 0.6s ease-out;">
            <div class="login-header" style="background-color: #4a90e2; padding: 30px 0; text-align: center;">
                <h1 style="color: #ffffff; font-size: 28px; margin: 0;">Login</h1>
            </div>
            <div class="login-form-section" style="padding: 40px;">
                <p style="text-align: center; color: #666; margin-bottom: 30px;">Sign in to your account to continue.</p>
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="email" style="display: block; margin-bottom: 5px; color: #333;">Email address</label>
                        <div class="input-group" style="position: relative;">
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus style="width: 100%; padding: 12px 15px 12px 40px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s ease;">
                            <span class="input-group-text" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);"><i class="icon-user" style="color: #4a90e2;"></i></span>
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert" style="color: #e3342f; font-size: 14px; margin-top: 5px;">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="password" style="display: block; margin-bottom: 5px; color: #333;">Password</label>
                        <div class="input-group show-hide-password" style="position: relative;">
                            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" style="width: 100%; padding: 12px 15px 12px 40px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s ease;">
                            <span class="input-group-text toggle-password" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"><i class="icon-eye-off" aria-hidden="true"></i></span>
                            <span class="input-group-text" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);"><i class="icon-lock" style="color: #4a90e2;"></i></span>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert" style="color: #e3342f; font-size: 14px; margin-top: 5px;">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100%; padding: 12px; background-color: #4a90e2; color: #fff; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease;">Sign in</button>
                    </div>
                </form>
                <div class="text-center">
                    <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" style="color: #4a90e2; text-decoration: none; font-size: 14px; transition: color 0.3s ease;">Forgot Your Password?</a>
                    <?php endif; ?>
                    <p style="margin-top: 15px; font-size: 14px; color: #666;">
                        Not registered? 
                        <a href="<?php echo e(route('register')); ?>" style="color: #4a90e2; text-decoration: none; font-weight: bold; transition: color 0.3s ease;">Create account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="background-decoration" style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background-color: rgba(74, 144, 226, 0.1); border-radius: 50%; z-index: 0;"></div>
    <div class="background-decoration" style="position: absolute; bottom: -100px; left: -100px; width: 500px; height: 500px; background-color: rgba(74, 144, 226, 0.05); border-radius: 50%; z-index: 0;"></div>
</section>

<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
@keyframes  slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-control:focus {
    border-color: #4a90e2;
    outline: none;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}

.btn-primary:hover {
    background-color: #3a7bc8;
}

a:hover {
    color: #3a7bc8;
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

<?php /**PATH D:\New folder\htdocs\RUN\resources\views/auth/login.blade.php ENDPATH**/ ?>