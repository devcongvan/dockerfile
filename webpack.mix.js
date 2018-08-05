let mix = require('laravel-mix');

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

mix.js('resources/assets/main.js', 'public/js/main2.js')
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    })
    .sass('resources/assets/main.scss', 'public/css/main2.css').copy('node_modules/line-awesome/dist/fonts', 'public/fonts');;

mix.webpackConfig({
    module: {
        rules: [
            // your rules may go here
            // next rules are just example, you can modify them according to your needs
            {
                test: /\.(jpe?g|png|gif|svg)$/i,
                loader: "file-loader?name=/resources/assets/jqueryautocomplete/images/[name].[ext]"
            }
        ],
        loaders: [
            {
                test: /\.js?$/,
                loader: 'babel-loader',
                exclude: /node_modules/
            }
        ]
    }
});


