<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Button
 *
 * @method $this size(string $size)
 * @method $this type(string $type)
 * @method $this plain(bool $plain = true)
 * @method $this round(bool $round = true)
 * @method $this circle(bool $circle = true)
 * @method $this loading(bool $loading = true)
 * @method $this disabled(bool $disabled = true)
 * @method $this icon(string $icon)
 * @method $this autofocus(bool $autofocus = true)
 * @method $this nativeType(string $nativeType)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this type_success()
 * @method $this type_warning()
 * @method $this type_danger()
 * @method $this type_info()
 * @method $this type_text()
 *
 * @method $this onClick(string $handler = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Button extends Component
{
    /**
     * Button constructor.
     *
     * @param string|array|null $text
     * @param string|array|null $type
     * @param array|null $attributes
     */
    public function __construct($text = null, $type = null, $attributes = null)
    {
        if (is_array($text)) {
            parent::__construct($text);
        } else {
            if (is_array($type)) {
                $attributes = $type;
                $type = null;
            }

            parent::__construct($attributes);
            $text and $this->add($text);
            $type and $this->set('type', $type);
        }
    }

    /**
     * Get a Button instance.
     *
     * @param string|array|Closure|self|null $text
     * @param string|array|null $type
     * @param array|null $attributes
     *
     * @return static
     */
    public static function make($text = null, $type = null, $attributes = null): self
    {
        if ($text instanceof Closure) {
            $text = call_closure($text, new static());
        }

        if ($text instanceof self) {
            return $text;
        }

        return new static($text, $type, $attributes);
    }
}