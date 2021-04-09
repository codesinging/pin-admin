if (process.env.npm_config_admin === true) {
    require('./resources/admin/webpack.mix')
} else {
    const mix = require('laravel-mix')

    //
}