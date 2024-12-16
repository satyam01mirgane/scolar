<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section id="page-title" data-bg-parallax="<?php echo e(asset('assets/images/top-cart-banner.jpg')); ?>">
            <div class="container">
                <div class="page-title">
                    <h1>Cart</h1>
                    
                </div>
            </div>
    </section>
<section id="shop-cart">
            <div class="container">
                <div class="shop-cart">
					<?php if($message = Session::get('success')): ?>
						<div class="alert alert-success">
						  <p class="text-green-800"><?php echo e($message); ?></p>
						</div>
					<?php endif; ?>
					<?php 
						$udis = 0;
						$total_dis = 0;
					?>
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
                                <?php if(count($cartItems) >0): ?>
								<?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="cart-product-remove">
										<form action="<?php echo e(route('cart.remove')); ?>" method="POST">
										  <?php echo csrf_field(); ?>
											  <input type="hidden" value="<?php echo e($item->id); ?>" name="id">
											  <button class="btn btn-light text-danger">X</button>
										  </form>
                                    </td>
                                    <td class="cart-product-thumbnail">
                                        <a href="#">
                                            <img alt="Learn Cloud Computing" src="<?php echo e(asset($item->attributes->image)); ?>">
                                        </a>
                                        <div class="cart-product-thumbnail-name"><?php echo e($item->name); ?></div>
                                    </td>
									<?php
										$udis = calculate_discount($item->id);
										$total_dis = $total_dis + $udis;
									?> 
                                    <td class="cart-product-description">
                                        <p><span><?php echo e(GetCatNameById($item->id)->trainer_name); ?></span>
                                        </p>
                                    </td>
                                    <td class="cart-product-price">
                                        <span class="amount">₹ <?php echo e($item->price); ?></span>
                                    </td>

									<td class="cart-product-price">
                                        <span class="amount">₹ <?php echo e($udis); ?></span>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <span class="amount">₹ <?php echo e(($item->price * $item->quantity) - $udis); ?></span>
                                    </td>
                                </tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
								<tr>
								  <td colspan="4">Cart is empty</td>
								</tr>
								<?php endif; ?>
                            </tbody>
                        </table>
                    </div>
					<?php
						$subtotal = Cart::getTotal();
						$discount = $total_dis;
						$grand_total = $subtotal - $discount;
					?> 
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
                                                <span class="amount color lead"><strong>₹<?php echo e($subtotal); ?></strong></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart-product-name">
                                                <strong>Discount(-)</strong>
                                            </td>
                                            <td class="cart-product-name text-end">
                                                <span class="amount color lead"><strong>₹<?php echo e($discount); ?></strong></span>
                                            </td>
                                        </tr>
										<tr>
                                            <td class="cart-product-name">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="cart-product-name text-end">
                                                <span class="amount color lead"><strong><?php if(Cart::getTotal() ==0 ): ?> Free <?php else: ?> ₹<?php echo e($grand_total); ?> <?php endif; ?></strong></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
							 <?php if(!empty(Auth::user())): ?>
								<form action="<?php echo e(url('process-order')); ?>" method="post">
								<?php echo csrf_field(); ?>
							  <?php if(empty(Auth::user()->email_verified_at)): ?><!-- will be checked not empty -->
							  <button class="btn icon-left float-right" type="submit">Make Purchase</button>
							  <?php else: ?>
								  <button class="btn icon-left float-right" type="button">Email not verified</button>
							  <?php endif; ?>
							  </form>
							  <a href="<?php echo e(url('workshops')); ?>" class="btn icon-left float-right" style="margin-right:5px;"> Back to explore </a>
							<?php else: ?>
								<form  action="<?php echo e(url('process-order')); ?>" method="post">
								<?php echo csrf_field(); ?>
							  <button class="btn icon-left float-right" type="submit" style="margin-right:5px;">Make Purchase</button>
							  <a href="<?php echo e(url('workshops')); ?>" class="btn icon-left float-right" style="margin-right:5px;">  Back to explore </a>
							  </form>
							<?php endif; ?>
							
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/cart.blade.php ENDPATH**/ ?>