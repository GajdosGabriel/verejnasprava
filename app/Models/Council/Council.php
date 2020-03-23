<?php

namespace App\Models\Council;

use App\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Council extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function meetings(){
        return $this->hasMany(Meeting::class)->orderBy('start_at', 'asc');
    }

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
