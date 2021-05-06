<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\CheckboxButton;
use Orchestra\Testbench\TestCase;

class CheckboxButtonTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-checkbox-button></el-checkbox-button>', CheckboxButton::make());
    }
}
