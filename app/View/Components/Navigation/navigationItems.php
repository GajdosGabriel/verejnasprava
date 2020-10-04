<?php

namespace App\View\Components\Navigation;

use App\Models\Organization;
use Illuminate\View\Component;

class navigationItems extends Component
{
    public $meeting;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($meeting)
    {
        $this->meeting = $meeting;
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

    public function logoUrl(){
        return route('org.index', [$this->meeting->id, $this->meeting->slug])  ;
    }

    public function logoTitle(){
        return $this->meeting->name;
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
                'url' => route('item.create', [ $this->meeting->id, $this->meeting->slug ]),
                'active' => $this->isActive('item.create')
            ],
        ];
    }
}
