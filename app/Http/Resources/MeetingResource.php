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
            'items' => $this->items,
            'invitations' => $this->invitations,
            'itemspublished' => $this->itemspublished,
        ];
    }
}
