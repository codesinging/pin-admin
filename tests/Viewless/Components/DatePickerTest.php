<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\DatePicker;
use Orchestra\Testbench\TestCase;

class DatePickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-date-picker></el-date-picker>', DatePicker::make());
    }
}
