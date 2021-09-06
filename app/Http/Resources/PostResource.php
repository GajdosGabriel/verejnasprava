<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'contact'           => $this->contact,
            'organization'      => $this->organization,
            'files'             => $this->files,
            'date_in'           => $this->date_in,
            'organization_id'   => $this->organization_id,
            'contact_id'        => $this->contact_id,
            'category_id'       => $this->category_id,
            'dic'               => $this->dic,
            'ic_dic'            => $this->when($this->ic_dic, $this->ic_dic),
            'testovanie'        => $this->when( auth()->user(), 'niečo' ),

            'links' => [
                // 'view'              => $this->when($request->user()->can('view', $request->user()), route('organizations.users.create', [$this->active_organization])),
                // 'edit'              => $this->when($request->user()->can('update', $request->user()), route('organizations.users.edit', [$this->active_organization, $this->active_organization])),
                // 'destroy'           => $this->when($request->user()->can('destroy', $request->user()), route('organizations.posts.update', [$this->organization_id, $this->id])),
                // 'store'             => $this->when($request->user()->can('update', $request->user()), route('organizations.users.store', [$this->active_organization])),
                // 'destroy'           => $this->when( $request->user()->can('update', $request->user()), route('organizations.users.destroy', [$this->active_organization, $this->id])),
            ],
        ];
    }
}
