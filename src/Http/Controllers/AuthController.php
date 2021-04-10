<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Facades\Admin;
use CodeSinging\PinAdmin\Http\Requests\AdminUserRequest;
use CodeSinging\PinAdmin\Models\AdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index()
    {
        $captchaSrc = captcha_src();
        return $this->adminView('auth.index', compact('captchaSrc'));
    }

    public function login(AdminUserRequest $request): JsonResponse
    {
        $request->validate([
                'password' => ['required'],
            ], [
                'password.required' => '密码不能为空'
            ]
        );

        if (Admin::config('captcha')){
            $request->validate([
                'captcha' => ['required', 'captcha'],
            ], [
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '验证码不正确',
            ]);
        }

        $credentials = $request->only('mobile', 'password');

        if (Admin::auth()->attempt($credentials)){
            return $this->success('登录成功');
        } else {
            return $this->error('登录失败');
        }
    }

    public function logout(): JsonResponse
    {
        Admin::auth()->logout();
        return $this->success('注销成功');
    }

    public function edit()
    {
        return $this->adminView('auth.edit');
    }

    public function update(AdminUserRequest $request): JsonResponse
    {
        $adminUser = AdminUser::find(Admin::auth()->id());

        $request->validate([
            'name' => [Rule::unique('admin_users')->ignore($adminUser)],
        ], [
            'name.unique' => '用户名称已经存在',
        ]);

        $result = $adminUser->fill($request->only('name', 'password'))->save();

        return $result ? $this->success('修改成功') : $this->error('修改失败');
    }
}