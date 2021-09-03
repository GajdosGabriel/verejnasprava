<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Filters\ContactFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactCreateRequest;

class OrganizationContactController extends Controller
{
    public function index(Organization $organization, ContactFilters $contactFilters)
    {
        return $organization->contacts()
            ->filter($contactFilters)
            ->paginate();
    }

    public function update(Organization $organization, Contact $contact, ContactCreateRequest $request)
    {
        //        $this->authorize('update', $company);
        $contact->update($request->all());
        //        flash()->success('Dodávateľ aktualizovaný!');
        //        return redirect()->route('contact.index');
    }


    public function store(Organization $organization, ContactCreateRequest $contactRequest)
    {
        $organization->contacts()->create($contactRequest->all());
        //        flash()->success('Dodávateľ bol vytvorený');
        //        return redirect()->route('contact.index');
    }



    public function destroy(Organization $organization, Contact $contact)
    {
        $contact->delete();
    }
}