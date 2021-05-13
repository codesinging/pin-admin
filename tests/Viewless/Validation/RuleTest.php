<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Validation;

use CodeSinging\PinAdmin\Viewless\Validation\Rule;
use Orchestra\Testbench\TestCase;

class RuleTest extends TestCase
{
    public function testMake()
    {
        self::assertInstanceOf(Rule::class, Rule::make());

        self::assertEquals([], Rule::make()->data());

        self::assertEquals(['required' => true], (new Rule(['required' => true]))->data());
        self::assertEquals(['type' => 'number'], Rule::make(['type' => 'number'])->data());

        self::assertEquals(['required' => true, 'message' => '不能为空', 'trigger' => 'change'], Rule::make('required')->data());

        self::assertEquals(['type' => 'number'], Rule::make(function () {
            return ['type' => 'number'];
        })->data());
        self::assertEquals(['type' => 'number'], Rule::make(function (Rule $rule) {
            return $rule->type_number();
        })->data());
        self::assertEquals(['type' => 'number'], Rule::make(function (Rule $rule) {
            $rule->type_number();
        })->data());

        self::assertEquals(['type' => 'number'], Rule::make(Rule::make(['type' => 'number']))->data());
        self::assertEquals(['type' => 'number'], Rule::make()->type('number')->data());
    }

    public function testCalls()
    {
        self::assertEquals(['type' => 'number'], Rule::make()->type_number()->data());
    }

    public function testScene()
    {
        self::assertEquals('both', Rule::make()->scene());
        self::assertEquals('add', Rule::make()->scene('add')->scene());
        self::assertEquals('add', Rule::make()->scene_add()->scene());
        self::assertEquals('edit', Rule::make()->scene_edit()->scene());
    }
}
