<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\OptionGroup;
use Orchestra\Testbench\TestCase;

class OptionGroupTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-option-group></el-option-group>', OptionGroup::make());
    }

    public function testOption()
    {
        self::assertEquals('<el-option-group><el-option></el-option></el-option-group>', OptionGroup::make()->addOption());
    }
}
