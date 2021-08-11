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

    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }


    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'first_name'            => $this->first_name,
            'last_name'             => $this->last_name,
            'full_name'             => $this->full_name(),
            'employment'            => $this->employment,
            'email_verified_at'     => $this->email_verified_at,
            'active_organization'   => $this->active_organization,
            'send_invitation'       => $this->send_invitation,
            // 'roles'                 => RoleResource::collection($this->whenLoaded('roles')),
            // 'permissions'           => PermissionResource::collection($this->whenLoaded('permissions')),
            // 'organization'          => new OrganizationResource( $this->organization ),
            'organization'          => $this->organization->name,
            'organization_id'       => $this->organization->id,


            'url' => [
                'view'              => $this->when($request->user()->can('view', $request->user()), route('organizations.users.create', [$this->active_organization])),
                'edit'              => $this->when($request->user()->can('update', $request->user()), route('organizations.users.edit', [$this->active_organization, $this->active_organization])),
                'update'            => $this->when($request->user()->can('update', $request->user()), route('organizations.users.update', [$this->active_organization, $this->id])),
                'store'             => $this->when($request->user()->can('update', $request->user()), route('organizations.users.store', [$this->active_organization])),
                // 'destroy'               => $this->when( $request->user()->can('update', $request->user()), route('organizations.users.destroy', [$this->active_organization, $this->id])),
            ],

            'titles' => [
                'view'              => $this->when($request->user()->can('view', $request->user()), 'Zobraziť'),
                'edit'              => $this->when($request->user()->can('update', $request->user()), 'Upraviť'),
            ]

        ];
    }

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
