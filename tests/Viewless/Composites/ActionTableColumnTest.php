<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Composites;

use CodeSinging\PinAdmin\Viewless\Components\Button;
use CodeSinging\PinAdmin\Viewless\Composites\ActionTableColumn;
use Orchestra\Testbench\TestCase;

class ActionTableColumnTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals("<el-table-column></el-table-column>", ActionTableColumn::make()->build());
    }

    public function testAddButton()
    {
        self::assertEquals("<el-table-column><template #default='scope'>\n<el-button></el-button>\n</template></el-table-column>", ActionTableColumn::make()->addButton()->build());
    }

    public function testAddButtons()
    {
        self::assertEquals("<el-table-column><template #default='scope'>\n<el-button></el-button>\n</template></el-table-column>", ActionTableColumn::make()->addButtons(Button::make())->build());
    }
}
