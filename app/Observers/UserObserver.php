<?php

namespace App\Observers;


use App\Models\User;
use App\Notifications\User\NewUserCreated;
use Illuminate\Support\Str;

class UserObserver
{

    public function saving(User $user)
    {
        $user->slug = Str::slug($user->first_name .' '.$user->last_name, '-');
        $this->addTag($user);
    }

    public function created(User $user)
    {
        User::first()->notify(new NewUserCreated($user));
    }

    // Vytvorením usera alebo update sa vytvorí Tag z employment collumn
    private function addTag($user)
    {
        if(! $user->organization->tags()->whereSlug(Str::slug($user->employment, '-'))->first()){
            $user->organization->tags()->create( [
                'name' => $user->employment,
                'slug' => Str::slug($user->employment, '-'),
            ]);

        }

    }


}
