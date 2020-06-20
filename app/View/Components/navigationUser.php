<?php

namespace App\View\Components;

use Illuminate\View\Component;

class navigationUser extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

    public function logoTitle(){
        return  auth()->user()->full_name();
    }

    public function logoUrl(){
        return route('user.home', [auth()->user()->id, auth()->user()->slug]);
    }


    public function headerMenu(){

        $nav = new \App\Services\Navigation();
        return [
            $nav->userProfil(),
            $nav->spat(),
        ];
    }
}
