<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models\Support;

class IndentTree
{
    /**
     * Configuration
     *
     * @var array
     */
    protected $config = [
        'id' => 'id',
        'parentId' => 'parent_id',
        'children' => 'children',
        'name' => 'name',
        'key' => 'tree',
        'depth' => 'depth',
        'tab' => 'tab',
        'tabName' => 'name',
        'parentMap' => 'parents',
        'childrenMap' => 'children',
        'sign_0' => '　',
        'sign_1' => '├',
        'sign_2' => '│',
        'sign_3' => '└',
        'sign_4' => ' ',
        'sign_5' => '　',
    ];

    /**
     * Indent constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $config and $this->config = array_merge($this->config, $config);
    }

    /**
     * Convert to tree-like data.
     *
     * @param array $data
     * @param int $parentId
     *
     * @return array
     */
    protected function toTree(array $data, int $parentId = 0): array
    {
        $tree = [];
        foreach ($data as $item) {
            if ($item[$this->config['parentId']] == $parentId) {
                $children = $this->toTree($data, $item[$this->config['id']]);
                $item[$this->config['children']] = $children;
                $tree[] = $item;
            }
        }
        return $tree;
    }

    /**
     * Get indented data.
     *
     * @param array $treeData
     * @param string $path
     * @param int $depth
     * @param array $parentMap
     *
     * @return array
     */
    protected function getIndent(array $treeData, string $path = '', int $depth = 0, array $parentMap = []): array
    {
        $list = [];
        $count = count($treeData);

        foreach ($treeData as $index => $row) {
            $item = $row;
            unset($item[$this->config['children']]);

            $isLast = $index === $count - 1;
            $isFirst = $index === 0;

            $treeConfig = [];
            $treeConfig[$this->config['tab']] = $path . ($path ? $this->config['sign_5'] : '') . ($isLast ? $this->config['sign_3'] : $this->config['sign_1']);
            $treeConfig[$this->config['tabName']] = $treeConfig[$this->config['tab']] . $this->config['sign_4'] . $item[$this->config['name']];
            $treeConfig[$this->config['depth']] = $depth + 1;
            $treeConfig[$this->config['parentMap']] = $parentMap;

            $item[$this->config['key']] = $treeConfig;
            $list[] = $item;

            if (isset($row[$this->config['children']])) {
                $childrenPath = $path . ($path ? $this->config['sign_5'] : '') . ($isLast ? $this->config['sign_0'] : $this->config['sign_2']);
                $childrenList = $this->getIndent($row[$this->config['children']], $childrenPath, $item[$this->config['key']][$this->config['depth']], array_merge($parentMap, [$item[$this->config['id']]]));
                $list = array_merge($list, $childrenList);
            }

        }

        return $list;
    }

    /**
     * Convert to indented data.
     *
     * @param array $treeData
     *
     * @return array
     */
    protected function toIndent(array $treeData): array
    {
        $indentData = $this->getIndent($treeData);

        $map = [];
        foreach ($indentData as $item) {
            $item[$this->config['key']][$this->config['childrenMap']] = [];
            $map[$item[$this->config['id']]] = $item;
        }

        foreach ($indentData as $item) {
            foreach ($item[$this->config['key']][$this->config['parentMap']] as $parentId) {
                $map[$parentId][$this->config['key']][$this->config['childrenMap']][] = $item[$this->config['id']];
            }
        }

        return array_values($map);
    }

    /**
     * Get indented data.
     *
     * @param array $data
     *
     * @return array
     */
    public function indentData(array $data): array
    {
        $treeData = $this->toTree($data);
        return $this->toIndent($treeData);
    }

    /**
     * Get tree data.
     *
     * @param array $data
     *
     * @return array
     */
    public function treeData(array $data): array
    {
        return $this->toTree($data);
    }
}