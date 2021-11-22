<?php

namespace App\Http\Resources;

use App\Models\Menu;
use App\Http\Resources\MenuResource;
use App\Http\Resources\CouncilResource;
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
            'dic'               => $this->when($this->ic_dic, $this->ic_dic),
            'user'              => $this->user,
            'ic_dic'            => $this->when($this->ic_dic, $this->ic_dic),
            'menus'             => [
                'menuActive'    => MenuResource::collection($this->menus),
                'paidmodules'   => MenuResource::collection(Menu::paidmodule()->get()),
                'horizontal'    => MenuResource::collection($this->horizontal),
                'vertical'      => MenuResource::collection($this->vertical),
            ],
            'posts' => [
                // 'postsindex'     =>  route('organizations.posts.index', [auth()->user()->active_organization]),
                'years_of_posts'    => $this->years_of_posts,

            ],

            'councils'          => CouncilResource::collection($this->councils),

            "can" => [
                "viewAny"   => auth()->user()->can("viewAny", $this->resource),
                "view"      => auth()->user()->can("view", $this->resource),
                "create"    => auth()->user()->can("create", $this->resource),
                "update"    => auth()->user()->can("update", $this->resource),
                "store"     => auth()->user()->can("store", $this->resource),
                "delete"    => auth()->user()->can("delete", $this->resource)
            ]

        ];
    }
}
