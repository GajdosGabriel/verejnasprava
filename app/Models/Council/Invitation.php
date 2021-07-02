<?php

namespace App\Models\Council;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Invitation extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    
    protected $guarded = [];
    protected $with = ['user'];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
