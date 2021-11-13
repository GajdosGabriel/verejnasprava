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
            'url'               => [
                    'index'     =>  route('organizations.posts.index', [auth()->user()->active_organization]),
                    'show'      =>  route('organizations.posts.show', [auth()->user()->active_organization, $this->id]),
                    'store'     =>  route('organizations.posts.store', [auth()->user()->active_organization]),
                    'destroy'   =>  route('organizations.posts.destroy', [auth()->user()->active_organization, $this->id]),
            ],
            // 'testovanie'        => $this->when( \Auth::check() && \Auth::user()->can('create', App\Models\Post::class), 'niečo' ),
            // 'testovanie'        => $this->when( auth()->user()->can('create', App\Models\Post::class), 'niečo' ),

            'navigations' => [
                'edit' => $this->when(auth()->user()->hasAnyRole(['admin', 'moderator']) || auth()->user()->id == $this->user_id, [
                    'name' => 'Upraviť',
                    'title' => 'Upraviť položku',
                    'action' => 'edit',
                    'url' => route('posts.edit', [$this->id]),
                    'icon' => 'iconEdit',
                ]),

                'delete' =>  $this->when(auth()->user()->hasAnyRole(['admin', 'moderator']) || auth()->user()->id == $this->user_id, [
                    'name' => 'Zmazať',
                    'title' => 'Zmazať položku',
                    'action' => 'delete',
                    'url' => route('organizations.posts.destroy', [$this->organization_id, $this->id]),
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
