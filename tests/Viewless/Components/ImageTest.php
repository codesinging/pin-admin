<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Image;
use Orchestra\Testbench\TestCase;

class ImageTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-image></el-image>", Image::make());
    }
}
