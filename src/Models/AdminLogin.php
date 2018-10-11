<?php

namespace RuLong\Panel\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLogin extends Model
{

    const UPDATED_AT = null;

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
