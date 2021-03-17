<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Controllers;
use CodeSinging\PinAdmin\Facades\Admin;
use Illuminate\Support\Facades\Route;

Admin::routeGroup(function (){

    Route::get('/', [Controllers\IndexController::class, 'index'])->name('index.index');

});

Admin::routeGroup(function (){

    Route::get('/auth', [Controllers\AuthController::class, 'index'])->name('auth.index');

}, false);