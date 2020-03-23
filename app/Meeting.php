<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function votes(){
        return $this->hasMany(Vote::class);
    }
}
