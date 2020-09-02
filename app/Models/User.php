<?php

namespace App\Models;

use App\Models\Council\Council;
use App\Models\Council\Item;
use App\Notifications\UserRegistration;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    protected $with = ['roles', 'organization'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'send_invitation' => 'datetime',
    ];


    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'active_organization');
    }

    public function councils()
    {
        return $this->belongsToMany(Council::class);
    }


    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('created_at', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function full_name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * Create slug from title before storing to DB
     *
     * @param $value
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function getDateInAttribute($value)
    {
        return date('j M Y', strtotime($value));
    }


    public function getCreatedAtAttribute($value)
    {
        return date('j M Y', strtotime($value));
    }


}
