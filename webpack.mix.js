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


// home js
mix.js([

	'resources/js/bootstrap.js',
	'public/app/js/front.js'
], 'public/js/home.lib.js');




//admin js
mix.js([
	'resources/js/bootstrap.js',
	'public/assets/js/jquery.easing.min.js',
	'public/assets/js/sb-admin-2.min.js'
], 'public/js/admin.lib.js');

mix.js([
	'public/assets/js/chart.min.js',
	'public/assets/js/chart-pie-demo.js',
], 'public/js/admin.chart.js');





// home page css
mix.styles([
    'public/app/css/bootstrap.min.css',
    'public/app/css/custom.css',
    'public/app/css/style.default.css',
    'public/app/css/font-awesome.all.css'
], 'public/css/base.css');

mix.styles([
    'public/assets/css/tagsinput.css',
    'public/app/css/summernote.min.css'
], 'public/css/create_post.css');

// admin css
mix.styles([
    'public/assets/css/sb-admin-2.min.css',
    'public/app/css/font-awesome.all.css'
], 'public/css/admin.base.css');







