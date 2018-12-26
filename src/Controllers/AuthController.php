<?php
namespace RuLong\Panel\Controllers;

use Admin;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:4',
                'password' => 'required|min:6',
                'verify'   => 'required|captcha',
            ], [
                'username.required' => '用户名必须填写',
                'username.min'      => '用户名不少于:min位',
                'password.required' => '密码必须填写',
                'password.min'      => '密码不少于:min位',
                'verify.required'   => '验证码必须填写',
                'verify.captcha'    => '验证码不正确',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $certificates = [
                'username' => $request->username,
                'password' => $request->password,
            ];
            $remember = $request->remember ?: false;
            if (Admin::attempt($certificates, $remember)) {
                Admin::user()->logins()->create([
                    'login_ip' => $request->ip(),
                ]);
                return $this->success('登录成功', route('RuLong.index'));
            } else {
                return $this->error('用户名或密码错误');
            }
        } else {
            return view('RuLong::auth.login');
        }
    }

    public function loginDialog(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:4',
                'password' => 'required|min:6',
            ], [
                'username.required' => '用户名必须填写',
                'username.min'      => '用户名不少于:min位',
                'password.required' => '密码必须填写',
                'password.min'      => '密码不少于:min位',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $certificates = [
                'username' => $request->username,
                'password' => $request->password,
            ];
            $remember = $request->remember ?: false;
            if (Admin::attempt($certificates, $remember)) {
                Admin::user()->logins()->create([
                    'login_ip' => $request->ip(),
                ]);
                return $this->success('登录成功', 'close');
            } else {
                return $this->error('用户名或密码错误');
            }
        } else {
            return view('RuLong::auth.login_dialog');
        }
    }

    public function logout(Request $request)
    {
        Admin::logout();
        session()->flush();
        return $this->success('注销成功');
    }
}
