<?php

namespace RuLong\Panel\Controllers;

use Admin;
use Hash;
use Illuminate\Http\Request;
use RuLong\Panel\Models\Menu;
use Validator;

class IndexController extends Controller
{

    public function index()
    {
        $adminMenus = Menu::adminShow();
        return view('RuLong::public.index', compact('adminMenus'));
    }

    public function dashboard()
    {
        return view('RuLong::public.dashboard');
    }

    public function password(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'oldpass' => ['required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Admin::user()->password)) {
                        return $fail('原始密码不正确');
                    }
                }],
                'newpass' => 'required|between:6,32|different:oldpass',
                'repass'  => 'required|same:newpass',
            ], [
                'oldpass.required'  => '原始密码必须填写',
                'newpass.required'  => '新的密码必须填写',
                'newpass.between'   => '新密码长度应在:min-:max位之间',
                'newpass.different' => '新密码不能与原密码相同',
                'repass.required'   => '确认密码必须填写',
                'repass.same'       => '两次输入的密码不一致',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $user = Admin::user();

            $user->password = $request->repass;

            if ($user->save()) {
                return $this->success('密码修改成功', 'close');
            } else {
                return $this->error();
            }
        } else {
            return view('RuLong::public.password');
        }
    }
}
