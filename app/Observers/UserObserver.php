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
    }

    public function created(User $user)
    {
        User::first()->notify(new NewUserCreated($user));
        $this->addTag($user);
    }

    public function updated(User $user)
    {
        $this->addTag($user);
    }

    // Vytvorením usera alebo update sa vytvorí Tag z employment collumn
    private function addTag($user)
    {
        // If Employment is empty.
        if($user->employment == '') return ;

        // If Tag slug exist.
        if (! $user->organization->tags()->whereSlug(Str::slug($user->employment, '-'))->first()) {
            $tag = $user->organization->tags()->create([
                'name' => $user->employment,
                'slug' => Str::slug($user->employment, '-')
            ]);

            $user->tags()->attach($tag->id);
        }
    }
}
