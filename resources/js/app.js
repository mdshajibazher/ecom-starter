require('./bootstrap');
window.Vue = require('vue');

/*v-form*/
import { HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


/*vue progress var*/
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '4px'
})


import CreateProduct from './components/CreateProduct';
Vue.component('create-product',CreateProduct);
Vue.component('ProductCollections', require('./components/ProductCollections').default);
Vue.component('vue-modal', () => import('./components/modal/VueModal'));
Vue.component('pagination', require('laravel-vue-pagination'));




const app = new Vue({
    el: '#app',
});
