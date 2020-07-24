<?php

namespace App\Http\Controllers\Organizations\Contacts;


use App\Models\Contact;
use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ApiContactsController extends Controller
{


    public function getContacts(Organization $organization, $search = null)
    {
        $contacts = Contact::whereOrganizationId($organization->id)
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('city', 'like', '%' . $search . '%')->get();
        return $contacts;
    }


}
