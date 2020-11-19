<?php

namespace App\Http\Controllers\Contacts;


use App\Filters\ContactFilters;
use App\Models\Contact;
use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;


class ApiContactsController extends Controller
{

    public function getContacts($organizationId, ContactFilters $contactFilters)
    {
        return Contact::whereOrganizationId($organizationId)
            ->filter($contactFilters)
            ->latest()->paginate();
    }

    public function delete(Contact $contact){
        $contact->delete();
    }


}
