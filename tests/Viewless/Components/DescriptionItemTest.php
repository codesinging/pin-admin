<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\DescriptionItem;
use Orchestra\Testbench\TestCase;

class DescriptionItemTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-description-item></el-description-item>", DescriptionItem::make());
    }
}
