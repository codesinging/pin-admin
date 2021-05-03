<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Input
 *
 * @method $this type(string $type)
 * @method $this modelValue(string $modelValue)
 * @method $this maxlength(int $maxlength)
 * @method $this minlength(int $minlength)
 * @method $this showWordLimit(bool $showWordLimit = true)
 * @method $this placeholder(string $placeholder)
 * @method $this clearable(bool $clearable = true)
 * @method $this showPassword(bool $showPassword = true)
 * @method $this disabled(bool $disabled = true)
 * @method $this size(string $size)
 * @method $this prefixIcon(string $prefixIcon)
 * @method $this suffixIcon(string $suffixIcon)
 * @method $this autocomplete(string $autocomplete)
 * @method $this name(string $name)
 * @method $this readonly(bool $readonly = true)
 * @method $this max(int $max)
 * @method $this min(int $min)
 * @method $this step(int $step)
 * @method $this autofocus(bool $autofocus = true)
 * @method $this form(string $form)
 * @method $this label(string $label)
 * @method $this tabindex(string $tabindex)
 * @method $this validateEvent(bool $validateEvent = true)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this autocomplete_on()
 * @method $this autocomplete_off()
 *
 * @method $this slotPrefix($contents, string $props = null)
 * @method $this slotSuffix($contents, string $props = null)
 * @method $this slotPrepend($contents, string $props = null)
 * @method $this slotAppend($contents, string $props = null)
 *
 * @method $this onBlur(string $handler = null, ...$parameters)
 * @method $this onFocus(string $handler = null, ...$parameters)
 * @method $this onChange(string $handler = null, ...$parameters)
 * @method $this onInput(string $handler = null, ...$parameters)
 * @method $this onClear(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Input extends Component
{
    /**
     * Input constructor.
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
     * Make a Input instance.
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