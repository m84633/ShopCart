<template>
  <div>
    <div class="row mb-4">
        <div class="col-md-5 col-lg-3 col-xl-3">
          <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
            <img class="img-fluid w-100"
              :src="getImg(picture)" alt="Sample">
          </div>
        </div>
        <div class="col-md-7 col-lg-9">
          <div>
            <div class="d-flex justify-content-between">
            	<div class="row">
            		<div class="col-md-10" style="height: 140px">
		                <h5>{{ name }}</h5>
		                <p class="mb-3 text-muted text-uppercase small">{{ describe }}</p>
	               </div>
            	</div>
              
              <div class="col-md-6">
                <div class="def-number-input number-input safari_only mb-0 w-100">
                 	<i style="cursor: pointer" @click="minus" class="fas fa-minus"></i>
                  <input v-model="quantity" class="quantity" min="0" name="quantity" type="number">
                 	<i style="cursor: pointer" @click="plus" class="fas fa-plus"></i>
                </div>
                <small id="passwordHelpBlock" class="form-text text-muted text-center">
                  (Note, 1 piece)
                </small>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-ends">
              <div>
                <a @click.prevent.stop="removeItem" type="button" style="text-decoration: none" class="card-link-secondary small text-uppercase mr-3"><i
                    class="fas fa-trash-alt mr-1"></i> 移除此項目 </a>
              </div>
              <p class="mb-0"><span><strong id="summary">${{ price }}</strong></span></p class="mb-0">
            </div>
          </div>
        </div>
    </div>
    <hr class="mb-4">
  </div>  
</template>
<script>
	export default{
    props : ['author','desc','name','picture','price','qty','id'],
    methods : {
      getImg(){
        return 'storage/products/'+this.picture
      },
      plus(){
        this.quantity ++
        this.$emit('plus_one',this.price)

        axios.post('/add',{
          id : this.id
        })
          .then((response)=> {
            // console.log(response);
          })
          .catch(function (error) {
            console.log(error);
        });
      },
      minus(){
        if(this.quantity > 1){
          this.quantity --
          this.$emit('minus_one',this.price)

          axios.post('/minus_one',{
          id : this.id
          })
          .then((response)=> {
            // console.log(response);
          })
          .catch(function (error) {
            console.log(error);
        });
        }


      },
      removeItem(){
        axios.post('/remove_item',{
          id : this.id
        })
          .then((response)=> {
            // console.log(response);
            this.item_qty = response.data
          })
          .catch(function (error) {
            console.log(error);
        });

        this.$emit('remove_item',this.id,this.price,this.quantity)
      }
    },
    data(){
      return {
        quantity : '',
        describe : ''
      }
    },
    watch : {
      qty : {
        immediate: true,
        handler(newValue,oldValue){
          this.quantity = this.qty
        }
      }, 
      desc : {
        immediate: true,
        handler(newValue,oldValue){
          if(this.desc.length >= 85){
            this.describe = this.desc.substring(0,85)+' . . .'
          }else{
            this.describe = this.desc
          }
        }
      }
      // qty(newVal){
      //   console.log('123')
      //   this.quantity = newVal
      // }
    }
	}
</script>