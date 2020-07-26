<?php


namespace App\Services;


class Navigation
{
    protected function isActive($routeName) {
        if( \Route::currentRouteName() === $routeName  ) {
            return 'font-semibold text-white underline';
        }
        return 'text-teal-200';
    }

//    Organization
    public function zverejnovanie($id, $slug){
       return [
            'title' => 'Zverejňovanie',
            'url' => route('org.post.index', [$id, $slug]),
            'active' => $this->isActive('org.post.index')
        ];
    }

    public function contacts($id, $slug){
        return [
            'title' => 'Kontakty',
            'url' => route('contact.index'),
            'active' => $this->isActive('contact.index')
        ];
    }

    public function orders($id, $slug){
        return [
            'title' => 'Objednávky',
            'url' => route('order.index', [$id, $slug]),
            'active' => $this->isActive('order.index')
        ];
    }

    public function councils($id, $slug){
        return [
            'title' => 'Zastupiteľstva',
            'url' => route('zast.index', [$id, $slug]),
            'active' => $this->isActive('zast.index')
        ];
    }

    public function navody($id, $slug){
        return [
            'title' => 'Návody',
            'url' => route('question.index', [auth()->user()->id, auth()->user()->slug]),
            'active' => $this->isActive('question.index')
        ];
    }
// User
    public function userProfil(){
        return [
            'title' => 'Profil',
            'url' => route('user.edit', [auth()->user()->id, auth()->user()->slug]),
            'active' => $this->isActive('user.edit')
        ];
    }

    public function spat(){
        return [
            'title' => 'Späť',
            'url' => route('org.index', [auth()->user()->id, auth()->user()->slug]),
            'active' => $this->isActive('')
        ];
    }



}
