<?php echo $__env->make('front.common.profile-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">User Profile</a></li>
              <li class="breadcrumb-item active">Change Password
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">         
          <!-- /.col -->
          <div class="col-md-12">
            
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo e(url('update-password')); ?>" method="post" enctype="multipart/form-data">
			  <?php echo csrf_field(); ?>
                <div class="card-body">
					<?php if(count($errors) > 0): ?>
					   <div class = "alert alert-danger">
						  <ul>
							 <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($error); ?></li>
							 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </ul>
					   </div>
					<?php endif; ?>
					
					<?php if($message = Session::get('success')): ?>
					  <div class="alert alert-success">
						  <p class="text-green-800"><?php echo e($message); ?></p>
					  </div>
					<?php endif; ?>
					<?php if($message = Session::get('error')): ?>
					  <div class="alert alert-danger">
						  <p class="text-green-800"><?php echo e($message); ?></p>
					  </div>
					<?php endif; ?>
                  <div class="form-group">
                    <label for="old_pass">Old Password</label>
                    <input type="password" class="form-control" id="old_pass" name="old_pass" required placeholder="Old Password"/>
                  </div>
                  <div class="form-group">
                    <label for="email">New Password </label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Password" />
                  </div>
                  <div class="form-group">
                    <label for="contactNumber">Confirm password</label>
                    <input type="text" class="form-control" id="new_password" name="new_password" required placeholder="Confirm password" /> 
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update password</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php echo $__env->make('front.common.profile-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/change-password.blade.php ENDPATH**/ ?>