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
        self::assertEquals(BuildExample::VALUE, (new BuildExample())->build());
    }

    public function testToString()
    {
        self::assertEquals(BuildExample::VALUE, new BuildExample());
    }
}

class BuildExample extends Buildable
{
    const VALUE = 'value';

    public function build(): string
    {
        return self::VALUE;
    }
}