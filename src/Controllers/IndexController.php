<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Controllers;

use CodeSinging\PinAdmin\Controllers\Support\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return $this->adminView('index.index');
    }
}