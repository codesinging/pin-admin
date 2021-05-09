<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\RadioButton;
use Orchestra\Testbench\TestCase;

class RadioButtonTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-radio-button label='Male'></el-radio-button>", RadioButton::make('Male'));
    }
}
