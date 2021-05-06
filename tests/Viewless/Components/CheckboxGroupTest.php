<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\CheckboxGroup;
use Orchestra\Testbench\TestCase;

class CheckboxGroupTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-checkbox-group></el-checkbox-group>', CheckboxGroup::make());
    }

    public function testAddItems()
    {
        self::assertEquals('<el-checkbox-group><el-checkbox></el-checkbox></el-checkbox-group>', CheckboxGroup::make()->addCheckbox()->build());
        self::assertEquals('<el-checkbox-group><el-checkbox-button></el-checkbox-button></el-checkbox-group>', CheckboxGroup::make()->addCheckboxButton()->build());
    }
}
