<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Checkbox
 * 
 * @method $this value(string|int|boolean $value)
 * @method $this label(string|int|boolean $label)
 * @method $this trueLabel(string|int $trueLabel)
 * @method $this falseLabel(string|int $trueLabel)
 * @method $this disabled(bool $disabled = true)
 * @method $this border(bool $border = true)
 * @method $this size(string $size)
 * @method $this name(string $name)
 * @method $this checked(bool $checked = true)
 * @method $this indeterminate(bool $indeterminate = true)
 * 
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Checkbox extends Component
{
    /**
     * Checkbox constructor.
     *
     * @param array|string|null $model
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     */
    public function __construct($model = null,  $content = null, array $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        is_array($content) and [$attributes, $content] = [$content, null];

        parent::__construct($attributes, $content);

        is_null($model) or $this->vModel($model);
    }

    /**
     * Make a Checkbox instance.
     *
     * @param array|string|null $model
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return self
     */
    public static function make($model = null, $content = null, array $attributes = null): self
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $content, $attributes);
    }
}