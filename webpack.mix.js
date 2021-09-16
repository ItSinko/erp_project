const mix = require("laravel-mix");

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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

// mix.js("resources/js/app.js", "public/costum/js");
// mix.sass("resources/sass/app.scss", "public/costum/css");

// mix.js("resources/js/app/ppic/app.js", "public/costum/js/ppic.js");
mix.js("resources/js/ppic/schedule/app.js", "public/costum/js/schedule.js");
mix.js("resources/js/app.js", "public/costum/js/test.js");