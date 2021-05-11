<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Description;
use Orchestra\Testbench\TestCase;

class DescriptionTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-description></el-description>", Description::make());
    }

    public function testAddItem()
    {
        self::assertEquals("<el-description><el-description-item></el-description-item></el-description>", Description::make()->addItem());
    }
}
