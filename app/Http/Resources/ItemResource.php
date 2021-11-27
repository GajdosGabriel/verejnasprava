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
        ];
    }
}
