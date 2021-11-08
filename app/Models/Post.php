<?php

namespace App\Models;


use App\Models\RecordsActivity;
use App\Services\FileUpload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;


class Post extends Model
{
    use RecordsActivity, FileUpload, SoftDeletes, HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'date_in' => 'datetime'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
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

    // Date for create and edit form
    public function getDatessAttribute()
    {
        if($this->date_in) {
          return  $this->date_in->format('Y-m-d\TH:i');
        } else {
            return Carbon::now()->format('Y-m-d\TH:i');
        }
    }


}
