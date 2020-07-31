<?php

namespace App\Http\Controllers\Organizations\Contacts;


use App\Models\Contact;
use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;


class ApiContactsController extends Controller
{

    public function getContacts(Organization $organization, $search = null)
    {
        $contacts = $organization->contacts()
            ->where(function (Builder $query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            })->paginate();
        return $contacts;
    }


}
