<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Composites\ActionTableColumn;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Table
 *
 * @method $this data(array|string $data)
 * @method $this height(string|int $height)
 * @method $this maxHeight(string|int $maxHeight)
 * @method $this stripe(bool $stripe = true)
 * @method $this border(bool $border = true)
 * @method $this size(string $size)
 * @method $this fit(bool $fit = true)
 * @method $this showHeader(bool $showHeader = true)
 * @method $this highlightCurrentRow(bool $highlightCurrentRow = true)
 * @method $this currentRowKey(string|int $currentRowKey)
 * @method $this rowClassName(string $rowClassName)
 * @method $this rowStyle(array $rowStyle)
 * @method $this cellClassName(string $cellClassName)
 * @method $this cellStyle(array $cellStyle)
 * @method $this headerRowClassName(string $headerRowClassName)
 * @method $this headerRowStyle(array $headerRowStyle)
 * @method $this headerCellClassName(string $headerCellClassName)
 * @method $this headerCellStyle(array $headerCellStyle)
 * @method $this rowKey(string $rowKey)
 * @method $this emptyText(string $emptyText)
 * @method $this defaultExpandAll(bool $defaultExpandAll = true)
 * @method $this expandRowKeys(array $expandRowKeys)
 * @method $this defaultSort(array $defaultSort)
 * @method $this tooltipEffect(string $tooltipEffect)
 * @method $this showSummary(bool $showSummary = true)
 * @method $this sumText(string $sumText)
 * @method $this indent(int $indent)
 * @method $this lazy(bool $lazy = true)
 * @method $this treeProps(array $treeProps)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this tooltipEffect_dark()
 * @method $this tooltipEffect_light()
 *
 * @method $this onSelect(string $handler = null, ...$parameters)
 * @method $this onSelectAll(string $handler = null, ...$parameters)
 * @method $this onSelectChange(string $handler = null, ...$parameters)
 * @method $this onCellMouseEnter(string $handler = null, ...$parameters)
 * @method $this onCellMouseLeave(string $handler = null, ...$parameters)
 * @method $this onCellClick(string $handler = null, ...$parameters)
 * @method $this onCellDblclick(string $handler = null, ...$parameters)
 * @method $this onRowClick(string $handler = null, ...$parameters)
 * @method $this onRowContextmenu(string $handler = null, ...$parameters)
 * @method $this onRowDblclick(string $handler = null, ...$parameters)
 * @method $this onHeaderClick(string $handler = null, ...$parameters)
 * @method $this onHeaderContextmenu(string $handler = null, ...$parameters)
 * @method $this onSortChange(string $handler = null, ...$parameters)
 * @method $this onFilterChange(string $handler = null, ...$parameters)
 * @method $this onCurrentChange(string $handler = null, ...$parameters)
 * @method $this onHeaderDragend(string $handler = null, ...$parameters)
 * @method $this onExpandChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Table extends Component
{
    /**
     * @var TableColumn[]
     */
    protected $columns = [];

    /**
     * Table constructor.
     *
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        parent::__construct($attributes);
        $this->linebreak();
    }

    /**
     * @param array|Closure|self|null $attributes
     *
     * @return Table|static
     */
    public static function make(array $attributes = null): self
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }
        return $attributes instanceof self ? $attributes : new static($attributes);
    }

    /**
     * Add a TableColumn.
     *
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     *
     * @return TableColumn
     */
    public function column($prop = null, $label = null, array $attributes = null, $content = null): TableColumn
    {
        $column = TableColumn::make($prop, $label, $attributes, $content);
        $this->columns[] = $column;
        return $column;
    }

    /**
     * Add a TableColumn.
     *
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     *
     * @return $this
     */
    public function addColumn($prop = null, $label = null, array $attributes = null, $content = null): self
    {
        $this->column($prop, $label, $attributes, $content);
        return $this;
    }

    /**
     * Add an `id` column.
     *
     * @param array $attributes
     *
     * @return TableColumn
     */
    public function columnId(array $attributes = []): TableColumn
    {
        return $this->column('id', 'ID', $attributes)->align_center();
    }

    /**
     * Add a `created_at` column.
     *
     * @param array|string|null $label
     * @param array $attributes
     *
     * @return TableColumn
     */
    public function columnCreatedAt($label = null, array $attributes = []): TableColumn
    {
        is_array($label) and [$attributes, $label] = [$label, '创建时间'];
        is_null($label) and $label = '创建时间';
        return $this->column('created_at', $label, $attributes);
    }

    /**
     * Add a `updated_at` column.
     *
     * @param array|string|null $label
     * @param array $attributes
     *
     * @return TableColumn
     */
    public function columnUpdatedAt($label = null, array $attributes = []): TableColumn
    {
        is_array($label) and [$attributes, $label] = [$label, '更新时间'];
        is_null($label) and $label = '更新时间';
        return $this->column('updated_at', $label, $attributes);
    }

    /**
     * Add an ActionTableColumn.
     *
     * @param array|string|ActionTableColumn|Closure|null $label
     * @param array|null $attributes
     *
     * @return ActionTableColumn
     */
    public function actionColumn($label = null, array $attributes = null): ActionTableColumn
    {
        is_null($label) and $label = '操作';
        $column = ActionTableColumn::make($label, $attributes);
        $this->columns[] = $column;
        return $column;
    }

    /**
     * Return all TableColumns.
     *
     * @return TableColumn[]
     */
    public function columns(): array
    {
        return $this->columns;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        $this->add(...$this->columns);
    }
}