<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function show (File $file, $name )
    {
        if ($file) {
            return response()->file( 'storage/'. $file->path);
        } else {
            abort(404);
        }
    }
}
