<?php

namespace RuLong\Panel\Middleware;

use Admin;
use Closure;
use Response;

class Authenticate
{

    public function handle($request, Closure $next)
    {
        if (Admin::guest() && !$this->shouldPassThrough($request)) {
            if ($request->ajax()) {
                return Response::json([
                    'statusCode' => 408,
                    'message'    => '登录超时',
                ]);
            } else {
                return redirect(route('RuLong.auth.login'));
            }
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
