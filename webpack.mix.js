const mix = require('laravel-mix');
// globのインポート
const glob = require('glob');

require('laravel-mix-bundle-analyzer');

if (!mix.inProduction()) {
    mix.bundleAnalyzer();
}


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

mix.webpackConfig({
    module: {
        rules: [{
            // ローダーの処理対象ファイル
            test: /\.scss/,
            enforce: "pre",
            loader: 'import-glob-loader'
        }]
    }
})
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css')
    .sourceMaps();