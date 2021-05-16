<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Composites;

use CodeSinging\PinAdmin\Viewless\Components\Table;
use CodeSinging\PinAdmin\Viewless\Components\TableColumn;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;

class ExtendedTable extends Table
{
    protected $baseTag = 'table';

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
     * Add a Switch column.
     *
     * @param array|string|Closure|SwitchColumn|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return TableColumn|SwitchColumn
     */
    public function switchColumn($prop = null, $label = null, array $attributes = null, bool $linebreak = null)
    {
        $column = SwitchColumn::make($prop, $label, $attributes, $linebreak);
        $this->columns[] = $column;
        return $column;
    }
}