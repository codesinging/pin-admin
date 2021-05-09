<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\MonthRangePicker;
use Orchestra\Testbench\TestCase;

class MonthRangePickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-date-picker type='monthrange'></el-date-picker>", MonthRangePicker::make()->build());
    }
}
