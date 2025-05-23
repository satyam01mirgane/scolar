@include('front.common.profile-header')
@include('front.common.sidebar')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;600;700&display=swap');

html, body {
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
    color: #1b2e4f;
    text-align: center;
    width: 100%;
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
}

.certID {
    position: absolute;
    top: 12%;
    left: 6%;
    font-size: 1.7vw;
    color: #1b2e4f;
    font-family: 'Montserrat', sans-serif;
}

.Cbox {
    position: relative;
}

.course {
    position: absolute;
    top: 73%;
    font-size: 2.4vw;
    color: #1b2e4f;
    text-align: center;
    width: 100%;
    font-family: 'Montserrat', sans-serif;
    font-weight: bold;
}

.date {
    position: absolute;
    color: #1b2e4f;
    bottom: 10%;
    top: auto;
    left: 12%;
    font-size: 2.5vw;
    font-family: 'Montserrat', sans-serif;
}

/* Force landscape orientation for printing */
@media print {
    @page {
        size: landscape;
    }

    body {
        -webkit-print-color-adjust: exact; /* Ensures background colors are printed */
    }
}
</style>

<!-- Section -->
<div class="Cbox" id="printarea">
    <div class="certID">Certificate ID : <span>VSCL{{rand(1000,9999)}}</span></div>
    <div class="name">{{ucwords(Auth::user()->name)}}</div>
    <div class="course">{{$orders->product_name}}  @if($orders->type=='Workshop') <b> Masterclass</b> @else <b></b> @endif</div>        
    <div class="date">{{date('d M Y',strtotime($orders->session_date))}}</div>
    <img src="{{asset('assets/images/mcertificate.jpg')}}" class="yr-cert-img">
</div>

<!-- End Section -->
<!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
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
}, 20000);
</script>
