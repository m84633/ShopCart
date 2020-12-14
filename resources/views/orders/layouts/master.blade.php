<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	@include('orders.partials.head')
</head>
<body>
	@include('orders.partials.nav')
	@section('content')

	@show
	@stack('script')
</body>
</html>