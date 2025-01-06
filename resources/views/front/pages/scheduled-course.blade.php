@include('front.common.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #f4f6f9; min-height: 100vh; padding: 20px;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom: 20px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-size: 2.5rem; color: #333; font-weight: 600;">Scheduled Masterclass</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #007bff; text-decoration: none;">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #6c757d;">Scheduled Masterclass</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; transition: all 0.3s ease;">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap" style="margin-bottom: 0;">
                                <thead>
                                    <tr>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Name</th>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Zoom Link</th>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Masterclass ID</th>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Instructor</th>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Date</th>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Time</th>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Amount Paid</th>
                                        <th style="padding: 15px; font-size: 1rem; color: #333;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                        @foreach($orders as $k => $v)
                                            <tr style="transition: all 0.3s ease;">
                                                <td style="padding: 15px; font-size: 1rem; color: #666;">{{$v->workshopname}}</td>
                                                <td style="padding: 15px; font-size: 1rem; color: #007bff;"><a href="{{$v->zoom_link}}" style="text-decoration: none;">Link</a></td>
                                                <td style="padding: 15px; font-size: 1rem; color: #666;">WKPID{{$v->product_id}}</td>
                                                <td style="padding: 15px; font-size: 1rem; color: #666;">{{$v->trainername}}</td>
                                                <td style="padding: 15px; font-size: 1rem; color: #666;">{{date('d-m-Y', strtotime($v->session_date))}}</td>
                                                <td style="padding: 15px; font-size: 1rem; color: #666;">{{date('H:i:s A', strtotime($v->session_time))}}</td>
                                                <td style="padding: 15px; font-size: 1rem; color: #666;">
                                                    @if($v->workshop_type == 'Free')
                                                        Free
                                                    @else
                                                        Rs.{{$v->price - $v->product_discount}}
                                                    @endif
                                                </td>
                                                <td style="padding: 15px; font-size: 1rem; color: #666;">{{$v->session_status}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" style="padding: 20px; font-size: 1rem; color: #666; text-align: center;">No Masterclass found</td>
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
@include('front.common.profile-footer')

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
    tr:hover {
        background-color: #f8f9fa;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
