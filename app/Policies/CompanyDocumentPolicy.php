<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CompanyDocument;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyDocumentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CompanyDocument');
    }

    public function view(AuthUser $authUser, CompanyDocument $companyDocument): bool
    {
        return $authUser->can('View:CompanyDocument');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CompanyDocument');
    }

    public function update(AuthUser $authUser, CompanyDocument $companyDocument): bool
    {
        return $authUser->can('Update:CompanyDocument');
    }

    public function delete(AuthUser $authUser, CompanyDocument $companyDocument): bool
    {
        return $authUser->can('Delete:CompanyDocument');
    }

    public function restore(AuthUser $authUser, CompanyDocument $companyDocument): bool
    {
        return $authUser->can('Restore:CompanyDocument');
    }

    public function forceDelete(AuthUser $authUser, CompanyDocument $companyDocument): bool
    {
        return $authUser->can('ForceDelete:CompanyDocument');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CompanyDocument');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CompanyDocument');
    }

    public function replicate(AuthUser $authUser, CompanyDocument $companyDocument): bool
    {
        return $authUser->can('Replicate:CompanyDocument');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CompanyDocument');
    }

}