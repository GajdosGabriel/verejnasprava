<?php

namespace App\Http\Controllers\Organizations\Contacts;



use App\Contact;
use App\Http\Requests\OrganizationFormRequest;
use App\Organization;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContactsController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Organization $organization) {
        return view('contacts.index', compact('organization'))
//            ->with('organization', new Organization)
            ;
    }

    public function create(Organization $organization, $slug) {
        $org = $organization; // for route
        $organization = new Organization; // for form
        return view('contacts.create', compact('organization', 'org'));
    }



    public function edit(Contact $organization, $slug) {
        return view('contacts.edit', compact('organization'));
    }



    public function update(Contact $organization, OrganizationFormRequest $request) {
//        $this->authorize('update', $company);
        $organization->update($request->all());
//        flash()->success('Dodávateľ aktualizovaný!');
        return back();

    }


    public function store(Organization $organization, OrganizationFormRequest $request) {

        $organization->contacts()->create($request->all());
//        flash()->success('Dodávateľ bol vytvorený');
        return back();
    }


}
