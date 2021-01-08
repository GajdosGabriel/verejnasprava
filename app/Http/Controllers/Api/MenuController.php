<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Organization;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show($id){
        $menu = Menu::horizontalMenu()->get();
        $organization = Organization::find($id);

        return response([ $menu, $organization]);
    }

    public function update($id, Request $request)
    {
        $organization = Organization::find($id);
        $organization->menus()->toggle($request->input('modul'));
    }
}
