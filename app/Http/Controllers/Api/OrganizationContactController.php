<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Filters\ContactFilters;
use App\Http\Controllers\Controller;

class OrganizationContactController extends Controller
{
    public function index(Organization $organization, ContactFilters $contactFilters)
    {
        return $organization->contacts()
            ->filter($contactFilters)
            ->latest()->paginate();
    }

    public function destroy(Organization $organization, Contact $contact){
        $contact->delete();
    }
}
