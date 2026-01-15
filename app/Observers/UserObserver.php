<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saved(User $user): void
    {
        if ($user->roles()->exists()) {
            $roleName = $user->getRoleNames()->first();

            if ($user->role !== $roleName) {
                \DB::table('users')
                    ->where('id', $user->id)
                    ->update(['role' => $roleName]);
            }
        }
    }
}