@extends('layouts.master')
@section('title','購物車')
@section('head')
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endsection


@section('content')
	<div>
    <loading :active.sync="load"></loading>
	</div>
	<div v-if="!load"  class="container" style="margin-top: 70px">
	  <div  class="row">

	    <!--Grid column-->
	    <div v-if="item_qty" class="col-lg-8">

	      <!-- Card -->
	      <div class="mb-3">
	        <div class="pt-4 wish-list">
	          {{-- @if($cart) --}}
	          <h5 v-cloak v-if="!load" class="mb-4">購物車 (<span>@{{ item_qty }}</span> 件商品)</h5>
	          <shop_item @minus_one="minus" @plus_one="plus"  @remove_item="remove_item(arguments)" v-for="(item,index) in items" v-if="items[index]" :key=item.item.id v-bind="item.item" :qty="item.qty">
	          </shop_item>
	        </div>
	      </div>
	    </div>
	    <!--Grid column-->

	    <!--Grid column-->
	    <div v-if="item_qty" class="col-lg-4">

	      <!-- Card -->
	      <div class="mb-3">
	        <div v-cloak class="pt-4">

	          <h5 class="mb-3"><strong>總計</strong></h5>

	          <ul class="list-group list-group-flush">
	            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
	              小計
	              <span>$@{{ sum }}</span>
	            </li>
	            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
	              其他費用
	              <span>0</span>
	            </li>
	            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
	              <div>
	                <h5><strong>總額</strong></h5>
	                <strong>
	                  {{-- <p class="mb-0">(including VAT)</p> --}}
	                </strong>
	              </div>
	              <span><strong>$@{{ sum }}</strong></span>
	            </li>
	          </ul>

	          <a href="{{ route('checkout') }}" type="button" class="btn btn-primary btn-block">前往結帳</a>

	        </div>
	      </div>
	    </div>
	    <!--Grid column-->
	    {{-- @else --}}
	    	<div v-cloak><h3 v-if="!item_qty">目前購物車暫無商品</h3></div>
	    {{-- @endif --}}
	  </div>
	</div>
	
@endsection
@push('script')
	<script src="{{ asset('js/app.js') }}"></script>
@endpush