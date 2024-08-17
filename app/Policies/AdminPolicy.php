<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(Admin $user): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin): bool
    {
        return $admin->hasAnyPermission('show_admins');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasAnyPermission('add_admins');

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin): bool
    {
        return $admin->hasAnyPermission('update_admins');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        return $admin->hasAnyPermission('delete_admins');

    }
    public function manage(Admin $admin)
{
    return $admin->can('show_admins') && $admin->can('edit_admins') && $admin->can('add_admins');
}

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Admin $admin): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Admin $admin): bool
    // {
    //     //
    // }

}
