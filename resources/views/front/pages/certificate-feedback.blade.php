<!-- @include('front.common.profile-header') -->
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
                                {{ Session::get('success') }}
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
                                        <td>{{ $v->workshopname }}</td>
                                        <td>WKPID{{ $v->product_id }}</td>
                                        <td>{{ date('d-m-Y', strtotime($v->session_date)) }}</td>
                                        <td>{{ date('H:i:s A', strtotime($v->session_time)) }}</td>
                                        <td>
                                            @if($v->session_status != 'Open')
                                            <a href="{{ url('print-certificate/'.$v->product_id) }}">Certificate</a>
                                            @else 
                                            <span style="color:red;">Certificate not completed.</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($v->feedback))
                                            <span>Feedback Submitted</span>
                                            @else
                                            <a href="#" data-toggle="modal" data-target="#myModal" onclick="feedback('{{ $v->product_id }}')">Feedback</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" align="center">No workshop found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

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
                <form id="contact_form" name="contact_form" class="default-form" method="post" action="{{ url('feedback') }}">
                    @csrf
                    <input type="hidden" name="wpid" id="wpid" value="">
                    <div class="row">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
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
                                <label class="form-label">Please rate the overall workshop/course<span>*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="workshop_rate" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">1</label>
                                </div>
                                <!-- Add other rating options here -->
                            </div>
                            <!-- Add other form fields for feedback -->
                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
