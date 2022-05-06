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
            'deleted_at'       => $this->deleted_at,
            'ic_dic'          => $this->when($this->ic_dic, $this->ic_dic),
            'url' => [
                'show'          => route('organization.contact.show', [$this->organization_id, $this->id]),
                'updateDelete'  => route('organizations.contacts.destroy', [$this->organization_id, $this->id]),
                'store'         => route('organizations.contacts.store', [$this->organization_id]),
            ],

            'navigations' => [
                'show' =>  $this->when(auth()->user()->can("view", $this->resource), [
                    'name' => 'Zobraziť',
                    'title' => 'Zobraziť položku',
                    'action' => 'show',
                    'url' => route('organization.contact.show', [$this->organization_id, $this->id]),
                    'icon' => 'iconShow',
                ]),

                'edit' =>  $this->when(auth()->user()->can("update", $this->resource), [
                    'name' => 'Upraviť',
                    'title' => 'Upraviť položku',
                    'action' => 'edit',
                    'url' => route('organization.contact.edit', [$this->organization_id, $this->id]),
                    'typeOfButton' => 'button',
                    'icon' => 'iconEdit',
                ]),

                'delete' => $this->when(auth()->user()->can("delete", $this->resource), [
                    'name' => $this->deleted_at ? 'Obnoviť' : 'Zmazať',
                    'title' =>  $this->deleted_at ? 'Obnoviť kontakt' : 'Zmazať položku',
                    'action' => 'delete',
                    'typeOfButton' => 'button',
                    'url' => route('organizations.contacts.destroy', [$this->organization_id, $this->id]),
                    'icon' =>  $this->deleted_at ? 'iconBack' : 'iconDelete',
                ])
            ],

            // "can" => [
            //     "viewAny"   => auth()->user()->can("viewAny", $this->resource),
            //     "view"      => auth()->user()->can("view", $this->resource),
            //     "create"    => auth()->user()->can("create", $this->resource),
            //     "update"    => auth()->user()->can("update", $this->resource),
            //     "delete"    => auth()->user()->can("delete", $this->resource)
            // ]
        ];
       
    }
}
