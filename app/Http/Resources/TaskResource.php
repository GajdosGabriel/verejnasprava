<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'requested_id' => $this->requested_id,
            'user_id' => $this->user_id,
            'organization_id' => $this->organization_id,
            'due_date' => $this->due_date,
            'due_time' => $this->due_time,
            'name' => $this->name,
            'body' => $this->body,
            'completed' => $this->completed,
            'created_at' => $this->created_at,
            // 'routeindex' =>  route('users.tasks.index', $this->id) 
        ];
    }
}
