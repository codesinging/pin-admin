<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\ColorPicker;
use Orchestra\Testbench\TestCase;

class ColorPickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-color-picker></el-color-picker>", ColorPicker::make());
    }
}
