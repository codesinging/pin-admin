<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class ColorPicker
 *
 * @method static $this make(array|string|ColorPicker|Closure|null $model = null, array|null $attributes = null)
 *
 * @method $this value(string $value)
 * @method $this disabled(bool $disabled = true)
 * @method $this size(string $size)
 * @method $this showAlpha(bool $showAlpha = true)
 * @method $this colorFormat(string $colorFormat)
 * @method $this popperClass(string $popperClass)
 * @method $this predefine(array $predefine)
 *
 * @method $this size_large()
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this colorFormat_hsl()
 * @method $this colorFormat_hsv()
 * @method $this colorFormat_hex()
 * @method $this colorFormat_rgb()
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 * @method $this onActiveChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class ColorPicker extends Component
{
    /**
     * ColorPicker constructor.
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