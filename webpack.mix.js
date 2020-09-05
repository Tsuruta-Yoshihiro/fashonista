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

mix.js('resources/js/app.js', 'public/js').sourceMaps()
   
   
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/post.scss', 'public/css')
    .sass('resources/sass/profile.scss', 'public/css')
    .sass('resources/sass/mypages.scss', 'public/css')
    .sass('resources/sass/top.scss', 'public/css')
    .sass('resources/sass/profile_edit.scss' , 'public/css')
    .sass('resources/sass/followings.scss' , 'public/css')
    .sass('resources/sass/followers.scss' , 'public/css')
    .sass('resources/sass/likes.scss' , 'public/css');
    //.version();