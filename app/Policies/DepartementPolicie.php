<?php

namespace App\Policies;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartementPolicie
{
    use HandlesAuthorization;

    /**
     * Determine whether the departement can view any models.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( User $user)
    {
        return $user->can('view_any_departement');
    }

    /**
     * Determine whether the departement can view the model.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( User $user)
    {
        return $user->can('view_departement');
    }

    /**
     * Determine whether the departement can create models.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( User $user)
    {
        return $user->can('create_departement');
    }

    /**
     * Determine whether the departement can update the model.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( User $user)
    {
        return $user->can('update_departement');
    }

    /**
     * Determine whether the departement can delete the model.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( User $user)
    {
        return $user->can('delete_departement');
    }

    /**
     * Determine whether the departement can bulk delete.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny( User $user)
    {
        return $user->can('delete_any_departement');
    }

    /**
     * Determine whether the departement can permanently delete.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete( User $user)
    {
        return $user->can('force_delete_departement');
    }

    /**
     * Determine whether the departement can permanently bulk delete.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny( User $user)
    {
        return $user->can('force_delete_any_departement');
    }

    /**
     * Determine whether the departement can restore.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( User $user)
    {
        return $user->can('restore_departement');
    }

    /**
     * Determine whether the departement can bulk restore.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny( User $user)
    {
        return $user->can('restore_any_departement');
    }

    /**
     * Determine whether the departement can bulk restore.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate( User $user)
    {
        return $user->can('replicate_departement');
    }

    /**
     * Determine whether the departement can reorder.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder( User $user)
    {
        return $user->can('reorder_departement');
    }
}
