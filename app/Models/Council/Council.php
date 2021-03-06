<?php

namespace App\Models\Council;



use App\Models\Organization;
use App\Models\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\File;


class Council extends Model
{
    use SoftDeletes,  RecordsActivity;
    protected $guarded = [];
    protected $with = ['meetings', 'users'];

    public function meetings(){
        return $this->hasMany(Meeting::class)->orderBy('start_at', 'desc');
    }

    public function organizations() {
        return $this->belongsToMany(Organization::class);
    }
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
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
