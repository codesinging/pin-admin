<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\DateRangePicker;
use Orchestra\Testbench\TestCase;

class DateRangePickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-date-picker type='daterange'></el-date-picker>", DateRangePicker::make()->build());
    }
}
