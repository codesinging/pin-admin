<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Col;
use Orchestra\Testbench\TestCase;

class ColTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-col></el-col>', Col::make());
    }
}
