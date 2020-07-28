<?php

namespace App\View\Components;

use App\Models\Organization;
use Illuminate\View\Component;

class navigationItems extends Component
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

    public function isActive($routeName) {
        if( \Route::currentRouteName() === $routeName  ) {
            return 'font-semibold text-white underline';
        }
        return 'text-teal-200';
    }


    public function headerMenu(){
        return [
            [
                'title' => 'Nový návrh',
                'url' => route('item.create', [$this->object->id, $this->object->slug ]),
                'active' => $this->isActive('item.create')
            ],

        ];
    }
}
