<?php

namespace App\Http\Resources;

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
            'menus'             => $this->menus,
            // 'menu_active_horizontal'   => $this->menus()->horizontal()->get(),
            // 'menu_active_vertical'   => $this->menus()->vertical()->get(),
            'years_of_posts'    => $this->years_of_posts,
        ];
    }
}
