<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


trait FileUpload
{
    public function saveImage($request) {
        if ($request->hasFile('filename')){

            foreach($request->filename as $file) {

                //            $path =  $file->store('public/username' .  auth()->id() );
                //            $file = $request->filename->move(storage_path('organization' . auth()->id()), $imageName);
                //            $path = storage_path('public/username' . auth()->id()) . '/' . basename($file);

                $url =  Storage::disk('public')->put('organization' .  auth()->user()->active_organization, $file);

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


//    public function saveImage($request) {
//        if (request()->hasFile('filename')){
//
//            $imageName =  request()->file('filename')->store('organization' .  auth()->user()->active_organization );
//            $file = $request->filename->move(storage_path('organization' .auth()->user()->active_organization), $imageName);
//            $path = storage_path('organization' . auth()->user()->active_organization) . '/' . basename($file);
//
//            $this->file()->create([
//                'filename' => $imageName,
//                'name' => request()->filename->getClientOriginalName(),
//            ]);
//
//            if (getimagesize($path)) {
//                $resize = Image::make($path);
//                $resize->widen(1000);
//                $resize->save($path, 75);
//            }
//        }
//    }


}
