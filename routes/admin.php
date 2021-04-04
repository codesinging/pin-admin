<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Facades\Admin;
use Illuminate\Support\Facades\Route;

Admin::defaultRoutes();

Admin::authRouteGroup(function (){

});

Admin::guestRouteGroup(function (){

});