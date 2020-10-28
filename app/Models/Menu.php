<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }
}
