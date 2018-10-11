<?php

namespace RuLong\Panel\Models;

use Illuminate\Database\Eloquent\Model;

class AdminOperationLog extends Model
{

    const UPDATED_AT = null;

    protected $guarded = [];

    protected function setInputAttribute($value)
    {
        if (!empty($value) && is_array($value)) {
            if (isset($value['_token'])) {
                unset($value['_token']);
            }
            if (isset($value['_method'])) {
                unset($value['_method']);
            }
            if (isset($value['_'])) {
                unset($value['_']);
            }
            if (!empty($value)) {
                $this->attributes['input'] = json_encode($value);
            }
        }
    }

    protected function getMethodAttribute($value)
    {
        switch (strtoupper($value)) {
            case 'GET':
                return '<span class="label label-primary">GET</span>';
                break;
            case 'POST':
                return '<span class="label label-success">POST</span>';
                break;
            case 'PUT':
                return '<span class="label label-warning">PUT</span>';
                break;
            case 'DELETE':
                return '<span class="label label-danger">DELETE</span>';
                break;
            default:
                return $value;
                break;
        }
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
