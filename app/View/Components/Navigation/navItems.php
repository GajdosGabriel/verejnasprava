<?php


namespace App\View\Components\Navigation;


class navItems
{
    protected function isActive($routeName)
    {
        if (\Route::currentRouteName() === $routeName) {
            return 'font-semibold text-white underline';
        }
        return 'text-teal-200';
    }

//    Organization
    public function zverejnovanie()
    {
        return [
            'title' => 'Zverejňovanie',
            'url' => route('post.index'),
            'active' => $this->isActive('post.index')
        ];
    }

    public function contacts()
    {
        return [
            'title' => 'Kontakty',
            'url' => route('contact.index'),
            'active' => $this->isActive('contact.index')
        ];
    }

    public function orders($id, $slug)
    {
        if(auth()->user()->hasPermissionTo('delete'))
        return [
            'title' => 'Objednávky',
            'url' => route('order.index'),
            'active' => $this->isActive('order.index')
        ];
    }

    public function councils($id, $slug)
    {
        if(auth()->user()->hasPermissionTo('delete'))
        return [
            'title' => 'Zastupiteľstva',
            'url' => route('zast.index'),
            'active' => $this->isActive('zast.index')
        ];
    }

    public function tasks()
    {
        if(auth()->user()->hasPermissionTo('delete'))
        return [
            'title' => 'Úlohy',
            'url' => route('task.index'),
            'active' => $this->isActive('task.index')
        ];
    }

    public function navody()
    {
        return [
            'title' => 'Návody',
            'url' => route('question.index'),
            'active' => $this->isActive('question.index')
        ];
    }

// User
    public function userProfil()
    {
        return [
            'title' => 'Profil',
            'url' => route('user.edit', [auth()->user()->id, auth()->user()->slug]),
            'active' => $this->isActive('user.edit')
        ];
    }

    public function spat()
    {
        return [
            'title' => 'Späť',
            'url' => route('org.index', [auth()->user()->id, auth()->user()->slug]),
            'active' => $this->isActive('')
        ];
    }


}
