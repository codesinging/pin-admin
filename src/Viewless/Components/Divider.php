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
 * Class Divider
 *
 * @method static $this make(array|string|Buildable $content = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this direction(string $direction)
 * @method $this contentPosition(string $contentPosition)
 *
 * @method $this direction_horizontal()
 * @method $this direction_vertical()
 *
 * @method $this contentPosition_left()
 * @method $this contentPosition_center()
 * @method $this contentPosition_right()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Divider extends Component
{
    /**
     * Divider constructor.
     *
     * @param array|string|Buildable|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($content = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content, $linebreak);
    }
}