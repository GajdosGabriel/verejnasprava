<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Council;
use App\Models\Organization;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Description;

class ApiCouncilController extends Controller
{

    public function show(Council $council){
        return $council;
    }

    public function update(Request $request, Council $council) {
        $council->update($request->only(['name', 'description', 'quorate', 'min_user']));
        return $council;
    }

    public function destroy(Council $council) {
        $council->delete();
    }

}
