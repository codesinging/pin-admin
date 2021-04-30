<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Elements;

use CodeSinging\PinAdmin\Viewless\Elements\Div;
use Orchestra\Testbench\TestCase;

class DivTest extends TestCase
{
    public function testMake()
    {
        self::assertEquals('<div></div>', Div::make());
    }
}
