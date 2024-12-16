@include('front.common.profile-header')
@include('front.common.sidebar')
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
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
					@if(count($orders)>0)
					@foreach($orders as $k=>$v)
                    <tr>
                      <td>{{$v->workshopname}}</td>
                      @if(!empty($v->video_link))
                      <td><a href="{{$v->video_link}}">Link</a></td>
                      @else
                      <td>Video not available</td>
                      @endif
                      <td>WKPID{{$v->product_id}}</td>
                      <td>{{$v->trainername}}</td>
                      <td>{{date('d-m-Y',strtotime($v->session_date))}}</td>
					  <td>{{date('H:i:s A',strtotime($v->session_time))}}</td>
                      <td>Rs.{{$v->price}}</td>
                      <td><a href="{{url('print-invoice/'.$v->order_no)}}">Invoice</a></td>
					  <td>{{$v->session_status}}</td>
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
  <!-- /.content-wrapper -->
@include('front.common.profile-footer')
