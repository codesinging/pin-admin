<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\WeekPicker;
use Orchestra\Testbench\TestCase;

class WeekPickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-date-picker type='week'></el-date-picker>", WeekPicker::make()->build());
    }
}
