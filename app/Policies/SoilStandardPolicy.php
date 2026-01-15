<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SoilStandard;
use Illuminate\Auth\Access\HandlesAuthorization;

class SoilStandardPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SoilStandard');
    }

    public function view(AuthUser $authUser, SoilStandard $soilStandard): bool
    {
        return $authUser->can('View:SoilStandard');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SoilStandard');
    }

    public function update(AuthUser $authUser, SoilStandard $soilStandard): bool
    {
        return $authUser->can('Update:SoilStandard');
    }

    public function delete(AuthUser $authUser, SoilStandard $soilStandard): bool
    {
        return $authUser->can('Delete:SoilStandard');
    }

    public function restore(AuthUser $authUser, SoilStandard $soilStandard): bool
    {
        return $authUser->can('Restore:SoilStandard');
    }

    public function forceDelete(AuthUser $authUser, SoilStandard $soilStandard): bool
    {
        return $authUser->can('ForceDelete:SoilStandard');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SoilStandard');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SoilStandard');
    }

    public function replicate(AuthUser $authUser, SoilStandard $soilStandard): bool
    {
        return $authUser->can('Replicate:SoilStandard');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SoilStandard');
    }

}