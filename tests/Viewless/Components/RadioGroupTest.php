<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\RadioGroup;
use Orchestra\Testbench\TestCase;

class RadioGroupTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-radio-group></el-radio-group>', RadioGroup::make());
    }

    public function testRadio()
    {
        self::assertEquals('<el-radio-group><el-radio></el-radio></el-radio-group>', RadioGroup::make()->addRadio());
    }

    public function testRadioButton()
    {
        self::assertEquals('<el-radio-group><el-radio-button></el-radio-button></el-radio-group>', RadioGroup::make()->addRadioButton());
    }
}
