<?php

namespace App\Models\Council;

use App\Models\Comment;
use App\Models\File;
use App\Models\RecordsActivity;
use App\Models\User;
use App\Services\FileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use SoftDeletes, RecordsActivity, FileUpload , Notifiable;

    protected $guarded = [];

    // protected $with = ['itemspublished', 'users', 'files', 'invitations'];

    protected $casts = [
        'start_at' => 'datetime',
        'published' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }
    public function comments() {
        return $this->morphMany(Comment::class, 'fileable');
    }

    public function items() {
        return $this->belongsToMany(Item::class)->orderBy('position', 'asc');
    }

    public function itemspublished() {
        return $this->belongsToMany(Item::class)->orderBy('position', 'asc')->wherePublished(1);
    }

    public function council() {
        return $this->belongsTo(Council::class);
    }

    public function invitations(){
        return $this->hasMany(Invitation::class);
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
