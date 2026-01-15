<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LandAnalysisRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class LandAnalysisRequestPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LandAnalysisRequest');
    }

    public function view(AuthUser $authUser, LandAnalysisRequest $landAnalysisRequest): bool
    {
        return $authUser->can('View:LandAnalysisRequest');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LandAnalysisRequest');
    }

    public function update(AuthUser $authUser, LandAnalysisRequest $landAnalysisRequest): bool
    {
        return $authUser->can('Update:LandAnalysisRequest');
    }

    public function delete(AuthUser $authUser, LandAnalysisRequest $landAnalysisRequest): bool
    {
        return $authUser->can('Delete:LandAnalysisRequest');
    }

    public function restore(AuthUser $authUser, LandAnalysisRequest $landAnalysisRequest): bool
    {
        return $authUser->can('Restore:LandAnalysisRequest');
    }

    public function forceDelete(AuthUser $authUser, LandAnalysisRequest $landAnalysisRequest): bool
    {
        return $authUser->can('ForceDelete:LandAnalysisRequest');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LandAnalysisRequest');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LandAnalysisRequest');
    }

    public function replicate(AuthUser $authUser, LandAnalysisRequest $landAnalysisRequest): bool
    {
        return $authUser->can('Replicate:LandAnalysisRequest');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LandAnalysisRequest');
    }

}