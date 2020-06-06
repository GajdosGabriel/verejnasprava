<?php

namespace App\View\Components;

use App\Models\Organization;
use Illuminate\View\Component;

class navigationOrganization extends Component
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


    public function headerMenu(){
        return [
            [
                'title' => 'Zverejňovanie',
                'url' => route('org.post.index', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Kontakty',
                'url' => route('org.contact.index', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Objednávky',
                'url' => route('order.index', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Zastupiteľstva',
                'url' => route('zast.index', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Návody',
                'url' => route('question.index', [auth()->user()->id, auth()->user()->slug ])
            ]
        ];
    }


    public function dropDownItems(){
        return [
            [
                'title' => 'Nastavenia',
                'url' => route('org.edit', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Ľudia',
                'url' => route('user.index', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Objednávky',
                'url' => route('order.index', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Zastupiteľstva',
                'url' => route('zast.admin.index', [$this->object->id, $this->object->slug ])
            ],
            [
                'title' => 'Návody',
                'url' => route('question.index', [auth()->user()->id, auth()->user()->slug ])
            ]
        ];
    }
}
