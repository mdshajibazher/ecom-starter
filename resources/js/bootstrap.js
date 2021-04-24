window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
    window.iziToast = require('izitoast/dist/js/iziToast.min.js');
    window.Swal = require('sweetalert2');
    require('select2');
    // Dropify
    require('dropify/src/js/dropify');
    // Nestable
    require('nestable2/jquery.nestable');


    require('bootstrap');

    $('select').select2({
        theme: 'bootstrap4',
    })

} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

