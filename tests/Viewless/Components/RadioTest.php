<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Radio;
use Orchestra\Testbench\TestCase;

class RadioTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-radio v-model="radio" label="1">选项</el-radio>', Radio::make('radio', '1', '选项')->build());
    }
}
