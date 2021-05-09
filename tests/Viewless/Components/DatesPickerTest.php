<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\DatesPicker;
use Orchestra\Testbench\TestCase;

class DatesPickerTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-date-picker type='dates'></el-date-picker>", DatesPicker::make()->build());
    }
}
