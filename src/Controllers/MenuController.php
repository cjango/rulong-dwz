<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Menu;
use Validator;

class MenuController extends Controller
{

    public function index(Request $request)
    {
        $keyword    = $request->keyword;
        $parent_id  = $request->get('parent_id', 0);
        $numPerPage = $request->numPerPage ?: 30;

        $menuTree = Menu::with(['children'])->where('parent_id', 0)->orderBy('sort', 'asc')->get();

        $menus = Menu::when($keyword, function ($query) use ($keyword) {
            return $query->where('title', 'like', "%{$keyword}%");
        })->where('parent_id', $parent_id)->orderBy('sort', 'asc')->paginate($numPerPage);
        return view('RuLong::menus.index', compact('menus', 'menuTree'));
    }

    public function create()
    {
        $topMenus = Menu::treeShow();
        return view('RuLong::menus.create', compact('topMenus'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:16',
            'sort'  => 'required|integer',
            'uri'   => 'required_unless:parent_id,0',
        ], [
            'title.required'      => '菜单名称必须填写',
            'title.max'           => '菜单名称长度应在:max以内',
            'sort.required'       => '菜单排序必须填写',
            'sort.integer'        => '菜单排序只能是数字',
            'uri.required_unless' => '菜单连接地址必须填写',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if (Menu::create($request->all())) {
            return $this->success('新增菜单成功', 'close');
        } else {
            return $this->error();
        }
    }

    public function edit(Menu $menu)
    {
        $topMenus = Menu::treeShow($menu->id);
        return view('RuLong::menus.edit', compact('topMenus', 'menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:16',
            'sort'  => 'required|integer',
            'uri'   => 'required_unless:parent_id,0',
        ], [
            'title.required'      => '菜单名称必须填写',
            'title.max'           => '菜单名称长度应在:max以内',
            'sort.required'       => '菜单排序必须填写',
            'sort.integer'        => '菜单排序只能是数字',
            'uri.required_unless' => '菜单连接地址必须填写',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if ($menu->update($request->all())) {
            return $this->success('编辑菜单成功', 'close');
        } else {
            return $this->error();
        }
    }

    public function destroy(Menu $menu)
    {
        if ($menu->children()->count()) {
            return $this->error('菜单下有子菜单，不允许直接删除');
        } elseif ($menu->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
