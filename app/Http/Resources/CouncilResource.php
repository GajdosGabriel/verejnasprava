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
            'checked' =>  $this->users->contains(auth()->user()->id)        
        ];
    }
}
