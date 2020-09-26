<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class ApiCouncilController extends Controller
{
    public function index(Organization $organization)
    {
      $councils =  $organization->councils()->orderBy('id', 'asc')->get();
      return $councils;
    }
}
