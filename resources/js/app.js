require('./bootstrap');

window.Vue = require('vue/dist/vue.min');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.Swal = require('sweetalert2');