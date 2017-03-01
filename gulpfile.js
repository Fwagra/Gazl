var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        'bootflat.scss',
        'flat/red.css',
        'bootstrap.min.scss',
        'jquery-ui.min.scss',
        'select2.min.scss',
        'styles.scss'
    ], 'public/css/app.css' );
    mix.sass('pdf.scss', 'public/css/pdf.css');
    mix.scriptsIn(['resources/assets/js'], 'public/js/app.js');
});
