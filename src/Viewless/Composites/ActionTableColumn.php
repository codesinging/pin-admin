<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Composites;

use Closure;
use CodeSinging\PinAdmin\Viewless\Components\Button;
use CodeSinging\PinAdmin\Viewless\Components\TableColumn;

/**
 * Class ActionTableColumn
 *
 * @method static $this make(array|string|ActionTableColumn|Closure $label = null, array $attributes = null, bool $linebreak = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Composites
 */
class ActionTableColumn extends TableColumn
{
    /**
     * @var string
     */
    protected $baseTag = 'table-column';

    /**
     * @var Button[]
     */
    protected $buttons = [];

    /**
     * ActionTableColumn constructor.
     *
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($label = null, array $attributes = null, bool $linebreak = null)
    {
        parent::__construct(null, $label, null, $attributes, $linebreak);
    }

    /**
     * Add a button.
     *
     * @param string|array|Closure|self|null $text
     * @param string|array|null $type
     * @param array|null $attributes
     *
     * @return Button
     */
    public function button($text = null, $type = null, $attributes = null): Button
    {
        $button = Button::make($text, $type, $attributes);
        $this->buttons[] = $button;
        return $button;
    }

    /**
     * Add a button.
     *
     * @param string|array|Closure|self|null $text
     * @param string|array|null $type
     * @param array|null $attributes
     *
     * @return $this
     */
    public function addButton($text = null, $type = null, $attributes = null): self
    {
        $this->button($text, $type, $attributes);
        return $this;
    }

    /**
     * Add buttons.
     *
     * @param Button ...$buttons
     *
     * @return $this
     */
    public function addButtons(...$buttons): self
    {
        $this->buttons = array_merge($this->buttons, $buttons);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();

        $this->buttons and $this->slotDefault($this->buttons, 'scope', true);
    }
}