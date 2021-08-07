<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationContactController extends Controller
{
    public function show(Organization $organization, Contact $contact) {
        return view('contacts.show', ['user' => $contact]);
    }
}
