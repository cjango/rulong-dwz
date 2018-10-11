<?php

namespace RuLong\Panel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    use SoftDeletes;

    protected $table = 'admin_roles';

    protected $guarded = [];

    protected $casts = [
        'rules' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(Admin::class, 'admin_role_user')->withTimestamps();
    }
}
