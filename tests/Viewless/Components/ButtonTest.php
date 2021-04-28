<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Button;
use Orchestra\Testbench\TestCase;

class ButtonTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-button></el-button>', new Button());
    }

    public function testAttributes()
    {
        self::assertEquals('<el-button disabled></el-button>', Button::make(['disabled']));
        self::assertEquals('<el-button :disabled="true"></el-button>', Button::make(['disabled' => true]));
        self::assertEquals('<el-button :disabled="true"></el-button>', Button::make()->disabled());
        self::assertEquals('<el-button :disabled="true" size="small"></el-button>', Button::make(['disabled' => true])->size('small'));
        self::assertEquals('<el-button :disabled="true" size="small"></el-button>', Button::make(['disabled' => true])->size_small());
        self::assertEquals('<el-button :disabled="true" type="success"></el-button>', Button::make(['disabled' => true])->type_success());
        self::assertEquals('<el-button :disabled="true" type="success"></el-button>', Button::make(['disabled' => true])->type('success'));
    }

    public function testEvent()
    {
        self::assertEquals('<el-button @click="click"></el-button>', Button::make()->onClick());
        self::assertEquals('<el-button @click="onClick"></el-button>', Button::make()->onClick('onClick'));
    }
}
