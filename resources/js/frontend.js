/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

 window.Vue = require('vue');
 window.axios = require('axios');
 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



 Vue.component('ViewButton', require('./components/frontend/ViewButton').default);
 Vue.component('ProductDetail', require('./components/frontend/ProductDetail').default);

 const app = new Vue({
    el: '#vue-app',
});
