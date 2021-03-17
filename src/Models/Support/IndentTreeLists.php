<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models\Support;

use Closure;

trait IndentTreeLists
{
    /**
     * @param Closure|null $query
     * @param Closure|null $handler
     * @return array
     */
    public function indentTreeLists(Closure $query = null, Closure $handler = null): array
    {
        $lists = $this->lists($query, $handler);

        $indentTree = new IndentTree();
        $lists['data'] = $indentTree->indentData($lists['data']);

        return $lists;
    }
}