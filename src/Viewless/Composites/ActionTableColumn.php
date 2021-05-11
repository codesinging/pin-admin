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
     * @var Button
     */
    public $editButton;

    /**
     * @var Button
     */
    public $deleteButton;

    /**
     * @var string[]
     */
    protected $attributes = [
        'align' => 'center',
    ];

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
     * @inheritDoc
     */
    protected function initialize(): void
    {
        parent::initialize();

        $this->linebreak();

        $this->editButton = Button::make('编辑')
            ->onClick('onEditItem(scope)')
            ->type_primary()
            ->size_mini();

        $this->deleteButton = Button::make('删除')
            ->onClick('onDeleteItem(scope)')
            ->type_danger()
            ->size_mini();
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();

        $this->slotDefault([
            $this->editButton,
            $this->deleteButton
        ], 'scope', true);
    }
}