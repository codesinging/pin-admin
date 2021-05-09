<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\DateTimePicker;
use Orchestra\Testbench\TestCase;

class DateTimePickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-date-picker type='datetime'></el-date-picker>", DateTimePicker::make()->build());
    }
}
