<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Row;
use Orchestra\Testbench\TestCase;

class RowTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-row></el-row>', Row::make());
    }

    public function testAddCol()
    {
        self::assertEquals('<el-row><el-col></el-col></el-row>', Row::make()->addCol());
    }
}
