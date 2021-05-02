<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Dialog;
use Orchestra\Testbench\TestCase;

class DialogTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-dialog></el-dialog>', Dialog::make());
    }
}
