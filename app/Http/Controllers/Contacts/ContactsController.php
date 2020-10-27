<?php

namespace App\Http\Controllers\Contacts;



use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Models\Contact;
use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContactsController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index() {
        return view('contacts.index');
    }

    public function create(Organization $organization) {
        $org = $organization; // for route
        $organization = new Organization; // for form
        return view('contacts.create', compact('organization', 'org'));
    }



    public function edit(Contact $organization) {
        return view('contacts.edit', compact('organization'));
    }



    public function update(Contact $contact, Request $request) {
//        $this->authorize('update', $company);
        $contact->update($request->all());
//        flash()->success('Dodávateľ aktualizovaný!');
//        return redirect()->route('contact.index');
    }


    public function store(Organization $organization, ContactCreateRequest $contactRequest) {
        $organization->contacts()->create($contactRequest->all());
//        flash()->success('Dodávateľ bol vytvorený');
//        return redirect()->route('contact.index');
    }


}
