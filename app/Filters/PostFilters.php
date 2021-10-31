<?php

namespace App\Filters;



use App\Models\Organization;

class PostFilters extends Filters
{
    protected $filters = [
        'id',
        'name',
        'contact',
        'category',
        'categories',
        'supplierFilter',
        'organization',
        'year'
    ];

    public function id($id)
    {
        return $this->builder->where('id', $id);
    }

    public function name(string $search)
    {
        return $this->builder->where('name', 'like', "%$search%");
    }

    public function contact($contactId)
    {
        return $this->builder->where('contact_id', 'like', $contactId );
    }

    public function category($categoryId)
    {
        return $this->builder->where('category_id', 'like', $categoryId );
    }

    public function year($year)
    {
        return $this->builder->whereYear('date_in', $year );
    }


//    public function contact($contactName)
//    {
//        $supplier_id = Contact::where('name', $contactName)->first()->id;
//        return $this->builder->whereHas('contact', function (Builder $query) use ($supplier_id) {
//            $query->where('contact_id', $supplier_id);
//        });
//    }

    public function organization($organizationName)
    {
        $org_id = Organization::where('name', $organizationName)->first()->id;
        return $this->builder->where('organization_id', $org_id);
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
