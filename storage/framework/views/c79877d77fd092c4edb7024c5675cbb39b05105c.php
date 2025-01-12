<?php echo $__env->make('front.common.profile-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left:0px ; background-color: #f4f6f9; min-height: 100vh; padding: 20px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>">User Profile</a></li>
              <li class="breadcrumb-item active">Edit User Profile</li>
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
          <div class="col-md-3">
            
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo e(url('pofile-update')); ?>" method="post" enctype="multipart/form-data">
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
				  <div class="row">
					  <div class="form-group col-md-6">
						<label for="fname">Full Name<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="name" name="name" required placeholder="Name" value="<?php echo e($user_profile->name); ?>" />
					  </div>
					  <div class="form-group col-md-6">
						<label for="email">Email address<span class="text-danger">*</span></label>
						<input type="email" class="form-control" id="email" name="email" required placeholder="Email Address" value="<?php echo e(Auth::user()->email); ?>" readonly />
					  </div>
				  </div>
				  <div class="row">
					<div class="form-group col-md-6">
						<label for="age">Age<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="age" name="age" required placeholder="Age" value="<?php echo e($user_profile->age); ?>" /> 
					</div>
					<div class="form-group col-md-6">
						<label for="phone_number">Mobile Number<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="phone_number" name="phone_number" required placeholder="Phone number" value="<?php echo e($user_profile->phone_number); ?>" /> 
					</div>
				  </div>
				  
				  
				  <div class="row">
					<div class="form-group col-md-6">
						<label for="school">University<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="school" name="school" required placeholder="University" value="<?php echo e($user_profile->school); ?>" /> 
					</div>
					<div class="form-group col-md-6">
						<label for="profession">Profession<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="profession" name="profession" required placeholder="Profession" value="<?php echo e($user_profile->profession); ?>" /> 
					</div>
				  </div>
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="address">Address<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="address" required name="add1" value="<?php echo e($user_profile->address); ?>">
					  </div>
					 
					  <div class="form-group col-md-6">
						<label for="zip">Pincode<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="zip" name="zip"  required placeholder="Postcode/ZIP" value="<?php echo e($user_profile->pincode); ?>" />
					  </div>
					</div>
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="country">Country<span class="text-danger">*</span></label>
						<select class="form-control" id="country" name="country" required>
							<option value="">----Select country----</option>
							<?php $__currentLoopData = country_list(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($v->id); ?>" <?php if($user_profile->country == $v->id){echo 'selected';}?>><?php echo e($v->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					  </div>
					 
					  <div class="form-group col-md-6">
						<label for="state">State<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="state" name="state"  required placeholder="State" value="<?php echo e($user_profile->state); ?>" />
					  </div>
					</div>
				  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob"  required placeholder="DOB" value="<?php echo e($user_profile->dob); ?>" />
                  </div>
				  <div class="form-group col-md-6">
					<label for="photo">Profile Picture</label>
                    <input type="file" class="form-control" id="photo" name="photo" placeholder="photo" />
					<?php if(isset($user_profile->photo)): ?>
						<img src="<?php echo e(asset('profile/'.$user_profile->photo)); ?>" width="150" height="150">
					<?php endif; ?>
                  </div>
				  </div>
				   <div class="row">
                  <div class="form-group col-md-12">
                    <label for="dob">Reference</label>
                    <input type="text" class="form-control" id="reference" name="reference"  placeholder="Reference" value="<?php echo e($user_profile->reference); ?>" />
                  </div>
				  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Profile</button>
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
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/user-edit.blade.php ENDPATH**/ ?>