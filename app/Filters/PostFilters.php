<?php

namespace App\Filters;



use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Builder;

class PostFilters extends Filters
{
    protected $filters = [
        'id',
        'name',
        'contact',
        'categories',
        'supplierFilter'
    ];

    public function id($id)
    {
        return $this->builder->where('id', $id);
    }

    public function name(string $search)
    {
        return $this->builder->where('name', 'like', "%$search%");
    }


    public function contact($contactName)
    {
        $supplier_id = Contact::where('name', $contactName)->first()->id;
        return $this->builder->whereHas('contact', function (Builder $query) use ($supplier_id) {
            $query->where('contact_id', $supplier_id);
        });
    }

    public function organization($organizationId)
    {
        $supplier_id = Organization::whereId($organizationId)->first()->id;
        return $this->builder->whereHas('contact', function (Builder $query) use ($supplier_id) {
            $query->where('organization_id', $supplier_id);
        });
    }



//    public function categories($categories)
//    {
//        $ids = explode(',', $categories);
//
//        return $this->builder->whereHas('categories', function (Builder $query) use ($ids) {
//            $query->whereIn('category_id', $ids);
//        });
//    }

}
