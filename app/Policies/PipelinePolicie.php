<?php

namespace App\Policies;

use App\Models\Pipeline;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PipelinePolicie
{
    use HandlesAuthorization;

    /**
     * Determine whether the pipeline can view any models.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( User $user)
    {
        return $user->can('view_any_pipeline');
    }

    /**
     * Determine whether the pipeline can view the model.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( User $user)
    {
        return $user->can('view_pipeline');
    }

    /**
     * Determine whether the pipeline can create models.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( User $user)
    {
        return $user->can('create_pipeline');
    }

    /**
     * Determine whether the pipeline can update the model.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( User $user)
    {
        return $user->can('update_pipeline');
    }

    /**
     * Determine whether the pipeline can delete the model.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( User $user)
    {
        return $user->can('delete_pipeline');
    }

    /**
     * Determine whether the pipeline can bulk delete.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny( User $user)
    {
        return $user->can('delete_any_pipeline');
    }

    /**
     * Determine whether the pipeline can permanently delete.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete( User $user)
    {
        return $user->can('force_delete_pipeline');
    }

    /**
     * Determine whether the pipeline can permanently bulk delete.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny( User $user)
    {
        return $user->can('force_delete_any_pipeline');
    }

    /**
     * Determine whether the pipeline can restore.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( User $user)
    {
        return $user->can('restore_pipeline');
    }

    /**
     * Determine whether the pipeline can bulk restore.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny( User $user)
    {
        return $user->can('restore_any_pipeline');
    }

    /**
     * Determine whether the pipeline can bulk restore.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate( User $user)
    {
        return $user->can('replicate_pipeline');
    }

    /**
     * Determine whether the pipeline can reorder.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder( User $user)
    {
        return $user->can('reorder_pipeline');
    }
}
