<?php

namespace App\View\Components;

use Illuminate\View\Component;

class navigation extends Component
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
        return  config('app.name', 'Verejná správa');
    }

    public function logoUrl(){
        return route('home.index');
    }

    public function headerMenu(){
        return [
            [
                'title' => 'Zverejňovanie',
                'url' => route('home.zverejnovanie')
            ],
            [
                'title' => 'Kontakt',
                'url' => route('home.contact')
            ],
            [
                'title' => 'Login',
                'url' => url('/login')
            ],
            [
                'title' => 'Registrácia',
                'url' => url('/register')
            ]
        ];
    }
}
