<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Avatar
 *
 * @method static $this make(array|string|Avatar|Closure|null $content = null, array|null $attributes = null, bool $linebreak = null)
 *
 * @method $this icon(string $icon)
 * @method $this size(string|int $size)
 * @method $this shape(string $shape)
 * @method $this src(string $src)
 * @method $this srcSet(string $srcSet)
 * @method $this alt(string $alt)
 * @method $this fit(string $fit)
 *
 * @method $this size_large()
 * @method $this size_medium()
 * @method $this size_small()
 *
 * @method $this shape_circle()
 * @method $this shape_square()
 *
 * @method $this fit_fill()
 * @method $this fit_contain()
 * @method $this fit_cover()
 * @method $this fit_none()
 * @method $this fit_scaleDown()
 *
 * @method $this onError(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Avatar extends Component
{
    /**
     * Avatar constructor.
     *
     * @param array|string|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($content = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content, $linebreak);
    }
}