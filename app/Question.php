<?php

namespace App;

use App\Notifications\Questions;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

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
