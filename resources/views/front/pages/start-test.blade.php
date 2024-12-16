@include('front.common.header')
@include('front.common.navbar')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
	<div class="container">
		<div class="page-title" style="min-height:150px;">
			<h1>Online Test</h1>
		</div>
	</div>
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section id="section3">
            <div class="container">
                <div class="row">
				<form method="POST" action="{{url('/submit-test')}}">
				<input type="hidden" name="quiz_id" value="{{$quiz_cat->id}}">
				@csrf
				<div class="col-lg-12">
					@if(count($quiz_list) > 0)
						@php $i=1; @endphp
						@foreach($quiz_list as $K=>$v)
					<h5 class="text-small mt-5">Que{{$i}}: {{$v->question}}:</h5>
						<input type="hidden" name="quiz[]" value="{{$v->id}}">
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="1"  type="radio">
							<label class="form-check-label" for="">
							{{$v->option_1}}
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="2" required type="radio">
							<label class="form-check-label" for="">
							{{$v->option_2}}
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="3" required type="radio">
							<label class="form-check-label" for="">
							{{$v->option_3}}
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="4" required type="radio">
							<label class="form-check-label" for="">
							{{$v->option_4}}
							</label>
						</div>
				<!-- Que END -->
					@php $i++; @endphp
					@endforeach
					<div class="mt-5">
						<button class="btn btn-primary" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;Submit</button>
					</div>
					@endif
                    </div>
					</form>
                </div>

            </div>
        </section>

<!--End Workshop Section-->
@include('front.common.footer')
<script>
$("#course_type").change(function(){
	var val = $(this).val();
	if(val =='CBSE Courses'){
		$("#classes").prop("disabled",false);
	}else{
		$("#classes").prop("disabled",true);
	}
});
</script>