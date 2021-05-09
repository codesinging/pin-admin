<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class TimeSelect
 *
 * @method static $this make(array|string|TimeSelect|Closure|null $model = null, array|null $attributes = null)
 *
 * @method $this value(string $value)
 * @method $this editable(bool $editable = true)
 * @method $this clearable(bool $clearable = true)
 * @method $this size(string $size)
 * @method $this placeholder(string $placeholder)
 * @method $this name(string $name)
 * @method $this prefixIcon(string $prefixIcon)
 * @method $this clearIcon(string $clearIcon)
 * @method $this start(string $start)
 * @method $this end(string $end)
 * @method $this step(string $step)
 * @method $this minTime(string $minTime)
 * @method $this maxTime(string $maxTime)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 * @method $this onBlur(string $handler = null, ...$parameters)
 * @method $this onFocus(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class TimeSelect extends Component
{
    /**
     * TimeSelect constructor.
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