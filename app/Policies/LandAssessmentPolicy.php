<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LandAssessment;
use Illuminate\Auth\Access\HandlesAuthorization;

class LandAssessmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LandAssessment');
    }

    public function view(AuthUser $authUser, LandAssessment $landAssessment): bool
    {
        return $authUser->can('View:LandAssessment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LandAssessment');
    }

    public function update(AuthUser $authUser, LandAssessment $landAssessment): bool
    {
        return $authUser->can('Update:LandAssessment');
    }

    public function delete(AuthUser $authUser, LandAssessment $landAssessment): bool
    {
        return $authUser->can('Delete:LandAssessment');
    }

    public function restore(AuthUser $authUser, LandAssessment $landAssessment): bool
    {
        return $authUser->can('Restore:LandAssessment');
    }

    public function forceDelete(AuthUser $authUser, LandAssessment $landAssessment): bool
    {
        return $authUser->can('ForceDelete:LandAssessment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LandAssessment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LandAssessment');
    }

    public function replicate(AuthUser $authUser, LandAssessment $landAssessment): bool
    {
        return $authUser->can('Replicate:LandAssessment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LandAssessment');
    }

}