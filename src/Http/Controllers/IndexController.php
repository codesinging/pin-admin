<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        return $this->adminView('index.index');
    }
}