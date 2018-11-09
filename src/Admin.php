<?php

namespace RuLong\Panel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Admin
{

    public function user()
    {
        return Auth::guard('rulong')->user();
    }

    public function guest()
    {
        return Auth::guard('rulong')->guest();
    }

    public function id()
    {
        return Auth::guard('rulong')->id();
    }

    public function attempt($certificates)
    {
        return Auth::guard('rulong')->attempt($certificates);
    }

    public function logout()
    {
        return Auth::guard('rulong')->logout();
    }

    public function registerRoutes()
    {
        Route::middleware(config('rulong.route.middleware'))
            ->prefix(config('rulong.route.prefix'))
            ->name('RuLong.')
            ->namespace('RuLong\Panel\Controllers')
            ->group(function ($router) {
                $router->match(['get', 'post'], 'auth/login', 'AuthController@login')->name('auth.login');
                $router->match(['get', 'post'], 'auth/login_dialog', 'AuthController@loginDialog')->name('auth.login.dialog');
                $router->get('auth/logout', 'AuthController@logout')->name('auth.logout');
                $router->get('/', 'IndexController@index')->name('index');
                $router->match(['get', 'post'], 'password', 'IndexController@password')->name('password');

                $router->resource('admins', 'AdminController')->except('show');
                $router->resource('menus', 'MenuController')->except('show');

                $router->match(['get', 'post'], 'roles/{role}/menus', 'RoleController@menus')->name('roles.menus');
                $router->match(['get', 'post'], 'roles/{role}/users', 'RoleController@users')->name('roles.users');
                $router->post('roles/{role}/{admin}/auth', 'RoleController@auth')->name('roles.auth');
                $router->delete('roles/{role}/{admin}/remove', 'RoleController@remove')->name('roles.remove');
                $router->resource('roles', 'RoleController')->except('show');
                $router->get('logs', 'LogController@index')->name('logs.index');
                $router->get('storages', 'StorageController@index')->name('storages.index');
                $router->get('storages/test', 'StorageController@test')->name('storages.test');
                $router->post('storages/{name}', 'StorageController@upload')->name('storages.upload');

            });
        // 加了中间件，无法获取session，很难搞
        Route::match(['get', 'post'], config('rulong.route.prefix') . '/ueditor/server', 'RuLong\Panel\Controllers\UeditorController@server')->name('RuLong.ueditor.server');
    }
}
