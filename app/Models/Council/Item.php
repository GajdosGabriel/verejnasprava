<?php

namespace App\Models\Council;

use App\Models\File;
use App\Models\User;
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

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('vote');
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function voteEnable(){
        if($this->vote_enable == 0) {
            $this->update(['vote_enable' => 1 ]);
        } else {
            $this->update(['vote_enable' => 0 ]);
        }

    }


}
