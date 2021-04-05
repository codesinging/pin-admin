const mix = require('laravel-mix')

mix.setPublicPath('resources/dist')
    .setResourceRoot('./')
    .js('resources/js/app.js', 'app.js')
    .vue()
    .postCss('resources/css/app.css', 'app.css', [require('tailwindcss'), require('autoprefixer')])
    .sourceMaps()
    .version()

