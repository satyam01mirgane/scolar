<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            background-color: #122536;
            text-align: center;
            padding: 20px 0;
        }
        .logo {
            max-width: 250px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }
        .customer-details, .invoice-info {
            width: 48%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #0071dc;
            color: white;
        }
        .total-row {
            font-weight: bold;
        }
        .notes {
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <h2 style="display: inline; color: #2250fc;">V</h2><h2 style="display: inline; color: #ff4d00;">SCHOLAR</h2>
        </div>
        
        <div class="invoice-details">
            <div class="customer-details">
                <h3>Customer</h3>
                <p>To: <strong style="color: #478fcc;">{{ Auth::user()->name }}</strong></p>
                @if(Auth::user()->address)
                    <p>{{ Auth::user()->address }}</p>
                @endif
                @if(Auth::user()->country)
                    <p>{{ Auth::user()->country }}</p>
                @endif
                @if(Auth::user()->phone_number)
                    <p>Tel: {{ Auth::user()->phone_number }}</p>
                @endif
            </div>
            <div class="invoice-info">
                <h3>Payment Receipt</h3>
                <p>Receipt Number: {{ $orders[0]->order_no }}</p>
                <p>Issue Date: {{ date('M d, Y', strtotime($orders[0]->created_at)) }}</p>
                <p>Status: <strong style="color: #478fcc;">Paid</strong></p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($orders as $k => $v)
                    @php $total += $v->product_price; @endphp
                    <tr>
                        <td>{{ ++$k }}</td>
                        <td>{{ $v->product_name }}</td>
                        <td>{{ $v->product_qunatity }}</td>
                        <td>₹{{ $v->product_price }}</td>
                        <td>₹{{ $v->product_discount }}</td>
                        <td>₹{{ $v->sub_total }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Bill Payment for Online education platform</td>
                    <td>Subtotal</td>
                    <td>₹{{ $total }}</td>
                </tr>
                @php $gst = ($total * 18) / 100; @endphp
                <tr>
                    <td colspan="4"></td>
                    <td>GST (18%)</td>
                    <td>₹{{ $gst }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4"></td>
                    <td>Total Amount</td>
                    <td>₹{{ number_format($total + $gst, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <p><strong>Total Amount in Words:</strong> {{ numberTowords($total + $gst) }} Only</p>

        <div class="notes">
            <h4>Please Note:</h4>
            <p>Dear Consumer, the bill payment will reflect in the next 48 hours or in the next billing cycle, at your service provider's end.</p>

            <h4>Declaration:</h4>
            <p>This is not an invoice but only a confirmation of the receipt of the amount paid against the service as described above. Subject to terms and conditions mentioned at VSCHOLAR .</p>
        </div>

        <div class="footer">
            <p>This is a computer-generated receipt and does not require a physical signature.</p>
            <p>VSCHOLAR  | 61-C Rajouri Garden, New Delhi-110027 | GSTIN: 07AAXFV4215H1ZR | Tel: +91-9667576014</p>
        </div>
    </div>
</body>
</html>
