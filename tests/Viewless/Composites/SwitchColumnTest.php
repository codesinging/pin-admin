<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Composites;

use CodeSinging\PinAdmin\Viewless\Composites\SwitchColumn;
use Orchestra\Testbench\TestCase;

class SwitchColumnTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-table-column><template #default='scope'>\n<el-switch></el-switch>\n</template></el-table-column>", SwitchColumn::make()->build());
    }
}
