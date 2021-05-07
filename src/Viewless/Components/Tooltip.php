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
 * Class Tooltip
 *
 * @method static $this make($tip = null, $content = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this appendToBody(bool $appendToBody = true)
 * @method $this effect(string $effect)
 * @method $this content(string $content)
 * @method $this placement(string $placement)
 *
 * @method $this effect_dark()
 * @method $this effect_light()
 *
 * @method $this placement_top()
 * @method $this placement_topStart()
 * @method $this placement_topEnd()
 * @method $this placement_bottom()
 * @method $this placement_bottomStart()
 * @method $this placement_bottomEnd()
 * @method $this placement_left()
 * @method $this placement_leftStart()
 * @method $this placement_leftEnd()
 * @method $this placement_right()
 * @method $this placement_rightStart()
 * @method $this placement_rightEnd()
 *
 * @method $this value(bool $value = true)
 * @method $this disabled(bool $disabled = true)
 * @method $this offset(int $offset)
 * @method $this transition(string $transition)
 * @method $this visibleArrow(bool $visibleArrow = true)
 * @method $this popperOptions(array $popperOptions)
 * @method $this showAfter(int $showAfter)
 * @method $this hideAfter(int $hideAfter)
 * @method $this autoClose(int $autoClose)
 * @method $this manual(bool $manual = true)
 * @method $this popperClass(string $popperClass)
 * @method $this enterable(bool $enterable = true)
 * @method $this tabindex(int $tabindex)
 *
 * @method $this slotContent($contents, string $props = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Tooltip extends Component
{
    /**
     * Tooltip constructor.
     *
     * @param array|string|null $tip
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($tip = null, $content = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($tip) and [$attributes, $tip] = [$tip, null];
        parent::__construct($attributes, $content, $linebreak);
        is_null($tip) or $this->content($tip);
    }
}