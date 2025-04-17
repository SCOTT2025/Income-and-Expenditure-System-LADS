const mix = require('laravel-mix');

mix.js('firstwebsite/resources/js/app.js', 'public/js') // Corrected path
   .sass('firstwebsite/resources/sass/app.scss', 'public/css'); // Corrected path