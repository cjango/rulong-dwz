<?php

namespace RuLong\Panel\Commands;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuLong\Panel\Models\Admin;
use RuLong\Panel\Models\Menu;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Admin::truncate();
        Admin::create([
            'username' => 'root',
            'password' => '111111',
            'nickname' => 'Rooter',
        ]);

        // add default menus.
        Menu::truncate();

        $menus = [
            ['id' => 1, 'parent_id' => 0, 'title' => '系统管理', 'icon' => 'fa-cogs', 'sort' => 99, 'uri' => null],
            ['id' => 10, 'parent_id' => 1, 'title' => '用户管理', 'icon' => 'fa-user', 'sort' => 1, 'uri' => 'RuLong.admins.index'],
            ['id' => 11, 'parent_id' => 10, 'title' => '新增用户', 'sort' => 1, 'uri' => 'Rulong.admins.create'],
            ['id' => 12, 'parent_id' => 10, 'title' => '新增-保存', 'sort' => 2, 'uri' => 'Rulong.admins.store'],
            ['id' => 13, 'parent_id' => 10, 'title' => '编辑用户', 'sort' => 3, 'uri' => 'Rulong.admins.edit'],
            ['id' => 14, 'parent_id' => 10, 'title' => '编辑-保存', 'sort' => 4, 'uri' => 'Rulong.admins.update'],
            ['id' => 15, 'parent_id' => 10, 'title' => '删除用户', 'sort' => 5, 'uri' => 'Rulong.admins.destroy'],
            ['id' => 20, 'parent_id' => 1, 'title' => '角色管理', 'icon' => 'fa-group', 'sort' => 2, 'uri' => 'RuLong.roles.index'],
            ['id' => 21, 'parent_id' => 20, 'title' => '新增角色', 'sort' => 1, 'uri' => 'Rulong.roles.create'],
            ['id' => 22, 'parent_id' => 20, 'title' => '新增-保存', 'sort' => 2, 'uri' => 'Rulong.roles.store'],
            ['id' => 23, 'parent_id' => 20, 'title' => '编辑角色', 'sort' => 3, 'uri' => 'Rulong.roles.edit'],
            ['id' => 24, 'parent_id' => 20, 'title' => '编辑-保存', 'sort' => 4, 'uri' => 'Rulong.roles.update'],
            ['id' => 25, 'parent_id' => 20, 'title' => '删除角色', 'sort' => 5, 'uri' => 'Rulong.roles.destroy'],
            ['id' => 26, 'parent_id' => 20, 'title' => '菜单授权', 'sort' => 6, 'uri' => 'Rulong.roles.menus'],
            ['id' => 27, 'parent_id' => 20, 'title' => '用户授权', 'sort' => 7, 'uri' => 'Rulong.roles.users'],
            ['id' => 28, 'parent_id' => 20, 'title' => '增加用户授权', 'sort' => 8, 'uri' => 'Rulong.roles.auth'],
            ['id' => 29, 'parent_id' => 20, 'title' => '移除用户授权', 'sort' => 9, 'uri' => 'Rulong.roles.remove'],
            ['id' => 30, 'parent_id' => 1, 'title' => '菜单管理', 'icon' => 'fa-bars', 'sort' => 3, 'uri' => 'RuLong.menus.index'],
            ['id' => 31, 'parent_id' => 30, 'title' => '新增菜单', 'sort' => 1, 'uri' => 'Rulong.menus.create'],
            ['id' => 32, 'parent_id' => 30, 'title' => '新增-保存', 'sort' => 2, 'uri' => 'Rulong.menus.store'],
            ['id' => 33, 'parent_id' => 30, 'title' => '编辑菜单', 'sort' => 3, 'uri' => 'Rulong.menus.edit'],
            ['id' => 34, 'parent_id' => 30, 'title' => '编辑-保存', 'sort' => 4, 'uri' => 'Rulong.menus.update'],
            ['id' => 35, 'parent_id' => 30, 'title' => '删除菜单', 'sort' => 5, 'uri' => 'Rulong.menus.destroy'],
            ['id' => 40, 'parent_id' => 1, 'title' => '系统日志', 'icon' => 'fa-list', 'sort' => 4, 'uri' => 'RuLong.logs.index'],
        ];
        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        Db::statement('alter table `admin_menus` auto_increment = 100');
    }
}
