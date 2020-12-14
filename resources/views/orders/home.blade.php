@extends('orders.layouts.master')
@section('title','訂單')
@section('head')
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection
@section('content')
	<div class="container" style="margin-top: 50px">
		<table id="datatable" width="100%" class="table table-bordered table-hover">
			<thead class="table-info">
				<tr>
					<th>訂單編號</th>
					<th>訂購者</th>
					<th>E-mail</th>
					<th>商品明細</th>
					<th>付款狀態</th>
					<th>訂購日期</th>
					<th class="text-center">刪除</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
					<tr>
						<td class="align-middle">{{ $order->uuid }}</td>
						<td class="align-middle"><strong>{{ $order->name }}</strong></td>
						<td class="align-middle">{{ $order->email }}</td>
						<td>@foreach(unserialize($order->cart)->items as $item)
								<strong>{{ $item['item']->name }}</strong>x{{ $item['qty'] }}<br>
							@endforeach
						</td>
						<td class="align-middle">
							{{ $order->paid == 1 ? '已付款':'尚未付款' }}
						</td>
						<td>{{ $order->created_at }}</td>
						<td class="align-middle text-center"><a onclick="event.preventDefault();if(confirm('是否要刪除?')){document.getElementById('delete{{ $order->id }}').submit()}" href="#"><i class=" fas fa-trash-alt align-middle" style="color: FireBrick"></i></a></td>
						<form id="delete{{ $order->id }}" method="post" style="display: none" action="{{ route('order.delete',$order->id) }}">
							@csrf
							@method('DELETE')
						</form>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection
@push('script')
	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
	<!-- DataTable -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
	<script>
		$(function () {
		    $('#datatable').DataTable({
		      "paging": true,
		      "lengthChange": false,
          	  "pageLength": 10,
		      "searching": true,
		      "ordering": true,
		      "info": false,
		      "autoWidth": false,
		      "responsive": true,
          "language": {
              "emptyTable":"無相關資料",
              "search":"搜尋:",
              "paginate": {
                "first":"第一頁",
                "last":"最後一頁",
                "next":"下一頁",
                "previous":"上一頁"
            },
          }
		    });
		  });		
	</script>
@endpush
