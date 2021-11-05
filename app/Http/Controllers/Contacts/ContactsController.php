<?php

namespace App\Http\Controllers\Contacts;

use App\Models\User;
use App\Http\Requests;
use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Notifications\ContactUs;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactCreateRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\OrganizationFormRequest;
use App\Http\Requests\OrganizationUpdateRequest;

class ContactsController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('contacts.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'body' => 'required',
        ]);

        $users = User::whereHas('roles', function ($q) {
            $q->whereName('super-admin');
        })->get();

        foreach ($users as $user) {
            Notification::send($user, new ContactUs($request));
        }

        session()->flash('flash', 'Správa bola odoslaná.');

        return redirect()->back();
    }
}
