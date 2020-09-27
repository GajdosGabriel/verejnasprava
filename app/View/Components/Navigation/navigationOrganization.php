<?php

namespace App\View\Components\Navigation;

use App\Models\Organization;
use Illuminate\View\Component;
use App\View\Components\Navigation\navItems;

class navigationOrganization extends Component
{
    public $object;
    public $navigation;

    public function __construct(navItems $navigation)
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
        return view('components.navigation.navigation');
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
            $this->navigation->zverejnovanie(),
            $this->navigation->contacts(),
            $this->navigation->tasks(),
            $this->navigation->orders($this->object->id, $this->object->slug),
            $this->navigation->councils($this->object->id, $this->object->slug),
            $this->navigation->navody(),
        ];
    }


    public function dropDownItems()
    {
        return [
            [
                'title' => 'Nastavenia',
                'url' => route('user.setup')
            ],
            [
                'title' => 'Ľudia',
                'url' => route('user.index', [$this->object->id, $this->object->slug])
            ],
            $this->navigation->orders($this->object->id, $this->object->slug),
//            $this->navigation->councils($this->object->id, $this->object->slug),
        ];
    }
}
