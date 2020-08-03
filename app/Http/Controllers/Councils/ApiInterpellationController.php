<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class ApiInterpellationController extends Controller
{
    public function getIndex(Item $itemId) {
        return $itemId->interpellations()->get();
    }
}
