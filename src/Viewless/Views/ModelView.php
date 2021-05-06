<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Views;

use Closure;
use CodeSinging\PinAdmin\Viewless\Components\Button;
use CodeSinging\PinAdmin\Viewless\Components\Dialog;
use CodeSinging\PinAdmin\Viewless\Components\Form;
use CodeSinging\PinAdmin\Viewless\Components\Pagination;
use CodeSinging\PinAdmin\Viewless\Components\Table;
use CodeSinging\PinAdmin\Viewless\Elements\Div;

class ModelView extends View
{
    /**
     * The view template.
     *
     * @var string
     */
    protected $template = 'viewless.model';

    /**
     * The add button instance.
     *
     * @var Button
     */
    public $addButton;

    /**
     * The refresh button instance.
     *
     * @var Button
     */
    public $refreshButton;

    /**
     * @var Table
     */
    public $table;

    /**
     * @var Pagination
     */
    public $pagination;

    /**
     * @var bool
     */
    protected $pageable = false;

    /**
     * @var int
     */
    protected $pageSize = 10;

    /**
     * @var Dialog
     */
    public $dialog;

    /**
     * @var Form
     */
    public $form;

    /**
     * @inheritDoc
     */
    protected function initialize(): void
    {
        parent::initialize();

        $this->addButton = Button::make('新增', 'primary')
            ->size_medium()
            ->onClick('onAddButtonClick')
            ->icon('el-icon-plus');

        $this->refreshButton = Button::make('刷新')
            ->size_medium()
            ->onClick('onRefreshButtonClick')
            ->loading(':state.refresh')
            ->icon('el-icon-refresh');

        $this->table = Table::make()
            ->data(':lists.data')
            ->css('mt-3')
            ->vLoading('state.refresh')
            ->linebreak()
            ->border();

        $this->pagination = Pagination::make()
            ->background()
            ->pageSize(':lists.size')
            ->currentPage(':lists.page')
            ->total(':lists.total');

        $this->dialog = Dialog::make()
            ->vModel('dialog.visible');

        $this->form = Form::make(':formData');
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();

        $actionBar = Div::make()
            ->add($this->addButton, $this->refreshButton)
            ->css('space-x-2')
            ->linebreak();

        $headerBar = Div::make()
            ->add($actionBar)
            ->css('flex items-center justify-between')
            ->linebreak();

        $paginationContainer = Div::make()
            ->vIf('lists.data')
            ->css('bg-gray-50 p-2 mt-3')
            ->add($this->pagination);

        $this->config->set('dialog.visible', false);

        $this->config->set('lists.pageable', $this->pageable);
        $this->pageable and $this->config->set('lists.size', $this->pageSize);

        $this->config->set('formData', $this->form->defaults());

        $this->dialog->add($this->form);

        $this->content->add(
            $headerBar,
            $this->table,
            $paginationContainer,
            $this->dialog
        );
    }

    /**
     * Set table for the view.
     *
     * @param Table|Closure $table
     *
     * @return $this
     */
    public function table($table): self
    {
        if ($table instanceof Closure) {
            $table = call_closure($table, $this->table);
        }

        if ($table instanceof Table) {
            $this->table = $table;
        }

        return $this;
    }

    /**
     * Determine if the table is pageable.
     *
     * @param bool $pageable
     *
     * @return $this
     */
    public function pageable(bool $pageable = true): self
    {
        $this->pageable = $pageable;
        return $this;
    }

    /**
     * Determine the item count of each page.
     *
     * @param int $size
     *
     * @return $this
     */
    public function pageSize(int $size): self
    {
        $this->pageSize = $size;
        return $this;
    }

    /**
     * Set Form for the view.
     *
     * @param Form|Closure $form
     *
     * @return $this
     */
    public function form($form): self
    {
        if ($form instanceof Closure) {
            $form = call_closure($form, $this->form);
        }

        if ($form instanceof Form) {
            $this->form = $form;
        }

        return $this;
    }
}