<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Database\Seeders;

use CodeSinging\PinAdmin\Models\AdminMenu;
use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    public function run()
    {
        AdminMenu::truncate();
        $this->add($this->data(), 0);
    }

    private function add(array $data, int $parentId)
    {
        foreach ($data as $datum) {
            $datum['parent_id'] = $parentId;

            if (!empty($datum['children'])){
                $children = $datum['children'];
                unset($datum['children']);
            }

            $menu = AdminMenu::create($datum);

            if (isset($children)){
                $this->add($children, $menu['id']);
            }
        }
    }

    private function data(): array
    {
        return [
            [
                'name' => '首页',
                'url' => 'home',
                'icon' => 'bi-house',
                'sort' => 999,
                'is_home' => 1,
            ],
            [
                'name' => '系统设置',
                'url' => '',
                'icon' => 'bi-gear',
                'sort' => 9,
                'is_opened' => 1,
                'children' => [
                    [
                        'name' => '管理员管理',
                        'url' => 'admin_users',
                        'icon' => 'bi-person',
                        'sort' => 2,
                    ],
                    [
                        'name' => '后台菜单管理',
                        'url' => 'admin_menus',
                        'icon' => 'bi-list',
                        'sort' => 4,
                    ]
                ]
            ],
        ];
    }
}