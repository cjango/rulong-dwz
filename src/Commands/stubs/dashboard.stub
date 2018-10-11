@extends('RuLong::layouts.app')

@section('content')
<h1 class="m-b">Dashboard</h1>
<div class="row">
    <div class="col-sm-4 m-b">
        <div class="ibox">
            <div class="ibox-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>参数名称</th>
                            <th>参数值</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PHP 版本</td>
                            <td>PHP/{{ phpversion() }}</td>
                        </tr>
                        <tr>
                            <td>Laravel 版本</td>
                            <td>{{ app()->version() }}</td>
                        </tr>
                        <tr>
                            <td>CGI 模式</td>
                            <td>{{ php_sapi_name() }}</td>
                        </tr>
                        <tr>
                            <td>Web Server</td>
                            <td>{{ array_get($_SERVER, 'SERVER_SOFTWARE') }}</td>
                        </tr>
                        <tr>
                            <td>Cache Driver</td>
                            <td>{{ config('cache.default') }}</td>
                        </tr>
                        <tr>
                            <td>Session Driver</td>
                            <td>{{ config('session.driver') }}</td>
                        </tr>
                        <tr>
                            <td>Queue Driver</td>
                            <td>{{ config('queue.driver') }}</td>
                        </tr>
                        <tr>
                            <td>Timezone</td>
                            <td>{{ config('app.timezone') }}</td>
                        </tr>
                        <tr>
                            <td>Locale</td>
                            <td>{{ config('app.locale') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4 m-b">
        <div class="ibox">
            <div class="ibox-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>参数名称</th>
                            <th>参数值</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Panel版本</td>
                            <td><img src="https://poser.pugx.org/rulong/laravel-panel/v/stable" alt=""></td>
                        </tr>
                        <tr>
                            <td>模板库地址</td>
                            <td><a href="http://tpl.cjango.com/" target="_blank">模板库</a></td>
                        </tr>
                        <tr>
                            <td>Laravel文档</td>
                            <td><a href="https://laravel-china.org/docs/laravel/5.6" target="_blank">Laravel文档</a></td>
                        </tr>
                        <tr>
                            <td>PHP设计模式</td>
                            <td><a href="https://laravel-china.org/docs/php-design-patterns/2018" target="_blank">PHP设计模式</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
