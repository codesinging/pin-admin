<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Pagination;
use Orchestra\Testbench\TestCase;

class PaginationTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-pagination></el-pagination>", Pagination::make());
    }
}
