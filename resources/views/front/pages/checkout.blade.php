@include('front.common.header')
@include('front.common.navbar')
<link href="{{asset('assets/css/ui.css')}}" rel="stylesheet">
<section class="padding-y bg-light">
  <div class="container">
  
  <!-- =================== COMPONENT CART+SUMMARY ====================== -->
  <div class="row">
    <div class="col-lg-9">
  
      <div class="card">
      <div class="content-body">
        <h4 class="card-title mb-4">Cart</h4>
		@if ($message = Session::get('success'))
			<div class="alert alert-success">
			  <p class="text-green-800">{{ $message }}</p>
			</div>
		@endif
		@if(count($cartItems) >0)
		@foreach ($cartItems as $item)
        <article class="row gy-3 mb-4">
          <div class="col-lg-5">
            <figure class="itemside me-lg-5">
              <div class="aside"><img src="{{asset($item->attributes->image)}}" class="img-sm img-thumbnail"></div>
              <figcaption class="info">
                <a href="#" class="title">Workshop Id - WKPID{{$item->id}}</a>
                <p class="text-muted"> {{$item->product_name}} </p>
                <p class="text-muted"> Instructor Name - Y. R. Rizvi </p>
              </figcaption>
            </figure>
          </div>
          <div class="col-lg-4 col-sm-4 col-6">
            <div class="price-wrap lh-sm"> 
              <var class="price h6">₹{{ $item->price * $item->quantity }}</var>  <br>
              <small class="text-muted"> ₹{{ $item->price}} / per item </small> 
            </div> <!-- price-wrap .// -->
          </div>
          <div class="col-lg col-sm-4">
            <div class="float-lg-end">
			  <form action="{{ route('cart.remove') }}" method="POST">
			  @csrf
				  <input type="hidden" value="{{ $item->id }}" name="id">
				  <button class="btn btn-light text-danger">Remove</button>
			  </form>
            </div>
          </div>
        </article> <!-- row.// -->
		@endforeach
		@else
		<article class="row gy-3 mb-4">
          <span style="color:red;">Cart is empty</span>
        </article> <!-- row.// -->	
		@endif
      </div> <!-- card-body .// -->
		
      
  
      </div> <!-- card.// -->
  
    </div> <!-- col.// -->
  <aside class="col-lg-3">
  
      <div class="card mb-3">
      <div class="card-body">
      <form>
        <div class="form-group">
          <label class="form-label">Have coupon?</label>
          <div class="input-group">
            <input type="text" class="form-control" name="" placeholder="Coupon code">
            <button class="btn btn-light">Apply</button>
          </div>
        </div>
      </form>
      </div> <!-- card-body.// -->
      </div> <!-- card.// -->
  
      <div class="card">
      <div class="card-body">
        <dl class="dlist-align">
          <dt>Total price:</dt>
          <dd class="text-end"> ₹{{ Cart::getTotal() }}</dd>
        </dl>
        <!--<dl class="dlist-align">
          <dt>Discount:</dt>
          <dd class="text-end text-success"> - ₹60.00 </dd>
        </dl>
        <dl class="dlist-align">
          <dt>TAX:</dt>
          <dd class="text-end"> ₹14.00 </dd>
        </dl>-->
        <hr>
        <dl class="dlist-align">
          <dt>Total:</dt>
          <dd class="text-end text-dark h5"> ₹{{ Cart::getTotal() }} </dd>
        </dl>
        
        <div class="d-grid gap-2 my-3">
          <a href="#" class="btn btn-success w-100"> Make Purchase </a>
          <a href="#" class="btn btn-light w-100"> Back to workshops </a>
        </div>
      </div> <!-- card-body.// -->
      </div> <!-- card.// -->
  
    </aside> <!-- col.// -->
  </div> <!-- row.// -->
  <!-- =================== COMPONENT 1 CART+SUMMARY .//END  ====================== -->
  
  <br><br>
  
  </div> <!-- container .//  -->
  </section>
 
  <!--================End Checkout Area =================-->
@include('front.common.footer')
<script>
$("#sameasbilling").click(function(){
	if($('input[name=sameasbilling]:checked')){
		$("#first1").val($("#first").val());
		$("#lname1").val($("#lname").val());
		$("#company1").val($("#company").val());
		$("#phone_number1").val($("#phone_number").val());
		$("#email1").val($("#email").val());
		$("#country1").val($("#country").val());
		$("#mySelect1").val($("#mySelect").val());
		$("#mySelectCity1").val($("#mySelectCity").val());
		$("#add11").val($("#add1").val());
		$("#add21").val($("#add2").val());
		$("#city1").val($("#city").val());
		$("#district1").val($("#district").val());
		$("#zip1").val($("#zip").val());
		$("#landmark1").val($("#landmark").val());
	}else{
		$("#first1").val('');
		$("#lname1").val('');
		$("#company1").val('');
		$("#phone_number1").val('');
		$("#email1").val('');
		$("#country1").val('');
		$("#mySelect1").val('');
		$("#mySelectCity1").val('');
		$("#add11").val('');
		$("#add21").val('');
		$("#city1").val('');
		$("#district1").val('');
		$("#zip1").val('');
		$("#landmark1").val('');
	}
});
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
var site_url = "{{url('/')}}";

function getState(cid) {
	if(cid !=''){
		$.ajax({
			url: site_url+"/getstate",
			type: 'POST',
			data: {
				'_token': "{{ csrf_token() }}",
				'cid':cid
			},
			dataType: 'json',
		   success:function(data) {
			  var dataObj = data.state;
			  $('#mySelect, #mySelect1').empty();
			  $('#mySelect, #mySelect1')
					 .append($("<option></option>").attr("value", '').text('Select State')); 
			  $.each(dataObj, function(key, value) {			  
				 $('#mySelect, #mySelect1')
					 .append($("<option></option>").attr("value", value.id).text(value.name)); 
			});
		   }
		});
	}
 }
 function getCity(sid) {
	if(sid !=''){
		$.ajax({
			url: site_url+"/getcity",
			type: 'POST',
			data: {
				'_token': "{{ csrf_token() }}",
				'sid':sid
			},
			dataType: 'json',
		   success:function(data) {
			  var dataObj = data.city;
			  $('#mySelectCity, #mySelectCity1').empty();
			  $('#mySelectCity, #mySelectCity1').append($("<option></option>").attr("value", '').text('Select City')); 
			  $.each(dataObj, function(key, value) {			  
				 $('#mySelectCity, #mySelectCity1')
					 .append($("<option></option>").attr("value", value.id).text(value.name)); 
			});
		   }
		});
	}
 }
</script>
