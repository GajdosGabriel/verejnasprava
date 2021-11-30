<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'council_id' => $this->council_id,
            'user_id' => $this->user_id,
            'council_users' => $this->council->users,
            'council_quorate' => $this->council->quorate,
            'locality' => $this->locality,
            'start_at' => $this->start_at,
            'published' => $this->published,
            'notification' => $this->notification,
            'users' => $this->users,
            'files' => $this->files,
            'items' =>ItemResource::collection($this->items),
            'invitations' => $this->invitations,
            'itemspublished' => $this->itemspublished,
         
            'navigations' => [

                'create' => $this->when(auth()->user()->can("create", $this->resource), [
                    'name' => 'Nový návrh programu',
                    'title' => 'Vytvoriť položku',
                    'action' => 'create',
                    'url' => route('meeting.item.create', [$this->id]),
                    'icon' => 'iconCreate',
                ]),

                'published' => $this->when(auth()->user()->can("view", $this->resource), [
                    'name' => 'Publikovať zasadnutie',
                    'title' => 'Publikovať zqasadnutie',
                    'action' => 'published',
                    'url' => route('council.meeting.create', [$this->council_id, $this->id]),
                    'icon' => 'iconPublished',
                ]),

                'edit' => $this->when(auth()->user()->can("update", $this->resource), [
                    'name' => 'Upraviť zasadnutie',
                    'title' => 'Upraviť položku',
                    'action' => 'edit',
                    'url' => route('meetings.edit', [$this->id]),
                    'icon' => 'iconEdit',
                ]),

                'delete' =>  $this->when(auth()->user()->can("delete", $this->resource), [
                    'name' => 'Zmazať',
                    'title' => 'Zmazať položku',
                    'action' => 'delete',
                    'url' => route('councils.meetings.destroy', [$this->council_id, $this->id]),
                    'icon' => 'iconDelete',
                ])
            ],
        ];
    }
}
