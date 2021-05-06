<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Validation;

use Closure;
use Illuminate\Support\Str;

/**
 * Class Rule
 *
 * @method $this type_string()
 * @method $this type_number()
 * @method $this type_boolean()
 * @method $this type_method()
 * @method $this type_regexp()
 * @method $this type_integer()
 * @method $this type_float()
 * @method $this type_array()
 * @method $this type_object()
 * @method $this type_enum()
 * @method $this type_date()
 * @method $this type_url()
 * @method $this type_hex()
 * @method $this type_email()
 *
 * @package CodeSinging\PinAdmin\Viewless\Validation
 */
class Rule
{
    /**
     * The rule data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $commonRules = [
        'required' => ['required' => true, 'message' => '不能为空', 'trigger' => 'change'],
        'date' => ['type' => 'date', 'message' => '类型不正确', 'trigger' => 'change'],
        'number' => ['type' => 'number', 'message' => '类型不正确', 'trigger' => 'change'],
        'email' => ['type' => 'email', 'message' => '类型不正确', 'trigger' => 'change'],
        'integer' => ['type' => 'integer', 'message' => '类型不正确', 'trigger' => 'change'],
        'url' => ['type' => 'url', 'message' => '类型不正确', 'trigger' => 'change'],
        'hex' => ['type' => 'hex', 'message' => '类型不正确', 'trigger' => 'change'],
        'float' => ['type' => 'float', 'message' => '类型不正确', 'trigger' => 'change'],
        'string' => ['type' => 'string', 'message' => '类型不正确', 'trigger' => 'change'],
        'boolean' => ['type' => 'boolean', 'message' => '类型不正确', 'trigger' => 'change'],
    ];

    /**
     * Rule constructor.
     *
     * @param string|array|null $data
     */
    public function __construct($data = null)
    {
        $this->rule($data);
    }

    /**
     * Make a rule instance.
     *
     * @param array|string|Closure|Rule|null $data
     *
     * @return static
     */
    public static function make($data = null): self
    {
        if ($data instanceof Closure) {
            $data = call_closure($data, new static());
        }

        return $data instanceof self ? $data : new static($data);
    }

    /**
     * Set rule data.
     *
     * @param string|array|null $data
     *
     * @return $this
     */
    public function rule($data = null): self
    {
        if (is_array($data)) {
            $this->data = $data;
        } elseif (is_string($data)) {
            if (isset($this->commonRules[$data])) {
                $this->data = $this->commonRules[$data];
            }
        }
        return $this;
    }

    /**
     * Set validator type to use.
     *
     * @param string $type
     *
     * @return $this
     */
    public function type(string $type): self
    {
        $this->data['type'] = $type;
        return $this;
    }

    /**
     * Set required property.
     *
     * @param bool $required
     *
     * @return $this
     */
    public function required(bool $required = true): self
    {
        $this->data['required'] = $required;
        return $this;
    }

    /**
     * @param string $pattern
     *
     * @return $this
     */
    public function pattern(string $pattern): self
    {
        $this->data['pattern'] = $pattern;
        return $this;
    }

    /**
     * @param int $min
     *
     * @return $this
     */
    public function min(int $min): self
    {
        $this->data['min'] = $min;
        return $this;
    }

    /**
     * @param int $max
     *
     * @return $this
     */
    public function max(int $max): self
    {
        $this->data['max'] = $max;
        return $this;
    }

    /**
     * @param int $len
     *
     * @return $this
     */
    public function len(int $len): self
    {
        $this->data['len'] = $len;
        return $this;
    }

    /**
     * @param array $enum
     *
     * @return $this
     */
    public function enum(array $enum = []): self
    {
        $this->data['enum'] = $enum;
        return $this;
    }

    /**
     * @param bool $whitespace
     *
     * @return $this
     */
    public function whitespace(bool $whitespace = true): self
    {
        $this->data['whitespace'] = true;
        return $this;
    }

    /**
     * @param string $transform
     *
     * @return $this
     */
    public function transform(string $transform): self
    {
        $this->data['transform'] = $transform;
        return $this;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function message(string $message): self
    {
        $this->data['message'] = $message;
        return $this;
    }

    /**
     * @param string $validator
     *
     * @return $this
     */
    public function validator(string $validator): self
    {
        $this->data['validator'] = $validator;
        return $this;
    }

    /**
     * @param string $trigger
     *
     * @return $this
     */
    public function trigger(string $trigger): self
    {
        $this->data['trigger'] = $trigger;
        return $this;
    }

    /**
     * @return $this
     */
    public function triggerWhenChange(): self
    {
        $this->trigger('change');
        return $this;
    }

    /**
     * @return $this
     */
    public function triggerWhenBlur(): self
    {
        $this->trigger('blur');
        return $this;
    }

    /**
     * @param string $method
     * @param array $parameters
     *
     * @return $this
     */
    public function __call(string $method, array $parameters = []): self
    {
        if (Str::startsWith($method, 'type_') && strlen($method) > 2) {
            $type = lcfirst(substr($method, 5));
            $this->type($type);
        }

        return $this;
    }

    /**
     * Get the rule data.
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }
}