<?php

namespace App\Models;

use App\Models\RecordsActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use RecordsActivity, SoftDeletes, Notifiable;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPscAttribute($value)
    {
        $this->attributes['psc']  = str_replace(' ', '', $value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function getformatPscAttribute() {
        return substr($this->psc,0,3)." ".substr($this->psc,3,2);
    }

//    public function phoneNumber() {
//        // add logic to correctly format number here
//        // a more robust ways would be to use a regular expression
//        return "(".substr($this->phone, 0, 3).") ".substr($this->phone, 3, 3)." ".substr($this->phone,6);
//    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
