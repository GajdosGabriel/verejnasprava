<?php

namespace App\Observers;

use App\Company;
use Illuminate\Support\Str;

class CompanyObserver
{
    public function saving(Company $company)
    {
        $company->slug = Str::slug($company->name, '-');
    }
}
