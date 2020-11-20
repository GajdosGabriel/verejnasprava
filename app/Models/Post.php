<?php

namespace App\Models;


use App\Models\RecordsActivity;
use App\Services\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;


class Post extends Model
{
    use RecordsActivity, FileUpload, SoftDeletes, HasFactory;

    protected $guarded = [];
    protected $with = ['category', 'files', 'contact', 'organization'];
    protected $casts = [
        'date_in' => 'date'
    ];

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
            $imageName =  request()->file('filename')->store('username' .  auth()->id() );
            $file = $request->filename->move(storage_path('username' . auth()->id()), $imageName);
            $path = storage_path('username' . auth()->id()) . '/' . basename($file);

            $this->file()->create([
                'filename' => $imageName,
                'name' => $request->filename->getClientOriginalName(),
            ]);

            if (getimagesize($path)) {
                $resize = Image::make($path);
                $resize->widen(1000);
                $resize->save($path, 75);
            }
        }
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }







}
