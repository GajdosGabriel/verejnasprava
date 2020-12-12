<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class ModuleActivatorsController extends Controller
{
    public function update($moduleActivations, Request $request)
    {
        $organization = Organization::find($moduleActivations);
        $organization->menus()->toggle($request->input('modul'));
        return back();
    }
}
