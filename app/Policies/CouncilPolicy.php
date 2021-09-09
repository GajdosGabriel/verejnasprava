<?php

namespace App\Policies;

use App\Models\Council\Council;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouncilPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return auth()->user();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Council  $council
     * @return mixed
     */
    public function view(User $user, Council $council)
    {
        return $user->active_organization == $council->organization_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // return auth()->user();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Council  $council
     * @return mixed
     */
    public function update(User $user, Council $council)
    {
        return $user->active_organization == $council->organization_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Council  $council
     * @return mixed
     */
    public function delete(User $user, Council $council)
    {
        return $user->active_organization == $council->organization_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Council  $council
     * @return mixed
     */
    public function restore(User $user, Council $council)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Council  $council
     * @return mixed
     */
    public function forceDelete(User $user, Council $council)
    {
        //
    }
}
