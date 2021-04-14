<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Css;
use Orchestra\Testbench\TestCase;

class CssTest extends TestCase
{
    public function testAddString()
    {
        self::assertEquals(['m'], (new Css())->add('m')->all());
        self::assertEquals(['m', 'p'], (new Css())->add('m p')->all());
        self::assertEquals(['m', 'p'], (new Css())->add('m')->add('p')->all());
    }

    public function testAddArray()
    {
        self::assertEquals(['m'], (new Css())->add(['m'])->all());
        self::assertEquals(['m', 'p'], (new Css())->add(['m', 'p'])->all());
        self::assertEquals(['m', 'p'], (new Css())->add(['m'])->add(['p'])->all());
    }

    public function testAddCssInstance()
    {
        self::assertEquals(['m'], (new Css())->add(new Css('m'))->all());
    }

    public function testAddClosure()
    {
        self::assertEquals(['m'], (new Css())->add(function () {
            return 'm';
        })->all());
        self::assertEquals(['m'], (new Css())->add(function () {
            return ['m'];
        })->all());
        self::assertEquals(['m'], (new Css())->add(function (Css $css) {
            return $css->add('m');
        })->all());
        self::assertEquals(['m'], (new Css())->add(function (Css $css) {
            $css->add('m');
        })->all());
    }

    public function testAddMultiParams()
    {
        self::assertEquals(['m', 'p'], (new Css())->add(['m'])->add('p')->all());
        self::assertEquals(['m', 'p'], (new Css())->add(['m'])->add(new Css('p'))->all());
    }

    public function testPrepend()
    {
        self::assertEquals(['m', 'p'], (new Css())->add(['p'])->prepend('m')->all());
        self::assertEquals(['m', 'p', 'b'], (new Css())->add(['b'])->prepend('m', 'p')->all());
    }

    public function testUnique()
    {
        self::assertEquals(['m', 'p'], array_values((new Css())->add('m')->add('m p')->all()));
        self::assertEquals(['m', 'p'], (new Css())->add(['m', 'p'])->add(['p'])->all());
    }

    public function testHas()
    {
        self::assertFalse((new Css())->has('m'));
        self::assertTrue((new Css('m'))->has('m'));
    }

    public function testIsEmpty()
    {
        self::assertTrue((new Css())->isEmpty());
        self::assertFalse((new Css('m'))->isEmpty());
    }

    public function testClear()
    {
        self::assertTrue((new Css('m'))->clear()->isEmpty());
    }

    public function testReset()
    {
        self::assertEquals(['m'], (new Css('p'))->reset('m')->all());
    }

    public function testBuild()
    {
        self::assertEquals('m p', new Css('m', 'p'));
    }
}
