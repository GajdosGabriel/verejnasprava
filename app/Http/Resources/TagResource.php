<?php

namespace App\Http\Resources;

use Attribute;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'organization_id' => $this->organization_id,
            'name' => $this->name,
            'slug' => $this->slug,

            'attribute' => [
                'index'     =>  route('organizations.tags.index', [auth()->user()->active_organization]),
                'show'      =>  route('organizations.tags.show', [auth()->user()->active_organization, $this->id]),
                'store'     =>  route('organizations.tags.store', [auth()->user()->active_organization]),
                'destroy'   =>  route('organizations.tags.destroy', [auth()->user()->active_organization, $this->id]),
            ],

            "can" => [
                "viewAny"   => auth()->user()->can("viewAny", $this->resource),
                "view"      => auth()->user()->can("view", $this->resource),
                "create"    => auth()->user()->can("create", $this->resource),
                "update"    => auth()->user()->can("update", $this->resource),
                "store"     => auth()->user()->can("store", $this->resource),
                "delete"    => auth()->user()->can("delete", $this->resource)
            ]
        ];

    }

    

}
