<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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

            'id'              => $this->id,
            'name'            => $this->name,
            'organization_id' => $this->organization_id,
            'email'           => $this->email,
            'street'          => $this->street,
            'city'            => $this->city,
            'psc'             => $this->psc,
            'phone'           => $this->phone,
            'ico'             => $this->ico,
            'dic'             => $this->dic,
            'ic_dic'          => $this->when($this->ic_dic, $this->ic_dic),

            'links' => [
                // 'view'              => $this->when($request->user()->can('view', $request->user()), route('organizations.users.create', [$this->active_organization])),
                // 'edit'              => $this->when($request->user()->can('update', $request->user()), route('organizations.users.edit', [$this->active_organization, $this->active_organization])),
                // 'update'            => $this->when($request->user()->can('update', $request->user()), route('organizations.users.update', [$this->active_organization, $this->id])),
                // 'store'             => $this->when($request->user()->can('update', $request->user()), route('organizations.users.store', [$this->active_organization])),
                // 'destroy'           => $this->when( $request->user()->can('update', $request->user()), route('organizations.users.destroy', [$this->active_organization, $this->id])),
            ],
        ];
    }
}
