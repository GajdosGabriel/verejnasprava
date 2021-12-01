<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'user_id' => $this->user_id,
            'position' => $this->position,
            'name' => $this->name,
            'body' => $this->body,
            'vote_status' => $this->vote_status,
            'vote_type' => $this->vote_type,
            'published' => $this->published,
            'result' => $this->result,
            'notification' => $this->notification,
            'interpellations' => $this->interpellations,
            'files' => $this->files,
            'votes' => $this->votes,
            'user' => $this->user,

            'navigations' => [

                'published' => $this->when(auth()->user()->can("notifiToVote", $this->resource), [
                    'name' => 'Publikovať položku',
                    'title' => 'Publikovať bod programu',
                    'action' => 'published',
                    'typeOfButton' => 'button',
                    'url' => route('items.update', [$this->id]),
                    'icon' => 'iconPublished',
                ]),

                'edit' => $this->when(auth()->user()->can("update", $this->resource), [
                    'name' => 'Upraviť položku',
                    'title' => 'Upraviť návrh',
                    'action' => 'edit',
                    'url' => route('items.edit', [$this->id]),
                    'icon' => 'iconEdit',
                ]),

                'notifiToVote' => $this->when(auth()->user()->can("notifiToVote", $this->resource), [
                    'name' => 'Výzva k hlasovanie',
                    'title' => 'Zaslať emailovú výzvu na hlasovanie',
                    'action' => 'notifiToVote',
                    'typeOfButton' => 'button',
                    'url' => '',
                    'icon' => 'iconEnvelop',
                ]),

                'moveToItems' => $this->when(auth()->user()->can("notifiToVote", $this->resource), [
                    'name' => 'Späť do návrhoch',
                    'title' => 'Stiahnúť návrh z rokovania.',
                    'action' => 'moveToItems',
                    'typeOfButton' => 'button',
                    'url' => '',
                    'icon' => 'iconArrow',
                ]),

                'delete' =>  $this->when(! auth()->user()->can("notifiToVote", $this->resource), [
                    'name' => 'Zmazať',
                    'title' => 'Zmazať položku',
                    'action' => 'delete',
                    'typeOfButton' => 'button',
                    'url' => '',
                    'icon' => 'iconDelete',
                ])
            ],
        ];
    }
}
