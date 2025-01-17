const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/custom.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]).sourceMaps();


mix.styles([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'resources/css/app.css'
    ], 'public/css/all.css');

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'resources/js/app.js'
    ], 'public/js/all.js');
