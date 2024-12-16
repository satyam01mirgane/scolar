<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 700px; margin: auto;">
  <tr style="background-color: #122536; text-align: center;">
    <td colspan="2"><img src="https:// VSCHOLAR .in/uploads/1/2022-09/logo dashboard.jpg" width="250"  /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php 
  //$orders = getOrder();
  ?>
  <tr>
    <td width="49%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
         
         
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">Customer </td>
          </tr>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">To <span style="font-weight: 600;color:#478fcc"><?php echo e(Auth::user()->name); ?></span></td>
          </tr>
		  <?php if(Auth::user()->address): ?>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"><?php echo e(Auth::user()->address); ?></td>
          </tr>
		  <?php endif; ?>
		  <?php if(Auth::user()->country): ?>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"><?php echo e(Auth::user()->country); ?></td>
          </tr>
		  <?php endif; ?>
		  <?php if(Auth::user()->phone_number): ?>
          <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">Tel : <?php echo e(Auth::user()->phone_number); ?></td>
          </tr>
		  <?php endif; ?>
          </table></td>
      </tr>
    </table></td>
    <td width="51%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;" align="right">Payment Receipt</td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right">Receipt Number: <?php echo e($orders[0]->order_no); ?></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">Issue Date : <?php echo e(date('M d, Y',strtotime($orders[0]->created_at))); ?></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;" align="right">Status : <span style="font-weight: 600;color:#478fcc">Paid</span></td>
      </tr>     
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right"><?php echo e(Auth::user()->phone_number); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr style="background-color: rgb(0 113 220);" >
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="10%" height="32" align="center">#</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="30%" height="32" align="center">Description</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="15%" align="center">Qty</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="15%" align="center">Unit Price</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="15%" align="center">Discount</td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="15%" align="center">Amount</td>
      </tr>
	  <?php  $total=0;  ?>
	  <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  <?php $total = $total + $v->product_price; ?>
      <tr>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center"><?php echo e(++$k); ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center"><?php echo e($v->product_name); ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center"><?php echo e($v->product_qunatity); ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">₹<?php echo e($v->product_price); ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">₹<?php echo e($v->product_discount); ?></td>
        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">₹<?php echo e($v->sub_total); ?></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td colspan="3">Bill Payment for Online education plateform</td>
        <td colspan="2" align="right"> SubTotal = ₹<?php echo e($total); ?></td>
      </tr>
	  <?php $gst = 0;
		$gst = $total - ($total*18/100);
	  ?>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="2" align="right"> GST Included (18%) = ₹<?php echo e($gst); ?></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="2" align="right"> Total Amount = ₹<?php echo e(number_format($total,2)); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">Total Amount in Words: <?php echo e(numberTowords($total)); ?> Only</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" colspan="2">Please Note:</td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">Dear Consumer, the bill payment will reflect in next 48 hours or in the next billing cycle, at your service provider&rsquo;s end.</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" colspan="2">DECLARATION:</td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">This is not an invoice but only a confirmation of the receipt of the amount paid against for the service as described above.  Subject to terms and conditions mentioned at VSCHOLAR LLP</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2" align="center">(This is computer generated receipt and does not require physical signature.)
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/pages/email-file.blade.php ENDPATH**/ ?>