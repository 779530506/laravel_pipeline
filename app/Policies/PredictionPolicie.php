<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Prediction;

class PredictionPolicie
{
    use HandlesAuthorization;

    /**
     * Determine whether the prediction can view any models.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( User $user)
    {
        return $user->can('view_any_prediction');
    }

    /**
     * Determine whether the prediction can view the model.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( User $user)
    {
        return $user->can('view_prediction');
    }

    /**
     * Determine whether the prediction can create models.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( User $user)
    {
        return $user->can('create_prediction');
    }

    /**
     * Determine whether the prediction can update the model.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( User $user)
    {
        return $user->can('update_prediction');
    }

    /**
     * Determine whether the prediction can delete the model.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( User $user)
    {
        return $user->can('delete_prediction');
    }

    /**
     * Determine whether the prediction can bulk delete.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny( User $user)
    {
        return $user->can('delete_any_prediction');
    }

    /**
     * Determine whether the prediction can permanently delete.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete( User $user)
    {
        return $user->can('force_delete_prediction');
    }

    /**
     * Determine whether the prediction can permanently bulk delete.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny( User $user)
    {
        return $user->can('force_delete_any_prediction');
    }

    /**
     * Determine whether the prediction can restore.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( User $user)
    {
        return $user->can('restore_prediction');
    }

    /**
     * Determine whether the prediction can bulk restore.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny( User $user)
    {
        return $user->can('restore_any_prediction');
    }

    /**
     * Determine whether the prediction can bulk restore.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate( User $user)
    {
        return $user->can('replicate_prediction');
    }

    /**
     * Determine whether the prediction can reorder.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder( User $user)
    {
        return $user->can('reorder_prediction');
    }
}
