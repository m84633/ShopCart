<template>
	<a href="#" @click.prevent.stop="add" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i>加入購物車</a>
</template>
<script>
	export default{
		props:['id'],
		methods : {
			add(){
				axios.post('/add', {
				    id : this.id,
				  })
				  .then((response)=>{
				    // console.log(response);
				    // this.$parent.totalQty = response.data;
				    this.$emit('update_qty',response.data)
				    this.$toasted.show('成功加入購物車',{
				    	type : 'info',
				    	duration : '3000',
				    	theme : 'bubble',
				    	icon : 'check'

				    })
				  })
				  .catch(function (error) {
				    console.log(error);

				  });
			}
		}
	}
</script>