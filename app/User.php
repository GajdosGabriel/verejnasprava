<?php

namespace App;

use App\Notifications\UserRegistration;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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


    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function organizations() {
        return $this->hasMany(Organization::class);
    }


    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('created_at', 'desc');
    }

    public function full_name(){
        return $this->first_name .' '. $this->last_name;
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

    public function getDateInAttribute( $value )
    {
        return date('j M Y', strtotime( $value ));
    }


    public function getCreatedAtAttribute( $value )
    {
        return date('j M Y', strtotime( $value ));
    }














}
