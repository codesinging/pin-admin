<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Input;
use CodeSinging\PinAdmin\Viewless\Elements\Icon;
use Orchestra\Testbench\TestCase;

class InputTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<el-input></el-input>', Input::make());
    }

    public function testSlot()
    {
        self::assertEquals("<el-input><template #prefix><i class='el-icon-home'></i></template></el-input>", Input::make()->slotPrefix(Icon::make('el-icon-home')));
    }
}
