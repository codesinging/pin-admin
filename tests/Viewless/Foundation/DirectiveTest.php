<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Builder;
use Orchestra\Testbench\TestCase;

class DirectiveTest extends TestCase
{
    public function testVText()
    {
        self::assertEquals('<div v-text="msg"></div>', (new Builder('div'))->vText('msg'));
    }

    public function testVHtml()
    {
        self::assertEquals('<div v-html="msg"></div>', (new Builder('div'))->vHtml('msg'));
    }

    public function testVShow()
    {
        self::assertEquals("<builder v-show=\"ok\"></builder>", (new Builder())->vShow('ok'));
    }

    public function testVIf()
    {
        self::assertEquals("<builder v-if=\"ok\"></builder>", (new Builder())->vIf('ok'));
    }

    public function testVElseIf()
    {
        self::assertEquals("<builder v-else-if=\"ok\"></builder>", (new Builder())->vElseIf('ok'));
    }

    public function testVElse()
    {
        self::assertEquals("<builder v-else></builder>", (new Builder())->vElse());
    }

    public function testVFor()
    {
        self::assertEquals("<builder v-for=\"item in items\"></builder>", (new Builder())->vFor('item in items'));
    }

    public function testVOn()
    {
        self::assertEquals("<builder @click=\"onClick\"></builder>", (new Builder())->vOn('click', 'onClick')->build());
        self::assertEquals("<builder @click.native=\"onClick\"></builder>", (new Builder())->vOn('click.native', 'onClick')->build());
        self::assertEquals("<builder @click=\"click\" @hover=\"onHover\"></builder>", (new Builder())->vOn(['click' => 'click', 'hover' => 'onHover'])->build());
    }

    public function testVClick()
    {
        self::assertEquals("<builder @click=\"onClick\"></builder>", (new Builder())->vClick('onClick'));
        self::assertEquals("<builder @click.native=\"onClick\"></builder>", (new Builder())->vClick('onClick', 'native'));
    }

    public function testVAssign()
    {
        self::assertEquals("<builder @click=\"disabled = true\"></builder>", (new Builder())->vAssign('disabled', true));
        self::assertEquals("<builder @click=\"disabled = false\"></builder>", (new Builder())->vAssign('disabled', false));
        self::assertEquals("<builder @click=\"age = 20\"></builder>", (new Builder())->vAssign('age', 20));
        self::assertEquals("<builder @click=\"name = \"app\"\"></builder>", (new Builder())->vAssign('name', '"app"')->build());
    }

    public function testVBind()
    {
        self::assertEquals("<builder :id=\"1\"></builder>", (new Builder())->vBind('id', 1)->build());
        self::assertEquals("<builder :visible.sync=\"visible\"></builder>", (new Builder())->vBind('visible.sync', 'visible')->build());
        self::assertEquals("<builder :id=\"1\" :name=\"Name\"></builder>", (new Builder())->vBind(['id' => 1, 'name' => 'Name'])->build());
    }

    public function testVModel()
    {
        self::assertEquals("<builder v-model=\"name\">", (new Builder())->closing(false)->vModel('name'));
        self::assertEquals("<builder v-model.number=\"age\">", (new Builder())->closing(false)->vModel('age', 'number'));
    }

    public function testVPre()
    {
        self::assertEquals("<builder v-pre></builder>", (new Builder())->vPre());
    }

    public function testVCloak()
    {
        self::assertEquals("<builder v-cloak></builder>", (new Builder())->vCloak());
    }

    public function testVOnce()
    {
        self::assertEquals("<builder v-once></builder>", (new Builder())->vOnce());
    }

    public function testRef()
    {
        self::assertEquals("<builder ref=\"table\"></builder>", (new Builder())->ref('table')->build());
    }
}
