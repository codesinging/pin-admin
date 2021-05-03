<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Elements;

use CodeSinging\PinAdmin\Viewless\Elements\Icon;
use Orchestra\Testbench\TestCase;

class IconTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<i class="el-home"></i>', Icon::make('el-home'));
    }
}
