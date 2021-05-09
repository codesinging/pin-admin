<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Badge;
use Orchestra\Testbench\TestCase;

class BadgeTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-badge></el-badge>", Badge::make());
    }
}
