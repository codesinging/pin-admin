<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Component;
use Orchestra\Testbench\TestCase;

class ComponentTest extends TestCase
{
    public function testTag()
    {
        self::assertEquals('<el-component></el-component>', new Component());
        self::assertEquals('<el-button>click</el-button>', new TestButtonComponent('click'));
    }
}

class TestButtonComponent extends Component
{
    protected $baseTag = 'button';
}