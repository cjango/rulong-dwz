<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Admin;
use RuLong\Panel\Models\Menu;
use RuLong\Panel\Models\Role;
use Validator;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $keyword        = $request->keyword;
        $orderField     = $request->orderField;
        $orderDirection = $request->orderDirection;
        $numPerPage     = $request->numPerPage ?: 30;

        $roles = Role::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->when($orderField, function ($query) use ($orderField, $orderDirection) {
            $query->orderBy($orderField, $orderDirection);
        })->withCount('users')->paginate($numPerPage);
        return view('RuLong::roles.index', compact('roles'));
    }

    public function create()
    {
        return view('RuLong::roles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|between:2,32|unique:admin_roles',
            'description' => 'max:255',
        ], [
            'name.required'   => '角色名称必须填写',
            'name.between'    => '角色名称长度应在:min-:max位之间',
            'name.unique'     => '角色名称已经存在',
            'description.max' => '角色描述应小于:max字符',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if (Role::create($request->all())) {
            return $this->success('新增角色成功', 'close');
        } else {
            return $this->error();
        }
    }

    public function edit(Role $role)
    {
        return view('RuLong::roles.edit', compact('role'));
    }

    public function update(Request $request, role $role)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|between:2,32|unique:admin_roles,name,' . $role->id,
            'description' => 'max:255',
        ], [
            'name.required'   => '角色名称必须填写',
            'name.between'    => '角色名称长度应在:min-:max位之间',
            'name.unique'     => '角色名称已经存在',
            'description.max' => '角色描述应小于:max字符',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if ($role->update($request->all())) {
            return $this->success('保存角色成功', 'close');
        } else {
            return $this->error();
        }
    }

    public function destroy(Role $role)
    {
        if ($role->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function menus(Request $request, Role $role)
    {
        if ($request->isMethod('post')) {
            $result = $role->update([
                'rules' => $request->rules,
            ]);
            if ($result) {
                return $this->success('菜单授权成功', route('RuLong.roles.index'));
            } else {
                return $this->error();
            }
        } else {
            $menus = Menu::with(['children'])->where('parent_id', 0)->orderBy('sort', 'asc')->get();
            return view('RuLong::roles.menus', compact('menus', 'role'));
        }
    }

    public function users(Request $request, Role $role)
    {
        $username = $request->username;
        $nickname = $request->nickname;
        $authed   = $request->get('authed', 'yes');

        if ($authed == 'yes') {
            $Model = $role->users();
        } else {
            $Model = Admin::whereDoesntHave('roles', function ($query) use ($role) {
                $query->where('role_id', $role->id);
            });
        }

        $admins = $Model->when($username, function ($query) use ($username) {
            $query->where('username', 'like', "%{$username}%");
        })->when($nickname, function ($query) use ($nickname) {
            $query->where('nickname', 'like', "%{$nickname}%");
        })->paginate(15);
        return view('RuLong::roles.users', compact('admins', 'role'));
    }

    /**
     * POST 用户授权
     * @Author:<C.Jason>
     * @Date:2018-10-09T17:40:22+0800
     * @param Role $role [description]
     * @param Admin $admin [description]
     * @return [type] [description]
     */
    public function auth(Role $role, Admin $admin)
    {
        try {
            $admin->roles()->attach($role);
            return $this->success();
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    /**
     * DELETE 解除授权
     * @Author:<C.Jason>
     * @Date:2018-10-09T17:40:34+0800
     * @param Role $role [description]
     * @param Admin $admin [description]
     * @return [type] [description]
     */
    public function remove(Role $role, Admin $admin)
    {
        try {
            $role->users()->detach($admin);
            return $this->success('操作成功');
        } catch (\Exception $e) {
            return $this->error();
        }
    }

}
