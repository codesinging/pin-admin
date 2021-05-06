<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Form;
use Orchestra\Testbench\TestCase;

class FormTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-form></el-form>', Form::make());
    }

    public function testAddItems()
    {
        self::assertEquals('<el-form><el-form-item></el-form-item></el-form>', Form::make()->addItem());
    }

    public function testDefaults()
    {
        $form = Form::make();
        $form->item('name')->default('pin');

        self::assertEquals(['name' => 'pin'], $form->defaults());
    }

    public function testBindItemModel()
    {
        $form = Form::make(':data');
        $form->item('name')->input();

        self::assertEquals('<el-form :model="data"><el-form-item prop="name"><el-input v-model="data.name"></el-input></el-form-item></el-form>', $form->build());
    }
}
