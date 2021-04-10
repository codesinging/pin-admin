if (process.env.npm_config_admin === true) {
    require('./resources/admin/webpack.mix')
} else {
    const mix = require('laravel-mix')

    // mix.js('resources/js/app.js', 'public/static/app.js')
}