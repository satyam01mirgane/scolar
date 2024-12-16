<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--Page Title-->
<section id="page-title" data-bg-parallax="<?php echo e(asset('assets/images/about-us-banner.jpg')); ?>">
            <div class="container">
                <div class="page-title" style="min-height:150px">
                   <h1><?php echo e($page_details->name); ?></h1>
                    
                </div>
            </div>
        </section>
<!--End Page Title-->
 <!-- Breadcrumb Begin -->

<!--End Page Title-->
<section>
<?php if(is_null($page_details)): ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="column-title text-center">Page content not found</h3>
			</div>
		</div>
	</div>
<?php else: ?>
  <div class="container">
    <div class="row" style="margin:30px;">
        <div class="col-lg-12">
          <p style="text-align:justify;font-weight:normal;"><?php echo nl2br($page_details->description);?></p>

        </div><!-- Col end -->
    </div><!-- Content row end -->
    </div>

  </div><!-- Container end -->
  <?php endif; ?>
  <hr>
</section><!-- Main container end -->

<!--  Footer Start -->
<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/page-details.blade.php ENDPATH**/ ?>