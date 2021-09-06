<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostfrontedResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'int_number'        => $this->int_number,
            'number_invoice'    => $this->number_invoice,
            'price'             => $this->price,
            'category'          => $this->category,
            'contact_name'      => $this->contact->name,
            'contact_id'        => $this->contact->id,
            'organization_name' => $this->organization->name,
            'files'             => $this->files,
            'date_in'           => $this->date_in,
            'organization_id'   => $this->organization_id,
            'contact_id'        => $this->contact_id,
            'category_id'       => $this->category_id,
            'dic'               => $this->dic,
            'ic_dic'            => $this->when($this->ic_dic, $this->ic_dic),

        ];
    }
}
