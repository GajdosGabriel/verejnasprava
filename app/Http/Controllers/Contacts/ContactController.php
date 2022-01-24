<?php

namespace App\Http\Controllers\Contacts;

use App\Models\User;
use App\Http\Requests;
use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactCreateRequest;

use App\Http\Requests\OrganizationFormRequest;
use App\Http\Requests\OrganizationUpdateRequest;

class ContactController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('contacts.index');
    }

   
}
