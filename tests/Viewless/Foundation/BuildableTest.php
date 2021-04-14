<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use Orchestra\Testbench\TestCase;

class BuildableTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals(BuildableBuild::VALUE, (new BuildableBuild())->build());
    }

    public function testToString()
    {
        self::assertEquals(BuildableBuild::VALUE, new BuildableBuild());
    }
}
