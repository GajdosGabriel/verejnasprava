<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Services\Navigation;
class navigationUser extends Component
{
    public $navigation;

    /**
     * Create a new component instance.
     *
     * @param Navigation $navigation
     */
    public function __construct(Navigation $navigation)
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
        return view('components.navigation');
    }

    public function logoTitle(){
        return  auth()->user()->full_name();
    }

    public function logoUrl(){
        return route('user.home', [auth()->user()->id, auth()->user()->slug]);
    }


    public function headerMenu(){
        return [
            $this->navigation->userProfil(),
            $this->navigation->spat(),
        ];
    }
}
