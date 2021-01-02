<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy
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
        return $user->can('list stores');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Store  $store
     * @return mixed
     */
    public function view(User $user, Store $store)
    {
        if ($user->can('show stores')) return true;
        return $user->id === $store->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create stores');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Store  $store
     * @return mixed
     */
    public function update(User $user, Store $store)
    {
        if ($user->can('update own stores')) {
            return $user->id === $store->user_id;
        }
        return $user->can('update stores');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Store  $store
     * @return mixed
     */
    public function delete(User $user, Store $store)
    {
        if ($user->can('delete own stores')) {
            return $user->id === $store->user_id;
        }

        return $user->can('delete stores');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Store  $store
     * @return mixed
     */
    public function restore(User $user, Store $store)
    {
        if ($user->can('restore own stores')) {
            return $user->id === $store->user_id;
        }

        return $user->can('restore stores');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Store  $store
     * @return mixed
     */
    public function forceDelete(User $user, Store $store)
    {
        //
    }
}
