@include('front.common.profile-header')
@include('front.common.sidebar')

<!-- Content Wrapper -->
<div class="content-wrapper" style="margin-left: 0px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Scheduled Masterclass</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Scheduled Masterclass</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Masterclass Name</th>
                                        <th>Zoom Link</th>
                                        <th>MasterclassID</th>
                                        <th>Instructor</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                        @foreach($orders as $v)
                                        <tr>
                                            <td>{{ $v->workshopname }}</td>
                                            <td><a href="{{ $v->zoom_link }}" target="_blank">Link</a></td>
                                            <td>WKPID{{ $v->product_id }}</td>
                                            <td>{{ $v->trainername }}</td>
                                            <td>{{ date('d-m-Y', strtotime($v->session_date)) }}</td>
                                            <td>{{ date('h:i:s A', strtotime($v->session_time)) }}</td>
                                            <td>
                                                @if($v->workshop_type == 'Free') Free
                                                @else Rs.{{ $v->price - $v->product_discount }}
                                                @endif
                                            </td>
                                            <td>{{ $v->session_status }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No Scheduled Masterclass Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
