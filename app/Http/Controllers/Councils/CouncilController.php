<?php

namespace App\Http\Controllers\Councils;


use App\Http\Controllers\Controller;
use App\Models\Council\Council;
use App\Models\Organization;
use Illuminate\Http\Request;

class CouncilController extends Controller
{
    public function index(Organization $organization){
        return view('council.index', compact('organization'));
    }

    public function create(Organization $organization){
        $council = new Council();
        return view('council.create', compact('organization','council') );
    }

    public function edit(Council $council){
        return view('council.edit', compact('council') );
    }

    public function update(Request $request, Council $council) {
        $council->update(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        return redirect()->route('zast.index', [$council->organization_id, $council->slug]);
    }


    public function store(Request $request, Organization $organization) {
        $organization->councils()->create(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        return redirect()->route('zast.index', [$organization->id, $organization->slug]);
    }
}
