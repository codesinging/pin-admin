<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class InputNumber
 *
 * @method $this modelValue(string $modelValue)
 * @method $this min(int $min)
 * @method $this max(int $max)
 * @method $this step(int $step)
 * @method $this stepStrictly(bool $stepStrictly = true)
 * @method $this precision(int $precision)
 * @method $this size(string $size)
 * @method $this disabled(bool $disabled = true)
 * @method $this controls(bool $controls = true)
 * @method $this controlsPosition(string $controlsPosition)
 * @method $this name(string $name)
 * @method $this label(string $label)
 * @method $this placeholder(string $placeholder)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this controlsPosition_right()
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 * @method $this onBlur(string $handler = null, ...$parameters)
 * @method $this onFocus(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class InputNumber extends Component
{
    /**
     * InputNumber constructor.
     *
     * @param array|string|null $model
     * @param array|null $attributes
     */
    public function __construct($model = null, $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes);
        is_null($model) or $this->vModel($model);
    }

    /**
     * Make a InputNumber instance.
     *
     * @param array|string|self|Closure|null $model
     * @param array|null $attributes
     *
     * @return static
     */
    public static function make($model = null, array $attributes = []): self
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $attributes);
    }
}