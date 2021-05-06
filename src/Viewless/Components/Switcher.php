<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Switcher
 *
 * @method $this value(string|int|boolean $value)
 * @method $this disabled(bool $disabled = true)
 * @method $this loading(bool $loading = true)
 * @method $this width(int $width)
 * @method $this activeIconClass(string $activeIconClass)
 * @method $this inactiveIconClass(string $inactiveIconClass)
 * @method $this activeText(string $activeText)
 * @method $this inactiveText(string $inactiveText)
 * @method $this activeValue(string|int|boolean $activeValue)
 * @method $this inactiveValue(string|int|boolean $activeValue)
 * @method $this activeColor(string $activeColor)
 * @method $this inactiveColor(string $inactiveColor)
 * @method $this name(string $name)
 * @method $this validateEvent(bool $validateEvent = true)
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Switcher extends Component
{
    protected $baseTag = 'switch';

    /**
     * Switcher constructor.
     *
     * @param array|string|null $model
     * @param array|null $attributes
     */
    public function __construct($model = null, array $attributes = null)
    {
        parent::__construct($attributes);
        is_null($model) or $this->vModel($model);
    }

    /**
     * Make a Switcher instance.
     *
     * @param array|string|self|Closure|null $model
     * @param array|null $attributes
     *
     * @return static
     */
    public static function make($model = null, array $attributes = null): self
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $attributes);
    }
}