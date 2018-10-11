<?php

namespace RuLong\Panel\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RuLong\Panel\Admin::class;
    }
}
