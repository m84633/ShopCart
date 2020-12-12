@extends('layouts.master')
@section('title','結帳')
@section('head')
	{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet"> --}}
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endsection
@section('content')
		
		@if($errors->count() > 0)
			<div class="container">
				@foreach($errors->all() as $error)
					<div style="margin-top: 20px" class="alert alert-danger" role="alert">
					  {{ $error }}
					</div>
				@endforeach
			</div>
		@endif
		<div class="container" style="margin-top: 30px">
			<h3>購物明細</h3>
			<table class="table">
			  <thead class="thead-light">
			    <tr>
			      <th scope="col">商品明細</th>
			      <th scope="col">價格</th>
			      <th scope="col">數量</th>
			      <th scope="col">小計</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($cart->items as $item)
			    <tr>
			      <td><strong>{{ $item['item']->name }}</strong></td>
			      <td>{{ $item['price'] }}</td>
			      <td>{{ $item['qty'] }}</td>
			      <td>{{ $item['qty']*$item['price'] }}</td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
			<div class="float-right">
				<h6><strong>共{{ count($cart->items) }}項商品,數量{{ $cart->totalQty }}個,總金額&nbsp;&nbsp;NT$&nbsp;{{ $cart->totalPrice }}</strong></h6>
			</div><br>
			<div class="p-2 bg-dark text-white" style="border-radius: 10px;">
				<div class="d-flex justify-content-end"><strong>本訂單須付款金額&nbsp;NT$&nbsp;&nbsp;{{ $cart->totalPrice }}	元</strong></div>
			</div>
			  <form action="{{ route('checkout') }}" method="post" class="mt-3">
			  	@csrf
			  	<div class="row">
			  		<div class="col-md-6">
					  	<div class="form-group">
						    <label for="exampleInputEmail1">姓名</label>&nbsp;<font style="color: red">*</font>
						    <input value="{{ old('name') }}" type="text" class="form-control" name="name">
						</div>
			  		</div>
			  		<div class="col-md-6">
						<div class="form-group">
						    <label for="exampleInputPassword1">E-mail</label>&nbsp;<font style="color: red">*</font>
						    <input value="{{ old('email') }}" type="email" class="form-control" name="email">
						</div>
			  		</div>
			  		<div class="col-md-6 offset-md-6">
			  			<div class="float-right">
							<a type="submit" href="{{ route('shopcart') }}" class="btn btn-secondary  shadow rounded mr-2"><strong>回到購物車</strong></a>
							<button type="submit" class="btn btn-warning border border-danger shadow rounded"><strong>送出訂單</strong></button>
			  			</div>
			  		</div>
			  	</div>
		
			</form>
		</div>
@endsection
@push('script')
	<script src="{{ asset('js/app.js') }}"></script>
	<!-- MDB core JavaScript -->
	{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script> --}}
@endpush
