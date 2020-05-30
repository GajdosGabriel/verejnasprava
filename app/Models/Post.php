<?php

namespace App\Models;

use App\Models\RecordsActivity;
use Carbon\Carbon;
use App\Services\FileUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;


class Post extends Model
{
    use RecordsActivity, FileUpload, SoftDeletes;

    protected $guarded = [];
    protected $with = ['category', 'files', 'contact'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * @param  $value
     * @return bool|string
     */
    public function getDateInAttribute( $value )
    {
        return  \Carbon\Carbon::parse($value)->format('d. m. Y');
    }

    public function getCreatedAtAttribute( $value )
    {
        return date('j M Y', strtotime( $value ));
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug']  = Str::slug($value);
        $this->attributes['name'] = ucfirst($value);
    }

    public function getDisplayPriceAttribute()
    {
        return number_format($this->price, 2, ',', ' ');
    }



//    public function setDate_inAttribute($value)
//    {
//        return  Carbon::parse($value);
//    }








}
