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
 * Class TableColumn
 *
 * @method $this type(string $type)
 * @method $this index(int $index)
 * @method $this columnKey(string $key)
 * @method $this label(string $label)
 * @method $this prop(string $prop)
 * @method $this width(string $width)
 * @method $this minWidth(string $minWidth)
 * @method $this fixed(string|bool $fixed = true)
 * @method $this sortable(bool $sortable = true)
 * @method $this sortBy(string|array $sortBy)
 * @method $this sortOrders(array $sortOrders)
 * @method $this resizable(bool $resizable = true)
 * @method $this showOverflowTooltip(bool $showOverflowTooltip = true)
 * @method $this align(string $align)
 * @method $this headerAlign(string $headerAlign)
 * @method $this className(string $className)
 * @method $this labelClassName(string $labelClassName)
 * @method $this filters(array $filters)
 * @method $this filterPlacement(string $filterPlacement)
 * @method $this filterMultiple(bool $filterMultiple = true)
 *
 *
 * @method $this type_selection()
 * @method $this type_index()
 * @method $this type_expand()
 *
 * @method $this fixed_left()
 * @method $this fixed_right()
 *
 * @method $this align_left()
 * @method $this align_center()
 * @method $this align_right()
 *
 * @method $this headerAlign_left()
 * @method $this headerAlign_center()
 * @method $this headerAlign_right()
 *
 * @method $this slotDefault($contents, string $props = null, bool $linebreak = null)
 * @method $this slotHeader($contents, string $props = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class TableColumn extends Component
{
    /**
     * TableColumn constructor.
     *
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|string|Buildable|Closure|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($prop = null, $label = null, $content = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($prop) and [$attributes, $prop] = [$prop, null];
        is_array($label) and [$attributes, $label] = [$label, null];
        is_array($content) and [$attributes, $content] = [$content, null];

        parent::__construct($attributes, $content, $linebreak);

        is_null($prop) or $this->set('prop', $prop);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make a TableColumn instance.
     *
     * @param array|string|Closure|self|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     *
     * @return static
     */
    public static function make($prop = null, $label = null, array $attributes = null, $content = null): self
    {
        if ($prop instanceof Closure) {
            $prop = call_closure($prop, new static());
        }

        return $prop instanceof self ? $prop : new static($prop, $label, $attributes, $content);
    }
}