<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use RecordsActivity, SoftDeletes;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPscAttribute($value)
    {
        $this->attributes['psc']  = str_replace(' ', '', $value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function getformatPscAttribute() {
        return substr($this->psc,0,3)." ".substr($this->psc,3,2);
    }
}
