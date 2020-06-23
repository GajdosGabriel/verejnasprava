<?php

namespace App\Models\Council;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
