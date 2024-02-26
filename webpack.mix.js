const mix = require('laravel-mix');
const { VitePlugin } = require('laravel-vite-plugin');

mix.js('resources/js/app.jsx', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
   ])
   .vite({
       plugins: [VitePlugin()],
   });
