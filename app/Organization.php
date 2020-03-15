<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['contacts'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    public function orders() {
        return $this->hasMany(Order::class)->orderBy('id', 'asc');
    }

    public function contacts() {
        return $this->hasMany(Contact::class)->orderBy('name', 'asc');
    }


}
