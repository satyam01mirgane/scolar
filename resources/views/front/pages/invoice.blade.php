<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 20px;
            color: #484b51;
            font-family: Arial, sans-serif;
        }
        .page-header {
            margin: 0 0 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px dotted #e2e2e2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-title {
            font-size: 1.75rem;
            font-weight: bold;
        }
        .text-secondary-d1 { color: #728299 !important; }
        .text-blue { color: #478fcc !important; }
        .text-success-d3 { color: #86bd68 !important; }
        .bgc-primary-l3 { background-color: #eaf4ff !important; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .text-150 { font-size: 150%; }
        .logo img { max-width: 150px; }
        .table th, .table td { vertical-align: middle; }
        .table thead th { background-color: #0071dc; color: #fff; }
    </style>
</head>
<body>
<div class="container">
    <!-- Header Section -->
    <div class="page-header">
        <h1 class="page-title">Invoice</h1>
        <small>
            <strong>GSTIN:</strong> 07AAXFV4215H1ZR<br>
            A-61-C Shivaji Enclave, Rajouri Garden, New Delhi-27<br>
            <strong>Email:</strong> helpdesk@vastavintellect.com<br>
            <strong>Phone:</strong> +91 9667576014<br>
            <strong>Website:</strong> www.vastavintellect.com
        </small>
    </div>

    <!-- Invoice Details -->
    <div class="row mt-4">
        <div class="col-sm-6">
            <strong>To:</strong> {{ Auth::user()->name }}<br>
            @if(isset(Auth::user()->phone_number))
            <i class="fa fa-phone"></i> {{ Auth::user()->phone_number }}<br>
            @endif
        </div>
        <div class="col-sm-6 text-right">
            <strong>Invoice ID:</strong> {{ $orders->order_no }}<br>
            <strong>Issue Date:</strong> {{ date('M d, Y', strtotime($orders->created_at)) }}<br>
            <strong>Status:</strong> <span class="badge badge-warning">Paid</span>
        </div>
    </div>

    <!-- Products Table -->
    <div class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $orders->product_name }}</td>
                    <td class="text-center">1</td>
                    <td class="text-center">₹{{ $orders->product_price }}</td>
                    <td class="text-right">₹{{ $orders->sub_total }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="row">
        <div class="col-sm-7">
            <strong>GSTIN:</strong> 06ABYFA7585M1ZD
        </div>
        <div class="col-sm-5 text-right">
            <table class="table">
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">₹{{ $orders->sub_total }}</td>
                </tr>
                <tr class="bgc-primary-l3">
                    <td><strong>Total Amount</strong></td>
                    <td class="text-right"><strong>₹{{ $orders->sub_total }}</strong></td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <p class="text-center text-secondary">Thank you for your business!</p>
</div>

<!-- Print Script -->
<script>
    function printDiv() {
        window.print();
        window.onafterprint = function() {
            window.location.href = "{{ url('/enrolled-workshop') }}";
        };
    }

    // Auto-redirect after printing or timeout
    setTimeout(function() {
        window.location.href = "{{ url('/enrolled-workshop') }}";
    }, 2000);

    // Trigger print on page load
    window.onload = printDiv;
</script>
</body>
</html>
