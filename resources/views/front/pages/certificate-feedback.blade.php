@include('front.common.sidebar')
<!-- @include('front.common.profile-header') -->
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

/* Table and Layout Styles */
.content-wrapper {
    min-height: 100vh;
    width: calc(100% - 250px);
    margin-left: 250px;
    background-color: #f4f6f9;
}

.table-wrapper {
    position: relative;
    max-height: calc(100vh - 250px);
    overflow: auto;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    background: #fff;
}

.table-wrapper table {
    width: 100% !important;
    margin-bottom: 0;
}

.table-wrapper thead th {
    position: sticky;
    top: 0;
    background-color: #f8f9fa;
    z-index: 1;
    border-bottom: 2px solid #dee2e6;
    padding: 12px 8px;
}

.table th, .table td {
    min-width: 120px;
    padding: 12px 8px;
    vertical-align: middle;
}

.card {
    margin-bottom: 1rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    border: 0;
}

.card-body {
    padding: 0;
}

/* Form and Modal Styles */
.form-group {
    margin-bottom: 1rem;
}

.alert {
    margin-bottom: 0;
    border-radius: 0;
}

.modal-dialog.modal-lg {
    max-width: 900px;
}

/* Custom Scrollbar */
.table-wrapper::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-wrapper::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.table-wrapper::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<div class="content-wrapper">

    <!-- Content Header -->
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
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            
                            <div class="table-wrapper">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Masterclass ID</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Certificate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($orders) > 0)
                                            @foreach($orders as $k => $v)
                                            <tr>
                                                <td>{{$v->workshopname}}</td>
                                                <td>WKPID{{$v->product_id}}</td>
                                                <td>{{date('d-m-Y', strtotime($v->session_date))}}</td>
                                                <td>{{date('H:i:s A', strtotime($v->session_time))}}</td>
                                                <td>
                                                    @if($v->session_status != 'Open')
                                                        <a href="{{url('print-certificate/'.$v->product_id)}}">Certificate</a>
                                                    @else
                                                        <span style="color:red;">Certificate not completed.</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No Masterclass found</td>
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

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

<script>
// Hide success message after 2 seconds
setTimeout(function() {
    $(".alert-success").slideToggle();
}, 2000);

// Initialize tooltips and other Bootstrap components
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    
    // Handle table scroll shadows
    const tableWrapper = document.querySelector('.table-wrapper');
    if (tableWrapper) {
        tableWrapper.addEventListener('scroll', function() {
            const isScrolled = tableWrapper.scrollLeft > 0;
            tableWrapper.classList.toggle('has-scroll', isScrolled);
        });
    }
});
</script>
