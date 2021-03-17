<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

return [

    /*
    |--------------------------------------------------------------------------
    | The name of PinAdmin application
    |--------------------------------------------------------------------------
    |
    | This value is the name of your PinAdmin application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */

    'name' => 'PinAdmin 后台管理系统',

    /*
    |--------------------------------------------------------------------------
    | The route prefix of the PinAdmin application
    |--------------------------------------------------------------------------
    |
    | This value is the prefix of all the application's route.
    */

    'route_prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | The home route of the PinAdmin application
    |--------------------------------------------------------------------------
    |
    | The route of the PinAdmin application's home.
    */

    'home' => '/',

    /*
    |--------------------------------------------------------------------------
    | The authentication configuration of the PinAdmin application
    |--------------------------------------------------------------------------
    |
    | All the configuration about authentication.
    */

    'auth' => [
        'captcha' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | The middleware of the PinAdmin application
    |--------------------------------------------------------------------------
    |
    | All the middleware of the PinAdmin application.
    */
    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | The auth guard of the PinAdmin application
    |--------------------------------------------------------------------------
    |
    | The authentication guard.
    |
    */

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin_users',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | The auth user provider of the PinAdmin application
    |--------------------------------------------------------------------------
    |
    | The authentication user provider.
    |
    */

    'providers' => [
        'admin_users' => [
            'driver' => 'eloquent',
            'model' => \CodeSinging\PinAdmin\Models\AdminUser::class,
        ]
    ],
];