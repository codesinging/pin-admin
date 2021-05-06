<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Slider
 *
 * @method $this value(int $value)
 * @method $this min(int $min)
 * @method $this max(int $max)
 * @method $this disabled(bool $disabled = true)
 * @method $this step(int $step)
 * @method $this showInput(bool $showInput = true)
 * @method $this showInputControls(bool $showInputControls = true)
 * @method $this inputSize(string $inputSize)
 * @method $this showStops(bool $showStops = true)
 * @method $this showTooltip(bool $showTooltip = true)
 * @method $this formatTooltip(string $formatTooltip)
 * @method $this range(bool $range = true)
 * @method $this vertical(bool $vertical = true)
 * @method $this height(string $height)
 * @method $this label(string $label)
 * @method $this debounce(int $debounce)
 * @method $this tooltipClass(string $tooltipClass)
 * @method $this marks(array $marks)
 *
 * @method $this inputSize_large()
 * @method $this inputSize_medium()
 * @method $this inputSize_small()
 * @method $this inputSize_mini()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Slider extends Component
{
    /**
     * Slider constructor.
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
     * Make a Slider instance.
     *
     * @param array|string|self|Closure|null $model
     * @param array|null $attributes
     *
     * @return self
     */
    public static function make($model = null, array $attributes = null): self
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $attributes);
    }
}