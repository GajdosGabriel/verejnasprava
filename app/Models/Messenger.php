<?php

namespace App\Models;

use App\Services\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory, FileUpload;
    protected $guarded = [];

//    protected $with = ['users'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }
}
