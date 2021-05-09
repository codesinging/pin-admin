<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Progress;
use Orchestra\Testbench\TestCase;

class ProgressTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-progress></el-progress>", Progress::make());
    }
}
