<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Filters\ContactFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Requests\ContactCreateRequest;

class OrganizationContactController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contact::class, 'contact');
    }

    public function index(Organization $organization, ContactFilters $contactFilters)
    {
        $contacts = $organization->contacts()
            ->filter($contactFilters)
            ->paginate();

        return ContactResource::collection($contacts);
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
        if ($contact->posts->count()) {
            return response()->json(['message' => 'Kontakt už obsahuje zverejnené doklady.'], 401);
        }

        $contact->delete();
    }
}
