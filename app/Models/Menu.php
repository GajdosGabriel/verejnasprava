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
        return $query->whereIn('id', [1, 3, 6,10]);

    }

    public static function activatorOfMenus($organization, $input){

        // If active/deActive Zverejnovanie add Contact also
        if ($input == 1) {
          return  $organization->menus()->toggle([1,2]);
        }

        // If active/deActive Zasadnutia add Návrhy also
        if ($input == 3) {
          return  $organization->menus()->toggle([3,4]);
        }

        $organization->menus()->toggle($input);
    }
}
