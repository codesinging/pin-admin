<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Elements;

use CodeSinging\PinAdmin\Viewless\Elements\Slot;
use Orchestra\Testbench\TestCase;

class SlotTest extends TestCase
{
    public function testMake()
    {
        self::assertEquals('<template #header></template>', Slot::make('header'));
        self::assertEquals("<template #header='props'></template>", Slot::make('header', null, 'props'));
        self::assertEquals("<template #header='props'></template>", Slot::make(['header', 'props']));
        self::assertEquals("<template #header='props'>content</template>", Slot::make('header', 'content', 'props'));
    }
}
