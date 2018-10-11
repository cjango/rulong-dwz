<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\AdminOperationLog;

class LogController extends Controller
{

    public function index(Request $request)
    {
        $numPerPage     = $request->numPerPage ?: 30;
        $orderField     = $request->orderField;
        $orderDirection = $request->orderDirection;
        $username       = $request->username;
        $method         = $request->method;
        $ip             = $request->ip;
        $path           = $request->path;

        $logs = AdminOperationLog::when($username, function ($query) use ($username) {
            return $query->whereHas('user', function ($query) use ($username) {
                return $query->where('username', $username);
            });
        })->when($method, function ($query) use ($method) {
            return $query->where('method', $method);
        })->when($ip, function ($query) use ($ip) {
            return $query->where('ip', $ip);
        })->when($path, function ($query) use ($path) {
            return $query->where('path', $path);
        })->when($orderField, function ($query) use ($orderField, $orderDirection) {
            $query->orderBy($orderField, $orderDirection);
        })->with('admin')->orderBy('id', 'desc')->paginate($numPerPage);
        return view('RuLong::logs.index', compact('logs'));
    }
}
