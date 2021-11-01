<?php

namespace App\Http\Resources;

use App\Models\Menu;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'street'            => $this->street,
            'city'              => $this->city,
            'psc'               => $this->psc,
            'phones'            => $this->phone,
            'web'               => $this->web,
            'ico'               => $this->ico,
            'dic'               => $this->dic,
            'ic_dic'            => $this->when($this->ic_dic, $this->ic_dic),
            'menus'             => MenuResource::collection($this->menus),
            'paidmodules'       => MenuResource::collection(Menu::paidmodule()->get()),
            'menuactive'        => MenuResource::collection($this->menus()->paidmodule()->get()),
            'years_of_posts'    => $this->years_of_posts,
            'authUser'              => new UserResource($this->user)
        ];
    }
}
