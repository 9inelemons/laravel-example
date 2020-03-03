/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
require( 'jquery-mask-plugin' );
require( 'datatables.net-dt' );
require( 'datatables.net-responsive-dt' );
require( 'datatables.net-rowreorder-dt' );
require('./datatables');
require('./cart');
require('./owner');


jQuery(document).ready(function($) {
    $('#openNav').click(function() {
        $('#mySidenav').css({"width": "250px", "padding": "15px"});
    });
    $('#closeNav').click(function () {
        $('#mySidenav').css({"width": "0", "padding": "0"});
    });

    $('#inputFile').on('change',function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    })

    $('.phone').mask('+7 (000) 000 00-00', {placeholder: "+7 (___) ___ __-__"});
});
//window.Vue = require('vue');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/


