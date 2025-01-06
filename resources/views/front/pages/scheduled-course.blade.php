<!-- Add this CSS in your header -->
<style>
@media (max-width: 768px) {
    .content-wrapper {
        margin-left: 0;
    }
    
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .breadcrumb {
        margin-top: 10px;
        float: none !important;
    }
    
    .content-header .col-sm-6 {
        width: 100%;
        text-align: center;
    }
    
    .float-sm-right {
        float: none !important;
        justify-content: center;
        display: flex;
    }
    
    .table td, .table th {
        min-width: 120px; /* Ensure columns don't get too narrow */
    }
    
    .table td:first-child {
        min-width: 200px; /* Course name needs more space */
    }
}

/* Optional: Hide less important columns on very small screens */
@media (max-width: 480px) {
    .hide-xs {
        display: none;
    }
}
</style>

<!-- Modified HTML structure -->
<div class="wrapper">
    @include('front.common.profile-header')
    @include('front.common.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h1>Scheduled Course</h1>
                    </div>
                    <div class="col-12 col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Scheduled Course</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Course Name</th>
                                                <th>Zoom Link</th>
                                                <th>Course ID</th>
                                                <th class="hide-xs">Instructor</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Amount</th>
                                                <th>Invoice</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($orders)>0)
                                                @foreach($orders as $k=>$v)
                                                <tr>
                                                    <td>{{$v->workshopname}}</td>
                                                    <td><a href="{{$v->zoom_link}}" class="btn btn-sm btn-primary">Link</a></td>
                                                    <td>WKPID{{$v->product_id}}</td>
                                                    <td class="hide-xs">{{$v->trainername}}</td>
                                                    <td>{{date('d-m-Y',strtotime($v->session_date))}}</td>
                                                    <td>{{date('H:i:s A',strtotime($v->session_time))}}</td>
                                                    <td>@if($v->workshop_type=='Free') Free @else ₹{{$v->price - $v->product_discount}} @endif</td>
                                                    <td>
                                                        @if($v->workshop_type!='Free')
                                                            <a href="#" class="btn btn-sm btn-info">Invoice</a>
                                                        @else
                                                            Free
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge @if($v->session_status == 'Completed') badge-success @else badge-primary @endif">
                                                            {{$v->session_status}}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center">No course found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('front.common.profile-footer')
</div>