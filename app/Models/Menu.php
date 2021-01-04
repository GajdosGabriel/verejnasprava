<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

//    protected $with = ['organizations'];

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function scopeHorizontalMenu($query)
    {
//        return $query->whereIn('id', [1, 2, 3, 4, 7, 8, 9]);
        return $query->whereIn('id', [1, 2, 3, 4, 7, 8, 9, 10]);

    }
}
