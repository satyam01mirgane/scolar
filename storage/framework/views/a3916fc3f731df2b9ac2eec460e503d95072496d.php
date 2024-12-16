<?php echo $__env->make('front.common.profile-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Enrolled Workshops</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Enrolled Workshops</li>
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
            
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Workshop Name</th>
                      <th>Video Link</th>
                      <th>Workshop ID</th>
                      <th>Instructor</th>
                      <th>Date</th>
					  <th>Time</th>
					  <th>Amount Paid</th>
                      <th>Invoice</th>
					  <th>Status</th>
				
                    </tr>
                  </thead>
                  <tbody>
					<?php if(count($orders)>0): ?>
					<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($v->workshopname); ?></td>
                      <?php if(!empty($v->video_link)): ?>
                      <td><a href="<?php echo e($v->video_link); ?>">Link</a></td>
                      <?php else: ?>
                      <td>Video not available</td>
                      <?php endif; ?>
                      <td>WKPID<?php echo e($v->product_id); ?></td>
                      <td><?php echo e($v->trainername); ?></td>
                      <td><?php echo e(date('d-m-Y',strtotime($v->session_date))); ?></td>
					  <td><?php echo e(date('H:i:s A',strtotime($v->session_time))); ?></td>
                      <td>Rs.<?php echo e($v->price); ?></td>
                      <td><a href="<?php echo e(url('print-invoice/'.$v->order_no)); ?>">Invoice</a></td>
					  <td><?php echo e($v->session_status); ?></td>
                    </tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<tr>
							<td colspan="9" align="center">No workshop found</td>
						</tr>
					<?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/order-list.blade.php ENDPATH**/ ?>