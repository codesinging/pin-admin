<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Validation;

class Validate
{
    /**
     * The validation rules.
     *
     * @var Rule[]
     */
    protected $rules = [];

    /**
     * Validate constructor.
     *
     * @param array|string|Closure|Rule ...$rules
     */
    public function __construct(...$rules)
    {
        $this->rule(...$rules);
    }

    /**
     * Make a Validate instance.
     *
     * @param array|string|Closure|Rule ...$rules
     *
     * @return self
     */
    public static function make(...$rules): self
    {
        return new static(...$rules);
    }

    /**
     * Add validation rules.
     *
     * @param array|string|Closure|Rule ...$rules
     *
     * @return $this
     */
    public function rule(...$rules): self
    {
        foreach ($rules as $rule) {
            $this->rules[] = Rule::make($rule);
        }
        return $this;
    }

    /**
     * Add validation rules.
     *
     * @param array|string|Closure|Rule ...$rules
     *
     * @return $this
     */
    public function rule_add(...$rules): self
    {
        foreach ($rules as $rule) {
            $this->rules[] = Rule::make($rule)->scene_add();
        }
        return $this;
    }

    /**
     * Add validation rules.
     *
     * @param array|string|Closure|Rule ...$rules
     *
     * @return $this
     */
    public function rule_edit(...$rules): self
    {
        foreach ($rules as $rule) {
            $this->rules[] = Rule::make($rule)->scene_edit();
        }
        return $this;
    }

    /**
     * Get all rules.
     *
     * @return Rule[]
     */
    public function rules(): array
    {
        return $this->rules;
    }

    /**
     * Get all rules data.
     *
     * @return array
     */
    public function data(): array
    {
        $data = [
            'both' => [],
            'add' => [],
            'edit' => []
        ];
        foreach ($this->rules as $rule) {
            $data[$rule->scene()][] = $rule->data();
        }

        return $data;
    }
}