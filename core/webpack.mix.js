// const mix = require('laravel-mix');
// const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
// const TerserPlugin = require('terser-webpack-plugin');

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

// Primera compilación para la carpeta 'public/assets/js'
// mix.js('nocompiled/js/app.js', 'public/js')
//     .sass('nocompiled/sass/app.scss', 'public/css')
//     .webpackConfig({
//         optimization: {
//             minimize: true,
//             minimizer: [
//                 new TerserPlugin({
//                     terserOptions: {
//                         compress: {
//                             drop_console: true, // Elimina las llamadas a console.*
//                         },
//                     },
//                 }),
//                 new CssMinimizerPlugin(),
//             ],
//         },
//     });

// Segunda compilación para la carpeta 'public/backup/js'
// mix.js('nocompiled/js/app.js', 'public/js')
//     .sass('nocompiled/sass/app.scss', 'public/css')
//     .webpackConfig({
//         optimization: {
//             minimize: true,
//             minimizer: [
//                 new TerserPlugin({
//                     terserOptions: {
//                         compress: {
//                             drop_console: true, // Elimina las llamadas a console.*
//                         },
//                     },
//                 }),
//                 new CssMinimizerPlugin(),
//             ],
//         },
//     });