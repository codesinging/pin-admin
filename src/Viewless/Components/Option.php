<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Option
 *
 * @method $this value(string|int|boolean|array $value)
 * @method $this label(string|int $label)
 * @method $this disabled(bool $disabled = true)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Option extends Component
{
    /**
     * Option constructor.
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     */
    public function __construct($value = null, $label = null, array $attributes = null)
    {
        is_array($value) and [$attributes, $value] = [$value, null];
        is_array($label) and [$attributes, $label] = [$label, null];
        parent::__construct($attributes);
        is_null($value) or $this->set('value', $value);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make an Option instance.
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     * @return self
     */
    public static function make($value = null, $label = null, array $attributes = null): self
    {
        if ($value instanceof Closure) {
            $value = call_closure($value, new static());
        }

        return $value instanceof self ? $value : new static($value, $label, $attributes);
    }
}