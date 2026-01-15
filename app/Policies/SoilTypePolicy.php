<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SoilType;
use Illuminate\Auth\Access\HandlesAuthorization;

class SoilTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SoilType');
    }

    public function view(AuthUser $authUser, SoilType $soilType): bool
    {
        return $authUser->can('View:SoilType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SoilType');
    }

    public function update(AuthUser $authUser, SoilType $soilType): bool
    {
        return $authUser->can('Update:SoilType');
    }

    public function delete(AuthUser $authUser, SoilType $soilType): bool
    {
        return $authUser->can('Delete:SoilType');
    }

    public function restore(AuthUser $authUser, SoilType $soilType): bool
    {
        return $authUser->can('Restore:SoilType');
    }

    public function forceDelete(AuthUser $authUser, SoilType $soilType): bool
    {
        return $authUser->can('ForceDelete:SoilType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SoilType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SoilType');
    }

    public function replicate(AuthUser $authUser, SoilType $soilType): bool
    {
        return $authUser->can('Replicate:SoilType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SoilType');
    }

}