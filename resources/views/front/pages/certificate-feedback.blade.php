@include('front.common.profile-header')
@include('front.common.sidebar')
<style>
  
.modal-header1 {
    display: -ms-flexbox;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Certificate & Feedback</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
          <!-- /.col -->
          <div class="col-md-12">
            
            <div class="card">
              <div class="card-body table-responsive p-0">
				  @if(Session::has('success'))
				  <div class="alert alert-success">
				  {{Session::get('success')}}
				  </div>
				  @endif
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Workshop Name</th>
                      <th>Workshop/Course ID</th>
                      <th>Date</th>
					  <th>Time</th>
                      <th>Certificate</th>
					  <th>Feedback</th>
				
                    </tr>
                  </thead>
                  <tbody>
					@if(count($orders)>0)
					@foreach($orders as $k=>$v)
                    <tr>
                      <td>{{$v->workshopname}}</td>
                      <td>WKPID{{$v->product_id}}</td>
                      <td>{{date('d-m-Y',strtotime($v->session_date))}}</td>
					  <td>{{date('H:i:s A',strtotime($v->session_time))}}</td>
                      <td>
					  @if($v->session_status !='Open')
					  <a href="{{url('print-certificate/'.$v->product_id)}}">Certificate</a>
					  @else 
						  <span style="color:red;">Certificate not completed.</span>
					  @endif
					  </td>
					  @if(!empty($v->feedback))
						  <td><span>Feedback Submitted</span></td>
					  @else
						  <td><a href="#" data-toggle="modal" data-target="#myModal" onclick="feedback('<?php echo $v->product_id;?>')">Feedback</a></td>
					  @endif
					  
                    </tr>
					@endforeach
					@else
						<tr>
							<td colspan="9" align="center">No workshop found</td>
						</tr>
					@endif
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
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header1">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Feedback</h4>
      </div>
      <div class="modal-body">
        <form id="contact_form" name="contact_form" class="default-form" method="post" action="{{url('feedback')}}">
		   @csrf
		   <input type="hidden" name="wpid" id="wpid" value="">
            <div class="row">
			  @if(Session::has('success'))
			  <div class="alert alert-success">
			  {{Session::has('success')}}
			  </div>
			  @endif
              <div class="contact-area style-two pl-0 pr-0 pr-lg-4">
          <div class="yr-f-form">
              <div class="row">
                <div class="col-md-12">                
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input class="form-control" type="email" name="email" placeholder="Your Answer" required="">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Your Answer" required="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">Contact No.</label>
                    <input class="form-control" type="text" name="phone" placeholder="Your Answer" required="">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Please Confirm Your name for the Certificates</label>
                    <input class="form-control" type="text" name="cname" placeholder="Your Answer" required="">
                  </div>                
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div><label class="form-label">Please rate the overall workshop/course<span>*</span></label></div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio1" value="1">
                      <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio2" value="2">
                      <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="3">
                      <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="4">
                      <label class="form-check-label" for="inlineRadio3">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="5">
                      <label class="form-check-label" for="inlineRadio3">5</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="6">
                      <label class="form-check-label" for="inlineRadio3">6</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="7">
                      <label class="form-check-label" for="inlineRadio3">7</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="8">
                      <label class="form-check-label" for="inlineRadio3">8</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="9">
                      <label class="form-check-label" for="inlineRadio3">9</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio3" value="10">
                      <label class="form-check-label" for="inlineRadio3">10</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div><label class="form-label">Did you enjoy the workshop/course? Please rate!<span>*</span></label></div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio1" value="1">
                      <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio2" value="2">
                      <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="3">
                      <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="4">
                      <label class="form-check-label" for="inlineRadio3">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="5">
                      <label class="form-check-label" for="inlineRadio3">5</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="6">
                      <label class="form-check-label" for="inlineRadio3">6</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="7">
                      <label class="form-check-label" for="inlineRadio3">7</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="8">
                      <label class="form-check-label" for="inlineRadio3">8</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="9">
                      <label class="form-check-label" for="inlineRadio3">9</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="workshop_exp" id="inlineRadio3" value="10">
                      <label class="form-check-label" for="inlineRadio3">10</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div><label class="form-label">Please rate the content of the workshop/course<span>*</span></label></div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio1" value="1">
                      <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio2" value="2">
                      <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="3">
                      <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="4">
                      <label class="form-check-label" for="inlineRadio3">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="5">
                      <label class="form-check-label" for="inlineRadio3">5</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="6">
                      <label class="form-check-label" for="inlineRadio3">6</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="7">
                      <label class="form-check-label" for="inlineRadio3">7</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="8">
                      <label class="form-check-label" for="inlineRadio3">8</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="9">
                      <label class="form-check-label" for="inlineRadio3">9</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="content_rate" id="inlineRadio3" value="10">
                      <label class="form-check-label" for="inlineRadio3">10</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div><label class="form-label">Please rate the skill set of the instructor<span>*</span></label></div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio1" value="1">
                      <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio2" value="2">
                      <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="3">
                      <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="4">
                      <label class="form-check-label" for="inlineRadio3">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="5">
                      <label class="form-check-label" for="inlineRadio3">5</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="6">
                      <label class="form-check-label" for="inlineRadio3">6</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="7">
                      <label class="form-check-label" for="inlineRadio3">7</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="8">
                      <label class="form-check-label" for="inlineRadio3">8</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="9">
                      <label class="form-check-label" for="inlineRadio3">9</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="instructor_skill" id="inlineRadio3" value="10">
                      <label class="form-check-label" for="inlineRadio3">10</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Any specific topic on which you want workshop/course?<span>*</span></label>
                    <input class="form-control" type="text" name="topic_suggest" placeholder="Your Answer" required="">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Any Suggestions?<span>*</span></label>
                    <input class="form-control" type="text" name="other_suggest" placeholder="Your Answer" required="">
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">submit now</button>
                  </div>
                </div>
              </div>
          </div>
          
        </div>
            </div>
          </form>
      </div>
    </div>

  </div>
</div>
  <!-- /.content-wrapper -->
@include('front.common.profile-footer')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
setTimeout(function() {$(".alert-success").slideToggle();}, 2000);
function feedback(wpid){
	if(wpid !=''){
		$(".btnshow").show();
		$("#show_form").show();
		$("#show_feedback").hide();
		$("#wpid").val(wpid);
	}
}
function show_feedback(msg){
	$(".btnshow").hide();
	$("#show_form").hide();
	$("#show_feedback").show();
	$("#showmsg").text(msg);
}
</script>
