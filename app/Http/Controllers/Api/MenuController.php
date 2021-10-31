<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;

class MenuController extends Controller
{
    public function update(Organization $menu, Request $request)
    {
        Menu::activatorOfMenus($menu, $request->input('modul'));

    }
}
