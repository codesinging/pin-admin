<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Tag;
use Orchestra\Testbench\TestCase;

class TagTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-tag>标签</el-tag>", Tag::make('标签')->build());
    }
}
