@include('front.common.header')
@include('front.common.navbar')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
	<div class="container">
		<div class="page-title" style="min-height:150px;">
			<h1>Quiz & Win</h1>
		</div>
	</div>
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section id="section3">
            <div class="container">
                <div class="row">
				<h4 id="total_mark"></h4>
				<form method="POST" action="{{url('/submit-quiz')}}">
				<input type="hidden" name="quiz_id" value="{{$quiz_cat->id}}">
				@csrf
				<div class="col-lg-12">
					@if(count($quiz_list) > 0)
						@php $i=1;$total_mark = 0; @endphp
						@foreach($quiz_list as $K=>$v)
						<?php if($v->quizres==$v->answer){
							$total_mark++;
						}
						?>
					<h5 class="text-small mt-5">Que{{$i}}: {{$v->question}}:</h5>
						<input type="hidden" name="quiz[]" value="{{$v->id}}">
						<div class="form-check">
							
							<label class="form-check-label" for="">
							{{$v->option_1}}
							</label>
						</div>
						<div class="form-check">
							
							<label class="form-check-label" for="">
							{{$v->option_2}}
							</label>
						</div>
						<div class="form-check">
							
							<label class="form-check-label" for="">
							{{$v->option_3}}
							</label>
						</div>
						<div class="form-check">
							
							<label class="form-check-label" for="">
							{{$v->option_4}}
							</label>
						</div>
						<div class="form-check">
							<b>Your choosen option is {{$v->quizres}} which is <?php if($v->quizres==$v->answer){?><span style="color:green;">Correct</span><?php }else{?> <span style="color:red;">Incorrect</span><?php }?></b>
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
var total_mark = '<?php echo $total_mark ?>';
$("#total_mark").text('Total Mark - '+total_mark);
</script>