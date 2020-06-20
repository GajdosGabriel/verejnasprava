<?php

namespace App\View\Components;

use App\Models\Organization;
use Illuminate\View\Component;

class navigationMeeting extends Component
{
    public $object;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
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

    public function logoUrl(){
        return route('org.index', [$this->object->id, $this->object->slug])  ;
    }

    public function logoTitle(){
        return $this->object->name;
    }


    public function headerMenu()
    {
        $nav = new \App\Services\Navigation();
        $nav->zverejnovanie($this->object->id, $this->object->slug) ;
        return [
            $nav->zverejnovanie($this->object->id, $this->object->slug),
            $nav->contacts($this->object->id, $this->object->slug),
            $nav->orders($this->object->id, $this->object->slug),
            $nav->councils($this->object->id, $this->object->slug),
            $nav->navody($this->object->id, $this->object->slug),
        ];
    }
}
