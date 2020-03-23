<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }
}
