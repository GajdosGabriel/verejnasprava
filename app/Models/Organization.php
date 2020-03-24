<?php

namespace App\Models;

use App\Models\Council\Council;
use App\Models\Post;
use App\Models\User;
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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    public function councils() {
        return $this->hasMany(Council::class)->orderBy('created_at', 'desc');
    }

    public function orders() {
        return $this->hasMany(Order::class)->orderBy('id', 'asc');
    }

    public function contacts() {
        return $this->hasMany(Contact::class)->orderBy('name', 'asc');
    }


}
