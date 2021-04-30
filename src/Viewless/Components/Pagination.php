<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Pagination
 *
 * @method $this small(bool $small = true)
 * @method $this background(bool $background = true)
 * @method $this pageSize(int $pageSize)
 * @method $this total(int $total)
 * @method $this pageCount(int $pageCount)
 * @method $this pagerCount(int $pagerCount)
 * @method $this currentPage(int $currentPage)
 * @method $this layout(string $layout)
 * @method $this pageSizes(int[] $pageSizes)
 * @method $this popperClass(string $popperClass)
 * @method $this prevText(string $prevText)
 * @method $this nextText(string $nextText)
 * @method $this disabled(bool $disabled = true)
 * @method $this hideOnSinglePage(bool $hideOnSinglePage = true)
 *
 * @method $this onSizeChange(string $handler = null, ...$parameters)
 * @method $this onCurrentChange(string $handler = null, ...$parameters)
 * @method $this onPrevClick(string $handler = null, ...$parameters)
 * @method $this onNextClick(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Pagination extends Component
{
    /**
     * Pagination constructor.
     *
     * @param array|null $attributes
     */
    public function __construct($attributes = null)
    {
        parent::__construct($attributes);
    }

    /**
     * Make a Pagination instance.
     *
     * @param array|Closure|self $attributes
     *
     * @return $this
     */
    public static function make($attributes = null): self
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }

        return $attributes instanceof self ? $attributes : new static($attributes);
    }
}