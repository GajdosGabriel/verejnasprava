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

            'navigations' => [
                'show' =>  $this->when(auth()->user()->can("view", $this->resource), [
                    'name' => 'Zobraziť',
                    'title' => 'Zobraziť položku',
                    'action' => 'show',
                    'url' => route('organizations.contacts.show', [$this->organization_id, $this->id]),
                    'icon' => 'iconShow',
                ]),

                'edit' =>  $this->when(auth()->user()->can("update", $this->resource), [
                    'name' => 'Upraviť',
                    'title' => 'Upraviť položku',
                    'action' => 'edit',
                    'url' => '',
                    'icon' => 'iconEdit',
                ]),

                'delete' => $this->when(auth()->user()->can("delete", $this->resource), [
                    'name' => 'Zmazať',
                    'title' => 'Zmazať položku',
                    'action' => 'delete',
                    'url' => route('organizations.contacts.destroy', [$this->organization_id, $this->id]),
                    'icon' => 'iconDelete',
                ])
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
