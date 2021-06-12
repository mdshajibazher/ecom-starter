require('./bootstrap');
window.Vue = require('vue');

/*v-form*/
import { HasError, AlertError } from 'vform'
import Vue from 'vue';
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


/*vue progress var*/
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '4px'
})


import CreateProduct from './components/backend/CreateProduct';
Vue.component('create-product',CreateProduct);
Vue.component('IndexProduct', require('./components/backend/IndexProduct').default);
Vue.component('ProductCollections', require('./components/backend/ProductCollections').default);
Vue.component('ProductSubcollections', require('./components/backend/ProductSubcollections').default);
Vue.component('SubcollectionLabel', require('./components/backend/SubcollectionLabel').default);
Vue.component('vue-modal', () => import('./components/modal/VueModal'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('VariantImageUploader',require('./components/backend/_product/VariantImageUploader').default)




const app = new Vue({
    el: '#app',
});
