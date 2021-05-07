<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Attribute;
use CodeSinging\PinAdmin\Viewless\Foundation\Builder;
use CodeSinging\PinAdmin\Viewless\Foundation\Content;
use CodeSinging\PinAdmin\Viewless\Foundation\Css;
use CodeSinging\PinAdmin\Viewless\Foundation\Style;
use Illuminate\Config\Repository;
use Orchestra\Testbench\TestCase;

class BuilderTest extends TestCase
{
    public function testClassAttributes()
    {
        self::assertEquals('span', (new TestClassAttribute())->baseTag());
        self::assertEquals('el-span', (new TestClassAttribute())->fullTag());
        self::assertStringNotContainsString('</span>', (new TestClassAttribute())->buildable()->build());
        self::assertStringContainsString(PHP_EOL, (new TestClassAttribute())->buildable()->closing()->build());
        self::assertInstanceOf(Css::class, (new TestClassAttribute())->css);
        self::assertInstanceOf(Style::class, (new TestClassAttribute())->style);
        self::assertInstanceOf(Attribute::class, (new TestClassAttribute())->attribute);
        self::assertEquals('', new TestClassAttribute());
        self::assertInstanceOf(Content::class, (new TestClassAttribute())->content);
    }

    public function testAutoBaseTag()
    {
        self::assertEquals('test-auto-base-tag', (new TestAutoBaseTag())->autoBaseTag());
    }

    public function testBaseTag()
    {
        self::assertEquals('builder', (new Builder())->baseTag());
        self::assertEquals('span', (new Builder())->baseTag('span')->baseTag());
        self::assertEquals('span', (new TestBaseTag())->baseTag());
        self::assertEquals('span', (new Builder())->baseTag('span')->baseTag());
    }

    public function testFullTag()
    {
        self::assertEquals('builder', (new Builder())->fullTag());
        self::assertEquals('el-button', (new TestFullTag('button'))->fullTag());
    }

    public function testClosing()
    {
        self::assertEquals('<img>', (new Builder('img'))->closing(false));
    }

    public function testLinebreak()
    {
        self::assertEquals('<div>' . PHP_EOL . '</div>', (new Builder('div'))->linebreak());
        self::assertEquals('<div>' . PHP_EOL . 'content' . PHP_EOL . '</div>', (new Builder('div', 'content'))->linebreak());
    }

    public function testCss()
    {
        self::assertInstanceOf(Css::class, (new Builder())->css());
        self::assertEquals('<div class="p"></div>', (new Builder('div'))->css('p'));
        self::assertEquals('<div class="p m"></div>', (new Builder('div'))->css('p', 'm'));
    }

    public function testStyle()
    {
        self::assertInstanceOf(Style::class, (new Builder())->style());
        self::assertEquals('<div style="width:1px;"></div>', (new Builder('div'))->style(['width' => '1px'])->build());
        self::assertEquals('<div style="width:1px; height:1px;"></div>', (new Builder('div'))->style(['width' => '1px'], ['height' => '1px'])->build());
    }

    public function testSet()
    {
        self::assertEquals(['id' => 1], (new Builder())->set(['id' => 1])->attribute->all());
        self::assertEquals(['id' => 1], (new Builder())->set('id', 1)->attribute->all());
    }

    public function testGet()
    {
        self::assertEquals(1, (new Builder())->set(['id' => 1])->get('id'));
    }

    public function testAttributes()
    {
        self::assertEquals(['id' => 1], (new Builder())->set(['id' => 1])->attributes());
    }

    public function testAdd()
    {
        self::assertEquals('hello', (new Builder())->add('hello')->contents());
        self::assertEquals('hello world', (new Builder())->add('hello', ' ', 'world')->contents());
        self::assertEquals('ab', (new Builder())->add(['a', 'b'])->contents());
        self::assertEquals('<div></div>', (new Builder())->add(new Builder('div'))->contents());
    }

    public function testPrepend()
    {
        self::assertEquals('ab', (new Builder('div', null, 'b'))->prepend('a')->contents());
        self::assertEquals('abc', (new Builder('div', null, 'c'))->prepend('a', 'b')->contents());
        self::assertEquals('abc', (new Builder('div', null, 'c'))->prepend('b')->prepend('a')->contents());
    }

    public function testInterpolation()
    {
        self::assertEquals('{{ title }}', (new Builder())->interpolation('title')->contents());
    }

    public function testSlot()
    {
        self::assertEquals('<template #title>Title</template>', (new Builder())->slot('title', 'Title')->contents());
        self::assertEquals('<template #title>hello world</template>', (new Builder())->slot('title', ['hello', ' ', 'world'])->contents());
        self::assertEquals('<template #title><div>Title</div></template>', (new Builder())->slot('title', new Builder('div', 'Title'))->contents());
        self::assertEquals('<template #title>Title</template>', (new Builder())->slot('title', function () {
            return 'Title';
        })->contents());
        self::assertEquals('<template #title>Title</template>', (new Builder())->slot('title', function (Content $content) {
            $content->add('Title');
        })->contents());
        self::assertEquals('<template #title="prop">Title</template>', (new Builder())->slot('title', 'Title', 'prop')->contents());
    }

    public function testContents()
    {
        self::assertEquals('hello', (new Builder())->add('hello')->contents());
    }

    public function testBuildable()
    {
        self::assertFalse((new Builder())->buildable(false)->isBuildable());
        self::assertTrue((new Builder())->buildable()->isBuildable());
    }

    public function testIsBuildable()
    {
        self::assertTrue((new Builder())->isBuildable());
    }

    public function testConfig()
    {
        self::assertInstanceOf(Repository::class, (new Builder())->config());

        self::assertEquals(1, (new Builder())->config(['id' => 1])->config('id'));
        self::assertEquals(2, (new Builder())->config(['id' => 1])->config('uid', 2));
    }

    public function testConfigs()
    {
        self::assertEquals(['id' => 1], (new Builder())->config(['id' => 1])->configs());
    }

    public function testCall()
    {
        self::assertEquals('small', (new TestCall())->size('small')->get('size'));
        self::assertTrue((new TestCall())->disabled()->get('disabled'));

        self::assertEquals('small', (new TestCall())->size_small()->get('size'));
        self::assertEquals('medium', (new TestCall())->size_medium()->get('size'));

        self::assertEquals('primary', (new TestCall())->type_primary()->get('type'));
        self::assertEquals('success', (new TestCall())->type_success()->get('type'));

        self::assertEquals('left', (new TestCall())->headerAlign_left()->get('headerAlign'));
        self::assertEquals('<div header-align="left"></div>', (new TestCall('div'))->headerAlign_left()->build());
        self::assertEquals('<div justify="space-around"></div>', (new TestCall('div'))->justify_spaceAround()->build());

        self::assertEquals('<div @click="click"></div>', (new TestCall('div'))->onClick()->build());
        self::assertEquals('<div @select="onSelect"></div>', (new TestCall('div'))->onSelect('onSelect'));
        self::assertEquals('<div @page-change="onPageChange(1, \'lists.size\')"></div>', (new TestCall('div'))->onPageChange('onPageChange', 1, "'lists.size'")->build());

        self::assertEquals('<div><template #header>Header</template></div>', (new TestCall('div'))->slotHeader('Header'));
    }

    public function testCallStatic()
    {
        self::assertEquals('<div></div>', TestCallStatic::make('div'));

        self::assertEquals('<div></div>', TestCallStatic::make(function (TestCallStatic $testCallStatic){
            $testCallStatic->baseTag('div');
        }));

        self::assertEquals('<div></div>', TestCallStatic::make(function (TestCallStatic $testCallStatic){
            return $testCallStatic->baseTag('div');
        }));

        self::assertEquals('<div></div>', TestCallStatic::make(function (){
            return new Builder('div');
        }));

        self::assertEquals('<div></div>', TestCallStatic::make(new Builder('div')));
    }

    public function testInitialize()
    {
        self::assertEquals('span', (new TestInitialize())->baseTag());
    }

    public function testReady()
    {
        self::assertEquals('<span></span>', (new TestReady())->build());
    }

    public function testBuildAboutBuildable()
    {
        self::assertEquals('<div></div>', (new Builder('div'))->build());
        self::assertSame('', (new Builder('div'))->buildable(false)->build());
    }

    public function testBuildAboutCssAttribute()
    {
        self::assertEquals('<div class="m p"></div>', (new Builder('div'))->css('m p'));
    }

    public function testBuildAboutStyleAttribute()
    {
        self::assertEquals('<div style="color:red;"></div>', (new Builder('div'))->style(['color' => 'red']));
    }
}

class TestClassAttribute extends Builder
{
    protected $baseTag = 'span';
    protected $tagPrefix = 'el-';
    protected $closing = false;
    protected $linebreak = true;
    protected $attributes = ['id' => 1];
    protected $buildable = false;
}

class TestAutoBaseTag extends Builder
{
}

class TestBaseTag extends Builder
{
    protected $baseTag = 'span';
}

class TestFullTag extends Builder
{
    protected $tagPrefix = 'el-';
}

/**
 * Class TestCall
 *
 * @method $this size(string $size)
 * @method $this disabled()
 * @method $this size_small()
 * @method $this size_medium()
 * @method $this type_primary()
 * @method $this type_success()
 * @method $this headerAlign_left()
 * @method $this justify_spaceAround()
 * @method $this onClick()
 * @method $this onSelect(string $handler)
 * @method $this onPageChange(string $handler, int $page, string $size)
 *
 * @method $this slotHeader($contents)
 *
 * @package CodeSinging\PinAdminView\Tests\Foundation
 */
class TestCall extends Builder
{
}

/**
 * Class TestCallStatic
 *
 * @method static $this make($tag = null, $attributes = null, $content = null, bool $closing = null, bool $linebreak = null)
 *
 * @package CodeSinging\PinAdmin\Tests\Viewless\Foundation
 */
class TestCallStatic extends Builder
{

}

class TestInitialize extends Builder
{
    protected function initialize(): void
    {
        parent::initialize();
        $this->baseTag('span');
    }
}

class TestReady extends Builder
{
    protected function ready(): void
    {
        parent::ready();
        $this->baseTag('span');
    }
}