<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Textarea;
use Orchestra\Testbench\TestCase;

class TextareaTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-input type="textarea"></el-input>', Textarea::make());
    }
}
