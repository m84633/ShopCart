/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


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
            // console.log(val)
            this.items[val['0']] = false
            this.sum -= (val['1']) * (val['2'])
            this.item_qty  --
            // if(item_qty == 0){
            //     item_qty = false
            // }
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
        axios.post('/getQty')
          .then((response)=> {
            // console.log(response);
            this.totalQty = response.data
          })
          .catch(function (error) {
            console.log(error);
          });
        //取得購物車項目
        axios.post('/get_items')
          .then((response)=> {
            // console.log(response);
            this.items = response.data
          })
          .catch(function (error) {
            console.log(error);
          });  
        //取得總額
        axios.post('/get_sum')
          .then((response)=> {
            // console.log(response);
            this.sum = response.data
          })
          .catch(function (error) {
            console.log(error);
          });
        //取得商品數
        axios.post('/get_itemqty')
          .then((response)=> {
            // console.log(response);
            this.item_qty = response.data
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
          // console.log(response);
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
