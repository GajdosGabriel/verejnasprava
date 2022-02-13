<?php

namespace App\Models;

use App\Models\Council\Council;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RecordsActivity;

class Organization extends Model
{
    use SoftDeletes,  RecordsActivity;

    protected $guarded = ['id'];

    // protected $withCount = [
    //     'orders',
    // ];

    public function users()
    {
        return $this->belongsToMany(User::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'active_organization');
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function councils()
    {
        return $this->hasMany(Council::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy('id', 'asc');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class)->orderBy('name', 'asc');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function getHorizontalAttribute()
    {
        return $this->menus()->where('type', 'horizontal')->get();
    }

    public function getVerticalAttribute()
    {
        // Vylúčiť zobrazenie nemu Ľudia ak nie admin
       $excuswId = auth()->user()->hasRole(['admin']) ? 0 : 9;
       
        return $this->menus()->where('type', 'vertical')->whereNotIn('id', [$excuswId])->get();
    }

    public function getYearsOfPostsAttribute()
    {
        return $this->posts()->whereNotNull('created_at')->distinct()->get([\DB::raw('YEAR(created_at) as year')]);
    }

}
