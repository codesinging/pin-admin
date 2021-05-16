<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Composites;

use CodeSinging\PinAdmin\Viewless\Composites\CustomColumn;
use Orchestra\Testbench\TestCase;

class CustomColumnTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-table-column><template #default='scope'>\n\n</template></el-table-column>", CustomColumn::make()->build());
        self::assertEquals("<el-table-column><template #default='scope'>\ncontent\n</template></el-table-column>", CustomColumn::make()->add('content')->build());
    }
}
