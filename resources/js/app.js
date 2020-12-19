

require('./bootstrap');

window.Vue = require('vue');


var Toasted = require('vue-toasted').default

Vue.use(Toasted,{
	iconPack : 'fontawesome'
})
//vue loading
import Loading from 'vue-loading-overlay' //component
import 'vue-loading-overlay/dist/vue-loading.css' //style
Vue.component('Loading', Loading)



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('join_cart', require('./components/join_cart.vue').default);
Vue.component('shop_item', require('./components/shop_item.vue').default);



// Vue.config.debug = false;
// Vue.config.devtools = false;

const app = new Vue({
    el: '#app',
    data : {
    	totalQty : '',
        add_page : false,
        items : {},
        sum : '',
        item_qty : '',
        load : ''
    },
    methods : {
    	addQty(val){
    		this.totalQty = val
    	},
        remove_item(val){
            this.items[val['0']] = false
            this.sum -= (val['1']) * (val['2'])
            this.item_qty  --
        },
        plus(price){
            this.sum += price
        },
        minus(price){
            this.sum -= price
        }
    },
    beforeCreate(){
        this.load = true
    },
    created(){
        //右上角Qty
        axios.post('/getCart')
          .then((response)=> {
            this.totalQty = response.data.totalQty
            this.items = response.data.items
            this.sum = response.data.totalPrice
            if(response.data.items){
              this.item_qty = Object.keys(response.data.items).length
            }
            this.load = false
          })
          .catch(function (error) {
            console.log(error);
          });

    },
    mounted(){
        var url = window.location.href
        var reg = RegExp(/books/);
        if(reg.test(url)){
            this.add_page = true
        }
        axios.post('/bought')
        .then((response)=> {
          if(response.data){
              this.$toasted.show('感謝您的購買!!',{
              type : 'success',
              duration : '3000',
              theme : 'bubble',
              icon : 'heart'
            })
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }

});
