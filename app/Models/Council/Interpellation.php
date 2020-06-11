<?php

namespace App\Models\Council;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interpellation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
