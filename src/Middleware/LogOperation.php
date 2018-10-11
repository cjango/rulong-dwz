<?php

namespace RuLong\Panel\Middleware;

use Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogOperation
{

    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldLogOperation($request)) {
            Admin::user()->operationLogs()->create([
                'path'   => $request->path(),
                'method' => $request->method(),
                'ip'     => $request->ip(),
                'input'  => $request->all(),
            ]);
        }
        return $next($request);
    }

    private function shouldLogOperation(Request $request)
    {
        return config('rulong.logs.enable') && Admin::user() && !$this->inExceptArray($request);
    }

    private function inExceptArray($request)
    {
        foreach (config('rulong.logs.except') as $except) {
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
