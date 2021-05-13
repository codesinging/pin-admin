<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Validation;

use CodeSinging\PinAdmin\Viewless\Validation\Rule;
use CodeSinging\PinAdmin\Viewless\Validation\Validate;
use Orchestra\Testbench\TestCase;

class ValidateTest extends TestCase
{
    public function testMake()
    {
        self::assertEquals(
            [
                'both' => [['required' => true], ['type' => 'number']],
                'add' => [],
                'edit' => [],
            ],
            Validate::make(['required' => true], ['type' => 'number'])->data()
        );

        self::assertEquals([
            'both' => [['type' => 'email', 'message' => '类型不正确', 'trigger' => 'change']],
            'add' => [],
            'edit' => [],
        ], Validate::make('email')->data());
    }

    public function testRule()
    {
        self::assertEquals(
            [
                'both' => [['required' => true], ['type' => 'number']],
                'add' => [],
                'edit' => [],
            ],
            (new Validate())->rule(['required' => true], ['type' => 'number'])->data()
        );
        self::assertEquals(
            [
                'both' => [['required' => true], ['type' => 'number']],
                'add' => [],
                'edit' => [],
            ],
            (new Validate())->rule(Rule::make()->required(), Rule::make(['type' => 'number']))->data()
        );
    }

    public function testRuleScene()
    {
        self::assertEquals(
            [
                'both' => [],
                'add' => [['required' => true], ['type' => 'number']],
                'edit' => [],
            ],
            (new Validate())->rule_add(['required' => true], ['type' => 'number'])->data()
        );
        self::assertEquals(
            [
                'both' => [['required' => true]],
                'add' => [],
                'edit' => [['type' => 'number']],
            ],
            (new Validate())->rule(Rule::make()->required())->rule_edit(Rule::make(['type' => 'number']))->data()
        );
    }
}
