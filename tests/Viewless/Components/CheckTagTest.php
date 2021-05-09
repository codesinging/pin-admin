<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\CheckTag;
use Orchestra\Testbench\TestCase;

class CheckTagTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-check-tag></el-check-tag>", CheckTag::make());
    }
}
