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
            // 'routeindex'        => route('organizations.posts.index', auth()->user()->organization_active),
            // 'testovanie'        => $this->when( \Auth::check() && \Auth::user()->can('create', App\Models\Post::class), 'niečo' ),
            // 'testovanie'        => $this->when( auth()->user()->can('create', App\Models\Post::class), 'niečo' ),

            'navigations' => [
                'edit' => $this->when( auth()->user()->hasAnyRole(['admin', 'moderator']), [
                    'name' => 'Upraviť',
                    'title' => 'Upraviť položku',
                    'action' => 'edit',
                    'url' => route('posts.edit', [$this->id]),
                    'icon' => 'iconEdit',
                ]),

                'delete' =>  $this->when( auth()->user()->hasAnyRole(['admin', 'moderator']), [
                    'name' => 'Zmazať',
                    'title' => 'Zmazať položku',
                    'action' => 'delete',
                    'url' => route('organizations.posts.destroy', [$this->organization_id, $this->id]),
                    'icon' => 'iconDelete',
                ])
            ],
        ];
    }
}
