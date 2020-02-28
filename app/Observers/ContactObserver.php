<?php

namespace App\Observers;

use App\Contact;
use Illuminate\Support\Str;

class ContactObserver
{
    public function saving(Contact $contact)
    {
        $contact->slug = Str::slug($contact->name, '-');
    }
}
