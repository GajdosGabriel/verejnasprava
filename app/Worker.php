<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = $value;
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function getWorkerContractAttribute()
    {
        $birthdate = new \DateTime($this->dateContract);
        $today     = new \DateTime();
        $interval  = $today->diff($birthdate);
        return  $interval->format('%y roky');
    }




}
