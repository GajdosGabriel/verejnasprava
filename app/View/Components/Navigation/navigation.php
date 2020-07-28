<?php

namespace App\View\Components\Navigation;

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
        return view('components.navigation.navigation');
    }

    public function logoTitle(){
        return  config('app.name', 'Verejná správa');
    }

    public function logoUrl(){
        return route('home.index');
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
                'title' => 'Zverejňovanie',
                'url' => route('home.zverejnovanie'),
                'active' => $this->isActive('home.zverejnovanie')
            ],
            [
                'title' => 'Kontakt',
                'url' => route('home.contact'),
                'active' => $this->isActive('home.contact')
            ],
            [
                'title' => 'Login',
                'url' => url('/login'),
                'active' => $this->isActive('login')
            ],
            [
                'title' => 'Registrácia',
                'url' => url('/register'),
                'active' => $this->isActive('register')
            ]
        ];
    }
}
