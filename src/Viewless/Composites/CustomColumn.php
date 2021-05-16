<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Composites;

use CodeSinging\PinAdmin\Viewless\Components\TableColumn;

class CustomColumn extends TableColumn
{
    /**
     * @var string
     */
    protected $baseTag = 'table-column';

    /**
     * CustomColumn constructor.
     *
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($prop = null, $label = null, array $attributes = null, bool $linebreak = null)
    {
        is_null($linebreak) and $linebreak = true;
        parent::__construct($prop, $label, null, $attributes, $linebreak);
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $contents = $this->contents();
        $this->content->clear();
        $this->slotDefault($contents, 'scope', true);
    }
}