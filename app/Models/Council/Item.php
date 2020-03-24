<?php

namespace App\Models\Council;

use App\Models\File;
use App\Services\FileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Item extends Model
{
    use SoftDeletes, FileUpload;
    protected $guarded = [];

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }


}
