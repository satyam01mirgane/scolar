<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--  Header Menu start -->
    <?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	 <!-- Page title -->
        <section id="page-title" data-bg-parallax="<?php echo e(asset('assets/images/top-banner.png')); ?>">
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
                                <form method="POST" action="<?php echo e(route('register')); ?>">
								<?php echo csrf_field(); ?>
                                    <div class="h5 mb-4">Account details</div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="username">Full name<span class="text-danger">*</span></label>
                                            <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
											<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required="" value="<?php echo e(old('email')); ?>">
											<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
									<div class="row">
										<div class="form-group col-md-6">
                                            <label for="telephone">Age<span class="text-danger">*</span></label>
                                            <input id="age" type="number" class="form-control" name="age" min="10" value="<?php echo e(old('age')); ?>" required autocomplete="age">
											<?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mobile">Mobile Number<span class="text-danger">*</span></label>
                                            <input id="mobile" type="text" class="form-control" onkeypress="return isNumberKey(event)" name="mobile" maxlength="10" value="<?php echo e(old('mobile')); ?>" required autocomplete="mobile">
											<?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
									<div class="row">
										<div class="form-group col-md-6">
                                            <label for="school">University/School<span class="text-danger">*</span></label>
                                            <input id="school" type="text" class="form-control" name="school" value="<?php echo e(old('school')); ?>" required autocomplete="University/school">
											<?php $__errorArgs = ['school'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="profession">Profession<span class="text-danger">*</span></label>
                                            <input id="profession" type="text" class="form-control" name="profession" value="<?php echo e(old('profession')); ?>" required autocomplete="Profession">
											<?php $__errorArgs = ['profession'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
									<div class="row">
										<div class="form-group col-md-6">
                                            <label for="country">Country<span class="text-danger">*</span></label>
                                            <select class="form-control" id="country" name="country" required>
												<option value="">----Select country----</option>
												<?php $__currentLoopData = country_list(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($v->id); ?>" <?php if(old('country') == $v->id){echo 'selected';}?>><?php echo e($v->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
											<?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="state">State<span class="text-danger">*</span></label>
                                            <input id="state" type="text" class="form-control" name="state" value="<?php echo e(old('state')); ?>" required autocomplete="state">
											<?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<span class="invalid-feedback" role="alert">
													<strong><?php echo e($message); ?></strong>
												</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <div class="input-group show-hide-password">
                                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password">
                                                <span class="input-group-text"><i class="icon-eye" aria-hidden="true" style="cursor: pointer;"></i></span>
												<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<span class="invalid-feedback" role="alert">
														<strong><?php echo e($message); ?></strong>
													</span>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                <div class="mt-4"><small>Already have an acocunt?</small> <a href="<?php echo e(url('login')); ?>" class="small fw-bold">Sign in</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}
</script><?php /**PATH /home/u104865507/domains/ VIEF SCHOLAR .in/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>