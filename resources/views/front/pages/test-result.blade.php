@include('front.common.header')
@include('front.common.navbar')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
	<div class="container">
		<div class="page-title" style="min-height:150px;">
			<h1>Online Test Result</h1>
		</div>
	</div>
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section id="section3">
            <div class="container">
                <div class="row">
				@if($correct_answer > 0)
					<h4 style="color:green;">Great! you answer {{$correct_answer}} correct answers.</h4>
				@else
					<h4 style="color:red;">Oops! your all answer is incorrect, try again.</h4>
				@endif
				<form method="POST" action="{{url('/submit-quiz')}}">
				<input type="hidden" name="quiz_id" value="{{$quiz_cat->id}}">
				@csrf
				<div class="col-lg-12">
					@if(count($quiz_list) > 0)
						@php $i=1; @endphp
						@foreach($quiz_list as $K=>$v)
					<h5 class="text-small mt-5">Que{{$i}}: {{$v->question}}:</h5>
						<input type="hidden" name="quiz[]" value="{{$v->id}}">
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="1" <?php if (in_array(1, $answer)){echo 'checked';}?>  type="radio">
							<label class="form-check-label" for="">
							{{$v->option_1}}
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="2" <?php if (in_array(2, $answer)){echo 'checked';}?> required type="radio">
							<label class="form-check-label" for="">
							{{$v->option_2}}
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="3" <?php if (in_array(3, $answer)){echo 'checked';}?> required type="radio">
							<label class="form-check-label" for="">
							{{$v->option_3}}
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" name="que{{$i}}" id="" value="4" <?php if (in_array(4, $answer)){echo 'checked';}?> required type="radio">
							<label class="form-check-label" for="">
							{{$v->option_4}}
							</label>
						</div>
				<!-- Que END -->
					@php $i++; @endphp
					@endforeach
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