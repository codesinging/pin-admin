<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Card;
use Orchestra\Testbench\TestCase;

class CardTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-card></el-card>', Card::make());
    }
}
