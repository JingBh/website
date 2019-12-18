const mix = require('laravel-mix');

mix.disableNotifications();
mix.extract(["lodash", "axios"]);
mix.version();

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

mix.sass('resources/sass/bootstrap-edited.scss', 'public/css');

mix.js('resources/js/home/app.js', 'public/js/home')
    .extract(["jquery", "popper.js", "bootstrap", "scrollreveal"]);

mix.scripts('modules/NCMRank/resources/app.js', 'public/js/ncmrank/app.js');
