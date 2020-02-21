<?php

namespace App\Http\Controllers\Companies;


use App\Company;
use App\Organization;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCompanyRequest;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(Organization $organization) {
        $companies = $organization->companies()->paginate(15);
        return view('companies.index', compact('companies'));
    }


    public function editCustomer($user, Company $company) {

        return view('companies.edit')->with('company', $company);
    }



    public function updateCustomer (SaveCompanyRequest $request, Company $company) {

        $this->authorize('update', $company);
        $company->update( $request->all() );
//        flash()->success('Dodávateľ aktualizovaný!');
        return back();

    }


    public function store(Organization $organization, SaveCompanyRequest $request) {

        $organization->companies()->create($request->all());
//        flash()->success('Dodávateľ bol vytvorený');
        return back();
    }


}
