<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug']  = Str::slug($value);
    }
}
