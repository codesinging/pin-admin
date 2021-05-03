<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\InputNumber;
use Orchestra\Testbench\TestCase;

class InputNumberTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-input-number></el-input-number>', InputNumber::make());
    }
}
