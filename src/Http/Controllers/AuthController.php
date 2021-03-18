<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Controllers;

use CodeSinging\PinAdmin\Facades\Admin;
use CodeSinging\PinAdmin\Http\Requests\AdminUserRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function index()
    {
        return $this->adminView('auth.index');
    }

    public function login(AdminUserRequest $request): JsonResponse
    {
        $request->validate(
            [
                'password' => ['required'],
            ],
            [
                'password.required' => '密码不能为空'
            ]
        );

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
}