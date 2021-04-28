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
        self::assertEquals('<el-table>' . PHP_EOL . '</el-table>', Table::make());
        self::assertEquals('<el-table :data="data">' . PHP_EOL . '</el-table>', Table::make()->data(':data'));
    }

    public function testColumn()
    {
        $table = Table::make();
        $table->column('id', 'ID');
        $table->column('name', 'Name');

        self::assertEquals(
            '<el-table>' . PHP_EOL
            . '<el-table-column prop="id" label="ID"></el-table-column>' . PHP_EOL
            . '<el-table-column prop="name" label="Name"></el-table-column>' . PHP_EOL
            . '</el-table>',
            $table->build()
        );
    }

    public function testColumnId()
    {
        self::assertEquals(
            '<el-table-column prop="id" label="ID" align="center"></el-table-column>',
            Table::make()->columnId()->build()
        );
    }

    public function testColumnCreatedAt()
    {
        self::assertEquals(
            '<el-table-column prop="created_at" label="创建时间"></el-table-column>',
            Table::make()->columnCreatedAt()->build()
        );
    }

    public function testColumnUpdatedAt()
    {
        self::assertEquals(
            '<el-table-column prop="updated_at" label="更新时间"></el-table-column>',
            Table::make()->columnUpdatedAt()->build()
        );
    }
}
