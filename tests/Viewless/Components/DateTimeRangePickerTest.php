<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\DateTimeRangePicker;
use Orchestra\Testbench\TestCase;

class DateTimeRangePickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-date-picker type='datetimerange'></el-date-picker>", DateTimeRangePicker::make()->build());
    }
}
