<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\OptionGroup;
use CodeSinging\PinAdmin\Viewless\Components\Select;
use Orchestra\Testbench\TestCase;

class SelectTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-select></el-select>', Select::make());
    }

    public function testAddOption()
    {
        self::assertEquals('<el-select><el-option></el-option></el-select>', Select::make()->addOption());
    }

    public function testAddOptionGroup()
    {
        self::assertEquals('<el-select><el-option-group></el-option-group></el-select>', Select::make()->addOptionGroup());
    }

    public function testAddOptionGroupAndOption()
    {
        self::assertEquals('<el-select><el-option-group><el-option></el-option></el-option-group></el-select>', Select::make()->addOptionGroup(OptionGroup::make()->addOption()));
    }
}
