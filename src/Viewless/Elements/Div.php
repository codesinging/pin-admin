<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Elements;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Element;

class Div extends Element
{
    /**
     * The element's base tag.
     *
     * @var string
     */
    protected $baseTag = 'div';

    /**
     * Div constructor.
     *
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($attributes = null, $content = null, bool $linebreak = null)
    {
        parent::__construct(null, $attributes, $content, true, $linebreak);
    }

    /**
     * Make a div instance.
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