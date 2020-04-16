const mix = require('laravel-mix');
var SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');

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
//    .sass('resources/sass/app.scss', 'public/css');

// mix.js([
//    'public/theme/adminlte/plugins/jquery/jquery.min.js',
//    'public/theme/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js',
//    'public/theme/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
//    'public/theme/adminlte/dist/js/adminlte.js'
// ], 'public/js/adminlte/plugins.js');

mix.webpackConfig({
   plugins: [
   new SWPrecacheWebpackPlugin({
       cacheId: 'pwa',
       filename: 'service-worker.js',
       staticFileGlobs: ['public/**/*.{css,eot,svg,ttf,woff,woff2,js}'],
       minify: true,
       stripPrefix: 'public/',
       handleFetch: true,
       dynamicUrlToDependencies: { //you should add the path to your blade files here so they can be cached
              //and have full support for offline first (example below)
           '/': ['resources/views/welcome.blade.php'],
           // '/posts': ['resources/views/posts.blade.php']
       },
       staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
       navigateFallback: '/',
       runtimeCaching: [
           {
               urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
               handler: 'cacheFirst'
           }
       ],
       // importScripts: ['./js/push_message.js']
   })
   ]
});