<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Composites;

use CodeSinging\PinAdmin\Viewless\Composites\ExtendedTable;
use Orchestra\Testbench\TestCase;

class ExtendedTableTest extends TestCase
{
    public function testColumnId()
    {
        self::assertEquals(
            "<el-table-column prop='id' label='ID' align='center'></el-table-column>",
            ExtendedTable::make()->columnId()->build()
        );
    }

    public function testColumnCreatedAt()
    {
        self::assertEquals(
            "<el-table-column prop='created_at' label='创建时间'></el-table-column>",
            ExtendedTable::make()->columnCreatedAt()->build()
        );
    }

    public function testColumnUpdatedAt()
    {
        self::assertEquals(
            "<el-table-column prop='updated_at' label='更新时间'></el-table-column>",
            ExtendedTable::make()->columnUpdatedAt()->build()
        );
    }
}
