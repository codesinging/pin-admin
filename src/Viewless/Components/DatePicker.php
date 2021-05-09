<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class DatePicker
 *
 * @method static $this make(array|string|DatePicker|Closure|null $model=null, array $attributes = null)
 *
 * @method $this value(string|array $value)
 * @method $this readonly(bool $readonly = true)
 * @method $this disabled(bool $disabled = true)
 * @method $this editable(bool $editable = true)
 * @method $this clearable(bool $clearable = true)
 * @method $this size(string $size)
 * @method $this placeholder(string $placeholder)
 * @method $this startPlaceholder(string $startPlaceholder)
 * @method $this endPlaceholder(string $endPlaceholder)
 * @method $this type(string $type)
 * @method $this format(string $format)
 * @method $this align(string $align)
 * @method $this popperClass(string $popperClass)
 * @method $this rangeSeparator(string $rangeSeparator)
 * @method $this defaultValue(string $defaultValue)
 * @method $this defaultTime(array $defaultTime)
 * @method $this name(string $name)
 * @method $this unlinkPanels(bool $unlinkPanels = true)
 * @method $this prefixIcon(string $prefixIcon)
 * @method $this clearIcon(string $clearIcon)
 * @method $this validateEvent(bool $validateEvent = true)
 * @method $this shortcuts(array $shortcuts)
 * @method $this disabledDate(string $disabledDate)
 *
 * @method $this size_large()
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this type_year()
 * @method $this type_month()
 * @method $this type_date()
 * @method $this type_dates()
 * @method $this type_week()
 * @method $this type_datetime()
 * @method $this type_datetimerange()
 * @method $this type_daterange()
 * @method $this type_monthrange()
 *
 * @method $this align_left()
 * @method $this align_center()
 * @method $this align_right()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class DatePicker extends Component
{
    /**
     * DatePicker constructor.
     *
     * @param array|string|null $model
     * @param array|null $attributes
     */
    public function __construct($model=null, array $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes);
        is_null($model) or $this->vModel($model);
    }
}