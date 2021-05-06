<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Option;
use Orchestra\Testbench\TestCase;

class OptionTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-option></el-option>', Option::make());
    }
}
