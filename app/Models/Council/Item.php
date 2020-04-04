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

    public function voteDisable(){
        if($this->vote_disabled == 0) {
            $this->update(['vote_disabled' => 1 ]);
        } else {
            $this->update(['vote_disabled' => 0 ]);
        }

    }

    public function descriptionLimit($value){
        return Str::limit($this->description, $value, ' (...)');
    }

    public function published(){
        if($this->published == 1) return $this->update(['published' => 0]);
        $this->update(['published' => 1]);

    }


}
