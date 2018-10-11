<?php

namespace RuLong\Panel\Middleware;

use Admin;
use Closure;

class Authenticate
{

    public function handle($request, Closure $next)
    {
        if (Admin::guest() && !$this->shouldPassThrough($request)) {
            return redirect(route('RuLong.auth.login'));
        }

        return $next($request);
    }

    protected function shouldPassThrough($request)
    {
        $excepts = [
            admin_url('auth/login'),
            admin_url('auth/logout'),
        ];

        foreach ($excepts as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
