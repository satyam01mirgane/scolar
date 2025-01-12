<?php echo $__env->make('front.common.profile-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px;>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
			<?php
			if(isset(Auth::user()->photo))
			{
				$photo = asset('profile/'.Auth::user()->photo);
			}else{
				$photo = asset('user.png');
			}
			?>
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo e($photo); ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo e(Auth::user()->name); ?></h3>
                <div class="text-center text-sm text-primary">Member Since <?php echo e(date('d M Y',strtotime(Auth::user()->created_at))); ?></div>
                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo e(Auth::user()->address); ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-body p-0">
				<?php if($message = Session::get('success')): ?>
				  <div class="alert alert-success">
					  <p class="text-green-800"><?php echo e($message); ?></p>
				  </div>
				<?php endif; ?>
                <table class="table">
				<td><a href="<?php echo e(url('profile-edit')); ?>" class="badge bg-danger">Edit</a>
                  <tbody>
				  
                    <tr>
                      <th>Personl ID</th>
                      <td>User<?php echo e(Auth::user()->unique_id); ?></td>
                      
                    </tr>
                    <tr>
                      <th> Name</th>
                      <td><?php echo e(Auth::user()->name); ?> </td>
                     
                    </tr>
					<tr>
                      <th> Email Address</th>
                      <td><?php echo e(Auth::user()->email); ?></td>
                 
                    </tr>
                    <tr>
                      <th>Contact Number</th>
                      <td><?php echo e(Auth::user()->phone_number); ?></td>
                 
                    </tr>
					<tr>
                      <th>Password</th>
                      <td>**************</td>
                     
                    </tr>
                    
                    
                    <tr>
                      <th>Address</th>
                      <td><?php echo e(Auth::user()->address); ?></td>
                    
                    </tr>
                    <tr>
                      <th>Pincode</th>
                      <td><?php echo e(Auth::user()->pincode); ?></td>
                    </tr>
					
					<tr>
                      <th>Date of Birth</th>
                      <td><?php echo e(date('d-M-Y',strtotime(Auth::user()->dob))); ?>

                    </tr>
					
                  </tbody>
              </td>  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
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
<script>
setTimeout(function() {$(".alert-success").slideToggle();}, 2000);
</script>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/user-account.blade.php ENDPATH**/ ?>