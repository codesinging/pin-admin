<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Link;
use Orchestra\Testbench\TestCase;

class LinkTest extends TestCase
{
    public function testLink()
    {
        self::assertEquals('<el-link></el-link>', Link::make());
    }

    public function testIconSuffix()
    {
        self::assertEquals("<el-link>查看<i class='el-icon-view el-icon--right'></i></el-link>", Link::make('查看')->iconSuffix('el-icon-view'));
    }
}
