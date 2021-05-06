<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Slider;
use Orchestra\Testbench\TestCase;

class SliderTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-slider></el-slider>', Slider::make());
    }
}
