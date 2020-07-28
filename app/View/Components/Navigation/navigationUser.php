<?php

namespace App\View\Components\Navigation;

use App\View\Components\Navigation\navItems;
use Illuminate\View\Component;

class navigationUser extends Component
{
    public $navigation;

    /**
     * Create a new component instance.
     *
     * @param navPublic $navigation
     */
    public function __construct(navItems $navigation)
    {
        $this->navigation = $navigation;
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

    public function logoTitle(){
        return  config('app.name', 'Verejná správa');
    }

    public function logoUrl(){
        return route('home.index');
    }

//    public function logoTitle(){
//        return  auth()->user()->full_name();
//    }
//
//    public function logoUrl(){
//        return route('user.home', [auth()->user()->id, auth()->user()->slug]);
//    }


    public function headerMenu(){
        return [
//            $this->navigation->userProfil(),
//            $this->navigation->spat(),
        ];
    }
}
