<nav class="navbar navbar-expand-lg navbar-light table-primary">
	<div id="" class="container">
		 	<a class="navbar-brand" href="{{ route('index') }}">
		Bootstrap
		 	</a>
		 	<div class="collapse navbar-collapse">
		 		<ul class="navbar-nav ml-auto">
		 			<li class="nav-item">
		 				@if(isset($books))
		                    <a v-if="add_page" href="{{ route('shopcart') }}" style="text-decoration: none;color: red" class="px-1">
		                    	<i class="fas fa-cart-arrow-down"></i>
		                    	<span v-cloak v-show="totalQty" class="badge badge-light">@{{ totalQty }}</span>
		                    	購物車
		                    </a>
	                    @else	                    
	                    <a v-if="!add_page" href="{{ route('index') }}" style="text-decoration: none;color: red" class="px-1">
	                    	<i class="fas fa-angle-left"></i>
	                    	購物去
	                    </a>
	                    @endif
            		</li>
		 		</ul>	
		 	</div>	
	</div>
</nav>