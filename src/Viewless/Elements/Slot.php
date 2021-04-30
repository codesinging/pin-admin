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
     * @param string|array|null $property
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($property = null, $content = null, bool $linebreak = null)
    {
        $attributes = [];
        if (is_string($property)) {
            $attributes = ["#{$property}"];
        } elseif (is_array($property)) {
            foreach ($property as $key => $value) {
                $attributes["#{$key}"] = $value;
            }
        }
        parent::__construct(null, $attributes, $content, true, $linebreak);
    }

    /**
     * Make a slot instance.
     *
     * @param string|array|self|Closure|null $property
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return static
     */
    public static function make($property = null, $content = null, bool $linebreak = null): self
    {
        if ($property instanceof Closure) {
            $property = call_closure($property, new static());
        }

        return $property instanceof self ? $property : new static($property, $content, $linebreak);
    }
}