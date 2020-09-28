<?php

namespace App\Models\Council;

use App\Models\Council\Interpellation;
use App\Models\Comment;
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
    protected $with = ['interpellations', 'files', 'user', 'votes'];

    protected $casts = [
        'vote_status' => 'boolean',
        'published' => 'boolean',
        'vote_type' => 'boolean',
    ];

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
    public function comments() {
        return $this->morphMany(Comment::class, 'fileable');
    }

    public function interpellations() {
        return $this->morphMany(Interpellation::class, 'fileable');
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function voteStatus(){

        if($this->vote_status == 0) {

            $this->update(['vote_status' => 1 ]);
        } else {

            $this->update(['vote_status' => 0 ]);
        }

    }

    public function descriptionLimit($value){
        return Str::limit($this->description, $value, ' (...)');
    }

    public function published(){
        if($this->published == 1) return $this->update(['published' => 0]);
        $this->update(['published' => 1]);

    }

    public function scopePublished($query){
        // For admin
//        if (auth()->user()->hasPermissionTo('delete')) return $query;

        // For common user
        return $query; // Dočasné kým nevyriešim Permission
//        return $query->wherePublished(1);
    }


}
