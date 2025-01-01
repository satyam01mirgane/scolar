<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section id="page-title" data-bg-parallax="<?php echo e(asset('assets/images/top-banner.png')); ?>">
            <div class="container">
                <div class="page-title">
                    <h1>Payment Page</h1>
                    
                </div>
            </div>
        </section>
<!--End Page Title-->
  <!-- slider Area End-->
<!--================Checkout Area =================-->
  <section class="checkout_area " style="padding-top:30px;">
    <div class="container">
      <div class="billing_details">
	  <div class="row">
			<?php if($message = Session::get('error')): ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Error!</strong> <?php echo e($message); ?>

				</div>
			<?php endif; ?>

			<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success alert-dismissible fade <?php echo e(Session::has('success') ? 'show' : 'in'); ?>" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Success!</strong> <?php echo e($message); ?>

				</div>
			<?php endif; ?>
	  </div>
		<?php 
			$udis = 0;
			$total_dis = 0;
			foreach($cartItems as $item){
				$udis = calculate_discount($item->id);
				$total_dis = $total_dis + $udis;
			}
			$subtotal = Cart::getTotal();
			$discount = $total_dis;
			$grand_total = $subtotal - $discount;
		?>
        <div class="row">
          <div class="col-lg-12">
            <h3 style="text-align:center;">Complete payment <br> Please do not press back button or refresh the page.</h3>
			<form action="<?php echo e(route('razorpay.payment.store')); ?>" method="POST" id="op" style="display:none;">
					<?php echo csrf_field(); ?>
					<script src="https://checkout.razorpay.com/v1/checkout.js"
							data-key="rzp_live_lP2LYJNlqAhhTs"
							data-amount="<?php echo e($grand_total*100); ?>"
							data-buttontext="Complete Order"
							data-name="<?php echo e(Auth::user()->name); ?>"
							data-description="Online Payment"
							data-image="<?php echo e(asset(app_setting()->logo)); ?>"
							data-prefill.name="<?php echo e(Auth::user()->name); ?>"
							data-prefill.email="<?php echo e(Auth::user()->email); ?>"
							data-theme.color="#ff7529">
					</script>
				</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->
<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
$("#op").submit();
window.history.forward();
function noBack() {
	window.history.forward();
}
</script>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/complete-payment.blade.php ENDPATH**/ ?>