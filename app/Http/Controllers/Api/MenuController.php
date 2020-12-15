<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Organization;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $menu = Menu::horizontalMenu()->get();
        $organization = Organization::find(1);

        return response([ $menu, $organization]);
    }

    public function update($menus, Request $request)
    {
        $organization = Organization::find($menus);
        $organization->menus()->toggle($request->input('modul'));
    }
}
