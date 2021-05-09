<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Rate
 *
 * @method static $this make(array|string|Rate|Closure|null $model = null, array|null $attributes = null)
 *
 * @method $this value(int $value)
 * @method $this max(int $max)
 * @method $this disabled(bool $disabled = true)
 * @method $this allowHalf(bool $allowHalf = true)
 * @method $this lowThreshold(int $lowThreshold)
 * @method $this highThreshold(int $highThreshold)
 * @method $this colors(array $colors)
 * @method $this voidColor(string $voidColor)
 * @method $this disabledVoidColor(string $disabledVoidColor)
 * @method $this iconClasses(array $iconClasses)
 * @method $this voidIconClass(string $voidIconClass)
 * @method $this disabledVoidIconClass(string $disabledVoidIconClass)
 * @method $this showText(bool $showText = true)
 * @method $this showScore(bool $showScore = true)
 * @method $this textColor(string $textColor)
 * @method $this texts(array $texts)
 * @method $this scoreTemplate(string $scoreTemplate)
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Rate extends Component
{
    /**
     * Rate constructor.
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