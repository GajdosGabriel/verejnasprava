<?php

namespace App\Services;

use Intervention\Image\Facades\Image;


trait FileUpload
{

    public function saveImage($request) {
        if (request()->hasFile('filename')){

            $imageName =  request()->file('filename')->store('username' .  auth()->id() );
            $file = $request->filename->move(storage_path('username' . auth()->id()), $imageName);
            $path = storage_path('username' . auth()->id()) . '/' . basename($file);

            $this->file()->create([
                'filename' => $imageName,
                'name' => request()->filename->getClientOriginalName(),
            ]);

            if (getimagesize($path)) {
                $resize = Image::make($path);
                $resize->widen(1000);
                $resize->save($path, 75);
            }
        }
    }


}