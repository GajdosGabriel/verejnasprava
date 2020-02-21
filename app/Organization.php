<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->hasMany(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function companies() {
        return $this->hasMany(Company::class)->orderBy('name', 'asc');
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

}
