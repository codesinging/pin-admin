<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Http\Requests\AdminMenuRequest;
use CodeSinging\PinAdmin\Models\AdminMenu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class AdminMenusController extends Controller
{
    public function index()
    {
        return $this->adminView('admin_menus.index');
    }

    public function lists(AdminMenu $adminMenu): JsonResponse
    {
        $lists = $adminMenu->indentTreeLists(function (Builder $builder){
            return $builder->orderByDesc('sort');
        });
        return $this->success('获取列表成功', compact('lists'));
    }

    public function store(AdminMenu $adminMenu, AdminMenuRequest $request): JsonResponse
    {
        $result = $adminMenu->fill($request->all())->save();

        return $result ? $this->success('添加成功') : $this->error('添加失败');
    }

    public function update(AdminMenu $adminMenu, AdminMenuRequest $request): JsonResponse
    {
        $result = $adminMenu->fill($request->all())->save();

        return $result ? $this->success('修改成功') : $this->error('修改失败');
    }

    public function destroy(AdminMenu $adminMenu): JsonResponse
    {
        return $adminMenu->delete()
            ? $this->success('删除成功')
            : $this->error('删除失败');
    }
}