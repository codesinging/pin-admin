<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\FormItem;
use Orchestra\Testbench\TestCase;

class FormItemTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-form-item></el-form-item>', FormItem::make());
    }

    public function testInput()
    {
        self::assertEquals('<el-form-item><el-input></el-input></el-form-item>', FormItem::make()->input());
    }

    public function testValidate()
    {
        self::assertEquals("<el-form-item :rules='[{\"required\":true}]'></el-form-item>", FormItem::make()->validate(['required' => true])->build());
        self::assertEquals("<el-form-item :rules='isEdit ? [{\"required\":true}] : []'></el-form-item>", FormItem::make()->validate_edit(['required' => true])->build());
        self::assertEquals("<el-form-item :rules='isEdit ? [{\"required\":true},{\"type\":\"number\"}] : [{\"required\":true}]'></el-form-item>", FormItem::make()->validate(['required' => true])->validate_edit(['type' => 'number'])->build());
    }

    public function testDefault()
    {
        self::assertEquals('pin', FormItem::make()->default('pin')->default());
    }
}
