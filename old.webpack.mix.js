/*let sassMix = require('laravel-mix');
let reactMix = require('laravel-mix');
let vueMix = require('laravel-mix');*/
let laravelMix = require('laravel-mix');

laravelMix.options({
    processCssUrls: false
});

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

const version = "v3"

laravelMix
    .react('resources/assets/js/reactjs/' + version + '/app.js', 'public/js')
    .react('resources/assets/js/reactjs/' + version + '/custom-modules.js', 'public/js')
    .react('resources/assets/js/reactjs/' + version + '/app-landing-page.js', 'public/js')
    .react('resources/assets/js/reactjs/' + version + '/app-support.js', 'public/js')
    .sass('resources/assets/sass/' + version + '/app.scss', 'public/css')
    .sass('resources/assets/sass/' + version + '/quote-landing-page/style.scss', 'public/templates/landing-pages/v1/css/style.css')
    .sass('resources/assets/sass/' + version + '/quote-landing-page/app.scss', 'public/templates/landing-pages/v1/css/app.css')
    .sass('resources/assets/sass/' + version + '/vendors/font-awesome/5.0.0/sass/wrapper.scss', 'public/templates/landing-pages/v2/css/dz-fa-5.css')
    .js('resources/assets/js/vue/vue-app.js', 'public/js');
