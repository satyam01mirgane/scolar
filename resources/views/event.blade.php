@include('front.common.header')

<!--  Header Menu start -->
<header>
    @include('front.common.topbar')
    @include('front.common.navbar')
</header>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Error Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
				<script>
					// Your application has indicated there's an error
					window.setTimeout(function(){
						// Move to a new location or you can do something else
						window.location.href = "{{url('home')}}";

					}, 5000);
				</script>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('success') !!}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding:200px;">
        </div>
    </div>  
</div>
<div class="clearfix pt-5"></div>
@include('front.common.footer')
