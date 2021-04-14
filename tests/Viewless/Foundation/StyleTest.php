<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Style;
use Orchestra\Testbench\TestCase;

class StyleTest extends TestCase
{
    public function testAddString()
    {
        self::assertEquals(['width' => '1px'], (new Style())->add('width:1px')->all());
        self::assertEquals(['width' => '1px', 'height' => '2px'], (new Style())->add('width:1px;height:2px')->all());
    }

    public function testAddArray()
    {
        self::assertEquals(['width' => '1px'], (new Style())->add(['width' => '1px'])->all());
        self::assertEquals(['width' => '1px', 'height' => '2px'], (new Style())->add(['width' => '1px', 'height' => '2px'])->all());
    }

    public function testAddStyleObject()
    {
        self::assertEquals(['width' => '1px'], (new Style())->add(new Style(['width' => '1px']))->all());
    }

    public function testAddClosure()
    {
        self::assertEquals(['width' => '1px'], (new Style(function () {
            return ['width' => '1px'];
        }))->all());
        self::assertEquals(['width' => '1px'], (new Style(function (Style $style) {
            return $style->add(['width' => '1px']);
        }))->all());
        self::assertEquals(['width' => '1px'], (new Style(function (Style $style) {
            $style->add(['width' => '1px']);
        }))->all());
    }

    public function testAddMultiParams()
    {
        self::assertEquals(['width' => '1px', 'height' => '2px'], (new Style())->add(['width' => '1px'], 'height:2px')->all());
    }

    public function testPrepend()
    {
        self::assertEquals(['width' => '1px', 'height' => '2px'], (new Style('height:2px'))->prepend(['width' => '1px'])->all());
    }

    public function testIsEmpty()
    {
        self::assertTrue((new Style())->isEmpty());
        self::assertFalse((new Style('width:1px'))->isEmpty());
    }

    public function testClear()
    {
        self::assertTrue((new Style('width:1px'))->clear()->isEmpty());
    }

    public function testReset()
    {
        self::assertEquals(['width' => '1px'], (new Style('height:2px'))->reset('width:1px')->all());
    }

    public function testAll()
    {
        self::assertEquals(['width' => '1px'], (new Style('width:1px'))->all());
    }

    public function testBuild()
    {
        self::assertEquals('width:1px;', (new Style('width:1px')));
        self::assertEquals('width:1px; height:2px;', (new Style('width:1px'))->add('height:2px'));
    }
}
