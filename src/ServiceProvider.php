<?php

namespace RuLong\Panel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use RuLong\Panel\Commands\InstallCommand;
use RuLong\Panel\Commands\MakeCommand;
use RuLong\Panel\Facades\Admin;

class ServiceProvider extends LaravelServiceProvider
{

    protected $routeMiddleware = [
        'rulong.auth'       => Middleware\Authenticate::class,
        'rulong.log'        => Middleware\LogOperation::class,
        'rulong.permission' => Middleware\Permission::class,
    ];

    protected $middlewareGroups = [
        'rulong' => [
            'rulong.auth',
            'rulong.log',
            'rulong.permission',
        ],
    ];

    protected $commands = [
        InstallCommand::class,
        MakeCommand::class,
    ];

    public function boot()
    {
        $this->commands($this->commands);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'RuLong');

        if (is_dir(admin_path('Views'))) {
            $this->loadViewsFrom(admin_path('Views'), 'Admin');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/rulong.php' => config_path('rulong.php')]);
            $this->publishes([__DIR__ . '/../config/captcha.php' => config_path('captcha.php')]);

            $this->publishes([__DIR__ . '/../resources/assets' => public_path('assets/dwzui')]);
            $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')]);
        }

        BladeExtends::ueditor();
    }

    public function register()
    {
        // 加载默认配置
        $this->mergeConfigFrom(__DIR__ . '/../config/rulong.php', 'rulong');
        $this->mergeConfigFrom(__DIR__ . '/../config/captcha.php', 'captcha');
        // 载入用户认证机制
        $this->loadAdminAuthConfig();
        // 注册中间件
        $this->registerRouteMiddleware();
        // 注册基础路由
        Admin::registerRoutes();
        // 加载自定义路由配置
        $this->loadAdminRoutes();
    }

    protected function loadAdminAuthConfig()
    {
        config(array_dot(config('rulong.auth', []), 'auth.'));
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            Route::aliasMiddleware($key, $middleware);
        }

        foreach ($this->middlewareGroups as $key => $middleware) {
            Route::middlewareGroup($key, $middleware);
        }
    }

    protected function loadAdminRoutes()
    {
        if (file_exists(admin_path('routes.php'))) {
            Route::middleware(config('rulong.route.middleware'))
                ->prefix(config('rulong.route.prefix'))
                ->name('Admin.')
                ->namespace('App\Admin\Controllers')
                ->group(admin_path('routes.php'));
        }
    }
}
