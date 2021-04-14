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
    public function testConstruct()
    {
        self::assertEquals('disabled title="Title"', (new Attribute(["disabled", "title" => "Title"]))->build());
        self::assertEquals('disabled title="Title"', (new Attribute(["disabled"], ["title" => "Title"]))->build());
    }

    public function testSetWhenKeyIsNull()
    {
        self::assertEquals("", (new Attribute())->set(null)->build());
    }

    public function testSetWhenKeyIsString()
    {
        self::assertEquals('title="Title"', (new Attribute())->set("title", "Title"));
        self::assertEquals('disabled', (new Attribute())->set('disabled'));
    }

    public function testSetWhenKeyIsArray()
    {
        self::assertEquals('title="Title"', (new Attribute())->set(["title" => "Title"]));
        self::assertEquals('disabled', (new Attribute())->set(['disabled']));
    }

    public function testSetWhenKeyIsAttribute()
    {
        self::assertEquals('title="Title"', (new Attribute())->set(new Attribute(["title" => "Title"])));
    }

    public function testSetWhenKeyIsClosure()
    {
        self::assertEquals('title="Title"', (new Attribute())->set(function () {
            return ["title" => "Title"];
        }));
        self::assertEquals('title="Title"', (new Attribute())->set(function (Attribute $attribute) {
            return $attribute->set(["title" => "Title"]);
        }));
        self::assertEquals('title="Title"', (new Attribute())->set(function (Attribute $attribute) {
            $attribute->set(["title" => "Title"]);
        }));
    }

    public function testGet()
    {
        self::assertEquals('Title', (new Attribute(['title' => 'Title']))->get('title'));
        self::assertEquals(null, (new Attribute(['title' => 'Title']))->get('name'));
        self::assertEquals('Name', (new Attribute(['title' => 'Title']))->get('name', 'Name'));
    }

    public function testHas()
    {
        $attribute = new Attribute();
        self::assertFalse($attribute->has("title"));
        $attribute->set("title", "Title");
        self::assertTrue($attribute->has("title"));
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
        self::assertArrayHasKey("id", (new Attribute(["id" => 1]))->all());
    }

    public function testPlaceholder()
    {
        $placeholders = [
            '@.' => 'properties.id.',
            '#.' => 'configs.id.',
            '\@\.' => '@.',
            '\#\.' => '#.',
        ];

        self::assertEquals(':visible="visible"', (new Attribute([':visible' => 'visible']))->placeholder($placeholders)->build());
        self::assertEquals(':visible="properties.id.visible"', (new Attribute([':visible' => '@.visible']))->placeholder($placeholders)->build());
        self::assertEquals(':visible="configs.id.visible"', (new Attribute([':visible' => '#.visible']))->placeholder($placeholders)->build());
        self::assertEquals(':visible="@."', (new Attribute([':visible' => '\@\.']))->placeholder($placeholders)->build());
        self::assertEquals(':visible="#."', (new Attribute([':visible' => '\#\.']))->placeholder($placeholders)->build());
    }

    public function testBuild()
    {
        self::assertEquals("id=\"1\"", (new Attribute(["id" => "1"])));
        self::assertEquals("disabled", new Attribute(["disabled"]));
        self::assertEquals("disabled readonly", new Attribute(["disabled", "readonly"]));
        self::assertEquals('disabled title="Title"', new Attribute(["disabled", "title" => 'Title']));
    }
}
