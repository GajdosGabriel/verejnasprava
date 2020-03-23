<?php

namespace App;

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

//    public function file()
//    {
//        return $this->hasMany(File::class);
//    }

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

    public function saveImage($request) {
        if ($request->hasFile('filename')){

            foreach($request->filename as $file) {

    //            $path =  $file->store('public/username' .  auth()->id() );
    //            $file = $request->filename->move(storage_path('username' . auth()->id()), $imageName);
    //            $path = storage_path('public/username' . auth()->id()) . '/' . basename($file);

              $url =  Storage::disk('public')->put('username' .  auth()->id(), $file);

                $this->files()->create([
                    'filename' => $this->slug,
                    'path' => $url,
                    'org_name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientOriginalExtension()
                ]);

    //            if (getimagesize($path)) {
    //                $resize = Image::make($path);
    //                $resize->widen(1000);
    //                $resize->save($path, 75);
    //            }

            }
        }
    }


//    public function setDate_inAttribute($value)
//    {
//        return  Carbon::parse($value);
//    }








}
