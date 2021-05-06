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
 * Class Dialog
 *
 * @method $this modelValue(bool $modelValue = true)
 * @method $this title(string $title)
 * @method $this width(string|int $width)
 * @method $this fullscreen(bool $fullscreen = true)
 * @method $this top(string $top)
 * @method $this modal(bool $modal = true)
 * @method $this appendToBody(bool $appendToBody = true)
 * @method $this lockScroll(bool $lockScroll = true)
 * @method $this customClass(string $customClass)
 * @method $this openDelay(int $openDelay)
 * @method $this closeDelay(int $closeDelay)
 * @method $this closeOnClickModal(bool $closeOnClickModal = true)
 * @method $this closeOnPressEscape(bool $closeOnPressEscape = true)
 * @method $this showClose(bool $showClose = true)
 * @method $this center(bool $center = true)
 * @method $this destroyOnClose(bool $destroyOnClose = true)
 *
 * @method $this onOpen(string $handler = null, ...$parameters)
 * @method $this onOpened(string $handler = null, ...$parameters)
 * @method $this onClose(string $handler = null, ...$parameters)
 * @method $this onClosed(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Dialog extends Component
{
    /**
     * Dialog constructor.
     *
     * @param string|array|null $title
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($title = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        is_array($title) and [$attributes, $title] = [$title, null];
        parent::__construct($attributes, $content, $linebreak);
        is_null($title) or $this->set('title', $title);
    }

    /**
     * Make a Dialog instance.
     *
     * @param array|string|self|Closure|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return static
     */
    public static function make($attributes = null, $content = null, bool $linebreak = null): self
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }

        return $attributes instanceof self ? $attributes : new static($attributes, $content, $linebreak);
    }
}