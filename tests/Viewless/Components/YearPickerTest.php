<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\YearPicker;
use Orchestra\Testbench\TestCase;

class YearPickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-date-picker type='year'></el-date-picker>", YearPicker::make()->build());
    }
}
