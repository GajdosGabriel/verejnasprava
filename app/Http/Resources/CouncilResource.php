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
            'url'               => [
                'index'     =>  route('organizations.councils.index', [auth()->user()->active_organization]),
                'show'      =>  route('organizations.councils.show', [auth()->user()->active_organization, $this->id]),
                'store'     =>  route('organizations.councils.store', [auth()->user()->active_organization]),
                'destroy'   =>  route('organizations.councils.destroy', [auth()->user()->active_organization, $this->id]),
            ],
        ];
    }
}
