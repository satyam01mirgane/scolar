@include('front.common.profile-header')
@include('front.common.sidebar')

<style>
.modal-header1 {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}
</style>

<!-- Content Wrapper -->
<div class="content-wrapper" style="margin-left:0px;">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Certificate & Feedback</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                        <div class="card-body table-responsive p-0">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Masterclass Name</th>
                                        <th>Masterclass ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Certificate</th>
                                        <th>Share</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                        @foreach($orders as $v)
                                            <tr>
                                                <td>{{ $v->workshopname }}</td>
                                                <td>WKPID{{ $v->product_id }}</td>
                                                <td>{{ date('d-m-Y', strtotime($v->session_date)) }}</td>
                                                <td>{{ date('H:i:s A', strtotime($v->session_time)) }}</td>
                                                <td>
                                                    @if($v->session_status != 'Open')
                                                        <a href="{{ url('print-certificate/'.$v->product_id) }}" target="_blank">Certificate</a>
                                                    @else
                                                        <span style="color:red;">Certificate not completed.</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($v->session_status != 'Open')
                                                        <div class="d-flex gap-3" style="justify-content: space-around; gap:3;">
                                                            <!-- LinkedIn Share -->
                                                            <a href="https://www.linkedin.com/sharing/share-offsite/?text=🎉 I’m thrilled to announce that I’ve successfully completed the masterclass '{{ $v->workshopname }}' under the expert guidance of {{ $v->trainername }}. 🚀💡 This experience has been truly enriching! #Masterclass #{{ str_replace(' ', '', $v->workshopname) }} #{{ str_replace(' ', '', $v->trainername) }}"
                                                               target="_blank" title="Share on LinkedIn">
                                                                <i class="fab fa-linkedin" style="color: #0077b5; font-size: 24px;"></i>
                                                            </a>


                                                            <!-- Copy to Clipboard -->
                                                            <a href="#" onclick="copyToClipboard('🎉 I’m thrilled to announce that I’ve successfully completed the masterclass \'{{ $v->workshopname }}\' under the expert guidance of {{ $v->trainername }}. 🚀💡 This experience has been truly enriching! #Masterclass #{{ str_replace(' ', '', $v->workshopname) }} #{{ str_replace(' ', '', $v->trainername) }}')" title="Copy Link">
                                                                <i class="fas fa-copy" style="color: #6c757d; font-size: 24px;"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span style="color:red;">Not available</span>
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
        </div>
    </section>
</div>

<script>
    // Copy to Clipboard Functionality
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert("Message copied to clipboard!");
        }, function(err) {
            console.error("Failed to copy: ", err);
        });
    }
</script>
