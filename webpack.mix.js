let mix = require('laravel-mix');

mix.postCss('resources/css/index.css', 'public/css')
   .js('resources/js/ajax.js', 'public/js');