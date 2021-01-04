<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;


    protected $guarded = ['id'];


    public function subject()
    {
        return $this->morphTo();
    }
}
