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
 * Class Radio
 *
 * @method $this value(string|int|boolean $value)
 * @method $this label(string|int|boolean $label)
 * @method $this disabled(bool $disabled = true)
 * @method $this border(bool $border = true)
 * @method $this size(string $size)
 * @method $this name(string $name)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Radio extends Component
{
    /**
     * Radio constructor.
     *
     * @param array|string|null $model
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     */
    public function __construct($model = null, $label = null, $content = null, array $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        is_array($label) and [$attributes, $label] = [$label, null];
        is_array($content) and [$attributes, $content] = [$content, null];

        parent::__construct($attributes, $content);

        is_null($model) or $this->vModel($model);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make a Radio instance.
     *
     * @param array|string|null $model
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return self
     */
    public static function make($model = null, $label = null, $content = null, array $attributes = null): self
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $label, $content, $attributes);
    }
}