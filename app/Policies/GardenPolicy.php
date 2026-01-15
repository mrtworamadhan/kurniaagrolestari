<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Garden;
use Illuminate\Auth\Access\HandlesAuthorization;

class GardenPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Garden');
    }

    public function view(AuthUser $authUser, Garden $garden): bool
    {
        return $authUser->can('View:Garden');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Garden');
    }

    public function update(AuthUser $authUser, Garden $garden): bool
    {
        return $authUser->can('Update:Garden');
    }

    public function delete(AuthUser $authUser, Garden $garden): bool
    {
        return $authUser->can('Delete:Garden');
    }

    public function restore(AuthUser $authUser, Garden $garden): bool
    {
        return $authUser->can('Restore:Garden');
    }

    public function forceDelete(AuthUser $authUser, Garden $garden): bool
    {
        return $authUser->can('ForceDelete:Garden');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Garden');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Garden');
    }

    public function replicate(AuthUser $authUser, Garden $garden): bool
    {
        return $authUser->can('Replicate:Garden');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Garden');
    }

}