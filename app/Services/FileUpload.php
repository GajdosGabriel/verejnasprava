<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


trait FileUpload
{
    public function saveFile($request) {
        if ($request->hasFile('filename')){

            foreach($request->filename as $file) {
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


        // Delete files in edit form
        if ($request->has('fileDelete')){
            foreach($request->fileDelete as $file) {
                $file = File::find($file);
                    $file->delete();
            }
        }
    }


//    public function saveFile($request) {
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
