<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\TableColumn;
use Orchestra\Testbench\TestCase;

class TableColumnTest extends TestCase
{
    public function testMake()
    {
        self::assertEquals('<el-table-column></el-table-column>', TableColumn::make());
        self::assertEquals('<el-table-column prop="name"></el-table-column>', TableColumn::make(['prop' => 'name']));
        self::assertEquals('<el-table-column prop="name"></el-table-column>', TableColumn::make('name'));
        self::assertEquals('<el-table-column prop="name"></el-table-column>', TableColumn::make(TableColumn::make('name')));
        self::assertEquals('<el-table-column prop="name"></el-table-column>', TableColumn::make(function (TableColumn $tableColumn){
            $tableColumn->prop('name');
        }));
    }

    public function testAttributes()
    {
        self::assertEquals('<el-table-column header-align="left"></el-table-column>', TableColumn::make()->headerAlign_left());
        self::assertEquals('<el-table-column :header-align="left"></el-table-column>', TableColumn::make()->headerAlign(':left'));
    }
}
