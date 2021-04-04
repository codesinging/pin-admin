const mix = require('laravel-mix')

mix.setPublicPath('publishes/dist')
    .setResourceRoot('./')
    .js('resources/assets/js/app.js', 'app.js')
    .vue()
    .postCss('resources/assets/css/app.css', 'app.css', [require('tailwindcss'), require('autoprefixer')])
    .sourceMaps()
    .version()