const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


mix.styles([
    "public/assets/admin/css/main.css",
    "public/assets/admin/toastr/toastr.min.css",
    "public/assets/admin/font-awesome.min.css",
], 'public/css/main.css');


mix.babel([
    "public/assets/admin/js/jquery-3.3.1.min.js",
    "public/assets/admin/js/popper.min.js",
    "public/assets/admin/js/bootstrap.min.js",
    "public/assets/admin/js/main.js",
    "public/assets/admin/js/plugins/pace.min.js",
    "public/assets/admin/js/plugins/bootstrap-datepicker.min.js",
    "public/assets/admin/js/plugins/select2.min.js",
    "public/assets/admin/toastr/toastr.min.js",
    "public/assets/admin/sweetalert.min.js",
], 'public/js/main.js');
