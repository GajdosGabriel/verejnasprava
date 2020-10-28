<?php

namespace App\Models;

use App\Models\Council\Council;
use App\Models\Council\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Organization extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['contacts'];

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

    public function modules()
    {
        return $this->belongsToMany(Module::class)->withTimestamps();
    }


}
