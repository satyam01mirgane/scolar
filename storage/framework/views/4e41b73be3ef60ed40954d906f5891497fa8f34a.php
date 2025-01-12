<?php echo $__env->make('front.common.profile-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
  @import  url('https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;600;700&display=swap');
html, body{
    padding: 0px;
    margin: 0px;
    color: #1b2e4f;
    font-family: 'EB Garamond', serif;
}
@font-face {
  font-family: theSuavityRegular;
  src: url(fonts/the-suavity.regular.ttf);
}
@font-face {
  font-family: myHomely;
  src: url(fonts/myHomely.ttf);
}
img.yr-cert-img {
    max-width: 100%;
}

.name {
    position: absolute;
    top: 53%;
    font-size: 5vw;
    color:rgb(0, 0, 0);
    text-align: center;
    width: 100%;
    font-family: Montserrat;
    font-weight: 500;
}

.certID {
    position: absolute;
    top: 12%;
    left: 6%;
    font-size: 1.7vw;
    color: #1b2e4f;
}

.Cbox {
    position: relative;
}
.course{
    position: absolute;
    top: 70%;
    font-size: 2vw;
    color: #1b2e4f;
    text-align: center;
    width: 100%;
    font-weight: bold;
}
.date {
    position: absolute;
    color: #1b2e4f;
    bottom: 10%;
    top: auto;
    left: 13%;
    font-size: 2.5vw;
}

/* Force landscape orientation for printing */
@media  print {
    @page  {
        size: landscape;
    }

    body {
        -webkit-print-color-adjust: exact; /* Ensures background colors are printed */
    }
}
</style>

<!-- Section -->
<div class="Cbox" id="printarea">
    <div class="certID">Certificate ID : <span>VSCL<?php echo e(rand(1000,9999)); ?></span></div>
    <div class="name"><?php echo e(ucwords(Auth::user()->name)); ?></div>
    <div class="course"><?php echo e($orders->product_name); ?>  <?php if($orders->type=='Workshop'): ?> <b> Masterclass</b> <?php else: ?> <b>Course</b> <?php endif; ?></div>        
    <div class="date"><?php echo e(date('d M Y',strtotime($orders->session_date))); ?></div>
    <img src="<?php echo e(asset('assets/images/mcertificate.jpg')); ?>" class="yr-cert-img">
</div>

<!-- End Section -->
<!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
</body>
</html>
<script>
printDiv('printarea');
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
     window.onafterprint = function(event) {
        window.location.href = "<?php echo url('/certificate-feedback')?>";
     };
     window.onaftercancel = function(event) {
        window.location.href = "<?php echo url('/certificate-feedback')?>";
     };
}
setTimeout(function() {
    window.location.href = "<?php echo url('/certificate-feedback')?>";
}, 2000);
</script>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/certificate.blade.php ENDPATH**/ ?>