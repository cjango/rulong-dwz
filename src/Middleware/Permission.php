<?php

namespace RuLong\Panel\Middleware;

use Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Route;
use RuLong\Panel\Models\Menu;
use Session;

class Permission
{
    protected $user;

    public function __construct()
    {
        $this->user = Admin::user();
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldCheck($request)) {

            $authed = Session::get('authed_routes');

            if (!$authed) {
                $rules   = $this->user->roles()->pluck('rules');
                $ruleIds = [];
                foreach ($rules as $rule) {
                    $ruleIds = array_merge($ruleIds, $rule);
                }
                array_unique($ruleIds);
                $authed = Menu::whereIn('id', $ruleIds)->whereNotNull('uri')->pluck('uri')->toArray();

                Session::put('authed_routes', $authed);
            }

            if (!in_array(Route::currentRouteName(), $authed)) {
                abort(403, 'Unauthorized.');
            }
        }
        return $next($request);
    }

    private function shouldCheck(Request $request)
    {
        return $this->user && !$this->user->isAdmin() && !$this->inExceptArray($request);
    }

    private function inExceptArray($request)
    {
        foreach (config('rulong.permission.except') as $except) {
            $except = admin_url($except);
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            $methods = [];

            if (Str::contains($except, ':')) {
                list($methods, $except) = explode(':', $except);
                $methods                = explode(',', $methods);
            }

            $methods = array_map('strtoupper', $methods);

            if ($request->is($except) && (empty($methods) || in_array($request->method(), $methods))) {
                return true;
            }
        }

        return false;
    }
}
