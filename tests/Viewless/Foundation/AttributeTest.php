<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Attribute;
use Orchestra\Testbench\TestCase;

class AttributeTest extends TestCase
{
    public function testSet()
    {
        self::assertEquals([], (new Attribute())->all());
        self::assertEquals([], (new Attribute())->set(null)->all());
        self::assertEquals([], (new Attribute())->set('')->all());
        self::assertEquals(['id' => 1], (new Attribute('id', 1))->all());
        self::assertEquals(['id' => 1], (new Attribute(['id' => 1]))->all());
        self::assertEquals(['id' => 1], (new Attribute())->set('id', 1)->all());
        self::assertEquals(['id' => 1], (new Attribute())->set(['id' => 1])->all());
        self::assertEquals(['id' => 1, 'name' => 'pin'], (new Attribute('id', 1))->set('name', 'pin')->all());
        self::assertEquals(['id' => 1, 'name' => 'pin'], (new Attribute(['id' => 1]))->set('name', 'pin')->all());
        self::assertEquals(['id' => 1, 'name' => 'pin'], (new Attribute())->set('id', 1)->set('name', 'pin')->all());
        self::assertEquals(['id' => 1, 'name' => 'pin'], (new Attribute())->set(['id' => 1])->set('name', 'pin')->all());
        self::assertEquals(['disabled' => null], (new Attribute(['disabled']))->all());
    }

    public function testGet()
    {
        self::assertEquals(1, (new Attribute('id', 1))->get('id'));
        self::assertEquals(null, (new Attribute())->get('name'));
        self::assertEquals('pin', (new Attribute())->get('name', 'pin'));
    }

    public function testHas()
    {
        self::assertFalse((new Attribute())->has('name'));
        self::assertFalse((new Attribute('id', 1))->has('name'));
        self::assertTrue((new Attribute('id', 1))->has('id'));
    }

    public function testRemove()
    {
        $attribute = new Attribute(["id" => "1"]);
        self::assertTrue($attribute->has("id"));
        $attribute->remove("id");
        self::assertFalse($attribute->has("id"));
    }

    public function testIsEmpty()
    {
        $attribute = new Attribute();
        self::assertTrue($attribute->isEmpty());
        $attribute->set("title", "Title");
        self::assertFalse($attribute->isEmpty());
    }

    public function testClear()
    {
        self::assertTrue((new Attribute(["id" => 1]))->clear()->isEmpty());
    }

    public function testAll()
    {
        self::assertEquals(["id" => 1], (new Attribute(["id" => 1]))->all());
    }

    public function testParse()
    {
        self::assertEquals('', (new Attribute())->parse(null));
        self::assertEquals('', (new Attribute())->parse(''));

        self::assertEquals(':name="pin"', (new Attribute())->parse(':name', 'pin'));
        self::assertEquals(':name="pin"', (new Attribute())->parse(':name', ':pin'));

        self::assertEquals('name="pin"', (new Attribute())->parse('name', 'pin'));
        self::assertEquals(':name="pin"', (new Attribute())->parse('name', ':pin'));

        self::assertEquals('name=":pin"', (new Attribute())->parse('name', '\:pin'));

        self::assertEquals(':disabled="true"', (new Attribute())->parse('disabled', true));
        self::assertEquals(':disabled="false"', (new Attribute())->parse('disabled', false));
        self::assertEquals(':disabled="true"', (new Attribute())->parse('disabled', null, true));

        self::assertEquals('id="1"', (new Attribute())->parse('id', '1'));
        self::assertEquals(':id="1"', (new Attribute())->parse('id', 1));
        self::assertEquals(':id="1.1"', (new Attribute())->parse('id', 1.1));

        self::assertEquals(':class="["margin"]"', (new Attribute())->parse("class", ['margin']));
        self::assertEquals(':data="{"title":"Title"}"', (new Attribute())->parse("data", ['title' => "Title"]));

        self::assertEquals('disabled', (new Attribute())->parse('disabled'));

        self::assertEquals('first-name="pin"', (new Attribute())->parse('firstName', 'pin'));
    }

    public function testBuild()
    {
        self::assertEquals('', (new Attribute()));
        self::assertEquals("id=\"1\"", (new Attribute(["id" => "1"])));
        self::assertEquals("disabled", (new Attribute(["disabled"]))->build());
        self::assertEquals("disabled readonly", new Attribute(["disabled", "readonly"]));
        self::assertEquals('disabled title="Title"', new Attribute(["disabled", "title" => 'Title']));
    }
}
