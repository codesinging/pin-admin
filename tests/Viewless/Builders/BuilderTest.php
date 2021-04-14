<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Builders;

use CodeSinging\PinAdmin\Viewless\Builders\Builder;
use Orchestra\Testbench\TestCase;

class BuilderTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<div></div>', new Builder('div'));
        self::assertEquals('<div id="app"></div>', new Builder('div', 'id="app"'));
        self::assertEquals('<div>content</div>', new Builder('div', '', 'content'));
        self::assertEquals('<img>', new Builder('img', '', '', false));
        self::assertEquals('<div>' . PHP_EOL . 'content' . PHP_EOL . '</div>', new Builder('div', '', 'content', true, true));
    }
}
