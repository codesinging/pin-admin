const mix = require('laravel-mix')

mix.setPublicPath('publishes/assets')
    .setResourceRoot('./')
    .js('resources/js/app.js', 'app.js')
    .vue()
    .postCss('resources/css/app.css', 'app.css')
    .sourceMaps()
    .version()