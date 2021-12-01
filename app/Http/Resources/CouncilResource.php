<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouncilResource extends JsonResource
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
            'min_user' => $this->min_user,
            'approved' => $this->approved,
            'quorate' => $this->quorate,
            'name' => $this->name,
            'description' => $this->description,
            'checked' =>  $this->users->contains(auth()->user()->id),
            'meetings_count' => $this->meetings()->count(),
            'meetings' => MeetingResource::collection($this->meetings),
            'users' => $this->users,
            'url'               => [
                'index'     =>  route('organizations.councils.index', [auth()->user()->active_organization]),
                'show'      =>  route('organizations.councils.show', [auth()->user()->active_organization, $this->id]),
                'store'     =>  route('organizations.councils.store', [auth()->user()->active_organization]),
                'destroy'   =>  route('organizations.councils.destroy', [auth()->user()->active_organization, $this->id]),
            ],

            'navigations' => [

                'create' => $this->when(auth()->user()->can("create", $this->resource), [
                    'name' => 'Nové zasadnutie',
                    'title' => 'Vytvoriť nové zasadnutie zastupiteľstva',
                    'action' => 'create',
                    'url' => route('council.meeting.create', [$this->organization_id]),
                    'icon' => 'iconCreate',
                ]),

                'edit' => $this->when(auth()->user()->can("update", $this->resource), [
                    'name' => 'Upraviť',
                    'title' => 'Upraviť položku',
                    'action' => 'edit',
                    'url' => route('organizations.councils.edit', [$this->organization_id, $this->id]),
                    'icon' => 'iconEdit',
                ]),

                'delete' =>  $this->when(auth()->user()->can("delete", $this->resource), [
                    'name' => 'Zmazať',
                    'title' => 'Zmazať položku',
                    'action' => 'delete',
                    'typeOfButton' => 'button',
                    'url' => route('organizations.councils.destroy', [$this->organization_id, $this->id]),
                    'icon' => 'iconDelete',
                ])
            ],

        ];
    }
}
