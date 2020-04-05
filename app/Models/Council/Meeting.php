<?php

namespace App\Models\Council;

use App\Services\FileUpload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\User;

class Meeting extends Model
{
    use SoftDeletes, FileUpload;

    protected $guarded = [];

    protected $casts = [
        'start_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }

    public function items() {
        return $this->hasMany(Item::class);
    }


    public function items() {
        return $this->hasMany(Item::class);
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function published(){
        if($this->published == 1) return $this->update(['published' => 0]);
        $this->update(['published' => 1]);

    }
}
