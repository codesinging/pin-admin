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
 * Class Row
 *
 * @method $this gutter(int $gutter)
 * @method $this type(string $type)
 * @method $this justify(string $justify)
 * @method $this align(string $align)
 * @method $this tag(string $tag)
 *
 * @method $this justify_start()
 * @method $this justify_end()
 * @method $this justify_center()
 * @method $this justify_spaceAround()
 * @method $this justify_spaceBetween()
 *
 * @method $this align_top()
 * @method $this align_middle()
 * @method $this align_bottom()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Row extends Component
{
    /**
     * @var Col[]
     */
    protected $cols = [];

    /**
     * Row constructor.
     *
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct(array $attributes = null, bool $linebreak = null)
    {
        parent::__construct($attributes, null, $linebreak);
    }

    /**
     * Make a Row instance.
     *
     * @param array|Closure|self|null $attributes
     * @param bool|null $linebreak
     *
     * @return self
     */
    public static function make($attributes = null, bool $linebreak = null): self
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }

        return $attributes instanceof self ? $attributes : new static($attributes, $linebreak);
    }

    /**
     * Add a Col for the Row.
     *
     * @param array|int|Col|Closure|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return Col
     */
    public function col($span = null, $attributes = null, $content = null, bool $linebreak = null): Col
    {
        $col = Col::make($span, $attributes, $content, $linebreak);
        $this->cols[] = $col;
        return $col;
    }

    /**
     * Add a Col for the Row.
     *
     * @param array|int|Col|Closure|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return $this
     */
    public function addCol($span = null, $attributes = null, $content = null, bool $linebreak = null): self
    {
        $this->col($span, $attributes, $content, $linebreak);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->cols);
    }
}