<?php
$contents = <<<BUILD
let mix = require('laravel-mix');

mix.postCss('vendor/ninjaphil/mvctut/resources/css/index.css', 'public/css')
   .js('vendor/ninjaphil/mvctut/resources/js/ajax.js', 'public/js');
BUILD;
file_put_contents("webpack.mix.js",$contents);