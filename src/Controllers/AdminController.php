<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Admin;
use Validator;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $username       = $request->username;
        $nickname       = $request->nickname;
        $orderField     = $request->orderField;
        $orderDirection = $request->orderDirection;
        $numPerPage     = $request->numPerPage ?: 30;

        $admins = Admin::when($username, function ($query) use ($username) {
            return $query->where('username', 'like', "%{$username}%");
        })->when($nickname, function ($query) use ($nickname) {
            return $query->where('nickname', 'like', "%{$nickname}%");
        })->when($orderField, function ($query) use ($orderField, $orderDirection) {
            $query->orderBy($orderField, $orderDirection);
        })->with('lastLogin')->withCount('logins')->paginate($numPerPage);
        return view('RuLong::admins.index', compact('admins'));
    }

    public function create()
    {
        return view('RuLong::admins.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'between:4,32', 'unique:admins'],
            'password' => 'required|between:6,32',
            'nickname' => 'nullable|between:2,16',
        ], [
            'username.required' => '用户名称必须填写',
            'username.between'  => '用户名称长度应在:min-:max位之间',
            'username.unique'   => '用户名称已经存在',
            'password.required' => '登录密码必须填写',
            'password.between'  => '登录密码长度应在:min-:max位之间',
            'nickname.between'  => '用户昵称长度应在:min-:max位之间',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if (Admin::create($request->all())) {
            return $this->success('', 'close');
        } else {
            return $this->error();
        }
    }

    public function edit(Admin $admin)
    {
        return view('RuLong::admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'nullable|between:6,32',
            'nickname' => 'nullable|between:2,16',
        ], [
            'password.between' => '登录密码长度应在:min-:max位之间',
            'nickname.between' => '用户昵称长度应在:min-:max位之间',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if ($admin->update($request->all())) {
            return $this->success('修改成功', 'close');
        } else {
            return $this->error();
        }
    }

    public function destroy(Admin $admin)
    {
        if ($admin->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
