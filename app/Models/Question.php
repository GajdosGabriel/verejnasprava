<?php

namespace App\Models;

use App\Notifications\Questions;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'question', 'user_id'
    ];


    /**
     * @param  $value
     * @return bool|string
     */
    public function getCreatedAtAttribute( $value )
    {
        return date('j M Y', strtotime( $value ));
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
