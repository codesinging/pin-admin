<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Content;
use Orchestra\Testbench\TestCase;

class ContentTest extends TestCase
{
    public function testConstruct()
    {
        self::assertEquals('abc', new Content('a', 'b', 'c'));
    }

    public function testAddNull()
    {
        $content = new Content(null, null);
        self::assertSame([], $content->all());
        self::assertTrue($content->isEmpty());
        self::assertEmpty($content->build());
    }

    public function testAddEmptyString()
    {
        $content = new Content('');
        $content->glue(',');
        self::assertSame([''], $content->all());
        self::assertFalse($content->isEmpty());
        self::assertEmpty($content->build());

        $content->add('');
        self::assertSame(['', ''], $content->all());
        self::assertSame(',', $content->build());

        $content->add('');
        self::assertSame(['', '', ''], $content->all());
        self::assertSame(',,', $content->build());
    }

    public function testAddString()
    {
        $content = new Content('a');
        $content->glue(',');
        $content->add('b', 'c');
        self::assertSame(['a', 'b', 'c'], $content->all());
        self::assertSame('a,b,c', $content->build());
    }

    public function testAddStringAndNull()
    {
        $content = new Content(null, 'a', null);
        $content->glue(',');
        self::assertSame(['a'], $content->all());
        self::assertSame('a', $content->build());
    }

    public function testAddStringAndEmptyString()
    {
        $content = new Content('a', '', 'b');
        $content->glue(',');
        self::assertSame(['a', '', 'b'], $content->all());
        self::assertSame('a,,b', $content->build());
    }

    public function testAddArray()
    {
        self::assertEquals(['a', 'b', 'c'], (new Content(['a', 'b', 'c']))->all());
        self::assertEquals(['a', 'b', 'c'], (new Content(['a', 'b'], 'c'))->all());
        self::assertEquals(['a', 'b', 'c'], (new Content(['a', 'b'], ['c']))->all());
        self::assertEquals(['a', 'b', 'c'], (new Content(['a', ['b']], ['c']))->all());
    }

    public function testAddClosure()
    {
        self::assertSame('ab', (new Content(function () {
            return 'ab';
        }))->build());

        self::assertSame('ab', (new Content(function (Content $content) {
            $content->add('a', 'b');
        }))->build());

        self::assertSame('ab', (new Content(function (Content $content) {
            return $content->add('a', 'b');
        }))->build());
    }

    public function testAddNumber()
    {
        self::assertSame('123', (new Content(1, 2, 3))->build());
    }

    public function testAddBuildable()
    {
        self::assertEquals('example', new Content(new ContentAddBuildable('example')));
    }

    public function testPrepend()
    {
        $content = new Content('e');
        $content->prepend('c', 'd');
        $content->prepend('a', 'b');
        self::assertEquals('abcde', $content);
    }

    public function testInterpolation()
    {
        self::assertEquals('name:{{ name }}', (new Content('name:'))->interpolation('name'));
    }

    public function testClear()
    {
        self::assertTrue((new Content('a'))->clear()->isEmpty());
    }

    public function testIsEmpty()
    {
        self::assertTrue((new Content())->isEmpty());
    }

    public function testGlue()
    {
        $content = new Content('a', 'b', 'c');
        self::assertEquals('abc', $content);
        self::assertEquals('a,b,c', $content->glue(','));
        self::assertEquals('a' . PHP_EOL . 'b' . PHP_EOL . 'c', $content->glue());
        self::assertEquals('a' . PHP_EOL . PHP_EOL . 'b' . PHP_EOL . PHP_EOL . 'c', $content->glue(2));
    }

    public function testLinebreak()
    {
        $content = new Content('a', 'b', 'c');
        self::assertEquals('a' . PHP_EOL . 'b' . PHP_EOL . 'c', $content->linebreak());
    }

    public function testAll()
    {
        self::assertEquals(['a', 'b'], (new Content('a', 'b'))->all());
    }

    public function testBuild()
    {
        self::assertEquals('ab', (new Content('a', 'b'))->build());
    }
}

class ContentAddBuildable extends Buildable
{
    protected $content;

    public function __construct(string $content = null)
    {
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function build(): string
    {
        return $this->content;
    }
}