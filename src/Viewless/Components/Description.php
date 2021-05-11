<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Description
 *
 * @method static $this make(array|string|Description|Closure $title = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this border(bool $border = true)
 * @method $this column(int $column)
 * @method $this direction(string $direction)
 * @method $this size(string $size)
 * @method $this title(string $title)
 * @method $this extra(string $extra)
 *
 * @method $this direction_vertical()
 * @method $this direction_horizontal()
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this slotTitle($contents, string $props = null)
 * @method $this slotExtra($contents, string $props = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Description extends Component
{
    /**
     * @var DescriptionItem[]
     */
    protected $items = [];

    /**
     * Description constructor.
     *
     * @param array|string|null $title
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($title = null, array $attributes = null, bool $linebreak = null)
    {
        parent::__construct($attributes, null, $linebreak);
    }

    /**
     * Add a DescriptionItem.
     *
     * @param array|string|DescriptionItem|Closure|null $label
     * @param array|string|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return DescriptionItem
     */
    public function item($label = null, $content = null, array $attributes = null, bool $linebreak = null): DescriptionItem
    {
        $item = DescriptionItem::make($label, $content, $attributes, $linebreak);
        $this->items[] = $item;
        return $item;
    }

    /**
     * Add a DescriptionItem.
     *
     * @param array|string|DescriptionItem|Closure|null $label
     * @param array|string|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return $this
     */
    public function addItem($label = null, $content = null, array $attributes = null, bool $linebreak = null): self
    {
        $this->item($label, $content, $attributes, $linebreak);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->items);
    }
}