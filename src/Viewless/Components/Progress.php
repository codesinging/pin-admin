<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Progress
 *
 * @method static $this make(array|int|Progress|Closure|null $percentage = null, array|null $attributes = null, $content = null)
 *
 * @method $this percentage(int $percentage)
 * @method $this type(string $type)
 * @method $this strokeWidth(int $strokeWidth)
 * @method $this textInside(bool $textInside = true)
 * @method $this status(string $status)
 * @method $this indeterminate(bool $indeterminate = true)
 * @method $this duration(int $duration)
 * @method $this color(string|array $color)
 * @method $this width(int $width)
 * @method $this showText(bool $showText = true)
 * @method $this strokeLinecap(string $strokeLinecap)
 * @method $this format(string $format)
 *
 * @method $this type_line()
 * @method $this type_circle()
 * @method $this type_dashboard()
 *
 * @method $this status_success()
 * @method $this status_exception()
 * @method $this status_warning()
 *
 * @method $this strokeLinecap_butt()
 * @method $this strokeLinecap_round()
 * @method $this strokeLinecap_square()
 *
 * @method $this slotDefault($contents, string $props = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Progress extends Component
{
    /**
     * Progress constructor.
     *
     * @param array|int|null $percentage
     * @param array|null $attributes
     * @param null $content
     */
    public function __construct($percentage = null, array $attributes = null, $content = null)
    {
        is_array($percentage) and [$attributes, $percentage] = [$percentage, null];
        parent::__construct($attributes, $content);
        is_null($percentage) or $this->set('percentage', $percentage);
    }
}