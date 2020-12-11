@extends('layouts.master')
@section('title','Shop')
@section('head')
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endsection
@section('content')
	<div class="container" style="margin-top: 70px">
		<div class="row">
			@foreach($books as $book)
			    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
			      <div class="card">
			        <img class="card-img" src="{{ asset("storage/products/".$book->picture) }}" alt="Vans">
	{{-- 		        <div class="card-img-overlay d-flex justify-content-end">
			          <a href="#" class="card-link text-danger like">
			            <i class="fas fa-heart"></i>
			          </a>
			        </div> --}}
			        <div class="card-body">
			          <h4 class="card-title">{{ $book->name }}</h4>
			          <h6 class="card-subtitle mb-2">作者: {{ $book->author }}</h6>
			          <div style="height: 80px"> 
			          	<p class="card-text">
			            　　{{ Illuminate\Support\Str::limit($book->desc,100,'...') }}            
			          	</p>
			          </div>
			          <div class="buy d-flex justify-content-between align-items-center">
			            <div class="price text-success">
			            	<h5 class="mt-4">${{ $book->price }}</h5>
			            </div>
			            <join_cart @update_qty="addQty" :id={{ $book->id }}></join_cart>
			          </div>
			        </div>
			      </div>
			    </div>
			@endforeach
		</div>
	</div>
@endsection	
@push('script')
	<script src="{{ asset('js/app.js') }}"></script>
@endpush	
