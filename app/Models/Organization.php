<?php

namespace App\Models;

use App\Models\Council\Council;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RecordsActivity;

class Organization extends Model
{
    use SoftDeletes,  RecordsActivity;

    protected $guarded = [];

    protected $with = ['contacts', 'menus'];

    protected $withCount = [
        'orders',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->latest();
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
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


}
