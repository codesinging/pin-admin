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
 * Class Col
 *
 * @method $this span(int $span)
 * @method $this offset(int $offset)
 * @method $this push(int $push)
 * @method $this pull(int $pull)
 * @method $this xs(int|array $xs)
 * @method $this sm(int|array $sm)
 * @method $this md(int|array $sm)
 * @method $this lg(int|array $sm)
 * @method $this xl(int|array $sm)
 * @method $this tag(string $tag)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Col extends Component
{
    /**
     * Col constructor.
     *
     * @param array|int|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($span = null, $attributes = null, $content = null, bool $linebreak = null)
    {
        is_array($span) and [$attributes, $span] = [$span, null];
        is_string($attributes) and [$content, $attributes] = [$attributes, null];

        parent::__construct($attributes, $content, $linebreak);

        $span and $this->set('span', $span);
    }

    /**
     * Make a Col instance.
     *
     * @param array|int|self|Closure|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return self
     */
    public static function make($span = null, $attributes = null, $content = null, bool $linebreak = null): self
    {
        if ($span instanceof Closure) {
            $span = call_closure($span, new static());
        }

        return $span instanceof self ? $span : new static($span, $attributes, $content, $linebreak);
    }
}