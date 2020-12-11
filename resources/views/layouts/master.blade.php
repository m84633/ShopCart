<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>
	<div id="app">
		@include('partials.nav')
		@section('content')
		@show	
	</div>
</body>
		@stack('script')
</html>