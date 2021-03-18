<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Http\Requests\AdminUserRequest;
use CodeSinging\PinAdmin\Models\AdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class AdminUsersController extends Controller
{
    public function index()
    {
        return $this->adminView('admin_users.index');
    }

    public function lists(AdminUser $adminUser): JsonResponse
    {
        $lists = $adminUser->lists();
        return $this->success('获取列表成功', compact('lists'));
    }

    public function store(AdminUser $adminUser, AdminUserRequest $request): JsonResponse
    {
        $request->validate([
            'mobile' => ['unique:admin_users'],
            'name' => ['required'],
            'password' => ['required'],
        ], [
            'mobile.unique' => '手机号码已经存在',
            'name.required' => '用户名称不能为空',
            'password.required' => '登录密码不能为空',
        ]);

        $result = $adminUser->fill($request->all())->save();

        return $result ? $this->success('添加成功') : $this->error('添加失败');
    }

    public function update(AdminUser $adminUser, AdminUserRequest $request): JsonResponse
    {
        $request->validate([
            'mobile' => [Rule::unique('admin_users')->ignore($adminUser)]
        ], [
            'mobile.unique' => '手机号码已经存在',
        ]);

        $result = $adminUser->fill($request->all())->save();

        return $result ? $this->success('修改成功') : $this->error('修改失败');
    }

    public function destroy(AdminUser $adminUser): JsonResponse
    {
        return $adminUser->delete()
            ? $this->success('删除成功')
            : $this->error('删除失败');
    }
}