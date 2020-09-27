<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Council;
use App\Models\Organization;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Description;

class ApiCouncilController extends Controller
{
    public function index(Organization $organization)
    {
      $councils =  $organization->councils()->orderBy('id', 'asc')->get();
      return $councils;
    }

    public function update(Request $request, Council $council) {
        $council->update($request->only(['name', 'description']));
        return $council;
    }

}
