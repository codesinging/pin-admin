<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Table;
use Orchestra\Testbench\TestCase;

class TableTest extends TestCase
{
    public function testMake()
    {
        self::assertEquals("<el-table>" . PHP_EOL . "</el-table>", Table::make());
        self::assertEquals("<el-table :data='data'>" . PHP_EOL . "</el-table>", Table::make()->data(":data"));
    }

    public function testColumn()
    {
        $table = Table::make();
        $table->column("id", "ID");
        $table->column("name", "Name");

        self::assertEquals(
            "<el-table>" . PHP_EOL
            . "<el-table-column prop='id' label='ID'></el-table-column>" . PHP_EOL
            . "<el-table-column prop='name' label='Name'></el-table-column>" . PHP_EOL
            . "</el-table>",
            $table->build()
        );
    }
}
