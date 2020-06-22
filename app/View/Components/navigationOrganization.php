<?php

namespace App\View\Components;

use App\Models\Organization;
use Illuminate\View\Component;
use App\Services\Navigation;

class navigationOrganization extends Component
{
    public $object;
    public $navigation;

    /**
     * Create a new component instance.
     *
     * @param \App\Services\Navigation $navigation
     */
    public function __construct(Navigation $navigation)
    {
        $this->navigation = $navigation;
        $this->object = Organization::whereId(auth()->user()->active_organization)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navigation');
    }

    public function logoUrl()
    {
        return route('org.index', [$this->object->id, $this->object->slug]);
    }

    public function logoTitle()
    {
        return $this->object->name;
    }


    public function headerMenu()
    {
        return [
            $this->navigation->zverejnovanie($this->object->id, $this->object->slug),
            $this->navigation->contacts($this->object->id, $this->object->slug),
            $this->navigation->orders($this->object->id, $this->object->slug),
            $this->navigation->councils($this->object->id, $this->object->slug),
            $this->navigation->navody($this->object->id, $this->object->slug),
        ];
    }


    public function dropDownItems()
    {
        return [
            [
                'title' => 'Nastavenia',
                'url' => route('org.edit', [$this->object->id, $this->object->slug])
            ],
            [
                'title' => 'Ľudia',
                'url' => route('user.index', [$this->object->id, $this->object->slug])
            ],
            [
                'title' => 'Objednávky',
                'url' => route('order.index', [$this->object->id, $this->object->slug])
            ],
            [
                'title' => 'Zastupiteľstva',
                'url' => route('zast.admin.index', [$this->object->id, $this->object->slug])
            ],
            [
                'title' => 'Návody',
                'url' => route('question.index', [auth()->user()->id, auth()->user()->slug])
            ]
        ];
    }
}
