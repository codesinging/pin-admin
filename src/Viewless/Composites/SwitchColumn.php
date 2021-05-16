<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Composites;

use CodeSinging\PinAdmin\Viewless\Components\Switcher;

class SwitchColumn extends CustomColumn
{
    /**
     * @var Switcher
     */
    public $switch;

    /**
     * @inheritDoc
     */
    protected function initialize(): void
    {
        parent::initialize();
        $this->switch = Switcher::make();
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        $this->switch->vModel(sprintf('scope.row.%s', $this->get('prop')))
            ->loading(':state["update_"+scope.row.id]')
            ->onChange('onSwitchChange(scope)');

        $this->add($this->switch);
        parent::ready();
    }
}