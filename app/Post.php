<?php

namespace App;

use Carbon\Carbon;
use App\Services\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;


class Post extends Model
{
    use RecordsActivity, FileUpload;

    protected $guarded = [];
    protected $with = ['posts', 'category', 'file','company'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->orderBy('created_at', 'desc');
    }

    public function file()
    {
        return $this->hasMany(File::class);
    }

    /**
     * @param  $value
     * @return bool|string
     */
    public function getDateInAttribute( $value )
    {
        return date('j M Y', strtotime( $value ));
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

//    public function saveImage($request) {
//        if ($request->hasFile('filename')){
//
//            $imageName =  request()->file('filename')->store('username' .  auth()->id() );
//            $file = $request->filename->move(storage_path('username' . auth()->id()), $imageName);
//            $path = storage_path('username' . auth()->id()) . '/' . basename($file);
//
//            $this->file()->create([
//                'filename' => $imageName,
//                'name' => $request->filename->getClientOriginalName(),
//            ]);
//
//            if (getimagesize($path)) {
//                $resize = Image::make($path);
//                $resize->widen(1000);
//                $resize->save($path, 75);
//            }
//        }
//    }


//    public function setDate_inAttribute($value)
//    {
//        return  Carbon::parse($value);
//    }







}
