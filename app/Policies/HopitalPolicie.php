<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Hopital;
use Illuminate\Auth\Access\HandlesAuthorization;

class HopitalPolicie
{
    use HandlesAuthorization;

    /**
     * Determine whether the hopital can view any models.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( User $user)
    {
        return $user->can('view_any_hopital');
    }

    /**
     * Determine whether the hopital can view the model.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( User $user)
    {
        return $user->can('view_hopital');
    }

    /**
     * Determine whether the hopital can create models.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( User $user)
    {
        return $user->can('create_hopital');
    }

    /**
     * Determine whether the hopital can update the model.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( User $user)
    {
        return $user->can('update_hopital');
    }

    /**
     * Determine whether the hopital can delete the model.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( User $user)
    {
        return $user->can('delete_hopital');
    }

    /**
     * Determine whether the hopital can bulk delete.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny( User $user)
    {
        return $user->can('delete_any_hopital');
    }

    /**
     * Determine whether the hopital can permanently delete.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete( User $user)
    {
        return $user->can('force_delete_hopital');
    }

    /**
     * Determine whether the hopital can permanently bulk delete.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny( User $user)
    {
        return $user->can('force_delete_any_hopital');
    }

    /**
     * Determine whether the hopital can restore.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( User $user)
    {
        return $user->can('restore_hopital');
    }

    /**
     * Determine whether the hopital can bulk restore.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny( User $user)
    {
        return $user->can('restore_any_hopital');
    }

    /**
     * Determine whether the hopital can bulk restore.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate( User $user)
    {
        return $user->can('replicate_hopital');
    }

    /**
     * Determine whether the hopital can reorder.
     *
     * @param  \App\Models\Hopital  $hopital
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder( User $user)
    {
        return $user->can('reorder_hopital');
    }
}
