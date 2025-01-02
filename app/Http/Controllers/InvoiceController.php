<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Add this at the top
use App\Models\Order; // Add your Order model

class InvoiceController extends Controller
{
    public function show($order_id)
    {
        $orders = Order::where('order_no', $order_id)->get();
        return view('invoices.template', compact('orders'));
    }

    public function downloadPDF($order_id)
    {
        $orders = Order::where('order_no', $order_id)->get();
        $pdf = PDF::loadView('invoices.template', compact('orders'));
        return $pdf->download('invoice-'.$order_id.'.pdf');
    }
}