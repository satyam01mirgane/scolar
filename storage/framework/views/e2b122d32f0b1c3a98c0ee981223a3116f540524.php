<?php echo $__env->make('front.common.profile-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
.modal-header1 {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left:0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Certificate & Feedback</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Certificate & Feedback</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <?php if(Session::has('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(Session::get('success')); ?>

                            </div>
                            <?php endif; ?>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Workshop Name</th>
                                        <th>Workshop/Course ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Certificate</th>
                                        <th>Share</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($orders) > 0): ?>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($v->workshopname); ?></td>
                                        <td>WKPID<?php echo e($v->product_id); ?></td>
                                        <td><?php echo e(date('d-m-Y', strtotime($v->session_date))); ?></td>
                                        <td><?php echo e(date('H:i:s A', strtotime($v->session_time))); ?></td>
                                        <td>
                                            <?php if($v->session_status != 'Open'): ?>
                                            <a href="<?php echo e(url('print-certificate/'.$v->product_id)); ?>" target="_blank">Certificate</a>
                                            <?php else: ?>
                                            <span style="color:red;">Certificate not completed.</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($v->session_status != 'Open'): ?>
                                            <div class="d-flex justify-content-start gap-3">
                                                <!-- LinkedIn Share -->
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(url('print-certificate/'.$v->product_id)); ?>&title=Excited to share my achievement!&summary=🎉 I’m thrilled to announce that I’ve successfully completed the masterclass '<?php echo e($v->workshopname); ?>' under the expert guidance of <?php echo e($v->trainername); ?>. 🚀💡 This experience has been truly enriching! Check out my certificate here: <?php echo e(url('print-certificate/'.$v->product_id)); ?> #VIEF #Vscholar @vscholar  #<?php echo e(str_replace(' ', '', $v->workshopname)); ?> #<?php echo e(str_replace(' ', '', $v->trainername)); ?>"
                                                   target="_blank" title="Share on LinkedIn">
                                                    <i class="fab fa-linkedin" style="color: #0077b5; font-size: 24px;"></i>
                                                </a>

                                                <!-- Instagram Share (placeholder link for web) -->
                                                <a href="https://instagram.com" target="_blank" title="Share on Instagram">
                                                    <i class="fab fa-instagram" style="color: #e4405f; font-size: 24px;"></i>
                                                </a>

                                                <!-- Copy to Clipboard -->
                                                <a href="#" onclick="copyToClipboard('🎉 I’m thrilled to announce that I’ve successfully completed the masterclass \'<?php echo e($v->workshopname); ?>\' under the expert guidance of <?php echo e($v->trainername); ?>. 🚀💡 This experience has been truly enriching! Check out my certificate here: <?php echo e(url('print-certificate/'.$v->product_id)); ?> #VIEF #Vscholar @vscholar  #<?php echo e(str_replace(' ', '', $v->workshopname)); ?> #<?php echo e(str_replace(' ', '', $v->trainername)); ?>')" title="Copy Link">
                                                    <i class="fas fa-copy" style="color: #6c757d; font-size: 24px;"></i>
                                                </a>
                                            </div>
                                            <?php else: ?>
                                            <span style="color:red;">Not available</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="6" align="center">No workshop found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    // Copy to Clipboard Functionality
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert("Message copied to clipboard!");
        }, function(err) {
            console.error("Failed to copy: ", err);
        });
    }
</script>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/certificate-feedback.blade.php ENDPATH**/ ?>