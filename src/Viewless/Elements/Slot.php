<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Elements;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Element;

class Slot extends Element
{
    /**
     * The element's base tag.
     *
     * @var string
     */
    protected $baseTag = 'template';

    /**
     * Template constructor.
     *
     * @param string|array|null $name
     * @param string|array|Buildable|Closure|null $content
     * @param string|null $prop
     * @param bool|null $linebreak
     */
    public function __construct($name = null, $content = null, string $prop = null, bool $linebreak = null)
    {
        if (is_null($name)) {
            $attributes = [];
        } else {
            if (is_string($name)) {
                $attributes = is_null($prop) ? ["#{$name}"] : ["#{$name}" => $prop];
            } elseif (is_array($name)) {
                $attributes = ["#{$name[0]}" => $name[1]];
            }
        }

        parent::__construct(null, $attributes ?? null, $content, true, $linebreak);
    }

    /**
     * Make a slot instance.
     *
     * @param string|array|Slot|Closure|null $name
     * @param string|array|Buildable|Closure|null $content
     * @param string|null $prop
     * @param bool|null $linebreak
     *
     * @return static
     */
    public static function make($name = null, $content = null, string $prop = null, bool $linebreak = null): self
    {
        if ($name instanceof Closure) {
            $name = call_closure($name, new static());
        }

        return $name instanceof self ? $name : new static($name, $content, $prop, $linebreak);
    }
}