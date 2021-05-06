<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Switcher;
use Orchestra\Testbench\TestCase;

class SwitcherTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-switch></el-switch>', Switcher::make());
        self::assertEquals('<el-switch v-model="sex"></el-switch>', Switcher::make('sex'));
    }
}
