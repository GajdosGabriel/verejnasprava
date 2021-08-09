<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }


    // public function toArray($request)
    // {
    //     return [
    //         'canUpdate'             => $request->user->can('update',$request->user),
    //         'id'                    => $this->id,
    //         'first_name'            => $this->first_name,
    //         'last_name'             => $this->last_name,
    //         'full_name'             => $this->full_name(),
    //         'employment'            => $this->employment,
    //         'email_verified_at'     => $this->email_verified_at,
    //         'active_organization'   => $this->active_organization,
    //         'send_invitation'       => $this->send_invitation,
    //         'url' => [
    //             'view'                  => route('organizations.users.show', [$this->active_organization, $this->id]),
    //             'create'                => $request->user->can('create',$request->user) ? route('organizations.users.create', [$this->active_organization])  : false,
    //             'edit'                  => $request->user->can('update',$request->user) ? route('organizations.users.edit', [$this->active_organization, $this->id])  : false,
    //             'update'                => $request->user->can('update',$request->user) ? route('organizations.users.update', [$this->active_organization, $this->id]) : false,
    //             'store'                 => route('organizations.users.store', [$this->active_organization]),
    //             'destroy'               => $request->user->can('delete',$request->user) ? route('organizations.users.destroy', [$this->active_organization, $this->id])  : false,
    //         ]

    //     ];
    // }

    // public function with($request) {
    //     //
    // }


    // 'canUpdate'  => $request->user->can('update',$request->user),

    // 'author_name' => $this->author->name,
    // 'author_url' => route('users.show', $this->author),
    // 'can_delete' => $user ? $user->can('delete', $this->resource) : false

    // 'url' => url($this->getUrl()),
    // 'thumb_url' => url($this->getUrl('thumb')),

    // 'comments_count' => $this->comments_count ?? $this->comments()->count(),
    // 'thumbnail_url' => $this->when($this->hasThumbnail(), url(optional($this->thumbnail)->getUrl())),
    // 'thumb_thumbnail_url' => $this->when($this->hasThumbnail(), url(optional($this->thumbnail)->getUrl('thumb')))

    // 'roles' => Role::collection($this->roles),
    // 'price' => number_format($this->price / 100, 2)
}
