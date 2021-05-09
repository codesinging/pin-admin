<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class TimePicker
 *
 * @method static $this make(array|string|TimePicker|Closure|null $model = null, array $attributes = null)
 *
 * @method $this value(string $value)
 * @method $this readonly(bool $readonly = true)
 * @method $this disabled(bool $disabled = true)
 * @method $this editable(bool $editable = true)
 * @method $this clearable(bool $clearable = true)
 * @method $this size(string $size)
 * @method $this placeholder(string $placeholder)
 * @method $this startPlaceholder(string $startPlaceholder)
 * @method $this endPlaceholder(string $endPlaceholder)
 * @method $this isRange(bool $isRange = true)
 * @method $this arrowControl(bool $arrowControl = true)
 * @method $this align(string $align)
 * @method $this popperClass(string $popperClass)
 * @method $this rangeSeparator(string $rangeSeparator)
 * @method $this format(string $format)
 * @method $this defaultValue(string $defaultValue)
 * @method $this name(string $name)
 * @method $this prefixIcon(string $prefixIcon)
 * @method $this clearIcon(string $clearIcon)
 * @method $this disabledHours(string $disabledHours)
 * @method $this disabledMinutes(string $disabledMinutes)
 * @method $this disabledSeconds(string $disabledSeconds)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this align_left()
 * @method $this align_center()
 * @method $this align_right()
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 * @method $this onBlur(string $handler = null, ...$parameters)
 * @method $this onFocus(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class TimePicker extends Component
{
    /**
     * TimePicker constructor.
     *
     * @param array|string|null $model
     * @param array|null $attributes
     */
    public function __construct($model = null, array $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes);
        is_null($model) or $this->vModel($model);
    }
}