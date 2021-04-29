<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Views;

use CodeSinging\PinAdmin\Viewless\Components\Table;

class ModelView extends View
{
    protected $template = 'viewless.model';

    /**
     * @var Table
     */
    public $table;

    /**
     * @inheritDoc
     */
    protected function initialize(): void
    {
        parent::initialize();

        $this->table = Table::make()
            ->data(':lists.data')
            ->linebreak()
            ->border();
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();

        $this->content->add(
            $this->table
        );
    }
}