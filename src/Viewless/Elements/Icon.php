<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Elements;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Element;

class Icon extends Element
{
    /**
     * Icon constructor.
     *
     * @param string|null $icon
     * @param array|null $attributes
     */
    public function __construct(string $icon = null, array $attributes = null)
    {
        parent::__construct('i', $attributes);
        $icon and $this->css($icon);
    }

    /**
     * Make a Icon instance.
     *
     * @param string|self|Closure|null $icon
     * @param array|null $attributes
     *
     * @return static
     */
    public static function make($icon = null, array $attributes = null): self
    {
        if ($icon instanceof Closure) {
            $icon = call_closure($icon, new static());
        }

        return $icon instanceof self ? $icon : new static($icon, $attributes);
    }
}